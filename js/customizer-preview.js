/**
 * Customizer Live Preview Script
 * 
 * Enables real-time preview of customizer changes without page reload
 * using postMessage API for better user experience.
 * 
 * @package CORES_Theme
 * @version 2.3.0
 */

(function($) {
    'use strict';

    // Wait for customizer to be ready
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            $('.logo-text a, .site-title').text(newval);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(newval) {
            $('.site-description').text(newval);
        });
    });

    // Logo Text
    wp.customize('cores_logo_text', function(value) {
        value.bind(function(newval) {
            $('.logo-text a').text(newval);
            if (newval === '') {
                $('.logo-text').hide();
            } else {
                $('.logo-text').show();
            }
        });
    });

    // Color Scheme - Real-time CSS updates
    wp.customize('cores_primary_color', function(value) {
        value.bind(function(newval) {
            updateColorVariable('--primary', newval);
        });
    });

    wp.customize('cores_accent_color', function(value) {
        value.bind(function(newval) {
            updateColorVariable('--accent', newval);
        });
    });

    wp.customize('cores_secondary_color', function(value) {
        value.bind(function(newval) {
            updateColorVariable('--secondary', newval);
        });
    });

    // Contact Information
    const contactFields = ['email_1', 'email_2', 'phone_1', 'phone_2', 'address'];
    contactFields.forEach(function(field) {
        wp.customize('cores_' + field, function(value) {
            value.bind(function(newval) {
                // Update contact info dynamically
                updateContactInfo(field, newval);
            });
        });
    });

    // Footer About Text
    wp.customize('cores_footer_about', function(value) {
        value.bind(function(newval) {
            $('.footer-section p').first().text(newval);
        });
    });

    // Stats - About Page
    for (let i = 1; i <= 4; i++) {
        wp.customize('cores_stat_' + i + '_number', function(value) {
            value.bind(function(newval) {
                $('.stat-card:nth-child(' + i + ') .stat-number').text(newval);
            });
        });

        wp.customize('cores_stat_' + i + '_label', function(value) {
            value.bind(function(newval) {
                $('.stat-card:nth-child(' + i + ') .stat-label').text(newval);
            });
        });
    }

    // Stats - Publications Page
    for (let i = 1; i <= 4; i++) {
        wp.customize('cores_pub_stat_' + i + '_number', function(value) {
            value.bind(function(newval) {
                $('.publication-stats .stat-card:nth-child(' + i + ') .stat-number').text(newval);
            });
        });

        wp.customize('cores_pub_stat_' + i + '_label', function(value) {
            value.bind(function(newval) {
                $('.publication-stats .stat-card:nth-child(' + i + ') .stat-label').text(newval);
            });
        });
    }

    /**
     * Update CSS variable for colors
     */
    function updateColorVariable(variable, value) {
        const root = document.documentElement;
        root.style.setProperty(variable, value);

        // Also update the style tag if it exists
        let styleTag = document.getElementById('cores-customizer-styles');
        if (!styleTag) {
            styleTag = document.createElement('style');
            styleTag.id = 'cores-customizer-styles';
            document.head.appendChild(styleTag);
        }

        // Get current CSS and update
        const cssText = styleTag.textContent || '';
        const regex = new RegExp(variable + ':\\s*[^;]+;', 'g');
        const newRule = variable + ': ' + value + ';';

        if (regex.test(cssText)) {
            styleTag.textContent = cssText.replace(regex, newRule);
        } else {
            // Add new rule
            if (!cssText.includes(':root')) {
                styleTag.textContent = ':root { ' + newRule + ' }';
            } else {
                styleTag.textContent = cssText.replace('}', newRule + ' }');
            }
        }

        // Animate color change
        $('body').css('transition', 'background-color 0.3s ease');
    }

    /**
     * Update contact information dynamically
     */
    function updateContactInfo(field, value) {
        const selectors = {
            'email_1': '.contact-item [itemprop="email"] a',
            'email_2': '.contact-item [itemprop="email"] a:nth-child(2)',
            'phone_1': '.contact-item [itemprop="telephone"] a',
            'phone_2': '.contact-item [itemprop="telephone"] a:nth-child(2)',
            'address': '.contact-item [itemprop="address"]'
        };

        const selector = selectors[field];
        if (selector) {
            if (field.startsWith('email') || field.startsWith('phone')) {
                $(selector).attr('href', 
                    field.startsWith('email') ? 'mailto:' + value : 'tel:' + value.replace(/\s/g, '')
                ).text(value);
            } else {
                // Address - convert line breaks to <br>
                $(selector).html(value.replace(/\n/g, '<br>'));
            }
        }
    }

    /**
     * Preview URL changes for better navigation
     */
    wp.customize.bind('preview-ready', function() {
        // Add smooth scroll for preview navigation
        wp.customize.preview.bind('scroll-to-section', function(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });

        // Highlight focused element
        wp.customize.preview.bind('highlight-control', function(controlId) {
            // Remove previous highlights
            $('.customizer-highlight').removeClass('customizer-highlight');

            // Add highlight to relevant element
            const element = findElementByControlId(controlId);
            if (element) {
                $(element).addClass('customizer-highlight');

                // Add CSS for highlight if not exists
                if (!$('#customizer-highlight-css').length) {
                    $('<style id="customizer-highlight-css">')
                        .text(`.customizer-highlight {
                            outline: 3px dashed #05BFDB !important;
                            outline-offset: 3px !important;
                            animation: highlight-pulse 2s ease-in-out infinite;
                        }
                        @keyframes highlight-pulse {
                            0%, 100% { outline-color: #05BFDB; }
                            50% { outline-color: #0A4D68; }
                        }`)
                        .appendTo('head');
                }

                // Scroll to element
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Remove highlight after 3 seconds
                setTimeout(function() {
                    $(element).removeClass('customizer-highlight');
                }, 3000);
            }
        });
    });

    /**
     * Find element by control ID
     */
    function findElementByControlId(controlId) {
        const elementMap = {
            'cores_logo_text': '.logo-text',
            'cores_primary_color': 'body',
            'cores_accent_color': '.cta-button',
            'cores_footer_about': '.footer-section p',
            // Add more mappings as needed
        };

        const selector = elementMap[controlId];
        return selector ? document.querySelector(selector) : null;
    }

    /**
     * Debounce helper for performance
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Console log for debugging (only in debug mode)
     */
    function debugLog(message, data) {
        if (window.console && window.console.log) {
            console.log('[CORES Customizer Preview]', message, data || '');
        }
    }

    // Log ready state
    debugLog('Preview script loaded and ready');

})(jQuery);