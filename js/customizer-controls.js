/**
 * Customizer Controls Enhancement Script
 * 
 * Adds enhanced functionality to the WordPress Customizer controls
 * for better user experience and productivity.
 * 
 * @package CORES_Theme
 * @version 2.3.0
 */

(function($, wp) {
    'use strict';

    // Wait for customizer to be fully loaded
    wp.customize.bind('ready', function() {
        
        // ============================================
        // ENHANCED CONTROL INTERACTIONS
        // ============================================

        /**
         * Add reset button to each control
         */
        function addResetButtons() {
            $('.customize-control').each(function() {
                const $control = $(this);
                const controlId = $control.attr('id');
                
                // Skip if no ID or already has reset button
                if (!controlId || $control.find('.cores-reset-button').length) {
                    return;
                }

                // Extract setting ID from control ID
                const settingId = controlId.replace('customize-control-', '');
                const setting = wp.customize(settingId);

                if (!setting) {
                    return;
                }

                // Get default value
                const defaultValue = setting._value; // Store initial value as default

                // Create reset button
                const $resetButton = $('<button class="cores-reset-button" type="button">')
                    .attr('title', 'Reset to default')
                    .html('<span class="dashicons dashicons-image-rotate"></span>')
                    .css({
                        'margin-left': '5px',
                        'padding': '2px 8px',
                        'font-size': '12px',
                        'line-height': '1',
                        'vertical-align': 'middle',
                        'cursor': 'pointer',
                        'background': '#f7f7f7',
                        'border': '1px solid #ccc',
                        'border-radius': '3px',
                        'color': '#555',
                        'transition': 'all 0.2s ease'
                    })
                    .hover(
                        function() {
                            $(this).css({
                                'background': '#05BFDB',
                                'border-color': '#05BFDB',
                                'color': '#fff'
                            });
                        },
                        function() {
                            $(this).css({
                                'background': '#f7f7f7',
                                'border-color': '#ccc',
                                'color': '#555'
                            });
                        }
                    )
                    .on('click', function(e) {
                        e.preventDefault();
                        if (confirm('Reset this setting to its default value?')) {
                            setting.set(defaultValue);
                            showNotification('Setting reset to default', 'success');
                        }
                    });

                // Insert reset button after the label
                $control.find('label').first().append($resetButton);
            });
        }

        // Initialize reset buttons
        setTimeout(addResetButtons, 500);

        /**
         * Add copy button to text/url inputs for easy sharing
         */
        function addCopyButtons() {
            $('.customize-control-text input, .customize-control-url input, .customize-control-email input').each(function() {
                const $input = $(this);
                
                // Skip if already has copy button
                if ($input.next('.cores-copy-button').length) {
                    return;
                }

                const $copyButton = $('<button class="cores-copy-button" type="button">')
                    .text('Copy')
                    .css({
                        'margin-left': '5px',
                        'padding': '4px 10px',
                        'font-size': '11px',
                        'cursor': 'pointer',
                        'background': '#fff',
                        'border': '1px solid #ddd',
                        'border-radius': '3px'
                    })
                    .on('click', function() {
                        $input.select();
                        document.execCommand('copy');
                        
                        $copyButton.text('Copied!').css('background', '#d4edda');
                        setTimeout(function() {
                            $copyButton.text('Copy').css('background', '#fff');
                        }, 2000);
                    });

                $input.after($copyButton);
            });
        }

        setTimeout(addCopyButtons, 500);

        /**
         * Add character counter to textarea controls
         */
        function addCharacterCounters() {
            $('.customize-control-textarea textarea').each(function() {
                const $textarea = $(this);
                
                // Skip if already has counter
                if ($textarea.next('.character-counter').length) {
                    return;
                }

                const maxLength = $textarea.attr('maxlength') || 'unlimited';
                const $counter = $('<div class="character-counter">')
                    .css({
                        'text-align': 'right',
                        'font-size': '11px',
                        'color': '#666',
                        'margin-top': '5px'
                    });

                function updateCounter() {
                    const length = $textarea.val().length;
                    const text = maxLength === 'unlimited' 
                        ? length + ' characters'
                        : length + ' / ' + maxLength + ' characters';
                    
                    $counter.text(text);
                    
                    // Change color if approaching limit
                    if (maxLength !== 'unlimited' && length > maxLength * 0.9) {
                        $counter.css('color', '#d63638');
                    } else {
                        $counter.css('color', '#666');
                    }
                }

                $textarea.after($counter);
                $textarea.on('input', updateCounter);
                updateCounter();
            });
        }

        setTimeout(addCharacterCounters, 500);

        /**
         * Add color picker enhancements
         */
        function enhanceColorPickers() {
            $('.customize-control-color .wp-picker-container').each(function() {
                const $container = $(this);
                const $input = $container.find('.wp-color-picker');
                
                // Add color presets
                const presets = [
                    '#0A4D68', // Primary
                    '#05BFDB', // Accent
                    '#088395', // Secondary
                    '#333333', // Dark
                    '#F5F5F5', // Light
                    '#FFFFFF', // White
                ];

                const $presets = $('<div class="color-presets">')
                    .css({
                        'margin-top': '10px',
                        'display': 'flex',
                        'gap': '5px',
                        'flex-wrap': 'wrap'
                    });

                presets.forEach(function(color) {
                    const $preset = $('<button type="button" class="color-preset">')
                        .css({
                            'width': '30px',
                            'height': '30px',
                            'border': '2px solid #ddd',
                            'border-radius': '4px',
                            'cursor': 'pointer',
                            'background': color,
                            'transition': 'all 0.2s ease'
                        })
                        .attr('title', color)
                        .hover(
                            function() {
                                $(this).css({
                                    'border-color': '#05BFDB',
                                    'transform': 'scale(1.1)'
                                });
                            },
                            function() {
                                $(this).css({
                                    'border-color': '#ddd',
                                    'transform': 'scale(1)'
                                });
                            }
                        )
                        .on('click', function(e) {
                            e.preventDefault();
                            $input.iris('color', color);
                            showNotification('Color preset applied', 'success');
                        });

                    $presets.append($preset);
                });

                $container.append($presets);
            });
        }

        setTimeout(enhanceColorPickers, 1000);

        // ============================================
        // PREVIEW URL MANAGEMENT
        // ============================================

        /**
         * Auto-navigate preview when expanding sections
         */
        wp.customize.section.each(function(section) {
            section.expanded.bind(function(isExpanded) {
                if (isExpanded && section.params.preview_url) {
                    wp.customize.previewer.previewUrl.set(section.params.preview_url);
                }
            });
        });

        /**
         * Quick navigation buttons
         */
        function addQuickNavigation() {
            const $quickNav = $('<div class="cores-quick-nav">')
                .css({
                    'padding': '15px',
                    'background': '#f7f7f7',
                    'border-bottom': '1px solid #ddd',
                    'margin-bottom': '15px'
                });

            const $title = $('<div>')
                .text('Quick Navigation')
                .css({
                    'font-weight': 'bold',
                    'margin-bottom': '10px',
                    'font-size': '13px'
                });

            $quickNav.append($title);

            const pages = [
                { name: 'Homepage', url: '/' },
                { name: 'About', url: '/about/' },
                { name: 'People', url: '/people/' },
                { name: 'Research', url: '/research/' },
                { name: 'Publications', url: '/publications/' },
                { name: 'Supervision', url: '/supervision/' },
            ];

            pages.forEach(function(page) {
                const $button = $('<button type="button">')
                    .text(page.name)
                    .css({
                        'margin-right': '5px',
                        'margin-bottom': '5px',
                        'padding': '5px 12px',
                        'font-size': '11px',
                        'cursor': 'pointer',
                        'background': '#fff',
                        'border': '1px solid #ddd',
                        'border-radius': '3px',
                        'transition': 'all 0.2s ease'
                    })
                    .hover(
                        function() {
                            $(this).css({
                                'background': '#0A4D68',
                                'border-color': '#0A4D68',
                                'color': '#fff'
                            });
                        },
                        function() {
                            $(this).css({
                                'background': '#fff',
                                'border-color': '#ddd',
                                'color': '#000'
                            });
                        }
                    )
                    .on('click', function() {
                        const baseUrl = wp.customize.settings.url.home;
                        wp.customize.previewer.previewUrl.set(baseUrl + page.url);
                        showNotification('Navigated to ' + page.name, 'info');
                    });

                $quickNav.append($button);
            });

            $('#customize-theme-controls').prepend($quickNav);
        }

        setTimeout(addQuickNavigation, 500);

        // ============================================
        // SEARCH FUNCTIONALITY
        // ============================================

        /**
         * Add search box to customizer
         */
        function addSearchBox() {
            const $searchContainer = $('<div class="cores-search-container">')
                .css({
                    'padding': '15px',
                    'background': '#fff',
                    'border-bottom': '1px solid #ddd',
                    'position': 'sticky',
                    'top': '0',
                    'z-index': '10'
                });

            const $searchInput = $('<input type="search" placeholder="Search settings...">')
                .css({
                    'width': '100%',
                    'padding': '8px 12px',
                    'border': '1px solid #ddd',
                    'border-radius': '4px',
                    'font-size': '13px'
                })
                .on('input', debounce(function() {
                    const query = $(this).val().toLowerCase();
                    searchSettings(query);
                }, 300));

            $searchContainer.append($searchInput);
            $('#customize-theme-controls').prepend($searchContainer);
        }

        function searchSettings(query) {
            if (!query) {
                // Show all
                $('.customize-control').show();
                $('.accordion-section').show();
                return;
            }

            let matchCount = 0;

            $('.customize-control').each(function() {
                const $control = $(this);
                const label = $control.find('label').first().text().toLowerCase();
                const description = $control.find('.description').text().toLowerCase();
                
                if (label.includes(query) || description.includes(query)) {
                    $control.show();
                    $control.closest('.accordion-section').show();
                    matchCount++;
                } else {
                    $control.hide();
                }
            });

            // Hide empty sections
            $('.accordion-section').each(function() {
                const $section = $(this);
                const visibleControls = $section.find('.customize-control:visible').length;
                if (visibleControls === 0) {
                    $section.hide();
                }
            });

            showNotification(matchCount + ' settings found', 'info');
        }

        setTimeout(addSearchBox, 500);

        // ============================================
        // KEYBOARD SHORTCUTS
        // ============================================

        $(document).on('keydown', function(e) {
            // Ctrl/Cmd + S to save (publish)
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                $('#save').trigger('click');
                showNotification('Changes saved!', 'success');
            }

            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                $('.cores-search-container input').focus();
            }

            // Esc to close active panel/section
            if (e.key === 'Escape') {
                const $expanded = $('.accordion-section.open');
                if ($expanded.length) {
                    $expanded.find('.accordion-section-title').trigger('click');
                }
            }
        });

        // Show keyboard shortcuts hint
        setTimeout(function() {
            if (!localStorage.getItem('cores_shortcuts_hint_shown')) {
                showNotification('💡 Tip: Press Ctrl+S to save, Ctrl+F to search', 'info', 5000);
                localStorage.setItem('cores_shortcuts_hint_shown', 'true');
            }
        }, 2000);

        // ============================================
        // NOTIFICATION SYSTEM
        // ============================================

        function showNotification(message, type, duration) {
            type = type || 'info';
            duration = duration || 3000;

            const icons = {
                success: '✓',
                error: '✗',
                warning: '⚠',
                info: 'ℹ'
            };

            const colors = {
                success: '#46b450',
                error: '#dc3232',
                warning: '#ffb900',
                info: '#00a0d2'
            };

            const $notification = $('<div class="cores-notification">')
                .html('<strong>' + icons[type] + '</strong> ' + message)
                .css({
                    'position': 'fixed',
                    'top': '50px',
                    'right': '20px',
                    'background': colors[type],
                    'color': '#fff',
                    'padding': '12px 20px',
                    'border-radius': '4px',
                    'box-shadow': '0 2px 10px rgba(0,0,0,0.2)',
                    'z-index': '9999999',
                    'font-size': '13px',
                    'animation': 'slideInRight 0.3s ease',
                    'max-width': '300px'
                });

            $('body').append($notification);

            setTimeout(function() {
                $notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, duration);
        }

        // Add CSS animation
        if (!$('#cores-notification-css').length) {
            $('<style id="cores-notification-css">')
                .text(`
                    @keyframes slideInRight {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                `)
                .appendTo('head');
        }

        // Make it available globally
        window.coresNotification = showNotification;

        // ============================================
        // UTILITY FUNCTIONS
        // ============================================

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

        // ============================================
        // CONDITIONAL CONTROL VISIBILITY
        // ============================================

        /**
         * Show/hide controls based on other settings
         */
        function setupConditionalControls() {
            // Example: Show logo text only if no custom logo
            wp.customize('custom_logo', function(setting) {
                setting.bind(function(value) {
                    const $logoTextControl = $('#customize-control-cores_logo_text');
                    if (value) {
                        $logoTextControl.slideUp();
                    } else {
                        $logoTextControl.slideDown();
                    }
                });
            });
        }

        setTimeout(setupConditionalControls, 1000);

        // ============================================
        // HELPFUL TOOLTIPS
        // ============================================

        /**
         * Add tooltips to controls with descriptions
         */
        function addTooltips() {
            $('.customize-control-description').each(function() {
                const $desc = $(this);
                const $control = $desc.closest('.customize-control');
                
                // Add tooltip icon
                const $icon = $('<span class="dashicons dashicons-info tooltip-icon">')
                    .css({
                        'margin-left': '5px',
                        'color': '#05BFDB',
                        'cursor': 'help',
                        'font-size': '16px',
                        'vertical-align': 'middle'
                    })
                    .attr('title', $desc.text())
                    .on('click', function() {
                        $desc.slideToggle();
                    });

                $control.find('label').first().append($icon);
                
                // Hide description by default
                $desc.hide();
            });
        }

        setTimeout(addTooltips, 1000);

        // ============================================
        // DEVELOPER MODE FEATURES
        // ============================================

        if (wp.customize('cores_debug_mode') && wp.customize('cores_debug_mode').get()) {
            console.log('[CORES Customizer] Debug mode enabled');
            
            // Add control IDs to labels for easy identification
            $('.customize-control').each(function() {
                const $control = $(this);
                const controlId = $control.attr('id');
                if (controlId) {
                    $control.find('label').first().append(
                        $('<code>').text(controlId).css({
                            'display': 'block',
                            'font-size': '10px',
                            'color': '#666',
                            'margin-top': '3px'
                        })
                    );
                }
            });
        }

        // ============================================
        // INITIALIZATION COMPLETE
        // ============================================

        console.log('[CORES Customizer Controls] Enhanced features loaded successfully');
        showNotification('CORES Customizer ready!', 'success', 2000);

    }); // End of wp.customize.bind('ready')

})(jQuery, wp);