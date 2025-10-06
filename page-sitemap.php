<?php
/**
 * Template Name: HTML Sitemap (Custom)
 * Description: Human-readable HTML sitemap: Pages, Posts, Products, Taxonomies, and Custom Aeroquip links.
 */

defined('ABSPATH') || exit;

get_header();

/* -------------------------------------------------
 * CONFIG
 * ------------------------------------------------- */
$hardcode_title               = true;               // forces <h1>Sitemap</h1>
$show_post_dates              = true;               // show (updated …) next to items
$include_posts                = true;               // include Blog Posts section
$include_products             = class_exists('WooCommerce'); // include Products if Woo active
$limit_per_section            = 0;                  // 0 = unlimited for top-level sections
$include_item_lists           = true;               // show items under each taxonomy term
$items_per_term_limit         = 0;                  // 0 = unlimited
$item_orderby                 = 'title';            // 'title' | 'date'
$item_order                   = 'ASC';              // 'ASC' | 'DESC'
$dedupe_across_sections       = true;               // prevent duplicate links anywhere on the page

// Taxonomies to skip
$exclude_taxonomies = [
    'nav_menu','link_category','post_format',
    'wp_theme','wp_template_part_area','wp_navigation',
];

/* -------------------------------------------------
 * HELPERS
 * ------------------------------------------------- */
$printed_ids = []; // cross-section de-duplication

$mark_printed = function($id) use (&$printed_ids) {
    $printed_ids[$id] = true;
};
$is_printed = function($id) use (&$printed_ids) {
    return isset($printed_ids[$id]);
};

$updated = function ($post_id) use ($show_post_dates) {
    if (!$show_post_dates) return '';
    $d = get_the_modified_time(get_option('date_format'), $post_id);
    return $d ? ' <span class="smap-updated">(updated ' . esc_html($d) . ')</span>' : '';
};

/* -------------------------------------------------
 * QUERIES
 * ------------------------------------------------- */

// Pages
$pages = get_pages([
    'sort_column' => 'menu_order,post_title',
    'sort_order'  => 'ASC',
    'exclude'     => [],
    'post_status' => 'publish',
]);

// Blog posts
$posts = [];
if ($include_posts) {
    $posts = get_posts([
        'numberposts' => ($limit_per_section ?: -1),
        'post_type'   => 'post',
        'post_status' => 'publish',
        'orderby'     => 'date',
        'order'       => 'DESC',
    ]);
}

// Products
$products = [];
if ($include_products) {
    $products = get_posts([
        'numberposts' => ($limit_per_section ?: -1),
        'post_type'   => 'product',
        'post_status' => 'publish',
        'orderby'     => 'title',
        'order'       => 'ASC',
    ]);
}

// All public taxonomies (minus excluded)
$tax_objects = get_taxonomies(['public' => true], 'objects');
$tax_objects = array_filter($tax_objects, function($tax) use ($exclude_taxonomies) {
    return !in_array($tax->name, $exclude_taxonomies, true);
});

// Build taxonomy -> terms
$taxonomy_terms_map = [];
foreach ($tax_objects as $tax) {
    $terms = get_terms([
        'taxonomy'   => $tax->name,
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ]);
    if (!is_wp_error($terms) && !empty($terms)) {
        $taxonomy_terms_map[$tax->name] = [
            'label'       => $tax->labels->name ?: $tax->name,
            'object_type' => (array) $tax->object_type,
            'terms'       => $terms,
        ];
    }
}
?>

<style>
h1{color:#000;}
.smap-wrap {max-width: 1100px; margin: 0 auto; padding: 32px 20px;}
.smap-header {margin-bottom: 18px;}
.smap-header h1 {margin: 0 0 6px; font-size: clamp(24px, 3vw, 34px);}
.smap-grid {display: grid; gap: 28px; grid-template-columns: 1fr;}
@media (min-width: 900px) {.smap-grid {grid-template-columns: 1fr 1fr;}}
.smap-card {background: #fff; border: 1px solid #e9ecef; border-radius: 14px; padding: 18px 18px 12px; box-shadow: 0 1px 3px rgba(0,0,0,.03);}
.smap-card h2 {font-size: 18px; margin: 0 0 10px;}
.smap-meta {font-size: 12px; color:#6c757d; margin-bottom: 10px;}
.smap-list {list-style: none; padding: 0; margin: 0;}
.smap-list li {padding: 6px 0; border-bottom: 1px dashed #f1f3f5;}
.smap-list li:last-child {border-bottom: none;}
.smap-list a {text-decoration: none;}
.smap-list a:hover {text-decoration: underline;}
.smap-updated {color:#6c757d; font-size: 12px; margin-left: 6px;}
.smap-empty {color:#6c757d; font-style: italic; padding: 6px 0 12px;}
.smap-tax-terms {display: grid; gap: 16px; grid-template-columns: 1fr;}
@media (min-width: 900px) {.smap-tax-terms {grid-template-columns: 1fr 1fr;}}
.smap-term-block h3 {font-size: 15px; margin: 0 0 6px;}
.smap-term-count {color:#6c757d; font-size: 12px; margin-left: 6px;}
.smap-term-items {margin: 6px 0 0 0; padding-left: 14px; border-left: 2px solid #f1f3f5;}
.smap-term-items li {border-bottom: none; padding: 4px 0;}
</style>

<main class="smap-wrap" aria-labelledby="sitemap-title">
    <header class="smap-header">
        <h1 id="sitemap-title"><?php echo $hardcode_title ? 'Sitemap' : esc_html( wp_get_document_title() ); ?></h1>
    </header>

    <section class="smap-grid" aria-label="Sitemap Sections">

        <!-- Pages -->
        <article class="smap-card">
            <h2>Pages</h2>
            <div class="smap-meta"><?php echo count($pages); ?> total</div>
            <?php if (!empty($pages)) : ?>
                <ul class="smap-list">
                    <?php foreach ($pages as $p) :
                        if ($dedupe_across_sections && $is_printed($p->ID)) continue; ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($p->ID)); ?>">
                                <?php echo esc_html(get_the_title($p->ID)); ?>
                            </a>
                            <?php echo $updated($p->ID); ?>
                        </li>
                        <?php $mark_printed($p->ID); ?>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <div class="smap-empty">No pages found.</div>
            <?php endif; ?>
        </article>

        <!-- Blog Posts -->
        <?php if ($include_posts) : ?>
        <article class="smap-card">
            <h2>Blog Posts</h2>
            <div class="smap-meta">
                <?php $post_count = wp_count_posts('post'); echo intval($post_count->publish) . ' total'; ?>
            </div>
            <?php if (!empty($posts)) : ?>
                <ul class="smap-list">
                    <?php foreach ($posts as $post_item) :
                        if ($dedupe_across_sections && $is_printed($post_item->ID)) continue; ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
                                <?php echo esc_html(get_the_title($post_item->ID)); ?>
                            </a>
                            <?php echo $updated($post_item->ID); ?>
                        </li>
                        <?php $mark_printed($post_item->ID); ?>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <div class="smap-empty">No posts found.</div>
            <?php endif; ?>
        </article>
        <?php endif; ?>

        <!-- Products -->
        <?php if ($include_products) : ?>
        <article class="smap-card">
            <h2>Products</h2>
            <div class="smap-meta">
                <?php $prod_count = wp_count_posts('product'); echo intval($prod_count->publish) . ' total'; ?>
            </div>
            <?php if (!empty($products)) : ?>
                <ul class="smap-list">
                    <?php foreach ($products as $prod) :
                        if ($dedupe_across_sections && $is_printed($prod->ID)) continue; ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($prod->ID)); ?>">
                                <?php echo esc_html(get_the_title($prod->ID)); ?>
                            </a>
                            <?php echo $updated($prod->ID); ?>
                        </li>
                        <?php $mark_printed($prod->ID); ?>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <div class="smap-empty">No products found.</div>
            <?php endif; ?>
        </article>
        <?php endif; ?>

        <!-- Custom Aeroquip Links -->
        <article class="smap-card">
            <h2>Custom Aeroquip Links</h2>
            <ul class="smap-list">
                <li><a href="https://defense.hydrasearch.com/aeroquip/90ef-1488cl-hs-2/">90ef-1488cl-hs-2</a></li>
                <li><a href="https://defense.hydrasearch.com/aeroquip/ef-mss1488c-hs-2/">ef-mss1488c-hs-2</a></li>
                <li><a href="https://defense.hydrasearch.com/aeroquip/ef-mb1488c-hs-2/">ef-mb1488c-hs-2</a></li>
                <!-- Add the rest of your URLs here -->
            </ul>
        </article>

        <!-- Taxonomies -->
        <?php if (!empty($taxonomy_terms_map)) : ?>
            <?php foreach ($taxonomy_terms_map as $tax_name => $data) : ?>
                <article class="smap-card">
                    <h2><?php echo esc_html($data['label']); ?></h2>
                    <div class="smap-meta">
                        <?php echo count($data['terms']); ?> terms
                    </div>
                    <div class="smap-tax-terms">
                        <?php foreach ($data['terms'] as $term) : ?>
                            <div class="smap-term-block">
                                <h3>
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </a>
                                    <span class="smap-term-count"><?php echo intval($term->count); ?> items</span>
                                </h3>
                                <?php if ($include_item_lists) :
                                    $object_types = !empty($data['object_type']) ? $data['object_type'] : ['any'];
                                    $object_types = array_filter($object_types, function($pt) {
                                        return post_type_exists($pt) && !in_array($pt, ['wp_block','wp_template','wp_template_part','wp_navigation'], true);
                                    });
                                    if (empty($object_types)) { $object_types = ['any']; }
                                    $items = get_posts([
                                        'numberposts' => ($items_per_term_limit ?: -1),
                                        'post_type'   => $object_types,
                                        'post_status' => 'publish',
                                        'orderby'     => $item_orderby,
                                        'order'       => $item_order,
                                        'tax_query'   => [[
                                            'taxonomy' => $tax_name,
                                            'field'    => 'term_id',
                                            'terms'    => $term->term_id,
                                        ]],
                                    ]);
                                    ?>
                                    <?php if (!empty($items)) : ?>
                                        <ul class="smap-list smap-term-items">
                                            <?php foreach ($items as $it) :
                                                if ($dedupe_across_sections && $is_printed($it->ID)) continue; ?>
                                                <li>
                                                    <a href="<?php echo esc_url(get_permalink($it->ID)); ?>">
                                                        <?php echo esc_html(get_the_title($it->ID)); ?>
                                                    </a>
                                                    <?php echo $updated($it->ID); ?>
                                                </li>
                                                <?php $mark_printed($it->ID); ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else : ?>
                                        <div class="smap-empty">No items found in this term.</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>