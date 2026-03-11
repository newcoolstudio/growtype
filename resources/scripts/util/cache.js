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
            console.warn(`Cache: Version mismatch detected (${lastVersion} -> ${version}). Clearing all caches...`);
            caches.keys().then(names => {
                return Promise.all(names.map(name => caches.delete(name)));
            }).then(() => {
                localStorage.setItem('site_cache_version', version);
                console.log(`Cache: Global flush for version ${version} complete. Reloading page...`);
                window.location.reload();
            });
        }
    }
};
