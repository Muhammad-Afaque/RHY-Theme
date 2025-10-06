<?php
get_header();
$queried = get_queried_object();
$term_id = $queried->term_id;
$filter_groups = function_exists('get_acf_flexible_filters_for_collection') ? get_acf_flexible_filters_for_collection($term_id) : [];
?>

<!-- Hidden inputs for JS context -->
<input type="hidden" id="filter-context" value="collection">
<input type="hidden" id="filter-term-id" value="<?php echo esc_attr($term_id); ?>">

<style>
  .sidebar.sticky-sidebar {
    position: -webkit-sticky;
    position: sticky;
    top: 100px;
    background: #F7F7F7;
    padding: 15px;
    border-radius: 6px;
    z-index: 2;
  }
  @media (max-width: 767.98px) {
    .sidebar.sticky-sidebar { display: none; }
  }
  .filter-checkbox:checked + label { font-weight: bold; }
  .card.card-box { border: 1px solid #eee; border-radius: 4px; transition: box-shadow 0.2s ease; }
  .card.card-box:hover { box-shadow: 0 0 10px rgba(0,0,0,0.08); }
  .btn-link { color: #01254C; font-weight: 600; font-size: 15px; text-decoration: none; display: flex; justify-content: space-between; width: 100%; }
  .btn-link .chevron { transition: transform 0.2s ease; }
  .btn-link[aria-expanded="true"] .chevron { transform: rotate(180deg); }
  .clear-filters { background: transparent; color: #005A87; border-color: #005A87; }
  .clear-filters:hover { background-color: #005A87; color: #fff; }
  .active-label { font-weight: bold; color: #005A87; }
  .ajax-pagination ul { list-style: none; padding: 0; display: inline-flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap; }
  .ajax-pagination li { display: inline; }
  .ajax-pagination li a,
  .ajax-pagination li span { padding: 6px 12px; border: 1px solid #ddd; border-radius: 4px; color: #01254C; text-decoration: none; font-weight: 500; display: inline-block; }
  .ajax-pagination li span.current { background-color: #005A87; color: #fff; border-color: #005A87; }
  .card-header.active { background-color: #f5f5f5; font-weight: bold; }
  .skeleton { background-color: #e0e0e0; border-radius: 4px; animation: pulse 1.5s infinite ease-in-out; }
  .skeleton-img { width: 100%; height: 200px; }
  .skeleton-title { height: 18px; width: 80%; }
  .skeleton-sku { height: 14px; width: 60%; }
  .skeleton-button { height: 36px; width: 40%; border-radius: 20px; }
  .filter-group .form-check { display: none; }
  .filter-group .form-check.visible { display: block; }
  @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
  #filter-drawer { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: #fff; z-index: 1050; display: none; flex-direction: column; padding: 1rem; overflow-y: auto; }
  #filter-drawer.open { display: flex; }
  .filter-drawer-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 0.5rem; margin-bottom: 1rem; }
  #close-filter-drawer { background: none; border: none; font-size: 1.5rem; line-height: 1; cursor: pointer; }
</style>

<section id="menu_list">
  <div class="container">
    <div class="row">
      <?php if (function_exists('category_breadcrumbs')) category_breadcrumbs('collection'); ?>
      <?php $category_image = get_field('category_image', $queried); ?>
    </div>
  </div>
</section>

<section id="marine">
  <div class="container">
	  <div class="row">
    <?php if ($category_image): ?>
      <div class="col-lg-6">
        <div class="img_hous d-flex">
          <img src="<?php echo esc_url($category_image['url']); ?>"
               alt="<?php echo esc_attr($queried->name); ?>">
        </div>
      </div>

    <?php endif; ?>

    <div class="col-lg-12">
      <div class="marine_div">
        <?php
            $current_term = single_term_title('', false);
            $sku          = get_field('sku', $queried);
            $sizes        = get_field('sizes', $queried);
            $description  = get_field('description', $queried);
            if ($current_term) {
                echo '<h1 class="collection-heading">' . esc_html($current_term) . '</h1>';
            }
            if ($sku) {
                echo '<h3>' . esc_html($sku) . '</h3>';
            }
            if ($sizes) {
                echo '<h5>Sizes: ' . esc_html($sizes) . '</h5>';
            }
            if ($description) {
                echo '<h4>Description:</h4>';
                echo '<p>' . esc_html($description) . '</p>';
            }
        ?>
<?php
                                                        // Get current term
    $taxonomy       = $queried->taxonomy ?? 'category'; // fallback to 'category'
    $parent_term_id = $queried->term_id;

    $child_terms = get_terms([
        'taxonomy'   => $taxonomy,
        'parent'     => $parent_term_id,
        'hide_empty' => false,
    ]);

    if (! empty($child_terms) && ! is_wp_error($child_terms)):
?>
  <div class="children-taxonomy-list">
    <ul class="list-unstyled">
      <?php foreach ($child_terms as $child): ?>
        <li>
		  <a href="<?php echo esc_url(get_term_link($child)); ?>">
            <?php echo esc_html($child->name); ?>
          </a> 
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php else: ?>
  
<?php endif; ?>
      </div>
    </div>

  </div>
	</div>
</section>

<div class="d-md-none mb-3 text-end">
  <button id="open-filter-drawer" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
</div>

<section>
  <div class="container mt-2 mb-5">
    <div class="row">
      <!-- Sidebar Filters -->
      <div class="col-md-3 position-relative">
        <div class="sidebar sticky-sidebar">
          <div class="accordion" id="collectionAccordion">
            <h5 class="mb-3">Filter Products</h5>
            <div id="active-filters-summary" class="mb-3"></div>
            <?php if (!empty($filter_groups)): ?>
              <div class="acf-flexible-filters">
                <?php $index = 0; foreach ($filter_groups as $group => $values): ?>
                  <?php $group_id = 'collapse-' . sanitize_title($group); $group_key = sanitize_title($group); ?>
                  <div class="card mb-2 filter-group" data-group-name="<?php echo esc_attr($group); ?>">
                    <div class="card-header p-2" id="heading-<?php echo $index; ?>">
                      <h6 class="mb-0">
                        <button class="btn btn-link p-0 text-left" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $group_id; ?>" aria-expanded="false" aria-controls="<?php echo $group_id; ?>">
                          <?php echo esc_html($group); ?> <span class="chevron">▼</span>
                        </button>
                      </h6>
                    </div>
                    <div id="<?php echo $group_id; ?>" class="collapse" data-bs-parent="#collectionAccordion">
                      <div class="card-body py-2" id="filter-body-<?php echo esc_attr($group_key); ?>">
                        <input type="text" class="form-control filter-search mb-2" placeholder="Search <?php echo esc_attr($group); ?>...">
                        <?php $i = 0; foreach ($values as $value): 
                            $value_slug = sanitize_title($value); 
                            $checkbox_id = esc_attr("{$group_key}-{$value_slug}"); 
                    
                            // Format label only
                            if ($value === '' || $value === null) {
                                $display_value = '-';
                            } else {
                                if (strpos($value, "'") === 0) {
                                    $formatted = ltrim($value, "'");
                                    $display_value = esc_html($formatted) . "''";
                                } else {
                                    $display_value = esc_html($value);
                                }
                            }
                        ?>
                          <div class="form-check <?php echo ($i < 5) ? 'visible' : ''; ?>">
                            <input 
                              class="form-check-input filter-checkbox" 
                              type="checkbox" 
                              data-group="<?php echo esc_attr($group); ?>" 
                              value="<?php echo esc_attr($value); ?>" 
                              id="<?php echo $checkbox_id; ?>">
                            <label class="form-check-label" for="<?php echo $checkbox_id; ?>">
                              <?php echo $display_value; ?>
                            </label>
                          </div>
                        <?php $i++; endforeach; ?>
                      </div>
                    </div>
                  </div>
                <?php $index++; endforeach; ?>
                <button type="button" class="btn btn-sm clear-filters mt-3">Clear All Filters</button>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Product List (AJAX content) -->
      <div class="col-md-9">
        <div id="product-count-number_parent" style="display:none;" class=" mb-3 text-muted">
		  <span id="product-count-number">0</span> Product(s) found.
		</div>

        <div id="content-list">
          <div id="content-list-inner" class="row"></div>
          <div class="mt-4 text-center ajax-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mobile Filter Drawer -->
<div id="filter-drawer" class="d-md-none">
  <div class="filter-drawer-header">
    <h5 class="m-0">Filter Products</h5>
    <button id="close-filter-drawer" aria-label="Close">&times;</button>
  </div>
  <div class="filter-drawer-body">
    <div class="accordion" id="mobileCollectionAccordion">
      <?php if (!empty($filter_groups)): ?>
        <div class="acf-flexible-filters">
          <?php $index = 0; foreach ($filter_groups as $group => $values): ?>
            <?php $group_id = 'mobile-collapse-' . sanitize_title($group); $group_key = sanitize_title($group); ?>
            <div class="card mb-2 filter-group" data-group-name="<?php echo esc_attr($group); ?>">
              <div class="card-header p-2" id="mobile-heading-<?php echo $index; ?>">
                <h6 class="mb-0">
                  <button class="btn btn-link p-0 text-left" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $group_id; ?>" aria-expanded="false" aria-controls="<?php echo $group_id; ?>">
                    <?php echo esc_html($group); ?> <span class="chevron">▼</span>
                  </button>
                </h6>
              </div>
              <div id="<?php echo $group_id; ?>" class="collapse" data-bs-parent="#mobileCollectionAccordion">
                <div class="card-body py-2">
                  <input type="text" class="form-control filter-search mb-2" placeholder="Search <?php echo esc_attr($group); ?>...">
                  <?php $i = 0; foreach ($values as $value): $value_slug = sanitize_title($value); $checkbox_id = esc_attr("mobile-{$group_key}-{$value_slug}"); ?>
                    <div class="form-check <?php echo ($i < 5) ? 'visible' : ''; ?>">
                      <input class="form-check-input filter-checkbox" type="checkbox" data-group="<?php echo esc_attr($group); ?>" value="<?php echo esc_attr($value); ?>" id="<?php echo $checkbox_id; ?>">
                      <label class="form-check-label" for="<?php echo $checkbox_id; ?>"><?php echo esc_html($value); ?></label>
                    </div>
                  <?php $i++; endforeach; ?>
                </div>
              </div>
            </div>
          <?php $index++; endforeach; ?>
          <button type="button" class="btn btn-sm clear-filters mt-3">Clear All Filters</button>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>