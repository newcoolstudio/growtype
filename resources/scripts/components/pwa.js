/**
 * Core PWA Logic - Parent Theme (Growtype)
 * Includes installation banner and manual instruction modal
 */

export const VAPID_PUBLIC_KEY = window.growtype_ajax?.pwa_pub_key || window.growtype_child_ajax?.pwa_pub_key || 'BDm6Rf2Lh_HF7t3LhpB3HQUiMi5Pi7J3epFerpJTweR-PkO7P2YSyRv9-wnbKwzwXMh9tI9e6KZskLb95fgSIkg';
let deferredPrompt;
let badgeCount = 0;

let pwaConfig = {
    appName: 'App',
    appIcon: '/app/themes/growtype-child/public/icons/favicon/web-app-manifest-192x192.png'
};


/**
 * Register Service Worker and initialize PWA enhancements
 * @param {Object} options - Customization options for the UI
 */
export const registerServiceWorker = (options = {}) => {
    const {
        showBannerCallback = (isIosMode) => showInstallBanner(isIosMode),
        hideBannerCallback = () => hideInstallBanner(),
        ajaxUrl = window.growtype_ajax?.url || window.growtype_child_ajax?.url,
        env = window.growtype_ajax?.wp_env || window.growtype_child_ajax?.wp_env || 'production',
        appName = window.growtype_ajax?.app_title || window.growtype_child_ajax?.app_title || pwaConfig.appName,
        appIcon = window.growtype_ajax?.app_icon || window.growtype_child_ajax?.app_icon || pwaConfig.appIcon,
        cacheVersion = window.growtype_ajax?.cache_version || window.growtype_child_ajax?.cache_version || '1.0.0'
    } = options;

    pwaConfig.appName = appName;
    pwaConfig.appIcon = appIcon;

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register(`/service-worker.js?env=${env}&v=${cacheVersion}`)
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
                showPwaInfoModal();
            }
        }
    });
};

/**
 * UI Components: Install Banner and Modal
 */
const showInstallBanner = (isIosMode = false, force = false) => {
    if (!force && (document.querySelector('.pwa-install-banner') || window.matchMedia('(display-mode: standalone)').matches)) return;

    const banner = document.createElement('div');
    banner.className = 'pwa-install-banner';
    banner.innerHTML = `
        <div class="pwa-install-banner__content">
            <div class="pwa-install-banner__icon">
                <img src="${pwaConfig.appIcon}" alt="${pwaConfig.appName}">
            </div>
            <div class="pwa-install-banner__info">
                <h4>${pwaConfig.appName} App</h4>
                <p>
                    ${isIosMode
            ? `Unlock the full ${pwaConfig.appName} experience! <a href="#" class="pwa-install-banner__link d-none">Learn how to install</a>`
            : `Experience ${pwaConfig.appName} at its best! <a href="#" class="pwa-install-banner__link d-none">Learn how</a>`}
                </p>
            </div>
        </div>
        <div class="pwa-install-banner__actions">
            <button class="pwa-install-banner__btn-install">Install</button>
            <button class="pwa-install-banner__btn-close">&times;</button>
        </div>
    `;

    document.body.appendChild(banner);
    setTimeout(() => banner.classList.add('is-visible'), 100);

    const installBtn = banner.querySelector('.pwa-install-banner__btn-install');
    if (installBtn) {
        installBtn.addEventListener('click', () => {
            // If mobile, show modal. If desktop, trigger native prompt.
            if (window.innerWidth <= 576) {
                showPwaInfoModal();
            } else {
                triggerInstallPrompt().then(() => hideInstallBanner());
            }
        });
    }

    const learnMoreLinks = banner.querySelectorAll('.pwa-install-banner__link');
    learnMoreLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            showPwaInfoModal();
        });
    });

    banner.querySelector('.pwa-install-banner__btn-close').addEventListener('click', () => {
        const storageKey = isIosMode ? 'pwa_ios_install_dismissed_at' : 'pwa_install_dismissed_at';
        localStorage.setItem(storageKey, Date.now().toString());
        hideInstallBanner();
    });
};

const showPwaInfoModal = () => {
    const modal = document.createElement('div');
    modal.className = 'pwa-info-modal';

    modal.innerHTML = `
        <div class="pwa-info-modal__overlay"></div>
        <div class="pwa-info-modal__container">
            <div class="pwa-info-modal__header">
                <h3>Install ${pwaConfig.appName}</h3>
                <button class="pwa-info-modal__close">&times;</button>
            </div>
            <div class="pwa-info-modal__content">
                <p>Add ${pwaConfig.appName} to your home screen for instant access and a seamless experience.</p>
                
                <div class="pwa-info-modal__platform">
                    <div class="pwa-info-modal__platform-header">
                        <span class="pwa-info-modal__platform-icon">🍎</span>
                        <h4>iPhone / iOS</h4>
                    </div>
                    <div class="pwa-info-modal__steps">
                        <ol>
                            <li>Tap the <strong>Share</strong> icon (square with up arrow)</li>
                            <li>Scroll down and select <strong>'Add to Home Screen'</strong></li>
                        </ol>
                    </div>
                    <div class="pwa-info-modal__image">
                        <img src="/app/themes/growtype/public/images/pwa/iphone-addtohomescreen.png" alt="iPhone Installation">
                    </div>
                </div>

                <div class="pwa-info-modal__platform">
                    <div class="pwa-info-modal__platform-header">
                        <span class="pwa-info-modal__platform-icon">🤖</span>
                        <h4>Android</h4>
                    </div>
                    <div class="pwa-info-modal__steps">
                        <ol>
                            <li>Tap the <strong>Menu</strong> icon (three dots)</li>
                            <li>Select <strong>'Install App'</strong> or <strong>'Add to Home Screen'</strong></li>
                        </ol>
                    </div>
                    <div class="pwa-info-modal__image">
                        <img src="/app/themes/growtype/public/images/pwa/android-addtohomescreen.png" alt="Android Installation">
                    </div>
                </div>
            </div>
            <div class="pwa-info-modal__footer">
                <button class="pwa-info-modal__btn-got-it">Got it!</button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
    setTimeout(() => modal.classList.add('is-visible'), 10);

    const closeModal = () => {
        modal.classList.remove('is-visible');
        setTimeout(() => modal.remove(), 300);
    };

    modal.querySelector('.pwa-info-modal__close').addEventListener('click', closeModal);
    modal.querySelector('.pwa-info-modal__overlay').addEventListener('click', closeModal);
    modal.querySelector('.pwa-info-modal__btn-got-it').addEventListener('click', closeModal);
};

const hideInstallBanner = () => {
    const banner = document.querySelector('.pwa-install-banner');
    if (banner) {
        banner.classList.remove('is-visible');
        setTimeout(() => banner.remove(), 500);
    }
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

        let subscription = await registration.pushManager.getSubscription();

        if (!subscription) {
            subscription = await registration.pushManager.subscribe(subscribeOptions);
            console.log('PWA: User subscribed:', subscription);
        } else {
            console.log('PWA: Existing subscription reused:', subscription);
        }

        if (ajaxUrl) {
            await sendSubscriptionToServer(subscription, ajaxUrl);
        }
    } catch (error) {
        console.error('PWA: Failed to subscribe the user: ', error);
    }
};

const sendSubscriptionToServer = async (subscription, ajaxUrl) => {
    try {
        const serializedSubscription = JSON.stringify(subscription);
        const subscriptionFingerprint = createSubscriptionFingerprint(serializedSubscription);
        const storageKey = 'growtype_pwa_subscription_fingerprint';
        const previousFingerprint = localStorage.getItem(storageKey);

        if (previousFingerprint && previousFingerprint === subscriptionFingerprint) {
            console.log('PWA: Subscription unchanged, skipping save.');
            return;
        }

        const response = await fetch(ajaxUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'growtype_save_pwa_subscription',
                subscription: serializedSubscription
            })
        });
        const data = await response.json();
        console.log('PWA: Subscription saved:', data);

        if (data?.success) {
            localStorage.setItem(storageKey, subscriptionFingerprint);
        }
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

function createSubscriptionFingerprint(serializedSubscription) {
    let hash = 0;

    for (let i = 0; i < serializedSubscription.length; i++) {
        hash = (hash << 5) - hash + serializedSubscription.charCodeAt(i);
        hash |= 0;
    }

    return String(hash);
}

/**
 * Debug helper
 */
window.forceShowPwaBanner = (isIosMode = false) => {
    hideInstallBanner();
    showInstallBanner(isIosMode, true);
};

// Expose these globally so plugins can use them
window.growtypePwa = {
    clearBadge,
    updateBadge,
    triggerInstallPrompt,
    subscribeUserToPush,
    showPwaInfoModal,
    forceShowPwaBanner
};
