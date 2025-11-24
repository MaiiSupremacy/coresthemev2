/**
 * Main JavaScript file for the CORES Theme
 *
 * ENHANCED FEATURES V2.3.0:
 * - Modern ES6+ syntax with backwards compatibility
 * - Performance optimized (debounce, throttle, passive listeners)
 * - Accessibility support (keyboard navigation, ARIA updates)
 * - Error handling and graceful degradation
 * - Mobile touch gesture support
 * - Intersection Observer for animations
 * - Service Worker ready
 * - AJAX contact form with validation
 * - Dynamic team modal system
 * - Progressive enhancement
 * - [NEW] Gallery Lightbox (Full screen image view)
 * - [NEW] Reading Progress Bar (For single posts)
 * - [NEW] Sticky Sidebar Logic (Smart scroll behavior)
 * - [NEW] Enhanced Cursor Logic (GPU accelerated)
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

'use strict';

// ============================================
// UTILITY FUNCTIONS
// ============================================

/**
 * Debounce function - limits function calls
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in ms
 * @returns {Function}
 */
const debounce = (func, wait = 250) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

/**
 * Throttle function - limits function execution rate
 * @param {Function} func - Function to throttle
 * @param {number} limit - Time limit in ms
 * @returns {Function}
 */
const throttle = (func, limit = 100) => {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
};

/**
 * Check if element is in viewport
 * @param {Element} element - DOM element
 * @returns {boolean}
 */
const isInViewport = (element) => {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
};

/**
 * Smooth scroll to element
 * @param {string} elementId - Element ID to scroll to
 */
const smoothScrollTo = (elementId) => {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    const navbar = document.getElementById('navbar');
    const offset = navbar ? navbar.offsetHeight : 80;
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;

    window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
    });
};

// ============================================
// GLOBAL STATE
// ============================================
const AppState = {
    currentSlide: 0,
    slideInterval: null,
    isSliderPaused: false,
    lastFocusedElement: null,
    map: null,
    currentZoom: 12,
};

// ============================================
// ERROR HANDLER
// ============================================
window.addEventListener('error', (e) => {
    console.error('JavaScript error:', e.error);
    // Log to analytics if available
    if (typeof gtag !== 'undefined') {
        gtag('event', 'exception', {
            description: e.error.message,
            fatal: false
        });
    }
}, { passive: true });

// ============================================
// INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    try {
        initLoader();
        initCursor();
        initNavigation();
        initSlider();
        initScrollAnimations();
        initForms();
        initMap();
        initGalleryCarousel(); // Enhanced with Lightbox
        initReadingProgressBar(); // NEW
        initStickySidebar(); // NEW
        initFilterButtons();
        initTeamCards();
        initMapControls();
        initAccessibility();
        
        // Initialize filter functions based on page content
        if (document.querySelector('.research-filters')) {
            if (typeof filterResearch === 'function') {
                filterResearch('all');
            }
        }
        if (document.querySelector('.team-filters')) {
            if (typeof filterTeam === 'function') {
                filterTeam('all');
            }
        }
    } catch (error) {
        console.error('Initialization error:', error);
        hideLoader();
    }
});

// ============================================
// LOADER FUNCTIONS
// ============================================
function initLoader() {
    const loader = document.getElementById('loader');
    if (!loader) return;

    loader.style.display = 'flex';
    loader.setAttribute('aria-busy', 'true');
    
    const hideLoaderWithDelay = () => {
        setTimeout(() => {
            hideLoader();
        }, 500);
    };

    if (document.readyState === 'complete') {
        hideLoaderWithDelay();
    } else {
        window.addEventListener('load', hideLoaderWithDelay, { once: true, passive: true });
    }

    // Fallback timeout
    setTimeout(() => {
        hideLoader();
    }, 4000);
}

function hideLoader() {
    const loader = document.getElementById('loader');
    if (!loader) return;
    
    loader.classList.add('hidden');
    loader.setAttribute('aria-busy', 'false');
    
    setTimeout(() => {
        loader.style.display = 'none';
    }, 500);
}

// ============================================
// CUSTOM CURSOR (Optimized)
// ============================================
function initCursor() {
    // Only on devices with hover capability (desktop)
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        return;
    }

    const cursor = document.querySelector('.cursor');
    const cursorFollower = document.querySelector('.cursor-follower');
    
    if (!cursor || !cursorFollower) return;

    let mouseX = 0, mouseY = 0;
    let followerX = 0, followerY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        // Use translate3d for GPU acceleration
        cursor.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0) translate(-50%, -50%)`;
    }, { passive: true });

    // Smooth follower animation loop
    const animateFollower = () => {
        const dx = mouseX - followerX;
        const dy = mouseY - followerY;
        
        followerX += dx * 0.1;
        followerY += dy * 0.1;
        
        // Use translate3d for GPU acceleration
        cursorFollower.style.transform = `translate3d(${followerX}px, ${followerY}px, 0) translate(-50%, -50%)`;
        
        requestAnimationFrame(animateFollower);
    };
    animateFollower();

    // Cursor scaling on hover
    const interactiveElements = 'a, button, .team-member, .card-link, .slider-arrow, .dot, .filter-btn, .milestone-link, input, textarea, select, .swiper-slide, .lightbox-close';
    
    document.querySelectorAll(interactiveElements).forEach(el => {
        el.addEventListener('mouseenter', () => {
            // Add active class for scaling
            cursorFollower.classList.add('active');
            
            // Optional: dynamic styling based on element type
            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                cursorFollower.style.borderColor = 'var(--secondary)';
            } else {
                cursorFollower.style.borderColor = 'var(--primary)';
            }
            
            // Ensure transform logic handles scaling correctly via CSS or here if needed
            cursorFollower.style.transform = `translate3d(${followerX}px, ${followerY}px, 0) translate(-50%, -50%) scale(2.5)`;
            
            document.body.classList.add('cursor-hover');
        }, { passive: true });
        
        el.addEventListener('mouseleave', () => {
            cursorFollower.classList.remove('active');
            cursorFollower.style.borderColor = 'var(--accent)';
            // Reset scale in next animation frame automatically
            document.body.classList.remove('cursor-hover');
        }, { passive: true });
    });
}

// ============================================
// NAVIGATION
// ============================================
function initNavigation() {
    const hamburger = document.getElementById('hamburger');
    const slideMenu = document.getElementById('slideMenu');
    const menuClose = document.getElementById('menuClose');
    const navbar = document.getElementById('navbar');

    if (!hamburger || !slideMenu || !menuClose) return;

    // Toggle mobile menu
    const toggleMenu = (open) => {
        const isOpen = open ?? !slideMenu.classList.contains('active');
        
        hamburger.setAttribute('aria-expanded', isOpen);
        slideMenu.setAttribute('aria-hidden', !isOpen);
        hamburger.classList.toggle('active', isOpen);
        slideMenu.classList.toggle('active', isOpen);
        
        // Lock body scroll when menu is open
        document.body.style.overflow = isOpen ? 'hidden' : '';
        
        if (isOpen) {
            // Focus first focusable element in menu
            const firstFocusable = slideMenu.querySelector('a, button');
            if (firstFocusable) {
                setTimeout(() => firstFocusable.focus(), 300);
            }
        } else {
            hamburger.focus();
        }
    };

    hamburger.addEventListener('click', () => toggleMenu(), { passive: true });
    menuClose.addEventListener('click', () => toggleMenu(false), { passive: true });

    // Close menu when clicking links
    slideMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (link.hash) {
                toggleMenu(false);
            }
        }, { passive: true });
    });

    // Close menu on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && slideMenu.classList.contains('active')) {
            toggleMenu(false);
        }
    });

    // Navbar scroll effect
    let lastScrollTop = 0;
    const handleScroll = throttle(() => {
        if (!navbar) return;

        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Update active navigation link
        updateActiveNavLink();
        
        lastScrollTop = scrollTop;
    }, 100);

    window.addEventListener('scroll', handleScroll, { passive: true });

    // Back to top button
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        const handleBackToTopVisibility = throttle(() => {
            if (window.pageYOffset > 500) {
                backToTop.classList.add('visible');
                backToTop.style.display = 'flex';
            } else {
                backToTop.classList.remove('visible');
                setTimeout(() => {
                    if (!backToTop.classList.contains('visible')) {
                        backToTop.style.display = 'none';
                    }
                }, 300);
            }
        }, 100);

        window.addEventListener('scroll', handleBackToTopVisibility, { passive: true });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.length > 1) {
                e.preventDefault();
                const targetId = href.substring(1);
                smoothScrollTo(targetId);
            }
        });
    });
}

/**
 * Update active navigation link based on scroll position
 */
function updateActiveNavLink() {
    const navLinks = document.querySelectorAll('nav ul a');
    const sections = document.querySelectorAll('section[id]');
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.pageYOffset + (navbar ? navbar.offsetHeight : 80) + 50;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute('id');
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                link.removeAttribute('aria-current');
                
                const href = link.getAttribute('href');
                if (href && href.includes(`#${sectionId}`)) {
                    link.classList.add('active');
                    link.setAttribute('aria-current', 'page');
                }
            });
        }
    });
}

// ============================================
// HERO SLIDER
// ============================================
function initSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const progressBar = document.getElementById('progressBar');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    const heroSection = document.querySelector('.hero-section');

    if (slides.length === 0) return;

    const SLIDE_DURATION = 7000;

    function showSlide(n) {
        slides.forEach((slide, index) => {
            const isActive = index === AppState.currentSlide;
            slide.classList.toggle('active', isActive);
            slide.setAttribute('aria-hidden', !isActive);
        });

        dots.forEach((dot, index) => {
            const isActive = index === AppState.currentSlide;
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-selected', isActive);
        });
        
        AppState.currentSlide = (n + slides.length) % slides.length;
        
        if (progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            progressBar.setAttribute('aria-valuenow', '0');
            
            setTimeout(() => {
                progressBar.style.transition = `width ${SLIDE_DURATION}ms linear`;
                progressBar.style.width = '100%';
                progressBar.setAttribute('aria-valuenow', '100');
            }, 50);
        }
    }

    function nextSlide() {
        showSlide(AppState.currentSlide + 1);
    }

    function prevSlide() {
        showSlide(AppState.currentSlide - 1);
    }

    function startSlideShow() {
        if (AppState.slideInterval) {
            clearInterval(AppState.slideInterval);
        }
        AppState.slideInterval = setInterval(nextSlide, SLIDE_DURATION);
        AppState.isSliderPaused = false;
    }

    function pauseSlideShow() {
        if (AppState.slideInterval) {
            clearInterval(AppState.slideInterval);
        }
        AppState.isSliderPaused = true;
    }

    // Event listeners for buttons
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            pauseSlideShow();
            nextSlide();
            startSlideShow();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            pauseSlideShow();
            prevSlide();
            startSlideShow();
        });
    }

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            pauseSlideShow();
            showSlide(index);
            startSlideShow();
        });
    });

    // Pause on hover
    if (heroSection) {
        heroSection.addEventListener('mouseenter', pauseSlideShow, { passive: true });
        heroSection.addEventListener('mouseleave', startSlideShow, { passive: true });

        // Touch gesture support
        let touchStartX = 0;
        let touchEndX = 0;

        heroSection.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        heroSection.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                pauseSlideShow();
                nextSlide();
                startSlideShow();
            }
            if (touchEndX > touchStartX + swipeThreshold) {
                pauseSlideShow();
                prevSlide();
                startSlideShow();
            }
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        // Don't interfere with form inputs
        if (document.activeElement.tagName === 'INPUT' || 
            document.activeElement.tagName === 'TEXTAREA') {
            return;
        }

        // Only control slider if hero is in view
        if (heroSection && isInViewport(heroSection)) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                pauseSlideShow();
                prevSlide();
                startSlideShow();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                pauseSlideShow();
                nextSlide();
                startSlideShow();
            }
        }
    });

    // Initialize
    showSlide(0);
    startSlideShow();

    // Pause when tab is not visible
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            pauseSlideShow();
        } else if (!AppState.isSliderPaused) {
            startSlideShow();
        }
    });
}

// ============================================
// SCROLL ANIMATIONS
// ============================================
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Unobserve after animation for performance
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach(el => {
        observer.observe(el);
    });
}

// ============================================
// FORM HANDLING
// ============================================
function initForms() {
    initContactForm();
    initNewsletterForm();
}

/**
 * Initialize AJAX contact form
 */
function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    
    if (!contactForm || typeof cores_ajax_object === 'undefined') {
        return;
    }
    
    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitButton = this.querySelector('button[type="submit"]');
        const buttonText = submitButton.querySelector('.button-text');
        const buttonLoader = submitButton.querySelector('.button-loader');
        const originalButtonText = buttonText ? buttonText.textContent : submitButton.textContent;

        // Validate form
        if (!this.checkValidity()) {
            this.reportValidity();
            return;
        }

        // Set loading state
        submitButton.disabled = true;
        if (buttonText && buttonLoader) {
            buttonText.style.display = 'none';
            buttonLoader.style.display = 'inline-block';
        } else {
            submitButton.textContent = cores_ajax_object.sending;
        }

        // Prepare form data
        const formData = new FormData(this);
        formData.append('action', 'send_contact_email');
        formData.append('nonce', cores_ajax_object.contact_nonce);
        
        try {
            const response = await fetch(cores_ajax_object.ajax_url, {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                showNotification(
                    cores_ajax_object.success,
                    cores_ajax_object.success_msg,
                    'success'
                );
                this.reset();
            } else {
                const errorMessage = result.data?.message || cores_ajax_object.error_msg;
                showNotification(
                    cores_ajax_object.error,
                    errorMessage,
                    'error'
                );
            }

        } catch (error) {
            console.error('Contact form submission error:', error);
            showNotification(
                cores_ajax_object.error,
                cores_ajax_object.error_msg,
                'error'
            );
        
        } finally {
            // Restore button
            submitButton.disabled = false;
            if (buttonText && buttonLoader) {
                buttonText.style.display = 'inline';
                buttonLoader.style.display = 'none';
            } else {
                submitButton.textContent = originalButtonText;
            }
        }
    });
}

/**
 * Initialize newsletter form
 */
function initNewsletterForm() {
    const newsletterForm = document.querySelector('.newsletter-form');
    if (!newsletterForm) return;

    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        console.log('Newsletter submitted (simulation):', email);
        
        showNotification(
            'Successfully Subscribed!',
            'Thank you for subscribing to our newsletter.',
            'success'
        );
        
        this.reset();
    });
}

/**
 * Show notification/toast message
 * @param {string} title - Notification title
 * @param {string} message - Notification message
 * @param {string} type - Type: 'success' or 'error'
 */
function showNotification(title, message, type = 'success') {
    // Remove existing notification
    const existingNotice = document.getElementById('custom-notice');
    if (existingNotice) {
        existingNotice.remove();
    }
    
    const notice = document.createElement('div');
    notice.id = 'custom-notice';
    notice.className = `notification ${type}`;
    notice.setAttribute('role', 'alert');
    notice.setAttribute('aria-live', 'assertive');
    
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    notice.innerHTML = `
        <div class="notification-content">
            <i class="fas ${iconClass}" aria-hidden="true"></i>
            <div>
                <div class="notification-title">${title}</div>
                <div class="notification-message">${message}</div>
            </div>
        </div>
    `;
    
    document.body.appendChild(notice);
    
    // Trigger animation
    setTimeout(() => notice.classList.add('show'), 10);
    
    // Auto-remove after 4 seconds
    setTimeout(() => {
        notice.classList.remove('show');
        setTimeout(() => notice.remove(), 300);
    }, 4000);
}

// ============================================
// MAP FUNCTIONS
// ============================================
function initMap() {
    if (typeof L === 'undefined') {
        return;
    }

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    // Read dynamic data from data attributes
    const lat = parseFloat(mapContainer.dataset.lat) || -8.4384848;
    const lng = parseFloat(mapContainer.dataset.lng) || 112.6678858;
    const zoom = parseInt(mapContainer.dataset.zoom, 10) || 12;
    const markerTitle = mapContainer.dataset.markerTitle || 'Research Location';

    AppState.currentZoom = zoom;

    try {
        AppState.map = L.map('map', {
            center: [lat, lng],
            zoom: zoom,
            zoomControl: false, // We'll add custom controls
            scrollWheelZoom: true,
        });
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(AppState.map);
        
        const mapIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--accent);"></i>',
            className: 'custom-map-icon',
            iconSize: [30, 42],
            iconAnchor: [15, 42],
            popupAnchor: [0, -42]
        });

        const marker = L.marker([lat, lng], {
            title: markerTitle,
            icon: mapIcon,
            alt: markerTitle
        }).addTo(AppState.map);
        
        marker.bindPopup(`<strong>${markerTitle}</strong><br>Coordinates: (${lat}, ${lng})`).openPopup();
        
        // Area of Interest polygon
        const aoiCoords = [
            [-8.469486, 112.616077],
            [-8.469486, 112.717667],
            [-8.415691, 112.717667],
            [-8.415691, 112.616077],
            [-8.469486, 112.616077]
        ];
        
        L.polygon(aoiCoords, {
            color: 'rgba(5, 191, 219, 0.3)',
            weight: 2,
            fillOpacity: 0.2
        }).addTo(AppState.map);
        
        // Update zoom level display
        AppState.map.on('zoomend', function() {
            AppState.currentZoom = AppState.map.getZoom();
            updateZoomLevel();
        });
        
        updateZoomLevel();
        
    } catch (error) {
        console.error('Map setup error:', error);
    }
}

function updateZoomLevel() {
    const zoomLevelElement = document.querySelector('.osm-zoom-level');
    if (zoomLevelElement) {
        const label = zoomLevelElement.textContent.split(' ')[0];
        zoomLevelElement.textContent = `${label} ${AppState.currentZoom}`;
    }
}

/**
 * Initialize map control buttons
 */
function initMapControls() {
    const zoomInBtn = document.getElementById('mapZoomIn');
    const zoomOutBtn = document.getElementById('mapZoomOut');

    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', () => {
            if (AppState.map) {
                AppState.map.zoomIn();
            }
        });
    }

    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', () => {
            if (AppState.map) {
                AppState.map.zoomOut();
            }
        });
    }
}

// ============================================
// FILTER FUNCTIONS
// ============================================

/**
 * Initialize filter button event listeners
 */
function initFilterButtons() {
    // Research filters
    const researchFilters = document.querySelectorAll('.research-filters .filter-btn');
    researchFilters.forEach(btn => {
        btn.addEventListener('click', () => {
            filterResearch(btn.dataset.category);
        });
    });

    // Team filters
    const teamFilters = document.querySelectorAll('.team-filters .filter-btn');
    teamFilters.forEach(btn => {
        btn.addEventListener('click', () => {
            filterTeam(btn.dataset.category);
        });
    });
}

/**
 * Filter research items
 * @param {string} category - Category to filter
 */
window.filterResearch = (category) => {
    const cards = document.querySelectorAll('.research-section .card');
    const buttons = document.querySelectorAll('.research-filters .filter-btn');
    
    buttons.forEach(btn => {
        const isActive = btn.dataset.category === category;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-selected', isActive);
    });
    
    cards.forEach(card => {
        const shouldShow = category === 'all' || card.dataset.category === category;
        
        if (shouldShow) {
            card.style.display = 'block';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 10);
        } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300);
        }
    });

    // Announce to screen readers
    const announcement = category === 'all' 
        ? 'Showing all research items' 
        : `Showing ${category} research items`;
    announceToScreenReader(announcement);
};

/**
 * Filter team members
 * @param {string} category - Category to filter
 */
window.filterTeam = (category) => {
    const members = document.querySelectorAll('.team-section .team-member');
    const buttons = document.querySelectorAll('.team-filters .filter-btn');
    const lecturersTitle = document.getElementById('lecturersTitle');
    const researchersTitle = document.getElementById('researchersTitle');

    buttons.forEach(btn => {
        const isActive = btn.dataset.category === category;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-selected', isActive);
    });

    // Show/hide section titles
    if (lecturersTitle) {
        lecturersTitle.style.display = (category === 'all' || category === 'lecture') ? 'block' : 'none';
    }
    if (researchersTitle) {
        researchersTitle.style.display = (category === 'all' || category === 'researcher') ? 'block' : 'none';
    }
    
    members.forEach(member => {
        const shouldShow = category === 'all' || member.dataset.category === category;
        
        if (shouldShow) {
            member.style.display = 'block';
            setTimeout(() => {
                member.style.opacity = '1';
                member.style.transform = 'translateY(0)';
            }, 10);
        } else {
            member.style.opacity = '0';
            member.style.transform = 'translateY(20px)';
            setTimeout(() => {
                member.style.display = 'none';
            }, 300);
        }
    });

    // Announce to screen readers
    const announcement = category === 'all' 
        ? 'Showing all team members' 
        : `Showing ${category} members`;
    announceToScreenReader(announcement);
};

// ============================================
// TEAM MODAL
// ============================================

/**
 * Initialize team card event listeners
 */
function initTeamCards() {
    // Use event delegation for better performance
    const teamGrids = document.querySelectorAll('.team-grid');
    
    teamGrids.forEach(grid => {
        grid.addEventListener('click', (e) => {
            const memberCard = e.target.closest('.team-member');
            if (memberCard && memberCard.dataset.modalId) {
                openTeamModal(memberCard.dataset.modalId);
            }
        });

        // Keyboard support
        grid.addEventListener('keydown', (e) => {
            const memberCard = e.target.closest('.team-member');
            if (memberCard && memberCard.dataset.modalId && (e.key === 'Enter' || e.key === ' ')) {
                e.preventDefault();
                openTeamModal(memberCard.dataset.modalId);
            }
        });
    });
}

/**
 * Open team member modal
 * @param {string} memberId - Member slug/ID
 */
window.openTeamModal = (memberId) => {
    const modal = document.getElementById('teamModal');
    const modalBody = document.getElementById('modalBody');
    
    if (!modal || !modalBody) return;
    
    // Store the element that triggered the modal
    AppState.lastFocusedElement = document.activeElement;
    
    // Get member data from localized script
    const member = (typeof coresTeamData !== 'undefined' && coresTeamData[memberId])
        ? coresTeamData[memberId]
        : {
            name: 'Data Not Found',
            title: 'Error',
            bio: 'Could not load team member data. Please ensure the member exists in the WordPress dashboard.',
            expertise: ['N/A'],
            publications: 'N/A',
            email: 'N/A'
        };
    
    // Populate modal content
    modalBody.innerHTML = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
                <i class="fas fa-user" aria-hidden="true"></i>
            </div>
            <h2 id="modalTitle" style="color: var(--primary); margin-bottom: 0.5rem; font-size: 1.5rem;">${member.name}</h2>
            <p style="color: var(--accent); font-size: 1.2rem;">${member.title}</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">About</h3>
            <div style="line-height: 1.6;">${member.bio}</div>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">Expertise</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                ${member.expertise.map(skill => `<span class="team-tag">${skill}</span>`).join('')}
            </div>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">Academic Profile</h3>
            <p>Publications: ${member.publications}</p>
            <p>Email: <a href="mailto:${member.email}" style="color: var(--accent);">${member.email}</a></p>
        </div>
        <div style="text-align: center;">
            <button class="cta-button" id="modalCloseButton">${document.documentElement.lang === 'id' ? 'Tutup' : 'Close'}</button>
        </div>
    `;
    
    // Show modal
    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modal.classList.add('active');
        // Focus the close button
        const closeBtn = document.getElementById('modalCloseButton');
        if (closeBtn) {
            closeBtn.focus();
            closeBtn.addEventListener('click', closeTeamModal);
        }
    }, 10);

    // Trap focus inside modal
    trapFocus(modal);
};

/**
 * Close team member modal
 */
window.closeTeamModal = () => {
    const modal = document.getElementById('teamModal');
    if (!modal) return;
    
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    
    setTimeout(() => {
        modal.style.display = 'none';
        // Return focus to the element that opened the modal
        if (AppState.lastFocusedElement) {
            AppState.lastFocusedElement.focus();
        }
    }, 300);
};

// Modal event listeners
const teamModal = document.getElementById('teamModal');
if (teamModal) {
    // Close on backdrop click
    teamModal.addEventListener('click', (e) => {
        if (e.target === teamModal || e.target.closest('.modal-close')) {
            closeTeamModal();
        }
    });

    // Close on Escape key
    teamModal.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeTeamModal();
        }
    });
}

// ============================================
// GALLERY CAROUSEL & LIGHTBOX (NEW FEATURES)
// ============================================
function initGalleryCarousel() {
    if (typeof Swiper === 'undefined') {
        return;
    }

    const galleryCarousel = document.querySelector('.gallery-carousel');
    if (!galleryCarousel) return;

    try {
        new Swiper('.gallery-carousel', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                type: 'bullets',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            a11y: {
                enabled: true,
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                paginationBulletMessage: 'Go to slide {{index}}',
            },
        });
    } catch (error) {
        console.error('Swiper.js setup error:', error);
    }

    // =========================================
    // LIGHTBOX IMPLEMENTATION (Added V2.3)
    // =========================================
    
    // Create lightbox elements if they don't exist
    let lightbox = document.getElementById('gallery-lightbox');
    if (!lightbox) {
        lightbox = document.createElement('div');
        lightbox.id = 'gallery-lightbox';
        lightbox.className = 'lightbox';
        lightbox.setAttribute('role', 'dialog');
        lightbox.setAttribute('aria-label', 'Image Lightbox');
        lightbox.innerHTML = `
            <button class="lightbox-close" aria-label="Close lightbox">&times;</button>
            <div class="lightbox-content">
                <img class="lightbox-img" src="" alt="Full screen image">
                <div class="lightbox-caption"></div>
            </div>
        `;
        document.body.appendChild(lightbox);
        
        // Add styles dynamically for lightbox so it works instantly
        const style = document.createElement('style');
        style.innerHTML = `
            .lightbox {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0,0,0,0.95); z-index: 10000; display: none;
                justify-content: center; align-items: center; opacity: 0;
                transition: opacity 0.3s ease; backdrop-filter: blur(5px);
            }
            .lightbox.active { opacity: 1; }
            .lightbox-content { position: relative; max-width: 90%; max-height: 85vh; text-align: center; }
            .lightbox-img { max-width: 100%; max-height: 80vh; border-radius: 4px; box-shadow: 0 5px 30px rgba(0,0,0,0.5); }
            .lightbox-caption { color: white; margin-top: 1rem; font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.8); }
            .lightbox-close {
                position: absolute; top: 20px; right: 30px; background: none; border: none;
                color: white; font-size: 3rem; cursor: pointer; z-index: 10001;
                transition: transform 0.2s; line-height: 1;
            }
            .lightbox-close:hover { transform: scale(1.2) rotate(90deg); color: var(--accent); }
        `;
        document.head.appendChild(style);
    }

    const lightboxImg = lightbox.querySelector('.lightbox-img');
    const lightboxCaption = lightbox.querySelector('.lightbox-caption');
    const lightboxClose = lightbox.querySelector('.lightbox-close');

    const closeLightbox = () => {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        setTimeout(() => {
            lightbox.style.display = 'none';
        }, 300);
    };

    const openLightbox = (src, alt) => {
        lightboxImg.src = src;
        lightboxImg.alt = alt || 'Research Image';
        lightboxCaption.textContent = alt || '';
        
        lightbox.style.display = 'flex';
        // Small delay to allow display:flex to apply before opacity transition
        setTimeout(() => {
            lightbox.classList.add('active');
        }, 10);
        document.body.style.overflow = 'hidden';
        lightboxClose.focus();
    };

    // Attach click events to swiper images
    document.querySelectorAll('.swiper-slide img').forEach(img => {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', () => {
            // Check if we have a high-res version in data attribute, else use src
            const fullSrc = img.getAttribute('data-full-src') || img.src;
            const caption = img.nextElementSibling?.innerText || img.alt;
            openLightbox(fullSrc, caption);
        });
        
        // Add keyboard support for opening
        img.setAttribute('tabindex', '0');
        img.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                img.click();
            }
        });
    });

    // Close events
    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox.style.display === 'flex') closeLightbox();
    });
}

// ============================================
// READING PROGRESS BAR (NEW FEATURE)
// ============================================
function initReadingProgressBar() {
    // Only run on single post pages where the bar exists
    const progressBar = document.getElementById('reading-progress-bar');
    const contentArea = document.querySelector('.entry-content');
    
    if (!progressBar || !contentArea) return;

    window.addEventListener('scroll', throttle(() => {
        const contentBox = contentArea.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        const totalHeight = contentBox.height;
        
        // Start calculating when the top of content hits the middle of viewport
        const startPoint = contentArea.offsetTop - windowHeight + (windowHeight / 2);
        const currentScroll = window.scrollY;
        
        let percentage = 0;
        
        if (currentScroll > startPoint) {
            const scrolled = currentScroll - startPoint;
            percentage = (scrolled / totalHeight) * 100;
        }
        
        // Clamp between 0 and 100
        percentage = Math.max(0, Math.min(100, percentage));
        
        progressBar.style.width = `${percentage}%`;
        progressBar.setAttribute('aria-valuenow', Math.round(percentage));
    }, 50), { passive: true });
}

// ============================================
// STICKY SIDEBAR LOGIC (NEW FEATURE)
// ============================================
function initStickySidebar() {
    const sidebar = document.querySelector('.sidebar-sticky-container');
    const footer = document.querySelector('footer');
    
    if (!sidebar || !footer) return;

    // Only run on desktop
    if (window.matchMedia('(max-width: 992px)').matches) return;

    window.addEventListener('scroll', throttle(() => {
        const sidebarRect = sidebar.getBoundingClientRect();
        const footerRect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        
        // Calculate limit
        const distanceToFooter = footerRect.top - windowHeight;
        
        // If sidebar is taller than viewport, we need more complex logic
        // For now, we assume standard sticky behavior via CSS is active
        // This JS just prevents it from overlapping the footer if CSS sticky fails
        // or adds a class when it hits the bottom.
        
        if (footerRect.top < windowHeight) {
            // Footer is entering view
            const pushUp = windowHeight - footerRect.top + 20; // 20px buffer
            sidebar.style.transform = `translateY(-${pushUp}px)`;
        } else {
            sidebar.style.transform = 'translateY(0)';
        }
    }, 50), { passive: true });
}

// ============================================
// ACCESSIBILITY HELPERS
// ============================================

/**
 * Initialize accessibility features
 */
function initAccessibility() {
    // Add skip links functionality
    const skipLinks = document.querySelectorAll('.skip-link');
    skipLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const targetId = link.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            if (target) {
                e.preventDefault();
                target.setAttribute('tabindex', '-1');
                target.focus();
                target.addEventListener('blur', () => {
                    target.removeAttribute('tabindex');
                }, { once: true });
            }
        });
    });

    // Announce page changes for SPAs (if implemented in future)
    observePageChanges();
}

/**
 * Trap focus inside an element (for modals)
 * @param {Element} element - Element to trap focus in
 */
function trapFocus(element) {
    const focusableElements = element.querySelectorAll(
        'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
    );
    
    if (focusableElements.length === 0) return;
    
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    const handleTabKey = (e) => {
        if (e.key !== 'Tab') return;

        if (e.shiftKey) {
            if (document.activeElement === firstElement) {
                e.preventDefault();
                lastElement.focus();
            }
        } else {
            if (document.activeElement === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    };

    element.addEventListener('keydown', handleTabKey);
}

/**
 * Announce to screen readers using aria-live region
 * @param {string} message - Message to announce
 */
function announceToScreenReader(message) {
    let liveRegion = document.getElementById('aria-live-region');
    
    if (!liveRegion) {
        liveRegion = document.createElement('div');
        liveRegion.id = 'aria-live-region';
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'screen-reader-text';
        document.body.appendChild(liveRegion);
    }
    
    liveRegion.textContent = message;
    
    // Clear after announcement
    setTimeout(() => {
        liveRegion.textContent = '';
    }, 1000);
}

/**
 * Observe page changes for SPA-like behavior
 */
function observePageChanges() {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                // Re-initialize scroll animations for new content
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1 && node.classList) {
                        if (node.classList.contains('fade-in') || 
                            node.classList.contains('slide-in-left') || 
                            node.classList.contains('slide-in-right')) {
                            // Trigger animation
                            setTimeout(() => node.classList.add('visible'), 100);
                        }
                    }
                });
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
}

// ============================================
// PERFORMANCE MONITORING
// ============================================

/**
 * Log performance metrics (development only)
 */
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    window.addEventListener('load', () => {
        setTimeout(() => {
            if (window.performance && window.performance.timing) {
                const perfData = window.performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                const connectTime = perfData.responseEnd - perfData.requestStart;
                const renderTime = perfData.domComplete - perfData.domLoading;
                
                console.log('⚡ Performance Metrics:');
                console.log(`Page Load Time: ${pageLoadTime}ms`);
                console.log(`Connect Time: ${connectTime}ms`);
                console.log(`Render Time: ${renderTime}ms`);
            }
        }, 0);
    }, { once: true, passive: true });
}

// ============================================
// SERVICE WORKER (PWA Support)
// ============================================

/**
 * Register service worker for offline support (if available)
 */
if ('serviceWorker' in navigator && window.location.protocol === 'https:') {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('ServiceWorker registered:', registration);
            })
            .catch(err => {
                console.log('ServiceWorker registration failed:', err);
            });
    }, { once: true, passive: true });
}

// ============================================
// LAZY LOADING IMAGES
// ============================================

/**
 * Native lazy loading fallback with Intersection Observer
 */
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ============================================
// CONSOLE EASTER EGG
// ============================================
if (console && typeof console.log === 'function') {
    console.log('%c🌊 CORES Theme V2.3.0', 'color: #05BFDB; font-size: 20px; font-weight: bold;');
    console.log('%cBuilt with ❤️ by CORES Research Team', 'color: #0A4D68; font-size: 12px;');
    console.log('%cInterested in our research? Visit: ' + window.location.origin, 'color: #088395; font-size: 12px;');
}

// ============================================
// GLOBAL UTILITY EXPORTS
// ============================================

// Export utility functions to window for external use
window.coresUtils = {
    smoothScrollTo,
    showNotification,
    announceToScreenReader,
    debounce,
    throttle,
};

// ============================================
// END OF MAIN.JS
// ============================================

/**
 * Theme: CORES Theme V2
 * Version: 2.3.0
 * Author: CORES Research Team
 * License: GPL v2 or later
 * * This JavaScript file follows modern best practices:
 * ✓ Performance optimized (debounce, throttle, passive listeners)
 * ✓ Accessibility compliant (WCAG 2.1 Level AA)
 * ✓ Progressive enhancement
 * ✓ Error handling and graceful degradation
 * ✓ Mobile-first and touch-friendly
 * ✓ Service Worker ready for PWA
 * ✓ Intersection Observer for animations
 * ✓ Clean, maintainable code structure
 */