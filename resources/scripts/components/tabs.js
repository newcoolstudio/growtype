function tabs() {

    function parseTabHashMap() {
        const hash = window.location.hash || '';
        if (hash && !hash.includes('tabs=')) {
            return { legacy: hash.replace('#', '') };
        }

        const map = {};
        if (!hash.startsWith('#')) return map;
        const hashContent = hash.split('#').pop();
        const params = new URLSearchParams(hashContent);
        const tabsParam = params.get('tabs');
        if (!tabsParam) return map;

        tabsParam.split(',').forEach(pair => {
            const parts = pair.split(':');
            if (parts.length >= 2) {
                const group = decodeURIComponent(parts.shift());
                const target = decodeURIComponent(parts.join(':'));
                map[group] = target;
            }
        });
        return map;
    }

    function updateTabHash(groupId, target) {
        if (!target) return;
        const map = parseTabHashMap();
        const cleanTarget = target.replace('#', '');

        if (groupId) {
            map[groupId] = cleanTarget;
        }
        delete map.legacy;

        const pairs = Object.entries(map).map(([g, t]) => `${encodeURIComponent(g)}:${encodeURIComponent(t)}`);
        const newHash = pairs.length ? `#tabs=${pairs.join(',')}` : '';

        const newUrl = window.location.pathname + window.location.search + newHash;
        if (window.history.pushState) {
            window.history.pushState(null, null, newUrl);
        } else {
            window.location.hash = newHash;
        }
    }

    function activateTabFromHash() {
        const map = parseTabHashMap();
        if (Object.keys(map).length === 0) return;

        Object.entries(map).forEach(([groupId, target]) => {
            if (groupId === 'legacy' && Object.keys(map).length > 1) return;

            const cleanTarget = target.replace('#', '');
            const triggerSelector = [
                `button[data-bs-target="#${cleanTarget}"]`,
                `a[data-bs-target="#${cleanTarget}"]`,
                `button[data-target="#${cleanTarget}"]`,
                `a[data-target="#${cleanTarget}"]`,
                `button[data-bs-target="${cleanTarget}"]`,
                `a[data-bs-target="${cleanTarget}"]`,
                `#${cleanTarget}-tab`
            ].join(',');

            const tabTriggerEl = document.querySelector(triggerSelector);

            if (tabTriggerEl) {
                // If it's already active, just trigger lazy load
                if (tabTriggerEl.classList.contains('active')) {
                    triggerTabActions(cleanTarget);
                    return;
                }

                if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                    bootstrap.Tab.getOrCreateInstance(tabTriggerEl).show();
                } else if (typeof jQuery !== 'undefined' && jQuery.fn.tab) {
                    $(tabTriggerEl).tab('show');
                } else {
                    tabTriggerEl.click();
                }
            }
        });
    }

    function triggerTabActions(target) {
        if (!target) return;
        const cleanTarget = target.replace('#', '');
        setTimeout(() => {
            // Trigger scroll for lazy loading
            $(window).trigger('scroll');

            // If theme has a global initLazyLoad
            if (typeof window.initLazyLoad === 'function') {
                window.initLazyLoad(`#${cleanTarget}`);
            }
        }, 100);
    }

    $(document).ready(function () {
        // 1. Handle all clicks for persistence (Delegated)
        $(document).on('click', '[data-bs-toggle="tab"], [data-toggle="tab"], .growtype-form-tabs-link', function (e) {
            const $el = $(this);
            const target = $el.attr('data-bs-target') || $el.attr('data-target') || $el.data('target');
            if (target) {
                const groupId = $el.closest('[role="tablist"]').attr('id') || 'default';
                updateTabHash(groupId, target);
            }
        });

        // 2. Handle events for lazy loading
        $(document).on('shown.bs.tab', function (e) {
            const target = $(e.target).attr('data-bs-target') || $(e.target).attr('data-target');
            triggerTabActions(target);
        });

        // 3. Initial Activation and State Changes
        setTimeout(activateTabFromHash, 200);
        window.addEventListener('hashchange', activateTabFromHash);

        // Support for dynamically loaded content via custom events
        document.addEventListener('growtypeChatProfileContentRendered', function () {
            setTimeout(activateTabFromHash, 100);
        });
    });
}

export { tabs };
