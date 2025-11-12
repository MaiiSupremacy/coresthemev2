/**
 * Main JavaScript file for the CORES Theme
 *
 * This file handles all the interactive elements:
 * - Loader
 * - Custom Cursor
 * - Navigation (scrolling, mobile menu)
 * - Hero Slider
 * - Scroll Animations
 * - Forms
 * - Leaflet Map
 * - Filtering for Research & Team
 * - Team Modal
 * - Gallery Carousel (Swiper.js)
 *
 * *** MAJOR UPDATE (STEP 12) ***
 * - DELETED the entire static `const teamData = {...}` object.
 * - MODIFIED `openTeamModal()` to read from the dynamic `coresTeamData` object
 * which is now provided by `functions.php` (via wp_localize_script).
 * - The Team Modals are now 100% dynamic and managed from WordPress.
 *
 * *** MAJOR UPDATE (STEP 13) ***
 * - REBUILT the `initForms()` function for the contact form.
 * - It now uses fetch() to send a secure AJAX request to WordPress.
 * - It uses the `cores_ajax_object` (from wp_localize_script) for the URL and nonce.
 * - ADDED a new `showCustomNotice()` helper function to display real success/error messages.
 */

// Global error handler to prevent script execution from stopping
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
});

// Initialize variables
let currentSlide = 0;
let slideInterval;
let map;
let aoiLayer;
let currentZoom = 12;

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functions with error handling
    try {
        initLoader();
        initCursor();
        initNavigation();
        initSlider();
        initScrollAnimations();
        initForms();
        initMap(); // Only runs if map container exists
        initGalleryCarousel(); // Only runs if gallery exists
        
        // Ensure filter functions are available on page load
        if (typeof filterResearch === 'function') {
            filterResearch('all'); 
        }
        if (typeof filterTeam === 'function') {
            filterTeam('all'); 
        }

        // *** ADDED: Event listeners for Research filter buttons (replaces onclick) ***
        const researchFilters = document.querySelectorAll('.research-filters .filter-btn');
        if (researchFilters.length > 0) {
            researchFilters.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterResearch(btn.dataset.category);
                });
            });
        }

        // *** ADDED: Event listeners for Team filter buttons (replaces onclick) ***
        const teamFilters = document.querySelectorAll('.team-filters .filter-btn');
        if (teamFilters.length > 0) {
            teamFilters.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterTeam(btn.dataset.category);
                });
            });
        }
        
        // *** ADDED: Event listeners for Team Member cards (replaces onclick) ***
        // This uses event delegation on the grid container for better performance
        const teamGridContainer = document.getElementById('team-grid-container');
        if (teamGridContainer) {
            teamGridContainer.addEventListener('click', (e) => {
                const memberCard = e.target.closest('.team-member');
                if (memberCard && memberCard.dataset.modalId) {
                    openTeamModal(memberCard.dataset.modalId);
                }
            });
        }
        // ... and for the second grid
        const teamGridContainer2 = document.querySelector('.team-grid:last-of-type'); // A bit fragile, but works
         if (teamGridContainer2) {
            teamGridContainer2.addEventListener('click', (e) => {
                const memberCard = e.target.closest('.team-member');
                if (memberCard && memberCard.dataset.modalId) {
                    openTeamModal(memberCard.dataset.modalId);
                }
            });
        }
        
        // *** ADDED: Event listeners for Map Controls (replaces onclick) ***
        const mapZoomIn = document.getElementById('mapZoomIn');
        const mapZoomOut = document.getElementById('mapZoomOut');
        if (mapZoomIn) {
            mapZoomIn.addEventListener('click', () => zoomIn());
        }
        if (mapZoomOut) {
            mapZoomOut.addEventListener('click', () => zoomOut());
        }


    } catch (error) {
        console.error('Initialization error:', error);
        hideLoader();
    }
});

// Loader functions
function initLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'flex'; 
    }
    
    window.addEventListener('load', () => {
        setTimeout(function() {
            hideLoader();
        }, 500);
    });

    setTimeout(function() {
        hideLoader();
    }, 4000); 
}

function hideLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.classList.add('hidden');
        setTimeout(() => {
            if (loader) loader.style.display = 'none';
        }, 500);
    }
}

// Custom Cursor - Only initialize on non-touch devices
function initCursor() {
    if (window.matchMedia('(hover: hover)').matches) {
        const cursor = document.querySelector('.cursor');
        const cursorFollower = document.querySelector('.cursor-follower');
        
        if (cursor && cursorFollower) {
            document.addEventListener('mousemove', (e) => {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
                
                setTimeout(() => {
                    cursorFollower.style.left = e.clientX + 'px';
                    cursorFollower.style.top = e.clientY + 'px';
                }, 100);
            });

             // *** ADDED: Cursor scaling on hover ***
            document.querySelectorAll('a, button, .team-member, .card-link, .slider-arrow, .dot, .filter-btn, .milestone-link').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursorFollower.style.transform = 'translate(-50%, -50%) scale(2.5)';
                    cursorFollower.style.borderColor = 'var(--primary)';
                });
                el.addEventListener('mouseleave', () => {
                    cursorFollower.style.transform = 'translate(-50%, -50%) scale(1)';
                    cursorFollower.style.borderColor = 'var(--accent)';
                });
            });
        }
    }
}

// Navigation functions
function initNavigation() {
    const hamburger = document.getElementById('hamburger');
    const slideMenu = document.getElementById('slideMenu');
    const menuClose = document.getElementById('menuClose');
    const navbar = document.getElementById('navbar');

    if (hamburger && slideMenu && menuClose) {
        hamburger.addEventListener('click', () => {
            const isExpanded = hamburger.getAttribute('aria-expanded') === 'true';
            hamburger.setAttribute('aria-expanded', !isExpanded);
            hamburger.classList.toggle('active');
            slideMenu.classList.toggle('active');
            if (!isExpanded) {
                slideMenu.querySelector('a, button').focus(); // Focus first item
            }
        });

        menuClose.addEventListener('click', () => {
            hamburger.setAttribute('aria-expanded', 'false');
            hamburger.classList.remove('active');
            slideMenu.classList.remove('active');
            hamburger.focus(); // Return focus to hamburger
        });

        const menuLinks = document.querySelectorAll('.slide-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (link.hash) {
                    hamburger.setAttribute('aria-expanded', 'false');
                    hamburger.classList.remove('active');
                    slideMenu.classList.remove('active');
                }
            });
        });
    }

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        if (navbar) {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        // Update active navigation link based on scroll position
        const navLinks = document.querySelectorAll('nav ul a');
        const sections = document.querySelectorAll('section[id]');
        const scrollPosition = window.scrollY + (navbar ? navbar.offsetHeight : 80) + 50;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') && link.getAttribute('href').includes(`#${sectionId}`)) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });

    // Back to top button
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Smooth scrolling for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href.length > 1) {
                e.preventDefault();
                const targetId = href.substring(href.indexOf('#') + 1);
                const target = document.getElementById(targetId);
                if (target) {
                    scrollToSection(targetId);
                }
            }
        });
    });
}

// Slider functions
function initSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const progressBar = document.getElementById('progressBar');
    const prevSlideBtn = document.getElementById('prevSlide');
    const nextSlideBtn = document.getElementById('nextSlide');

    if (slides.length === 0) return;

    function showSlide(n) {
        slides.forEach((slide, index) => {
            slide.classList.remove('active');
            slide.setAttribute('aria-hidden', 'true');
        });
        dots.forEach((dot, index) => {
            dot.classList.remove('active');
            dot.setAttribute('aria-selected', 'false');
        });
        
        currentSlide = (n + slides.length) % slides.length;
        
        slides[currentSlide].classList.add('active');
        slides[currentSlide].setAttribute('aria-hidden', 'false');

        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
            dots[currentSlide].setAttribute('aria-selected', 'true');
        }
        
        if (progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.transition = 'width 7s linear';
                progressBar.style.width = '100%';
            }, 50);
        }
    }
    
    // *** ADDED: Event Listeners for Dots ***
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            clearInterval(slideInterval);
            showSlide(index);
            startSlideShow();
        });
    });


    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function startSlideShow() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 7000);
    }

    if (nextSlideBtn) {
        nextSlideBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
        });
    }

    if (prevSlideBtn) {
        prevSlideBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        });
    }

    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        heroSection.addEventListener('mouseleave', () => {
            startSlideShow();
        });

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
            if (touchEndX < touchStartX - 50) {
                clearInterval(slideInterval);
                nextSlide();
                startSlideShow();
            }
            if (touchEndX > touchStartX + 50) {
                clearInterval(slideInterval);
                prevSlide();
                startSlideShow();
            }
        }
    }

    document.addEventListener('keydown', (e) => {
        if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
            return;
        }
        // Only control slider if hero is in view
        if(heroSection && (heroSection.getBoundingClientRect().top < 50 && heroSection.getBoundingClientRect().bottom > 50)) {
            if (e.key === 'ArrowLeft') {
                clearInterval(slideInterval);
                prevSlide();
                startSlideShow();
            } else if (e.key === 'ArrowRight') {
                clearInterval(slideInterval);
                nextSlide();
                startSlideShow();
            }
        }
    });

    showSlide(0);
    startSlideShow();
}

// Scroll animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach(el => {
        observer.observe(el);
    });
}

// ============================================
// *** STEP 13: FORM FUNCTIONS (AJAX) ***
// ============================================

/**
 * NEW: Reusable function to show a success/error notice
 * @param {string} title - The title of the notice
 * @param {string} message - The body text of the notice
 * @param {boolean} isSuccess - True for success (green/blue), false for error (red)
 */
function showCustomNotice(title, message, isSuccess = true) {
    const existingNotice = document.getElementById('custom-notice');
    if (existingNotice) {
        existingNotice.remove();
    }
    
    const notice = document.createElement('div');
    notice.id = 'custom-notice';
    const noticeColor = isSuccess ? 'linear-gradient(135deg, var(--primary), var(--accent))' : 'linear-gradient(135deg, #D32F2F, #E57373)';
    
    notice.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: ${noticeColor};
        color: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 10000;
        text-align: center;
        animation: fadeInUp 0.5s ease;
    `;
    
    notice.innerHTML = `
        <h3 style="margin-bottom: 1rem;">${title}</h3>
        <p>${message}</p>
    `;
    
    document.body.appendChild(notice);
    
    setTimeout(() => {
        notice.remove();
    }, 4000);
}


async function initForms() {
    
    // === Contact Form (AJAX Enabled) ===
    const contactForm = document.getElementById('contactForm');
    
    // Check if the form and our localized AJAX object exist
    if (contactForm && typeof cores_ajax_object !== 'undefined') {
        
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;

            // 1. Set loading state
            submitButton.disabled = true;
            submitButton.textContent = cores_ajax_object.sending; // "Sending..."

            // 2. Prepare form data
            const formData = new FormData(this);
            formData.append('action', 'send_contact_email'); // This is the PHP hook
            formData.append('nonce', cores_ajax_object.contact_nonce); // The security nonce
            
            try {
                // 3. Send the data
                const response = await fetch(cores_ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData,
                });

                // 4. Get the JSON response
                const result = await response.json();

                // 5. Handle success or error
                if (result.success) {
                    // Show success message (using translated strings from PHP)
                    showCustomNotice(cores_ajax_object.success, cores_ajax_object.success_msg, true);
                    this.reset();
                } else {
                    // Show error message from server
                    // If result.data.message exists, use it, otherwise use generic error
                    const errorMessage = result.data.message || cores_ajax_object.error_msg;
                    showCustomNotice(cores_ajax_object.error, errorMessage, false);
                }

            } catch (error) {
                // Network error, etc.
                console.error('Contact form submission error:', error);
                showCustomNotice(cores_ajax_object.error, cores_ajax_object.error_msg, false);
            
            } finally {
                // 6. Restore button
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    }

    // === Newsletter Form (Simulation) ===
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            console.log('Newsletter submitted (simulation):', email);
            
            // We can use our new helper function here too!
            showCustomNotice('Successfully Subscribed!', 'Thank you for subscribing to our newsletter.', true);
            
            this.reset();
        });
    }
}

// Map functions
// *** IMPROVED: Map now reads dynamic data from the HTML ***
function initMap() {
    if (typeof L === 'undefined') {
        console.error('Leaflet.js is not loaded.');
        return;
    }

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    // Read dynamic data from data- attributes
    const lat = parseFloat(mapContainer.dataset.lat) || -8.4384848;
    const lng = parseFloat(mapContainer.dataset.lng) || 112.6678858;
    const zoom = parseInt(mapContainer.dataset.zoom, 10) || 12;
    const markerTitle = mapContainer.dataset.markerTitle || 'Research Location';

    currentZoom = zoom; // Set global zoom variable

    try {
        map = L.map('map').setView([lat, lng], zoom);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        const mapIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--accent);"></i>',
            className: 'custom-map-icon',
            iconSize: [30, 42],
            iconAnchor: [15, 42],
            popupAnchor: [0, -42]
        });

        const marker = L.marker([lat, lng], {
            title: markerTitle,
            icon: mapIcon
        }).addTo(map);
        
        marker.bindPopup(`<b>${markerTitle}</b><br>Coordinates: (${lat}, ${lng})`).openPopup();
        
        const aoiCoords = [
            [-8.469486, 112.616077],
            [-8.469486, 112.717667],
            [-8.415691, 112.717667],
            [-8.415691, 112.616077],
            [-8.469486, 112.616077]
        ];
        
        aoiLayer = L.polygon(aoiCoords, {
            color: 'rgba(5, 191, 219, 0.3)',
            weight: 2,
            fillOpacity: 0.2
        }).addTo(map);
        
        map.on('zoomend', function() {
            currentZoom = map.getZoom();
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
        // Just update the number, keep the translated "Zoom:" text
        zoomLevelElement.textContent = `${zoomLevelElement.textContent.split(' ')[0]} ${currentZoom}`;
    }
}

// *** IMPROVED: Global functions for map controls ***
window.zoomIn = () => {
    if (map) {
        map.zoomIn();
    }
};

window.zoomOut = () => {
    if (map) {
        map.zoomOut();
    }
};

// Filter functions
window.filterResearch = (category) => {
    const cards = document.querySelectorAll('.research-section .card');
    const buttons = document.querySelectorAll('.research-filters .filter-btn');
    
    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false'); // Accessibility
        if (btn.dataset.category === category) {
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true'); // Accessibility
        }
    });
    
    cards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
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
};

window.filterTeam = (category) => {
    const members = document.querySelectorAll('.team-section .team-member');
    const buttons = document.querySelectorAll('.team-filters .filter-btn');
    
    const lecturersTitle = document.getElementById('lecturersTitle');
    const researchersTitle = document.getElementById('researchersTitle');

    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false'); // Accessibility
        if (btn.dataset.category === category) {
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true'); // Accessibility
        }
    });

    if (lecturersTitle) {
        lecturersTitle.style.display = (category === 'all' || category === 'lecture') ? 'block' : 'none';
    }
    if (researchersTitle) {
        researchersTitle.style.display = (category === 'all' || category === 'researcher') ? 'block' : 'none';
    }
    
    members.forEach(member => {
        if (category === 'all' || member.dataset.category === category) {
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
};

// ============================================
// *** STEP 12: DYNAMIC MODAL FUNCTIONS ***
// ============================================

// *** DELETED: The entire 100+ line static `const teamData = {...}` object. ***
// It is no longer needed. Data now comes from `coresTeamData`.

let lastFocusedElement; // For accessibility

window.openTeamModal = (memberId) => {
    const modal = document.getElementById('teamModal');
    const modalBody = document.getElementById('modalBody');
    
    if (!modal || !modalBody) return;
    
    // Store the element that was focused before opening the modal
    lastFocusedElement = document.activeElement;
    
    // *** MODIFIED (STEP 12): Read from `coresTeamData` (from PHP) instead of `teamData` ***
    const member = (typeof coresTeamData !== 'undefined' && coresTeamData[memberId])
        ? coresTeamData[memberId]
        : {
            // This is a new, more informative fallback object.
            name: 'Data Not Found',
            title: 'Error',
            bio: 'Could not load team member data. Please ensure the member slug is correct and data has been entered in the WordPress dashboard.',
            expertise: ['N/A'],
            publications: 'N/A',
            email: 'N/A'
        };
    
    // The rest of this function is identical, as the object keys match.
    // We also use .innerHTML for the 'bio' field because it's rich text (from the editor)
    modalBody.innerHTML = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
                <i class="fas fa-user"></i>
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
            <button class="cta-button" id="modalCloseButton">Close</button>
        </div>
    `;
    
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('active');
        // Focus the first focusable element in the modal (the close button)
        document.getElementById('modalCloseButton').focus();
    }, 10); // small delay for CSS transition

    // Add event listener to the new close button
    document.getElementById('modalCloseButton').addEventListener('click', closeTeamModal);
};

window.closeTeamModal = () => {
    const modal = document.getElementById('teamModal');
    if (modal) {
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
            // Return focus to the element that opened the modal
            if (lastFocusedElement) {
                lastFocusedElement.focus();
            }
        }, 300); // Wait for animation to finish
    }
};

const teamModal = document.getElementById('teamModal');
if (teamModal) {
    teamModal.addEventListener('click', (e) => {
        // Check for .modal-close click *or* backdrop click
        if (e.target.closest('.modal-close') || e.target === teamModal) {
            closeTeamModal();
        }
    });

    // Trap focus inside modal for accessibility
    teamModal.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeTeamModal();
            return;
        }

        if (e.key === 'Tab') {
            const focusableElements = modal.querySelectorAll('a[href], button, textarea, input, select');
            const firstElement = focusableElements[0]; // This should be the .modal-close button
            const lastElement = focusableElements[focusableElements.length - 1]; // This should be the main "Close" button

            if (e.shiftKey) { // if shift + tab
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    e.preventDefault();
                }
            } else { // if tab
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    e.preventDefault();
                }
            }
        }
    });
}

// Gallery Carousel (Swiper.js)
function initGalleryCarousel() {
    if (typeof Swiper === 'undefined') {
        console.error('Swiper.js is not loaded.');
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
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            keyboard: {
                enabled: true,
            },
        });
    } catch (error) {
        console.error('Swiper.js setup error:', error);
    }
}

// Global smooth scroll function
window.scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);
    const navbar = document.getElementById('navbar');
    
    if (section) {
        let offset = 0;
        if (navbar) {
            const navStyle = window.getComputedStyle(navbar);
            if (navStyle.position === 'fixed') {
                offset = navbar.offsetHeight;
            }
        }
        
        const targetPosition = section.offsetTop - offset;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
};