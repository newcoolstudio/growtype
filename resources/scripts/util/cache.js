/**
 * Force clear all Service Worker caches if a new version is detected
 * @param {string} version - Current application/assets version
 */
export const forceClearCache = (version) => {
    const lastVersion = localStorage.getItem('site_cache_version');

    console.log(`Cache Update Check:`, {
        serverVersion: version,
        storedVersion: lastVersion,
        needsUpdate: version && lastVersion !== version
    });

    if (version && lastVersion !== version) {
        if ('caches' in window) {
            caches.keys().then(names => {
                return Promise.all(names.map(name => caches.delete(name)));
            }).then(() => {
                localStorage.setItem('site_cache_version', version);

                const wpEnv = window.growtype_theme_data?.wp_env || window.growtype_child_ajax?.wp_env;
                const isDev = ['development', 'dev', 'local', 'test'].includes(wpEnv);

                if (!isDev) {
                    window.location.reload();
                }
            });
        }
    }
};
