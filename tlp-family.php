<?php
    /*
 *Template Name: Family Page
 */
    get_header();
?>
<!-- Header -->
<section id="menu_list">
  <div class="container">
    <div class="row">
    <ul class="breadcrumbs"><li><a href="http://localhost/defenseHydrasearch">Home</a></li><li> <i class="fa-solid fa-chevron-right"></i> </li><li><a href="defense">Defense</a></li><li> <i class="fa-solid fa-chevron-right"></i> </li><li><a href="marine-hose-fittings">Marine Hose &amp; Fittings</a></li><li> <i class="fa-solid fa-chevron-right"></i> </li><li>CoflexD Expansion Joint</li></ul>
    </div>
  </div>
</section>

<section id="collect_sec">
  <div class="container">
    <div class="row">
      <h1>Marine Hoses & Fittings</h1>
      <div class="col-lg-3">
        <div class="cat_spn">
          <h3>Category</h3>
          <div class="mirn_btn ">
            <p id="cat-list">None</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9"></div>
      <div class="col-md-3"><input class="cat_spn" type="text" id="sku-search" placeholder="SKU Search"></div>
    </div>
  </div>
</section>
<div class="container my-5">
  <div class="row">
    <!-- Sidebar Section -->
    <div class="col-md-3 sidebar">
      <div class="accordion" id="sidebarAccordion">
        <!-- Dropdown Menu Items -->
        <?php
            $product_category = get_taxonomy('product-category');

            if ($product_category) {
            ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <?php echo $product_category->label; ?>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($product_category->name, 2); ?>
              </div>
            </div>
          </div>
          <?php
              }

              $thread_size_t = get_taxonomy('thread_size_t');
              if ($thread_size_t) {
              ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <?php echo $thread_size_t->label; ?>
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($thread_size_t->name); ?>
              </div>
            </div>
          </div>
          <?php
              }

              $materials = get_taxonomy('material');
              if ($materials) {
              ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <?php echo $materials->label; ?>
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($materials->name); ?>
              </div>
            </div>
          </div>
          <?php
              }

              $thread_size = get_taxonomy('thread_size');
              if ($thread_size) {
              ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <?php echo $thread_size->label; ?>
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($thread_size->name); ?>
              </div>
            </div>
          </div>
          <?php
              }

              $mil_spec = get_taxonomy('mil_spec');
              if ($mil_spec) {
              ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <?php echo $mil_spec->label; ?>
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($mil_spec->name); ?>
              </div>
            </div>
          </div>
          <?php
              }

              $pipe_o_d = get_taxonomy('pipe_o_d');
              if ($pipe_o_d) {
              ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <?php echo $pipe_o_d->label; ?>
              </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
              data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <?php display_taxonomy_hierarchy($pipe_o_d->name); ?>
              </div>
            </div>
          </div>
          <?php
              }
          ?>
      </div>
    </div>

    <!-- Main Content Section with Card Boxes -->
    <div class="col-md-9">
      <div class="row" id="content-list">
        <?php
            $args = [
                'post_type'      => ['aeroquip', 'hydrasearch'],
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ];

            $collection  = new WP_Query($args);
            $found_posts = $collection->found_posts;
            if ($collection->have_posts()) {
                while ($collection->have_posts()) {
                    $collection->the_post();
                    $post_thumbnail = get_the_post_thumbnail_url();
                    $pn_number      = get_field('pn_number');
                    $sku            = get_field('sku');
                    $mil_number     = get_field('mil_number');
                    $types          = get_field('types');
                    $title_parts    = get_field('title_parts');
                    $post_id        = get_the_ID();
                    $feature_image  = get_the_post_thumbnail_url();
                    $term_obj_list  = get_the_terms($post_id, 'product-category');
                    $terms_string   = join(' - ', wp_list_pluck($term_obj_list, 'name'));
                ?>
            <div class="col-md-4">
              <div class="card card-box">
                <img src="<?php echo $post_thumbnail; ?>" alt="Card Image" />
                <div class="card-body">
                  <h5 class="card-title">
                    <?php
                        if ($title_parts) {
                                    foreach ($title_parts as $title_part) {
                                        echo $title_part['heading'] . ' ';
                                    }
                                }
                            ?>
                    (<?php echo($mil_number) ? $mil_number : "";
        echo ', ';
        echo($types) ? $types : ""; ?>)
                  </h5>
                  <p class="card-text"><?php echo $mil_number; ?></p>
                  <button class="req-info-btn" product-id="<?php echo $post_id; ?>">Request Information<div
                      class="loader-spin"></div></button>
                </div>
              </div>
            </div>
            <?php
                }
                }
            ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();