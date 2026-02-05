<?php
/**
 * Performance Logger - Request & Query Profiling
 * 
 * A comprehensive logging solution to identify slow queries and performance bottlenecks.
 * 
 * Enable by setting GROWTYPE_PERFORMANCE_LOG=true in your .env file
 * Logs are written to: web/app/performance.log
 * 
 * Features:
 * - SQL query logging with execution time
 * - Request timing and memory usage
 * - Slow query highlighting (>50ms)
 * - Duplicate query detection
 * - Per-request summary
 */

// Only activate when explicitly enabled
if (!filter_var(getenv('GROWTYPE_PERFORMANCE_LOG'), FILTER_VALIDATE_BOOLEAN)) {
    return;
}

class Growtype_Performance_Logger
{
    private static $instance = null;
    private $queries = [];
    private $start_time;
    private $start_memory;
    private $log_file;
    private $request_id;
    private $slow_query_threshold = 0.05; // 50ms
    private $enabled = true;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->start_time = microtime(true);
        $this->start_memory = memory_get_usage(true);
        $this->request_id = substr(md5(uniqid()), 0, 8);
        $this->log_file = ABSPATH . '../app/performance.log';

        // Hook into WordPress query logging
        add_filter('query', [$this, 'log_query_start'], 1);
        
        // Use SAVEQUERIES for detailed timing
        if (!defined('SAVEQUERIES')) {
            define('SAVEQUERIES', true);
        }

        // Log summary at shutdown
        add_action('shutdown', [$this, 'log_summary'], 9999);

        // Log AJAX requests specifically
        add_action('wp_ajax_nopriv_*', [$this, 'mark_ajax'], 1);
        add_action('wp_ajax_*', [$this, 'mark_ajax'], 1);
    }

    public function log_query_start($query)
    {
        if (!$this->enabled) {
            return $query;
        }

        // Store query with start time for later analysis
        $this->queries[] = [
            'query' => $query,
            'start' => microtime(true),
            'backtrace' => $this->get_simplified_backtrace()
        ];

        return $query;
    }

    private function get_simplified_backtrace()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 20);
        $simplified = [];

        foreach ($backtrace as $trace) {
            // Skip internal WordPress and this class
            if (isset($trace['file'])) {
                $file = str_replace(ABSPATH, '', $trace['file']);
                
                // Only include app-related files (plugins/themes)
                if (strpos($file, 'app/plugins/') !== false || strpos($file, 'app/themes/') !== false) {
                    $func = '';
                    if (isset($trace['function']) && !in_array($trace['function'], ['query', 'get_results', 'get_row', 'get_var', 'insert', 'update', 'delete'])) {
                        $func = isset($trace['class']) ? $trace['class'] . $trace['type'] . $trace['function'] : $trace['function'];
                        $func = ' (' . $func . ')';
                    }
                    $simplified[] = basename($file) . ':' . ($trace['line'] ?? '?') . $func;
                    if (count($simplified) >= 5) break;
                }
            }
        }

        return implode(' < ', $simplified);
    }

    public function mark_ajax()
    {
        // Mark this as an AJAX request for clearer logging
        $this->request_id .= '-AJAX';
    }

    public function log_summary()
    {
        if (!$this->enabled) {
            return;
        }

        global $wpdb;

        $end_time = microtime(true);
        $total_time = round(($end_time - $this->start_time) * 1000, 2);
        $peak_memory = memory_get_peak_usage(true);
        $memory_used = $peak_memory - $this->start_memory;

        // Get actual query times from WordPress
        $query_data = [];
        $total_query_time = 0;
        $slow_queries = [];
        $query_counts = [];

        if (isset($wpdb->queries) && is_array($wpdb->queries)) {
            foreach ($wpdb->queries as $index => $q) {
                $sql = $q[0];
                $time = $q[1];
                $caller = $q[2] ?? '';
                
                $total_query_time += $time;

                // Track duplicate queries
                $sql_hash = md5($sql);
                if (!isset($query_counts[$sql_hash])) {
                    $query_counts[$sql_hash] = ['count' => 0, 'sql' => $sql, 'total_time' => 0, 'callers' => []];
                }
                $query_counts[$sql_hash]['count']++;
                $query_counts[$sql_hash]['total_time'] += $time;
                
                // Link backtrace from our captured queries
                if (isset($this->queries[$index]['backtrace'])) {
                    $bt = $this->queries[$index]['backtrace'];
                    if (!in_array($bt, $query_counts[$sql_hash]['callers'])) {
                        $query_counts[$sql_hash]['callers'][] = $bt;
                    }
                }

                // Track slow queries
                if ($time > $this->slow_query_threshold) {
                    $bt = isset($this->queries[$index]['backtrace']) ? $this->queries[$index]['backtrace'] : $this->simplify_caller($caller);
                    $slow_queries[] = [
                        'sql' => $this->truncate_query($sql),
                        'time' => round($time * 1000, 2),
                        'caller' => $bt
                    ];
                }

                $query_data[] = [
                    'sql' => $sql,
                    'time' => $time
                ];
            }
        }

        $total_query_time_ms = round($total_query_time * 1000, 2);
        $query_count = count($query_data);

        // Find duplicate queries
        $duplicates = array_filter($query_counts, function($q) {
            return $q['count'] > 1;
        });

        // Sort duplicates by count
        uasort($duplicates, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        // Build log entry
        $request_url = $_SERVER['REQUEST_URI'] ?? 'CLI';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'CLI';
        
        // Add AJAX action for better context
        if (isset($_REQUEST['action'])) {
            $request_url .= sprintf(' [action: %s]', $_REQUEST['action']);
        }
        
        // Add POST payload summary
        if ($method === 'POST' && !empty($_POST)) {
            $post_data = $_POST;
            foreach (['password', 'nonce', '_wpnonce', 'token'] as $key) {
                if (isset($post_data[$key])) $post_data[$key] = '***';
            }
            $payload = json_encode($post_data);
            if (strlen($payload) > 200) $payload = substr($payload, 0, 200) . '...';
            $request_url .= sprintf(' [payload: %s]', $payload);
        }

        $log_lines = [];
        $log_lines[] = str_repeat('=', 80);
        $log_lines[] = sprintf('[%s] Request ID: %s', date('Y-m-d H:i:s'), $this->request_id);
        $log_lines[] = sprintf('URL: %s %s', $method, $request_url);
        $log_lines[] = str_repeat('-', 80);
        $log_lines[] = sprintf('Total Time: %sms | Query Time: %sms | Queries: %d | Memory: %s',
            $total_time,
            $total_query_time_ms,
            $query_count,
            $this->format_bytes($memory_used)
        );

        // Log slow queries
        if (!empty($slow_queries)) {
            $log_lines[] = '';
            $log_lines[] = '⚠️  SLOW QUERIES (>' . ($this->slow_query_threshold * 1000) . 'ms):';
            foreach (array_slice($slow_queries, 0, 10) as $sq) {
                $log_lines[] = sprintf('  [%sms] %s', $sq['time'], $sq['sql']);
                if ($sq['caller']) {
                    $log_lines[] = sprintf('         Called from: %s', $sq['caller']);
                }
            }
        }

        // Log duplicate queries
        if (!empty($duplicates)) {
            $log_lines[] = '';
            $log_lines[] = '🔄 DUPLICATE QUERIES:';
            foreach (array_slice($duplicates, 0, 10, true) as $hash => $dq) {
                $log_lines[] = sprintf('  [x%d, %sms total] %s',
                    $dq['count'],
                    round($dq['total_time'] * 1000, 2),
                    $this->truncate_query($dq['sql'])
                );
                
                foreach (array_slice($dq['callers'], 0, 3) as $caller) {
                    $log_lines[] = sprintf('         Called from: %s', $caller);
                }
            }
        }

        // Performance rating
        $log_lines[] = '';
        $rating = $this->get_performance_rating($total_time, $query_count, count($slow_queries));
        $log_lines[] = sprintf('Performance Rating: %s', $rating);

        $log_lines[] = str_repeat('=', 80);
        $log_lines[] = '';

        // Write to log file
        $log_content = implode("\n", $log_lines);
        
        // Verbose query logging if requested via ?debug_perf=1
        if (isset($_REQUEST['debug_perf']) || $query_count > 150) {
            $verbose_log = ["\n[VERBOSE QUERY LOG for Request $this->request_id]"];
            if (isset($wpdb->queries) && is_array($wpdb->queries)) {
                foreach ($wpdb->queries as $index => $q) {
                    $verbose_log[] = sprintf("  #%d [%sms] %s", $index, round($q[1] * 1000, 2), $this->truncate_query($q[0], 200));
                    $verbose_log[] = sprintf("     %s", $this->queries[$index]['backtrace'] ?? 'Unknown caller');
                }
            }
            $verbose_log[] = "[END VERBOSE LOG]\n";
            $log_content .= implode("\n", $verbose_log);
        }

        file_put_contents($this->log_file, $log_content, FILE_APPEND | LOCK_EX);

    }

    private function truncate_query($sql, $length = 120)
    {
        $sql = preg_replace('/\s+/', ' ', trim($sql));
        if (strlen($sql) > $length) {
            return substr($sql, 0, $length) . '...';
        }
        return $sql;
    }

    private function simplify_caller($caller)
    {
        // Extract meaningful function/method names
        if (preg_match('/([a-zA-Z_]+::[a-zA-Z_]+)/', $caller, $matches)) {
            return $matches[1];
        }
        if (preg_match('/([a-zA-Z_]+)\(/', $caller, $matches)) {
            return $matches[1];
        }
        return substr($caller, 0, 80);
    }

    private function format_bytes($bytes)
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . 'MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 2) . 'KB';
        }
        return $bytes . 'B';
    }

    private function get_performance_rating($total_time, $query_count, $slow_count)
    {
        $score = 100;

        // Time penalties
        if ($total_time > 3000) $score -= 40;
        elseif ($total_time > 1500) $score -= 25;
        elseif ($total_time > 500) $score -= 10;

        // Query count penalties
        if ($query_count > 200) $score -= 30;
        elseif ($query_count > 100) $score -= 15;
        elseif ($query_count > 50) $score -= 5;

        // Slow query penalties
        $score -= $slow_count * 5;

        $score = max(0, $score);

        if ($score >= 90) return "🟢 Excellent ($score/100)";
        if ($score >= 70) return "🟡 Good ($score/100)";
        if ($score >= 50) return "🟠 Needs Optimization ($score/100)";
        return "🔴 Poor ($score/100)";
    }

    /**
     * Disable logging temporarily (for batch operations)
     */
    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * Re-enable logging
     */
    public function enable()
    {
        $this->enabled = true;
    }
}

// Initialize the logger
Growtype_Performance_Logger::instance();

/**
 * Helper function to manually log performance checkpoints
 */
if (!function_exists('growtype_perf_checkpoint')) {
    function growtype_perf_checkpoint($label = 'Checkpoint')
    {
        static $last_time = null;
        static $start_time = null;

        if ($start_time === null) {
            $start_time = microtime(true);
        }

        $now = microtime(true);
        $since_start = round(($now - $start_time) * 1000, 2);
        $since_last = $last_time ? round(($now - $last_time) * 1000, 2) : 0;
        $last_time = $now;

        $log_message = sprintf(
            "[%s] Growtype Perf Checkpoint [%s]: %sms since start, %sms since last, Memory: %s\n",
            date('Y-m-d H:i:s'),
            $label,
            $since_start,
            $since_last,
            round(memory_get_usage(true) / 1048576, 2) . 'MB'
        );

        $log_file = ABSPATH . '../app/performance.log';
        file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
    }
}
