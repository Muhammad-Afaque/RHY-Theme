var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");
// Minimal JavaScript needed


var base_url = window.location.protocol + '//' + window.location.host;


const thumbnails = document.querySelectorAll('.thumbnail');
const mainImage = document.getElementById('currentImage');

thumbnails.forEach(thumb => {
  thumb.addEventListener('click', () => {
    const fullSrc = thumb.getAttribute('data-full');
    mainImage.style.opacity = 0;
    setTimeout(() => {
      mainImage.src = fullSrc;
      mainImage.style.opacity = 1;
    }, 200);
    thumbnails.forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
  });
});

function myFunction() {
    if (video.paused) {
        video.play();
        btn.innerHTML = "Pause";
    } else {
        video.pause();
        btn.innerHTML = "Play";
    }
}

jQuery(document).ready(function ($) {
 
var $slider = $('#logoslidesr');
if ($slider.length && $slider.children().length > 0) {
    var $slides = $slider.children();
    var logoCount = $slides.length;
    var minSlidesToShow = 4;

    if (logoCount < minSlidesToShow) {
        var timesToClone = Math.ceil(minSlidesToShow / logoCount);
        for (var i = 0; i < timesToClone; i++) {
            $slides.clone().appendTo($slider);
        }
    }

    $slider.slick({
        infinite: true,
        speed: 5000,
        autoplay: false,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: Math.min(minSlidesToShow, logoCount),
        slidesToScroll: 1,
        draggable: true,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: Math.min(3, logoCount),
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }
        ]
    });
}

    $('.logo_fot').slick({
        infinite: true,
        speed: 5000,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 4,
        slidesToScroll: 1,
        draggable: true,
        arrows: false,   // disables prev/next arrows
        dots: false,     // disables pagination dots
        pauseOnHover: false, // keeps scrolling even on hover

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }
        ]
    });
var $mobileSlider = $('#logoslider_smobile');
if ($mobileSlider.length && $mobileSlider.children().length > 0) {
    var $mobileSlides = $mobileSlider.children();
    var mobileLogoCount = $mobileSlides.length;
    var mobileMinSlidesToShow = 4;

    if (mobileLogoCount < mobileMinSlidesToShow) {
        var timesToClone = Math.ceil(mobileMinSlidesToShow / mobileLogoCount);
        for (var i = 0; i < timesToClone; i++) {
            $mobileSlides.clone().appendTo($mobileSlider);
        }
    }

    $mobileSlider.slick({
        infinite: true,
        speed: 6000,
        autoplay: false,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: Math.min(mobileMinSlidesToShow, mobileLogoCount),
        slidesToScroll: 1,
        draggable: true,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: Math.min(3, mobileLogoCount),
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            }
        ]
    });
}

    $('.case_study_slider').slick({
        infinite: false, // Use false to prevent jumpy looping effect with fractional slides
        speed: 300,
        slidesToShow: 2.5,
        slidesToScroll: 1,
        centerMode: false, // Ensures alignment starts from the left
        arrows: true,
        cssEase: 'ease',

        prevArrow: '<button class="custom-prev slick-arrow" style="position: absolute;top: -13%;right: 12%;border-radius: 15px;border: none;padding-bottom: 10px;background: #01254c;color: #fff;padding-left: 1rem;padding-right: 1rem;"><i class="fa fa-chevron-left"></i></button>',
        nextArrow: '<button class="custom-next slick-arrow" style="position: absolute;top: -13%;right: 8%;border-radius: 15px;border: none;padding-bottom: 10px;background: #01254c;color: #fff;padding-left: 1rem;padding-right: 1rem;"><i class="fa fa-chevron-right"></i></button>',

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1.5,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    // 2) Product slider
    $('.product-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        prevArrow: '<button type="button" class="product-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="product-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // 3) Custom slider
    $('.custom-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
        dots: true,
        prevArrow: '<button type="button" class="custom-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="custom-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // 1) Main product gallery
    $('.product_gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,               // hide its own arrows
        fade: true,
        asNavFor: '.thumbnail-slider' // link to thumbs
    });

    // 2) Thumbnail navigator
$('.thumbnail-slider').slick({
    slidesToShow: 3, // Show 3 thumbnails if available
    slidesToScroll: 1,
    asNavFor: '.product_gallery',
    dots: false,
    arrows: false,
    infinite: false, // Important: prevent infinite scroll behavior
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                infinite: false
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
                infinite: false
            }
        }
    ]
});


});


jQuery(document).ready(function ($) {
    $('.tab-content').hide();

    //     $(document).on('click', '.btn-remove', function () {
    //         var cookieName = $('.product-wrapper');
    //         var pid = $(this).attr('data-cookie');
    //         RemoveFromCookieAndGrid(cookieName, pid);
    //         $('#product-' + pid).remove();
    //         var cookieValue = JSON.parse($.cookie('list-product'));
    //         if (!cookieValue || cookieValue == '') {
    //             $.removeCookie('list-product', { path: '/' });
    //             location.reload();
    //         }

    //     });

    //     $('body').on('click', '.req-info-btn', function (e) {
    //         e.preventDefault();
    //         product_id = $(this).attr('product-id');
    //         $(this).find('.loader-spin').fadeIn()
    //         if (product_id) {
    //             if (!!$.cookie('list-product')) {
    //                 var elements = JSON.parse($.cookie('list-product'));
    //                 let pcdata = { "id": product_id };
    //                 elements.push(pcdata);
    //                 $.cookie('list-product', JSON.stringify(elements), { path: '/' });
    //             } else {
    //                 var elements = [];
    //                 let pcdata = { "id": product_id };
    //                 elements.push(pcdata); //add the id to the array of elements
    //                 $.cookie('list-product', JSON.stringify(elements), { path: '/' });
    //             }
    //         }
    //         $('.loader-spin').fadeOut();
    //         window.location.href = base_url + '/cart/';
    //     });

    //     $('.select-box').change(function () {
    //         dropdown = $(this).val();
    //         var selectedOption = $('.select-box option:selected');
    //         post_id = selectedOption.attr('post-id');

    //         $(this).parents(".req-info-wrapper").find(".req-info-btn").attr("product-id", post_id);

    //         //first hide all tabs again when a new option is selected
    //         $('.select-box').not($(this)).prop('selectedIndex', 0);
    //         $('.select-box-components').not($(this)).prop('selectedIndex', 0);
    //         $('.tab-content').hide();

    //         //then show the tab content of whatever option value was selected
    //         $('#' + "tab-" + dropdown).show();
    //     });

    //     $('.select-box-components').change(function () {
    //         dropdown = $(this).val();

    //         //first hide all tabs again when a new option is selected
    //         $('.select-box-components').not($(this)).prop('selectedIndex', 0);
    //         $('.components.tab-content').hide();

    //         //then show the tab content of whatever option value was selected
    //         $('#' + "tab-" + dropdown).show();
    //     });

    //     // Initial state
    //     // toggleComponentsTable();

    //     // Event listener
    //     //postIDDropdown.on('change', toggleComponentsTable);
    // });
})

jQuery(document).ready(function ($) {

    // 1) Main card slider
    /*
    $('.slick-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: true,
      dots: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
  */



});

// ────────────────────────────────────────────────────────────────
// Cart Form Handler Block
// ────────────────────────────────────────────────────────────────
// $(document).ready(function () {

// function RemoveFromCookieAndGrid(cookieName, pid) {
//     var cookieData = $.cookie('list-product');
//     if (cookieData) {
//         var dataArray = JSON.parse(cookieData);

//         dataArray = dataArray.filter(function (item) {
//             return item.id !== pid;
//         });

//         $.cookie('list-product', JSON.stringify(dataArray), { expires: 7, path: '/' });
//     }
// }

//     $("form.validate").submit(function (event) {
//         event.preventDefault();
//         var filter = $(this);
//         var form_data = new FormData(this);
//         $.ajax({
//             url: base_url + '/wp-admin/admin-ajax.php',
//             data: form_data,
//             type: filter.attr('method'),
//             cache: false,
//             processData: false,
//             contentType: false,
//             beforeSend: function (xhr) {
//                 $('.loader').fadeIn();
//             },
//             success: function (response) {
//                 $('.loader').fadeOut();
//                 var respObj = JSON.parse(response);
//                 filter.find('.text-success').text(respObj.message);
//                 if (respObj.url) {
//                     window.location.href = respObj.url;
//                 }
//                 filter[0].reset();
//                 $.removeCookie('list-product', { path: '/' });
//                 location.reload(); // Reload the page
//             }
//         });

//     });


// });


// ────────────────────────────────────────────────────────────────
// Add Circled Numbers To Tables Block
// ────────────────────────────────────────────────────────────────
jQuery(document).ready(function ($) {
    // Add CSS for the circled numbers
    $('head').append(`
    <style>
      .circle-number {
          display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background-color: transparent;
    border: 1px solid #716767;
    font-size: 10px;
    margin-left: 6px;
    font-weight: normal;
      }
    </style>
  `);

    // Process each table
    $('.table.table-bordered').each(function () {
        // Get rows excluding header row
        const rows = $(this).find('tbody tr:not(:first-child)');

        // Add circled numbers to each row
        rows.each(function (index) {
            // Get the first cell (Description column)
            const descCell = $(this).find('td:first-child');

            // Create the circled number element
            const circleSpan = $('<span>', {
                'class': 'circle-number',
                'text': ' ' + (index + 1) // Start counting from 1
            });

            // Add it to the description cell
            descCell.append(circleSpan);
        });
    });

});

// ────────────────────────────────────────────────────────────────
// Product Page Accordian Block
// ────────────────────────────────────────────────────────────────
// 
// Ensure we only initialize once
let isInitialized = false;

document.addEventListener('DOMContentLoaded', function () {
    if (isInitialized) return;
    isInitialized = true;

    // Initially hide all expand-lists
    const expandLists = document.querySelectorAll('.expand-list');

    expandLists.forEach(list => {
        list.style.display = 'none';
        // Reset any existing inline styles that might interfere
        list.style.maxHeight = null;
        list.style.overflow = 'visible';
    });

    // Add click event listeners to all cate_header elements
    const headers = document.querySelectorAll('.cate_header');

    headers.forEach((header) => {
        header.addEventListener('click', function (e) {
            // Prevent event bubbling
            e.stopPropagation();

            // Don't toggle if clicking on action buttons
            if (e.target.closest('.action-btns a')) {
                return;
            }

            // Get the parent cate_div
            const parentDiv = this.closest('.cate_div');

            // Get the expand-list element
            const expandList = parentDiv.querySelector('.expand-list');

            // Get the toggle button
            const toggleBtn = this.querySelector('.toggle-btn');

            if (!expandList) {
                return;
            }

            // Toggle visibility and icon
            const isExpanded = expandList.style.display === 'block';

            if (!isExpanded) {
                // Show the list
                expandList.style.display = 'block';
                expandList.style.maxHeight = 'none';
                expandList.style.overflow = 'visible';
                parentDiv.classList.add('active');
                if (toggleBtn) {
                    toggleBtn.classList.remove('fa-plus');
                    toggleBtn.classList.add('fa-minus');
                }
            } else {
                // Hide the list
                expandList.style.display = 'none';
                expandList.style.maxHeight = null;
                parentDiv.classList.remove('active');
                if (toggleBtn) {
                    toggleBtn.classList.remove('fa-minus');
                    toggleBtn.classList.add('fa-plus');
                }
            }
        });
    });
});

// ────────────────────────────────────────────────────────────────
// Search Funcionality Block
// ────────────────────────────────────────────────────────────────



jQuery(document).ready(function ($) {
    // Target the specific structure in your form
    $('form.searchandfilter > div > ul > li').each(function () {
        // Skip the search input and submit button
        if ($(this).find('input[type="text"], input[type="submit"]').length > 0) {
            return true; // Continue to next iteration
        }

        // Find the child UL that contains the filter options
        var filterUl = $(this).find('> ul');

        if (filterUl.length > 0) {
            // Get the hidden input that follows this UL (it contains the filter name)
            var hiddenInput = $(this).find('input[type="hidden"][name$="_operator"]');

            if (hiddenInput.length > 0) {
                // Extract the base name from the hidden input
                var nameAttr = hiddenInput.attr('name');
                var baseName = nameAttr.replace('_operator', '');
                var word = baseName.replace('of', '');

                // Handle hyphenated names
                if (word.includes('-')) {
                    word = word.split('-')[0];
                }

                // Capitalize the first letter
                var capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1);

                // Add the H5 heading before the filter UL
                filterUl.before('<h5>' + capitalizedWord + '</h5>');
            }
        }
    });
});
(function ($) {
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
            // Main search input
            $(document).on('input', '.universal-search-field', (e) => {
                this.handleSearchInput(e);
            });

            // Focus and blur events
            $(document).on('focus', '.universal-search-field', (e) => {
                this.showSearchResults();
            });

            $(document).on('blur', '.universal-search-field', (e) => {
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
            $(document).on('keydown', '.universal-search-field', (e) => {
                this.handleKeyboardNavigation(e);
            });

            // Close search when clicking outside
            $(document).on('click', (e) => {
                if (!$(e.target).closest('.live-search-container').length) {
                    this.hideSearchResults();
                }
            });
        }

        createSearchContainer() {
            if (!$('.live-search-results').length) {
                $('.universal-acf-search').append(`
                    <div class="live-search-results" style="display: none;">
                        <div class="search-loading" style="display: none;">
                            <span class="spinner"></span> Searching...
                        </div>
                        <div class="search-results-list"></div>
                        <div class="search-no-results" style="display: none;">
                            No results found
                        </div>
                    </div>
                `);
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

            this.currentRequest = $.ajax({
                url: base_url + '/wp-admin/admin-ajax.php',

                type: 'POST',
                data: {
                    action: 'universal_acf_search',
                    search_term: searchTerm,
                    post_type: 'product', // Change as needed
                    nonce: liveSearchAjax.nonce
                },
                success: (response) => {
                    this.hideLoading();
                    this.isSearching = false;

                    if (response.success) {
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
                    }
                }
            });
        }

        displayResults(results) {
            const $container = $('.search-results-list');
            $container.empty();

            if (results.length === 0) {
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

            const matchedFieldsHtml = result.matched_fields.length > 0 ?
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

            switch (e.keyCode) {
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
    $(document).ready(function () {
        new LiveSearchSystem();
    });

})(jQuery);


function toggleApps() {
    const dropdown = document.getElementById('appsDropdown');
    const userMenu = document.getElementById('userMenu');

    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    if (userMenu) userMenu.style.display = 'none';
}

function toggleUserMenu() {
    const userMenu = document.getElementById('userMenu');
    const appsDropdown = document.getElementById('appsDropdown');

    userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
    if (appsDropdown) appsDropdown.style.display = 'none';
}

// Close menus when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.apps-menu')) {
        const appsDropdown = document.getElementById('appsDropdown');
        if (appsDropdown) appsDropdown.style.display = 'none';
    }
    if (!e.target.closest('.user-avatar')) {
        const userMenu = document.getElementById('userMenu');
        if (userMenu) userMenu.style.display = 'none';
    }
});






document.addEventListener('DOMContentLoaded', function () {
    const pages = document.querySelectorAll('.mega-menu-page');
    const nextBtn = document.getElementById('megaNextBtn');
    const prevBtn = document.getElementById('megaPrevBtn');
    let currentPage = 0;

    console.log("Mega menu pagination initialized. Total pages:", pages.length);

    function updatePages() {
        pages.forEach((page, index) => {
            page.style.display = (index === currentPage) ? 'block' : 'none';
        });

        prevBtn.disabled = currentPage === 0;
        nextBtn.disabled = currentPage === pages.length - 1;

        console.log("Now showing page:", currentPage);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (currentPage < pages.length - 1) {
                currentPage++;
                updatePages();
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                updatePages();
            }
        });
    }

    updatePages(); // initial call
});


