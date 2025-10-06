(function($) {
    'use strict';
    
    class LiveSearchSystem {
        constructor() {
            this.searchTimeout = null;
            this.currentRequest = null;
            this.cache = new Map();
            this.isSearching = false;
            
            this.init();
        }
        
        init() {
            this.bindEvents();
            this.createSearchContainer();
        }
        
        bindEvents() {
            // Main search input - target the correct class
            $(document).on('input', '.universal-search-field', (e) => {
                this.handleSearchInput(e);
            });
            
            // Also handle the old search field for backward compatibility
            $(document).on('input', '.search-field', (e) => {
                this.handleSearchInput(e);
            });
            
            // Focus and blur events
            $(document).on('focus', '.universal-search-field, .search-field', (e) => {
                if ($(e.target).hasClass('universal-search-field') || $(e.target).hasClass('search-field')) {
                    this.showSearchResults();
                }
            });
            
            $(document).on('blur', '.universal-search-field, .search-field', (e) => {
                // Delay hiding to allow clicking on results
                setTimeout(() => this.hideSearchResults(), 150);
            });
            
            // Result clicks
            $(document).on('click', '.live-search-result', (e) => {
                e.preventDefault();
                const url = $(e.currentTarget).data('url');
                if (url) {
                    window.location.href = url;
                }
            });
            
            // Keyboard navigation
            $(document).on('keydown', '.universal-search-field, .search-field', (e) => {
                this.handleKeyboardNavigation(e);
            });
            
            // Close search when clicking outside
            $(document).on('click', (e) => {
                if (!$(e.target).closest('.live-search-container, .universal-acf-search').length) {
                    this.hideSearchResults();
                }
            });
        }
        
        createSearchContainer() {
            // Check if we already have results container
            if (!$('.live-search-results').length) {
                // Find the search container and add results div
                const $searchContainer = $('.universal-acf-search');
                if ($searchContainer.length) {
                    $searchContainer.append(`
                        <div class="live-search-results" style="display: none;">
                            <div class="search-loading" style="display: none;">
                                <div class="search-spinner"></div>
                                <span>Searching...</span>
                            </div>
                            <div class="search-results-list"></div>
                            <div class="search-no-results" style="display: none;">
                                <div class="no-results-icon">🔍</div>
                                <p>No results found</p>
                                <small>Try different keywords</small>
                            </div>
                        </div>
                    `);
                }
            }
        }
        
        handleSearchInput(e) {
            const searchTerm = $(e.target).val().trim();
            
            // Clear previous timeout
            clearTimeout(this.searchTimeout);
            
            // Cancel current request
            if (this.currentRequest) {
                this.currentRequest.abort();
            }
            
            if (searchTerm.length < 2) {
                this.hideSearchResults();
                return;
            }
            
            // Check cache first
            if (this.cache.has(searchTerm)) {
                this.displayResults(this.cache.get(searchTerm));
                return;
            }
            
            // Set timeout for new search
            this.searchTimeout = setTimeout(() => {
                this.performSearch(searchTerm);
            }, 300);
        }
        
        performSearch(searchTerm) {
            this.showLoading();
            this.isSearching = true;
            
            // Use the base_url if available, otherwise construct it
            const ajaxUrl = typeof base_url !== 'undefined' ? 
                base_url + '/wp-admin/admin-ajax.php' : 
                (typeof liveSearchAjax !== 'undefined' ? liveSearchAjax.ajaxUrl : '/wp-admin/admin-ajax.php');
            
            // Get nonce from available sources
            const nonce = typeof liveSearchAjax !== 'undefined' ? 
                liveSearchAjax.nonce : 
                (typeof ajax_object !== 'undefined' ? ajax_object.nonce : '');
            
            this.currentRequest = $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'universal_acf_search',
                    search_term: searchTerm,
                    post_type: 'product',
                    nonce: nonce
                },
                success: (response) => {
                    this.hideLoading();
                    this.isSearching = false;
                    
                    if (response.success && response.data) {
                        // Cache the results
                        this.cache.set(searchTerm, response.data);
                        this.displayResults(response.data);
                    } else {
                        this.showNoResults();
                    }
                },
                error: (xhr) => {
                    if (xhr.statusText !== 'abort') {
                        this.hideLoading();
                        this.isSearching = false;
                        this.showNoResults();
                        console.log('Search error:', xhr);
                    }
                }
            });
        }
        
        displayResults(results) {
            const $container = $('.search-results-list');
            $container.empty();
            
            if (!results || results.length === 0) {
                this.showNoResults();
                return;
            }
            
            results.forEach((result, index) => {
                const $item = this.createResultItem(result, index);
                $container.append($item);
            });
            
            this.showSearchResults();
        }
        
        createResultItem(result, index) {
            const thumbnailHtml = result.thumbnail ? 
                `<img src="${result.thumbnail}" alt="${result.title}" class="result-thumbnail">` : 
                '<div class="result-thumbnail-placeholder"></div>';
            
            const matchedFieldsHtml = result.matched_fields && result.matched_fields.length > 0 ? 
                result.matched_fields.map(field => 
                    `<div class="matched-field">
                        <strong>${field.label}:</strong> ${field.value}
                    </div>`
                ).join('') : '';
            
            return $(`
                <div class="live-search-result" data-url="${result.url}" data-index="${index}">
                    <div class="result-content">
                        ${thumbnailHtml}
                        <div class="result-text">
                            <h4 class="result-title">${result.title}</h4>
                            <p class="result-excerpt">${result.excerpt}</p>
                            ${matchedFieldsHtml}
                        </div>
                    </div>
                </div>
            `);
        }
        
        handleKeyboardNavigation(e) {
            const $results = $('.live-search-result');
            const $active = $('.live-search-result.active');
            
            switch(e.keyCode) {
                case 38: // Up arrow
                    e.preventDefault();
                    if ($active.length) {
                        const $prev = $active.prev('.live-search-result');
                        if ($prev.length) {
                            $active.removeClass('active');
                            $prev.addClass('active');
                        }
                    }
                    break;
                    
                case 40: // Down arrow
                    e.preventDefault();
                    if ($active.length) {
                        const $next = $active.next('.live-search-result');
                        if ($next.length) {
                            $active.removeClass('active');
                            $next.addClass('active');
                        }
                    } else if ($results.length) {
                        $results.first().addClass('active');
                    }
                    break;
                    
                case 13: // Enter
                    e.preventDefault();
                    if ($active.length) {
                        const url = $active.data('url');
                        if (url) {
                            window.location.href = url;
                        }
                    }
                    break;
                    
                case 27: // Escape
                    this.hideSearchResults();
                    $(e.target).blur();
                    break;
            }
        }
        
        showLoading() {
            $('.search-loading').show();
            $('.search-results-list, .search-no-results').hide();
            this.showSearchResults();
        }
        
        hideLoading() {
            $('.search-loading').hide();
        }
        
        showNoResults() {
            $('.search-no-results').show();
            $('.search-results-list, .search-loading').hide();
            this.showSearchResults();
        }
        
        showSearchResults() {
            $('.live-search-results').show();
        }
        
        hideSearchResults() {
            $('.live-search-results').hide();
            $('.live-search-result').removeClass('active');
        }
    }
    
    // Initialize when DOM is ready
    $(document).ready(function() {
        // Only initialize if we haven't already
        if (typeof window.liveSearchInitialized === 'undefined') {
            window.liveSearchInitialized = true;
            new LiveSearchSystem();
        }
    });
    
})(jQuery);