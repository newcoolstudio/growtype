<!doctype html>
<html {!! get_language_attributes() !!} data-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex">
  <title>Growtype Documentation</title>
  <link rel="stylesheet" href="@php echo dirname(get_template_directory_uri()) . '/public/styles/app.css'; @endphp">
  <link rel="stylesheet" href="@php echo includes_url('css/dashicons.min.css'); @endphp">
</head>

<body class="documentation-page" role="document">

<style>
  :root[data-theme="dark"] {
    --doc-bg: #0f1117;
    --doc-header-bg: #161b22;
    --doc-header-border: rgba(255,255,255,0.06);
    --doc-text: #e1e4e8;
    --doc-text-muted: #8b949e;
    --doc-link: #58a6ff;
    --doc-nav-hover: rgba(255,255,255,0.05);
    --doc-nav-active: rgba(88,166,255,0.12);
    --doc-section-bg: #161b22;
    --doc-section-border: rgba(255,255,255,0.06);
  }
  :root[data-theme="light"] {
    --doc-bg: #f6f8fa;
    --doc-header-bg: #ffffff;
    --doc-header-border: #e1e4e8;
    --doc-text: #24292f;
    --doc-text-muted: #57606a;
    --doc-link: #0969da;
    --doc-nav-hover: rgba(0,0,0,0.04);
    --doc-nav-active: rgba(9,105,218,0.08);
    --doc-section-bg: #ffffff;
    --doc-section-border: #e1e4e8;
  }

  body.documentation-page {
    background: var(--doc-bg);
    /* color: var(--doc-text); */
    margin: 0;
    padding: 0;
  }

  /* Header */
  .doc-header {
    background: var(--doc-header-bg);
    border-bottom: 1px solid var(--doc-header-border);
    position: sticky;
    top: 0;
    z-index: 100;
    padding: 0 24px;
  }
  .doc-header-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 56px;
  }
  .doc-header-left {
    display: flex;
    align-items: center;
    gap: 32px;
  }
  .doc-logo {
    font-size: 18px;
    font-weight: 700;
    color: var(--doc-text);
    text-decoration: none;
    white-space: nowrap;
  }
  .doc-logo:hover {
    color: var(--doc-link);
    text-decoration: none;
  }

  /* Nav */
  .doc-nav {
    display: flex;
    align-items: center;
    gap: 4px;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  .doc-nav a {
    display: block;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: var(--doc-text-muted);
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
  }
  .doc-nav a:hover {
    background: var(--doc-nav-hover);
    color: var(--doc-text);
    text-decoration: none;
  }
  .doc-nav a.active {
    background: var(--doc-nav-active);
    color: var(--doc-link);
  }

  /* Theme toggle */
  .doc-header-right {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .doc-theme-toggle {
    background: none;
    border: 1px solid var(--doc-header-border);
    border-radius: 8px;
    padding: 6px 10px;
    cursor: pointer;
    color: var(--doc-text-muted);
    font-size: 18px;
    line-height: 1;
    transition: background 0.15s, color 0.15s;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .doc-theme-toggle:hover {
    background: var(--doc-nav-hover);
    color: var(--doc-text);
  }
  .doc-theme-toggle .theme-label {
    font-size: 12px;
    font-weight: 500;
  }

  /* Intro */
  .doc-intro {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--doc-header-border);
  }
  .doc-intro h1 {
    font-size: 32px;
    font-weight: 700;
    color: var(--doc-text);
    margin: 0 0 8px;
  }
  .doc-intro p {
    font-size: 16px;
    color: var(--doc-text-muted);
    margin: 0;
  }

  /* Content wrapper */
  .doc-content-wrapper {
    max-width: 1400px;
    margin: 0 auto;
    padding: 30px 15px;
    min-height: calc(100vh - 56px);
  }
</style>

<header class="doc-header">
  <div class="doc-header-inner">
    <div class="doc-header-left">
      <a href="/growtype/documentation" class="doc-logo">📚 Growtype Docs</a>
      <nav>
        <ul class="doc-nav">
          <li><a href="/growtype/documentation" id="nav-home">Home</a></li>
          <li><a href="/growtype/documentation/style-guide" id="nav-style-guide">Style Guide</a></li>
          <li><a href="/growtype/documentation/icons" id="nav-icons">Icons</a></li>
        </ul>
      </nav>
    </div>
    <div class="doc-header-right">
      <button class="doc-theme-toggle" id="child-theme-toggle" title="Toggle child theme styles">
        <span class="theme-icon">🎨</span>
        <span class="theme-label">Child: Off</span>
      </button>
      <button class="doc-theme-toggle" id="theme-toggle" title="Toggle theme">
        <span class="theme-icon">🌙</span>
        <span class="theme-label">Dark</span>
      </button>
    </div>
  </div>
</header>

<div class="doc-content-wrapper">
  @hasSection('intro')
    <div class="doc-intro">
      @yield('intro')
    </div>
  @endif
  @yield('content')
</div>

<script>
  (function() {
    // Theme toggle (light/dark)
    var toggle = document.getElementById('theme-toggle');
    var html = document.documentElement;
    var icon = toggle.querySelector('.theme-icon');
    var label = toggle.querySelector('.theme-label');

    var saved = localStorage.getItem('growtype_doc_theme') || 'dark';
    html.setAttribute('data-theme', saved);
    updateThemeToggle(saved);

    toggle.addEventListener('click', function() {
      var current = html.getAttribute('data-theme');
      var next = current === 'dark' ? 'light' : 'dark';
      html.setAttribute('data-theme', next);
      localStorage.setItem('growtype_doc_theme', next);
      updateThemeToggle(next);
    });

    function updateThemeToggle(theme) {
      icon.textContent = theme === 'dark' ? '🌙' : '☀️';
      label.textContent = theme === 'dark' ? 'Dark' : 'Light';
    }

    // Child theme toggle
    var childToggle = document.getElementById('child-theme-toggle');
    var childIcon = childToggle.querySelector('.theme-icon');
    var childLabel = childToggle.querySelector('.theme-label');
    var childCssUrl = '@php echo dirname(get_stylesheet_directory_uri()) . "/public/styles/app-child.css"; @endphp';
    
    @php
      ob_start();
      growtype_customizer_general_css();
      $customizer_css = ob_get_clean();
    @endphp
    var childCustomizerHtml = {!! json_encode($customizer_css) !!};

    var childSaved = localStorage.getItem('growtype_doc_child_theme') === 'on';
    applyChildTheme(childSaved);

    childToggle.addEventListener('click', function() {
      // Toggle logic based on presence of the link element
      var isOn = !!document.getElementById('child-theme-css');
      applyChildTheme(!isOn);
      localStorage.setItem('growtype_doc_child_theme', !isOn ? 'on' : 'off');
    });

    function applyChildTheme(on) {
      var existingLink = document.getElementById('child-theme-css');
      var existingCustomizer = document.getElementById('child-customizer-css');
      
      if (on) {
        // Add Child CSS Link
        if (!existingLink) {
          var link = document.createElement('link');
          link.rel = 'stylesheet';
          link.href = childCssUrl;
          link.id = 'child-theme-css';
          document.head.appendChild(link);
        }
        // Add Customizer CSS
        if (!existingCustomizer && childCustomizerHtml) {
          var cssContent = childCustomizerHtml.replace(/<style[^>]*>/gi, '').replace(/<\/style>/gi, '');
          var style = document.createElement('style');
          style.id = 'child-customizer-css';
          style.textContent = cssContent;
          document.head.appendChild(style);
        }
      } else {
        // Remove Child CSS Link
        if (existingLink) existingLink.remove();
        // Remove Customizer CSS
        if (existingCustomizer) existingCustomizer.remove();
      }
      
      childIcon.textContent = on ? '🎨' : '🖌️';
      childLabel.textContent = 'Child: ' + (on ? 'On' : 'Off');
    }

    // Highlight active nav
    var path = window.location.pathname.replace(/\/$/, '');
    var links = document.querySelectorAll('.doc-nav a');
    links.forEach(function(link) {
      var href = link.getAttribute('href').replace(/\/$/, '');
      if (path === href) {
        link.classList.add('active');
      }
    });
  })();
</script>

</body>
</html>
