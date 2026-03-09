/**
 * Core PWA Logic - Parent Theme (Growtype)
 */

export const VAPID_PUBLIC_KEY = 'BDm6Rf2Lh_HF7t3LhpB3HQUiMi5Pi7J3epFerpJTweR-PkO7P2YSyRv9-wnbKwzwXMh9tI9e6KZskLb95fgSIkg';
let deferredPrompt;
let badgeCount = 0;

/**
 * Register Service Worker and initialize PWA enhancements
 * @param {Object} options - Customization options for the UI
 */
export const registerServiceWorker = (options = {}) => {
    const {
        showBannerCallback,
        hideBannerCallback,
        ajaxUrl = window.growtype_child_ajax?.url,
        env = window.growtype_child_ajax?.wp_env || 'production'
    } = options;

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register(`/service-worker.js?env=${env}`)
                .then(registration => {
                    console.log('SW registered: ', registration);

                    // Request notification permission and subscribe
                    handlePushSubscription(registration, ajaxUrl);
                })
                .catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }

    initInstallPrompt(showBannerCallback, hideBannerCallback);
    initBadgeAPI();
    initManualTriggers();
};

/**
 * Handle Push Notification permission and subscription
 */
const handlePushSubscription = (registration, ajaxUrl) => {
    if (Notification.permission === 'default') {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                subscribeUserToPush(registration, ajaxUrl);
            }
        });
    } else if (Notification.permission === 'granted') {
        subscribeUserToPush(registration, ajaxUrl);
    }
};

/**
 * Custom Install UI Logic - Listeners
 */
const initInstallPrompt = (showBannerCallback, hideBannerCallback) => {
    console.log('PWA: Initializing install prompt listeners...');

    window.addEventListener('beforeinstallprompt', (e) => {
        console.log('PWA: beforeinstallprompt event fired!');
        e.preventDefault();
        deferredPrompt = e;

        // Show the custom install banner if not dismissed recently
        const dismissedAt = localStorage.getItem('pwa_install_dismissed_at');
        const oneDay = 24 * 60 * 60 * 1000;

        if (!dismissedAt || (Date.now() - parseInt(dismissedAt)) > oneDay) {
            console.log('PWA: Scheduling banner display in 5s...');
            setTimeout(() => {
                if (showBannerCallback) showBannerCallback(false);
            }, 5000);
        }
    });

    // Handle iOS (it doesn't support beforeinstallprompt)
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches;

    if (isIOS && !isStandalone) {
        const dismissedAt = localStorage.getItem('pwa_ios_install_dismissed_at');
        const oneDay = 24 * 60 * 60 * 1000;

        if (!dismissedAt || (Date.now() - parseInt(dismissedAt)) > oneDay) {
            setTimeout(() => {
                if (showBannerCallback) showBannerCallback(true);
            }, 5000);
        }
    }

    window.addEventListener('appinstalled', (evt) => {
        console.log('PWA: App was installed');
        if (hideBannerCallback) hideBannerCallback();
        deferredPrompt = null;
    });
};

/**
 * Trigger the browser's install prompt
 * @returns {Promise}
 */
export const triggerInstallPrompt = async () => {
    if (!deferredPrompt) return { outcome: 'no_prompt' };

    deferredPrompt.prompt();
    const { outcome } = await deferredPrompt.userChoice;
    console.log(`PWA: User response to the install prompt: ${outcome}`);
    deferredPrompt = null;
    return { outcome };
};

/**
 * Manual trigger for UI
 */
const initManualTriggers = () => {
    document.addEventListener('click', (e) => {
        if (e.target.closest('.js-pwa-install')) {
            e.preventDefault();
            if (deferredPrompt) {
                triggerInstallPrompt();
            } else if (window.matchMedia('(display-mode: standalone)').matches) {
                alert('App is already installed!');
            } else {
                alert('To install: click the browser menu and select "Add to Home Screen".');
            }
        }
    });
};

/**
 * Badge API Logic
 */
export const clearBadge = () => {
    if ('clearAppBadge' in navigator) {
        navigator.clearAppBadge().catch((error) => console.error('Error clearing badge:', error));
        badgeCount = 0;
    }
};

export const updateBadge = (count) => {
    if ('setAppBadge' in navigator) {
        badgeCount += count;
        navigator.setAppBadge(badgeCount).catch((error) => console.error('Error setting badge:', error));
    }
};

const initBadgeAPI = () => {
    window.addEventListener('focus', clearBadge);
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') clearBadge();
    });
};

/**
 * Push Notification Subscription
 */
export const subscribeUserToPush = async (registration, ajaxUrl) => {
    try {
        const publicKey = window.growtype_child_ajax?.pwa_pub_key || VAPID_PUBLIC_KEY;
        const subscribeOptions = {
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(publicKey)
        };

        const subscription = await registration.pushManager.subscribe(subscribeOptions);
        console.log('PWA: User subscribed:', subscription);

        if (ajaxUrl) {
            await sendSubscriptionToServer(subscription, ajaxUrl);
        }
    } catch (error) {
        console.error('PWA: Failed to subscribe the user: ', error);
    }
};

const sendSubscriptionToServer = async (subscription, ajaxUrl) => {
    try {
        const response = await fetch(ajaxUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'growtype_save_pwa_subscription',
                subscription: JSON.stringify(subscription)
            })
        });
        const data = await response.json();
        console.log('PWA: Subscription saved:', data);
    } catch (error) {
        console.error('PWA: Error sending subscription to server:', error);
    }
};

/**
 * Helpers
 */
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

// Expose these globally so plugins can use them
window.growtypePwa = {
    clearBadge,
    updateBadge,
    triggerInstallPrompt,
    subscribeUserToPush
};
