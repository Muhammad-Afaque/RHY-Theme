# Defense WordPress Theme

A robust WordPress theme built for industrial and manufacturing websites with advanced product management, quote system integration, and performance optimization.

## Core Features

### Product Management
- Custom product template hierarchy
- Advanced product filtering system
- Dynamic specification tables
- Product comparison functionality
- PDF generation for specifications
- Quote basket integration
- Related products system

### Navigation
- Mega menu support
- Breadcrumb navigation
- Mobile-optimized menu
- Search integration
- Category dropdowns
- Collection navigation

### Collection System
- Custom taxonomy implementation
- AJAX-powered filtering
- Product grid/list views
- Filter combinations
- Search within collections
- Sort options
- Pagination system


### Performance Features
- Redis caching integration
- Image optimization
- Lazy loading
- AJAX content loading
- Minified assets
- Browser caching support

### Quote System Integration
- Quote basket functionality
- Multiple quote lists
- Quote request forms
- Admin quote management
- Email notifications
- Quote PDF generation

## Theme Setup

### Requirements
- WordPress 5.0+
- PHP 7.4+
- MySQL 5.7+
- WooCommerce 6.0+
- Advanced Custom Fields Pro
- Redis (recommended)

### Installation
1. Upload theme to `/wp-content/themes/defense`
2. Install required plugins:
   - WooCommerce
   - Advanced Custom Fields Pro
   - Redis Cache (recommended)
3. Activate theme
4. Import demo content (optional)
5. Configure theme settings

### Configuration

#### Product Settings
```php
// Custom product types
add_theme_support('defense_products');

// Product features
add_theme_support('product-gallery');
add_theme_support('product-specs');
add_theme_support('product-compare');
```

#### Collection Settings
```php
// Collection features
add_theme_support('collection-filters');
add_theme_support('collection-search');
add_theme_support('collection-sorting');
```

### Customization

#### Template Hierarchy
1. Product Pages
   - `single-product.php`
   - `archive-product.php`
   - `taxonomy-collection.php`

2. Collection Pages
   - `archive-collection.php`
   - `single-collection.php`

3. Quote System
   - `quote-basket.php`
   - `quote-form.php`
   - `quote-list.php`

#### Action Hooks
```php
// Before product content
do_action('defense_before_product_content');

// After collection filter
do_action('defense_after_collection_filter');

// Before quote submission
do_action('defense_before_quote_submit');
```

#### Filter Hooks
```php
// Modify product layout
add_filter('defense_product_layout', 'your_function');

// Adjust collection query
add_filter('defense_collection_args', 'your_function');

// Customize quote form
add_filter('defense_quote_fields', 'your_function');
```

## Theme Functions

### Product Functions
```php
defense_get_product_specs()
defense_product_gallery()
defense_related_products()
defense_product_pdf()
```

### Collection Functions
```php
defense_get_collection_filters()
defense_render_product_grid()
defense_collection_search()
```

### Quote Functions
```php
defense_add_to_quote()
defense_get_quote_basket()
defense_process_quote()
```

## Support & Documentation
For detailed documentation and support:
1. Visit theme documentation
2. Contact support team
3. Submit bug reports
4. Request features

## License
GPL v2 or later

---

*Note: This theme requires specific plugins and configuration for optimal performance. Please follow the installation guide carefully.*