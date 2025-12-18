/**
 * Info Window Component
 * Searches for elements with data-g-infowindow-text and data-g-infowindow-nr attributes
 * Creates info windows at the exact location of those elements
 * Maintains a singleton instance that can be extended with new elements
 */

// Use window object for truly global state across all module instances
const getSharedState = () => window.__infoWindowState__ || null;
const setSharedState = (state) => { window.__infoWindowState__ = state; };
let isProcessing = false;

export function infoWindow(options = {}) {
    const DEBUG = options.debug || false; // Debug disabled by default for production
    const log = DEBUG ? console.log.bind(console) : () => { };

    log('[InfoWindow] Function called, isProcessing:', isProcessing);

    // Prevent concurrent execution
    if (isProcessing) {
        log('[InfoWindow] Already processing, returning existing API');
        return getAPI();
    }

    // Set lock
    isProcessing = true;

    try {
        return executeInfoWindow(options, log);
    } finally {
        // Release lock
        isProcessing = false;
        log('[InfoWindow] Processing complete, lock released');
    }
}

function executeInfoWindow(options, log) {

    log('[InfoWindow] Function called 1');

    let sharedState = getSharedState();

    // Initialize shared state on first call only
    if (!sharedState) {
        log('[InfoWindow] Initializing shared state for first time');
        sharedState = {
            infoWindows: [],
            globalBackdrop: null,
            currentIndex: 0,
            escapeKeyHandler: null,
            isActive: false,
            showWindow: null,
            closeAll: null,
            destroy: null
        };

        // Create global backdrop once
        sharedState.globalBackdrop = document.createElement('div');
        sharedState.globalBackdrop.className = 'g-infowindow-backdrop';
        Object.assign(sharedState.globalBackdrop.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            width: '100%',
            height: '100%',
            display: 'none',
            zIndex: '9998'
        });
        document.body.appendChild(sharedState.globalBackdrop);
        log('[InfoWindow] Created global backdrop');

        setSharedState(sharedState);
    } else {
        log('[InfoWindow] Reusing existing shared state, current windows:', sharedState.infoWindows.length);
    }

    // Cookie helper functions
    const setCookie = (name, value, days = 365) => {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
        log('[InfoWindow] Cookie set:', name, '=', value);
    };

    const getCookie = (name) => {
        const nameEQ = `${name}=`;
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            cookie = cookie.trim();
            if (cookie.startsWith(nameEQ)) {
                return cookie.substring(nameEQ.length);
            }
        }
        return null;
    };

    // Find all elements with info window data attributes FIRST
    const elementsWithInfoWindow = document.querySelectorAll('[data-g-infowindow-text][data-g-infowindow-nr]');
    log('[InfoWindow] Found elements with info window attributes:', elementsWithInfoWindow.length);

    if (elementsWithInfoWindow.length === 0) {
        log('[InfoWindow] No elements found');
        return getAPI();
    }

    // Set default group for elements without group attribute
    elementsWithInfoWindow.forEach(element => {
        if (!element.dataset.gInfowindowGroup) {
            element.dataset.gInfowindowGroup = 'default';
            log('[InfoWindow] Set default group for element');
        }
    });

    // Get the group from the first element (all should be same group on a page)
    const infoWindowGroup = elementsWithInfoWindow[0].dataset.gInfowindowGroup;
    log('[InfoWindow] Info window group:', infoWindowGroup);

    // Sanitize group name for cookie
    const sanitizedGroup = infoWindowGroup.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

    const cookieName = `growtype_infowindow_dismissed_${sanitizedGroup}`;
    log('[InfoWindow] Cookie name:', cookieName);

    // Check if info windows have been dismissed
    const dismissedCookie = getCookie(cookieName);
    log('[InfoWindow] Cookie check:', dismissedCookie);

    if (dismissedCookie === 'true') {
        log('[InfoWindow] Already dismissed, exiting');
        return getAPI();
    }

    // Process new elements only
    let newWindowsAdded = 0;
    elementsWithInfoWindow.forEach((element, index) => {
        const nr = element.dataset.gInfowindowNr;
        const isProcessed = element.dataset.gInfowindowProcessed === 'true';

        log('[InfoWindow] Checking element', index, 'nr:', nr, 'processed:', isProcessed);

        // Skip if already processed
        if (isProcessed) {
            log('[InfoWindow] Skipping already processed element at index', index, 'nr:', nr);
            return;
        }

        // Check if we already have a window for this element (double-check)
        const existingWindow = sharedState.infoWindows.find(w => w.targetElement === element);
        if (existingWindow) {
            log('[InfoWindow] Window already exists for element', index, 'nr:', nr, '- marking as processed');
            element.dataset.gInfowindowProcessed = 'true';
            return;
        }

        // Check if element is visible (cache getBoundingClientRect)
        const rect = element.getBoundingClientRect();
        const isVisible = element.offsetParent !== null && rect.width > 0 && rect.height > 0;

        if (!isVisible) {
            log('[InfoWindow] Skipping hidden element at index', index, 'nr:', nr);
            return;
        }

        const text = element.dataset.gInfowindowText;

        log('[InfoWindow] Creating new window for element', index, 'with nr:', nr);

        // Mark element as processed BEFORE creating the window
        element.dataset.gInfowindowProcessed = 'true';

        // Create info window element
        const infoWindow = document.createElement('div');
        infoWindow.className = 'g-infowindow g-infowindow-fadein';
        infoWindow.dataset.nr = nr;
        Object.assign(infoWindow.style, {
            position: 'fixed',
            zIndex: '9999'
        });

        // Create close button
        const closeBtn = document.createElement('div');
        closeBtn.className = 'g-infowindow-close';
        closeBtn.textContent = '×';
        closeBtn.setAttribute('aria-label', 'Close');
        closeBtn.setAttribute('role', 'button');
        infoWindow.appendChild(closeBtn);

        // Create content
        const content = document.createElement('div');
        content.className = 'g-infowindow-content';
        content.innerHTML = text;
        infoWindow.appendChild(content);

        // Add to body (hidden initially)
        document.body.appendChild(infoWindow);

        sharedState.infoWindows.push({
            element: infoWindow,
            targetElement: element,
            nr: parseInt(nr, 10)
        });

        newWindowsAdded++;
        log('[InfoWindow] Successfully created info window for nr:', nr, 'Total windows:', sharedState.infoWindows.length);
    });

    // Check if we have any windows
    if (sharedState.infoWindows.length === 0) {
        log('[InfoWindow] No visible elements found');
        return getAPI();
    }

    // Sort all windows by nr
    sharedState.infoWindows.sort((a, b) => a.nr - b.nr);
    log('[InfoWindow] Total windows:', sharedState.infoWindows.length, 'New windows added:', newWindowsAdded);

    // Add navigation to windows that don't have it yet
    sharedState.infoWindows.forEach((windowData, index) => {
        const window = windowData.element;

        // Skip if navigation already exists
        if (window.querySelector('.g-infowindow-nav')) {
            log('[InfoWindow] Navigation already exists for window', index);
            return;
        }

        log('[InfoWindow] Adding navigation to window', index);

        // Create navigation container
        const nav = document.createElement('div');
        nav.className = 'g-infowindow-nav';

        // Always add previous arrow (will be hidden/disabled by handler if at start)
        const prevArrow = document.createElement('button');
        prevArrow.type = 'button';
        prevArrow.className = 'g-infowindow-arrow g-infowindow-prev';
        prevArrow.textContent = '←';
        prevArrow.setAttribute('aria-label', 'Previous');

        prevArrow.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            log('[InfoWindow] Previous arrow clicked');
            if (sharedState.currentIndex > 0) {
                showWindow(sharedState.currentIndex - 1);
            }
        });

        nav.appendChild(prevArrow);

        // Counter (will be updated dynamically)
        const counter = document.createElement('span');
        counter.className = 'g-infowindow-counter';
        counter.textContent = `${index + 1} / ${sharedState.infoWindows.length}`;
        counter.setAttribute('aria-live', 'polite');
        nav.appendChild(counter);

        // Always add next arrow (will be hidden/disabled by handler if at end)
        const nextArrow = document.createElement('button');
        nextArrow.type = 'button';
        nextArrow.className = 'g-infowindow-arrow g-infowindow-next';
        nextArrow.textContent = '→';
        nextArrow.setAttribute('aria-label', 'Next');

        nextArrow.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            log('[InfoWindow] Next arrow clicked');
            if (sharedState.currentIndex < sharedState.infoWindows.length - 1) {
                showWindow(sharedState.currentIndex + 1);
            }
        });

        nav.appendChild(nextArrow);

        window.appendChild(nav);

        // Add close button listener
        const closeBtn = window.querySelector('.g-infowindow-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                log('[InfoWindow] Close button clicked');
                closeAll();
            });
        }
    });

    // Update all counters and arrow visibility
    updateAllNavigation();

    // Position and show window
    const showWindow = (index) => {
        log('[InfoWindow] showWindow called with index:', index);

        // Hide all windows, remove shake from all target elements, and remove any clones
        sharedState.infoWindows.forEach(w => {
            w.element.classList.remove('is-active');
            w.element.style.display = 'none';
            w.targetElement.classList.remove('anim-shake');

            // Restore original element visibility
            if (w.targetElement.style.visibility === 'hidden') {
                w.targetElement.style.visibility = '';
            }

            // Remove clone if it exists
            if (w.clonedElement) {
                w.clonedElement.remove();
                w.clonedElement = null;
            }
        });

        // Show current window
        const windowData = sharedState.infoWindows[index];
        const infoWindowElement = windowData.element;
        const targetElement = windowData.targetElement;

        // Add shake animation to target element
        targetElement.classList.add('anim-shake');
        log('[InfoWindow] Added anim-shake to target element');

        // Hide original element temporarily
        targetElement.style.visibility = 'hidden';
        log('[InfoWindow] Hid original element');

        // Clone the target element and position it in front of backdrop
        const clonedElement = targetElement.cloneNode(true);
        clonedElement.classList.add('g-infowindow-cloned-element');

        // Get target element position
        const targetRect = targetElement.getBoundingClientRect();
        log('[InfoWindow] Target element rect:', targetRect);

        // Position clone exactly where original is
        Object.assign(clonedElement.style, {
            position: 'fixed',
            top: `${targetRect.top}px`,
            left: `${targetRect.left}px`,
            width: `${targetRect.width}px`,
            height: `${targetRect.height}px`,
            zIndex: '9998',
            pointerEvents: 'none',
            margin: '0',
            visibility: 'visible' // Ensure clone is visible even though original is hidden
        });

        // Add clone to body
        document.body.appendChild(clonedElement);
        windowData.clonedElement = clonedElement;
        log('[InfoWindow] Created and positioned clone');

        // Temporarily show to get dimensions
        infoWindowElement.style.display = 'block';
        infoWindowElement.style.visibility = 'hidden';
        const infoWindowRect = infoWindowElement.getBoundingClientRect();
        const infoWindowWidth = infoWindowRect.width || 300;
        const infoWindowHeight = infoWindowRect.height || 200;
        infoWindowElement.style.visibility = '';
        infoWindowElement.style.display = 'none';

        log('[InfoWindow] Info window dimensions:', infoWindowWidth, 'x', infoWindowHeight);

        const padding = 10;
        const topPadding = 30; // Minimum distance from top of screen

        // Calculate vertical position (prefer above target)
        let top = 'auto';
        let bottom = 'auto';

        const spaceAbove = targetRect.top;
        const spaceBelow = window.innerHeight - targetRect.bottom;

        if (spaceAbove >= infoWindowHeight + padding) {
            // Try to position above target
            bottom = window.innerHeight - targetRect.top + 10;

            // Check if this would put window too close to top
            const calculatedTop = window.innerHeight - bottom - infoWindowHeight;
            if (calculatedTop < topPadding) {
                // Would be too close to top
                // Check if adjusting to topPadding would overlap with target
                const adjustedBottom = topPadding + infoWindowHeight;

                if (adjustedBottom > targetRect.top) {
                    // Would overlap target, position below instead
                    bottom = 'auto';
                    top = Math.max(topPadding, targetRect.bottom + 10);
                    log('[InfoWindow] Positioned below to avoid overlap with target');
                } else {
                    // Can use top padding without overlap
                    bottom = 'auto';
                    top = topPadding;
                    log('[InfoWindow] Adjusted to maintain 30px from top');
                }
            }
        } else if (spaceBelow >= infoWindowHeight + padding) {
            // Position below target
            top = Math.max(topPadding, targetRect.bottom + 10);
        } else {
            // Not enough space above or below, center with constraints
            top = Math.max(topPadding, (window.innerHeight - infoWindowHeight) / 2);
        }

        // Calculate horizontal position (prefer aligned to right of target)
        let left = 'auto';
        const alignedRight = targetRect.right - infoWindowWidth;

        if (alignedRight >= padding && targetRect.right <= window.innerWidth - padding) {
            left = alignedRight;
        } else if (targetRect.left + infoWindowWidth <= window.innerWidth - padding) {
            left = targetRect.left;
        } else if (targetRect.right - infoWindowWidth >= padding) {
            left = Math.max(padding, targetRect.right - infoWindowWidth);
        } else {
            left = Math.max(padding, Math.min(window.innerWidth - infoWindowWidth - padding, targetRect.left));
        }

        // Apply final positioning
        Object.assign(infoWindowElement.style, {
            position: 'fixed',
            bottom: typeof bottom === 'number' ? `${bottom}px` : bottom,
            right: 'auto',
            left: typeof left === 'number' ? `${left}px` : left,
            top: typeof top === 'number' ? `${top}px` : top,
            transform: 'none'
        });

        // Show window and backdrop
        infoWindowElement.style.display = 'block';
        infoWindowElement.classList.add('is-active');
        sharedState.globalBackdrop.style.display = 'block';
        sharedState.globalBackdrop.classList.add('is-active');

        sharedState.currentIndex = index;
        sharedState.isActive = true;
        log('[InfoWindow] Showed window', index);
    };

    // Update all counters and arrow visibility
    function updateAllNavigation() {
        const hasMultipleWindows = sharedState.infoWindows.length > 1;

        sharedState.infoWindows.forEach((windowData, index) => {
            const element = windowData.element;

            // Update counter
            const counter = element.querySelector('.g-infowindow-counter');
            if (counter) {
                counter.textContent = `${index + 1} / ${sharedState.infoWindows.length}`;
            }

            // Show/hide arrows based on total windows
            const prevArrow = element.querySelector('.g-infowindow-prev');
            const nextArrow = element.querySelector('.g-infowindow-next');

            if (prevArrow) {
                prevArrow.style.display = hasMultipleWindows ? '' : 'none';
            }
            if (nextArrow) {
                nextArrow.style.display = hasMultipleWindows ? '' : 'none';
            }
        });
    }

    // Close all windows
    const closeAll = () => {
        log('[InfoWindow] Closing all windows');

        sharedState.infoWindows.forEach(w => {
            w.element.classList.remove('is-active');
            w.element.style.display = 'none';
            w.targetElement.classList.remove('anim-shake');

            // Restore original element visibility
            if (w.targetElement.style.visibility === 'hidden') {
                w.targetElement.style.visibility = '';
            }

            // Remove clone if it exists
            if (w.clonedElement) {
                w.clonedElement.remove();
                w.clonedElement = null;
            }
        });

        sharedState.globalBackdrop.style.display = 'none';
        sharedState.globalBackdrop.classList.remove('is-active');
        sharedState.isActive = false;

        // Save dismissal for current page using unique cookie name
        setCookie(cookieName, 'true', 365);

        // Remove escape key listener
        if (sharedState.escapeKeyHandler) {
            document.removeEventListener('keydown', sharedState.escapeKeyHandler);
            sharedState.escapeKeyHandler = null;
        }
    };

    // Cleanup function
    const destroy = () => {
        log('[InfoWindow] Destroying all info window elements');

        try {
            // Close all windows first
            closeAll();

            // Remove all info window elements
            sharedState.infoWindows.forEach(w => {
                // Remove info window element
                if (w.element && w.element.parentNode) {
                    w.element.remove();
                }

                // Remove cloned element if exists
                if (w.clonedElement && w.clonedElement.parentNode) {
                    w.clonedElement.remove();
                }

                // Remove processed marker from target element
                if (w.targetElement) {
                    delete w.targetElement.dataset.gInfowindowProcessed;
                    w.targetElement.classList.remove('anim-shake');
                }
            });

            // Remove global backdrop
            if (sharedState.globalBackdrop && sharedState.globalBackdrop.parentNode) {
                sharedState.globalBackdrop.remove();
            }

            // Remove escape key listener
            if (sharedState.escapeKeyHandler) {
                document.removeEventListener('keydown', sharedState.escapeKeyHandler);
            }

            // Clear global state
            setSharedState(null);

            log('[InfoWindow] Cleanup complete');
        } catch (error) {
            console.error('[InfoWindow] Error during cleanup:', error);
        }
    };

    // Store functions in shared state for API access
    sharedState.showWindow = showWindow;
    sharedState.closeAll = closeAll;
    sharedState.destroy = destroy;

    // Setup event listeners only once
    if (!sharedState.escapeKeyHandler) {
        // Backdrop click listener
        sharedState.globalBackdrop.addEventListener('click', (e) => {
            if (e.target === sharedState.globalBackdrop) {
                log('[InfoWindow] Backdrop clicked');
                closeAll();
            }
        });

        // Escape key listener
        sharedState.escapeKeyHandler = (e) => {
            if (e.key === 'Escape' && sharedState.globalBackdrop.classList.contains('is-active')) {
                log('[InfoWindow] Escape key pressed');
                closeAll();
            }
        };
        document.addEventListener('keydown', sharedState.escapeKeyHandler);
    }

    // Show first window after delay (only if not already active)
    if (newWindowsAdded > 0 && !sharedState.isActive) {
        log('[InfoWindow] Scheduling showWindow(0) after 500ms');
        setTimeout(() => {
            log('[InfoWindow] Timeout fired, calling showWindow(0)');
            showWindow(0);
        }, 500);
    }

    return getAPI();
}

// Return API helper function
function getAPI() {
    const state = getSharedState();
    return {
        showWindow: state?.showWindow || (() => { }),
        closeAll: state?.closeAll || (() => { }),
        destroy: state?.destroy || (() => { }),
        getCurrentIndex: () => state?.currentIndex || 0,
        getTotalWindows: () => state?.infoWindows?.length || 0,
        isActive: () => state?.isActive || false
    };
}
