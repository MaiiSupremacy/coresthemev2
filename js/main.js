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
 * UPDATED: Removed Chart.js functionality
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
            hamburger.classList.toggle('active');
            slideMenu.classList.toggle('active');
        });

        menuClose.addEventListener('click', () => {
            hamburger.classList.remove('active');
            slideMenu.classList.remove('active');
        });

        const menuLinks = document.querySelectorAll('.slide-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (link.hash) {
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
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        currentSlide = (n + slides.length) % slides.length;
        
        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
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

    window.goToSlide = (n) => {
        clearInterval(slideInterval);
        showSlide(n);
        startSlideShow();
    };

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
        if (e.key === 'ArrowLeft') {
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        } else if (e.key === 'ArrowRight') {
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
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

// Form functions
function initForms() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            console.log('Form submitted (simulation):', data);
            
            this.reset();
            
            const successMessage = document.createElement('div');
            successMessage.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, var(--primary), var(--accent));
                color: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                animation: fadeInUp 0.5s ease;
            `;
            successMessage.innerHTML = `
                <h3 style="margin-bottom: 1rem;">Message Sent Successfully!</h3>
                <p>Thank you for contacting us. We will get back to you soon.</p>
            `;
            
            document.body.appendChild(successMessage);
            
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
        });
    }

    const newsletterForm = document.querySelector('footer form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            console.log('Newsletter submitted (simulation):', email);
            
            const successMessage = document.createElement('div');
            successMessage.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, var(--primary), var(--accent));
                color: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                animation: fadeInUp 0.5s ease;
            `;
            successMessage.innerHTML = `
                <h3 style="margin-bottom: 1rem;">Successfully Subscribed!</h3>
                <p>Thank you for subscribing to our newsletter.</p>
            `;
            
            document.body.appendChild(successMessage);
            
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
            
            this.reset();
        });
    }
}

// Map functions
function initMap() {
    if (typeof L === 'undefined') {
        console.error('Leaflet.js is not loaded.');
        return;
    }

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    try {
        map = L.map('map').setView([-8.4384848, 112.6678858], 12);
        
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

        const marker = L.marker([-8.4384848, 112.6678858], {
            title: 'Clungup Research Location',
            icon: mapIcon
        }).addTo(map);
        
        marker.bindPopup(`<b>Clungup Research Location</b><br>Coordinates: (-8.4384848, 112.6678858)`).openPopup();
        
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
        zoomLevelElement.textContent = `Zoom: ${currentZoom}`;
    }
}

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

// *** REMOVED: Chart.js Initialization ***
// The initCoastalChangeChart() function has been removed
// as charts are no longer needed in the new design

// Filter functions
window.filterResearch = (category) => {
    const cards = document.querySelectorAll('.research-section .card');
    const buttons = document.querySelectorAll('.research-filters .filter-btn');
    
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.category === category) {
            btn.classList.add('active');
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
        if (btn.dataset.category === category) {
            btn.classList.add('active');
        }
    });

    if (lecturersTitle) {
        lecturersTitle.style.display = (category === 'all' || category === 'Lecture') ? 'block' : 'none';
    }
    if (researchersTitle) {
        researchersTitle.style.display = (category === 'all' || category === 'researchers') ? 'block' : 'none';
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

// Modal functions
const teamData = {
    supervisor1: {
        name: 'Dr. Ir. Runi Asmaranto ST., MT., IPM., ASEAN Eng.',
        title: 'Lecture',
        bio: 'Dr. Ir. Runi Asmaranto ST., MT., IPM., ASEAN Eng. is a renowned expert in dam engineering with over 20 years of experience in reservoir and dam conservation.',
        expertise: ['Dam Expert', 'Reservoir and Dam Conservation'],
        publications: 45,
        email: 'runi@ub.ac.id'
    },
    supervisor2: {
        name: 'Dr. Ir. Very Dermawan, ST., MT.,IPM., ASEAN Eng.',
        title: 'Lecture',
        bio: 'Dr. Ir. Very Dermawan, ST., MT.,IPM., ASEAN Eng. specializes in hydraulics with extensive field experience in water resources engineering.',
        expertise: ['Hydraulics', 'Water Resources', 'Fluid Mechanics'],
        publications: 38,
        email: 'very@ub.ac.id'
    },
    supervisor3: {
        name: 'Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng.',
        title: 'Lecture',
        bio: 'Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng. is a distinguished coastal engineer with expertise in coastal processes and protection strategies.',
        expertise: ['Coastal Engineering', 'Coastal Dynamics', 'Coastal Protection'],
        publications: 52,
        email: 'sebrian@ub.ac.id'
    },
    supervisor4: {
        name: 'Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D.',
        title: 'Lecture',
        bio: 'Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D. focuses on numerical modeling with expertise in computational methods for coastal engineering.',
        expertise: ['Numerical Modeling', 'Computational Methods', 'Data Analysis'],
        publications: 31,
        email: 'amar@ub.ac.id'
    },
    researcher1: {
        name: 'Shareef Abdurrahim Yulianto',
        title: 'Researcher',
        bio: 'Shareef specializes in wave analysis and field research, with expertise in coastal monitoring equipment and data collection.',
        expertise: ['Coastal Dynamics', 'Mangrove Studies', 'Field Research', 'Data Collection'],
        publications: 8,
        email: 'shareef@ub.ac.id'
    },
    researcher2: {
        name: 'Aan Mustaqim',
        title: 'Researcher',
        bio: 'Aan is an expert in laboratory analysis and geochemistry, focusing on sediment composition and transport mechanisms.',
        expertise: ['Mangrove Studies', 'Data Analysis', 'Coastal Dynamics', 'Lab Analysis', 'Geochemistry'],
        publications: 6,
        email: 'aan@ub.ac.id'
    },
    researcher3: {
        name: 'Bilan Ayu Ardita',
        title: 'Researcher',
        bio: 'Bilan combines GIS expertise with fieldwork skills to create comprehensive mapping solutions for coastal research.',
        expertise: ['Mangrove Studies', 'Coastal Dynamics', 'GIS', 'Field Research'],
        publications: 7,
        email: 'bilan@ub.ac.id'
    },
    researcher4: {
        name: 'Maharani Dewi Ayu Maulana Sinatria',
        title: 'Researcher',
        bio: 'Maharani specializes in coastal ecosystem studies, focusing on the interaction between physical and biological processes.',
        expertise: ['Coastal Dynamics', 'Mangrove Studies', 'Ecosystem Analysis'],
        publications: 5,
        email: 'maharani@ub.ac.id'
    },
    researcher5: {
        name: 'Laode Almay Fi Ahsany Taqwim',
        title: 'Researcher',
        bio: 'Laode is an expert in data analysis and modeling, transforming complex coastal data into actionable insights.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Mangrove Studies', 'Statistical Modeling'],
        publications: 4,
        email: 'laode@ub.ac.id'
    },
    researcher6: {
        name: 'Lhefiardo Syajidan Taqyuddin',
        title: 'Researcher',
        bio: 'Lhefiardo focuses on drone-based topographic mapping and data analysis for coastal monitoring.',
        expertise: ['Mangrove Studies', 'Data Analysis', 'Drone Topography', 'Photogrammetry'],
        publications: 3,
        email: 'lhefiardo@ub.ac.id'
    },
    researcher7: {
        name: 'Juan Carlos Tambunan',
        title: 'Researcher',
        bio: 'Juan specializes in data analysis and coastal dynamics, with a focus on quantitative methods.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Quantitative Methods'],
        publications: 6,
        email: 'juan@ub.ac.id'
    },
    researcher8: {
        name: 'Rafi Satria Sofriansyah',
        title: 'Researcher',
        bio: 'Rafi focuses on coastal dynamics and drone-based surveying for erosion monitoring.',
        expertise: ['Coastal Dynamics', 'Drone Topography', 'UAV Operations'],
        publications: 4,
        email: 'rafi@ub.ac.id'
    },
    researcher9: {
        name: 'Arwanda Maulana Rijal Al Fatah',
        title: 'Researcher',
        bio: 'Arwanda develops drone mapping solutions and data analysis tools for coastal research.',
        expertise: ['Drone Topography', 'Data Analysis', 'GIS'],
        publications: 2,
        email: 'arwanda@ub.ac.id'
    },
    researcher10: {
        name: 'Khalifa Firza Khafif Ar Razi',
        title: 'Researcher',
        bio: 'Khalifa specializes in data analysis and coastal dynamics with field research experience.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Drone Topography', 'Field Work'],
        publications: 1,
        email: 'khalifa@ub.ac.id'
    },
    researcher11: {
        name: 'Muhammad Azzikri Aditya Gama',
        title: 'Researcher',
        bio: 'Muhammad focuses on data analysis and coastal dynamics research.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Statistical Methods'],
        publications: 1,
        email: 'azzikri@ub.ac.id'
    }
};

window.openTeamModal = (memberId) => {
    const modal = document.getElementById('teamModal');
    const modalBody = document.getElementById('modalBody');
    
    if (!modal || !modalBody) return;
    
    const member = teamData[memberId] || {
        name: 'Team Member',
        title: 'Researcher',
        bio: 'Detailed information about this team member will be available soon.',
        expertise: ['Research'],
        publications: 0,
        email: 'coastalresearchers@gmail.com'
    };
    
    modalBody.innerHTML = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
                <i class="fas fa-user"></i>
            </div>
            <h2 style="color: var(--primary); margin-bottom: 0.5rem; font-size: 1.5rem;">${member.name}</h2>
            <p style="color: var(--accent); font-size: 1.2rem;">${member.title}</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">About</h3>
            <p style="line-height: 1.6;">${member.bio}</p>
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
            <button class="cta-button" onclick="closeTeamModal()">Close</button>
        </div>
    `;
    
    modal.classList.add('active');
};

window.closeTeamModal = () => {
    const modal = document.getElementById('teamModal');
    if (modal) {
        modal.classList.remove('active');
    }
};

const teamModal = document.getElementById('teamModal');
if (teamModal) {
    teamModal.addEventListener('click', (e) => {
        if (e.target === teamModal) {
            closeTeamModal();
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