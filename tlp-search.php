<?php
/**
 *Template Name: SKU Search
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package defense
 */

get_header(); ?>
<div class="container my-5" >
	<div class="row" style="display: flex;align-items: end;">
		<div class="col-md-6"></div>
		<div class="col-md-3">
		<label for="based_on">Choose a Selection:</label>
			<select name="based_on" id="based_on" class="cat_spn">
				<option value="famliy_pn">Search Family with P/N</option>
				<option value="famliy_sku">Search Family with SKU</option>
				<option value="product_sku">Search Product with Part Number</option>
			</select>
		</div>
		<div class="col-md-3"><input class="cat_spn" type="text" id="search" placeholder="SKU Search"></div>
	</div>
	<div class="row" id="content-list">
		<?php
  $sku = $_GET["sku"];
  $args = [
      "post_type" => ["product"],
      "posts_per_page" => -1,
      "meta_query" => [
          "relation" => "OR",
          [
              "key" => "sku",
              "value" => $sku,
              "compare" => "LIKE",
          ],
          [
              "key" => "pn_number",
              "value" => $sku,
              "compare" => "LIKE",
          ],
      ],
  ];

  $search = new WP_Query($args);

  if ($search->have_posts()):
      while ($search->have_posts()):

          $search->the_post();
          $post_title = get_the_title();
          $post_thumbnail = get_the_post_thumbnail_url();
          $pn_number = get_field("pn_number");
          $sku = get_field("sku");
          $post_type = get_post_type(); // Get the post type
          $mil_number = get_field("mil_number");
          $types = get_field("types");
          $title_parts = get_field("title_parts");
          $post_id = get_the_ID();
          $feature_image = get_the_post_thumbnail_url();
          $term_obj_list = get_the_terms($post_id, "product-category");
          $terms_string = join(" - ", wp_list_pluck($term_obj_list, "name"));

          // Get all required fields
          $product_data = [
              "pn_number" => get_field("pn_number"),
              "sku" => get_field("sku"),
              "mil_number" => get_field("mil_number"),
              "product_description" => get_field("product_description"),
              "following_hose" => get_field("following_hose"),
              "hose_to_flange_heading" => get_field("hose_to_flange_heading"),
              "hose_to_flange" => get_field("hose_to_flange"),
              "types" => get_field("types"),
              "flange_per" => get_field("flange_per"),
              "images" => get_field("images"),
          ];

          $post_id = get_the_ID();
          $term_obj_list = get_the_terms($post_id, "collection");
          $current_term = null;
          if (!empty($term_obj_list) && !is_wp_error($term_obj_list)) {
              $current_term = end($term_obj_list);
          }
          $taxonomy_terms = get_the_terms($post_id, "category");
          $is_aeroquip = false;
          $is_hydrasearch = false;

          // Check if the product belongs to specific taxonomies
          if (!empty($taxonomy_terms) && !is_wp_error($taxonomy_terms)) {
              foreach ($taxonomy_terms as $term) {
                  if (strtolower($term->slug) === "aeroquip") {
                      $is_aeroquip = true;
                  } elseif (strtolower($term->slug) === "hydrasearch") {
                      $is_hydrasearch = true;
                  }
              }
          }

          /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
          ?>
																				<div class="col-md-4 my-3">
						    <div class="card card-box">
		                    <a class="exempt_style" href="<?php echo get_the_permalink(); ?>">

						    <?php
          $images = get_field("images");
          if ($images && is_array($images)) {
              // Get the first image from the array
              $first_image = array_shift($images);
              if (isset($first_image["image"]["url"])) {
                  echo '<img src="' .
                      esc_url($first_image["image"]["url"]) .
                      '" alt="' .
                      esc_attr(get_the_title()) .
                      '">';
              }
          } elseif (has_post_thumbnail()) {
              the_post_thumbnail("full");
          } else {
              echo '<img src="' .
                  get_template_directory_uri() .
                  '/assets/images/placeholder.jpg" alt="Product Image">';
          }
          ?>
                    </a>
    <div class="card-body">
      

<a class="exempt_style" href="<?php echo get_the_permalink(); ?>">
<h5 class="card-title product-title">
            <?php
            if ($title_parts) {
                foreach ($title_parts as $title_part) {
                    echo $title_part["heading"] . " ";
                }
            }
            echo $post_title ? $post_title : "";
            ?>
        </h5>

</a>
        <h5 class="product-specs">(<?php echo $types ? $types : ""; ?>)</h5>



        <?php if ($mil_number): ?>
        <div class="cate_div">
            <div class="cate_header">
                <h4 class="specifications-heading">Specification</h4>
            </div>
            <p class="product-description">
            <?php if ($product_data["pn_number"]): ?>
<?php if ($is_aeroquip): ?>
                    Equal to Hydrasearch<?php echo esc_html(
                        $product_data["pn_number"]
                    ); ?>,
                <?php elseif ($is_hydrasearch): ?>
                    Equal to Aeroquip <?php echo esc_html(
                        $product_data["pn_number"]
                    ); ?>,
                <?php else: ?>
                    Equal to Aeroquip <?php echo esc_html(
                        $product_data["pn_number"]
                    ); ?>,
                <?php endif; ?>
<?php endif; ?>
            <br/>
            Use with the following hose:
            <span><?php echo esc_html(
                $product_data["following_hose"]
            ); ?></span>
        </p>
            <p class="card-text"><?php echo $mil_number; ?></p>
        </div>
        <?php endif; ?>

        <button class="req-info-btn getAQuote" product-id="<?php echo $post_id; ?>">
            Request Information
            <div class="loader-spin"></div>
        </button>
    </div>
</div>
							</div>
							<?php
      endwhile;
  else:
      get_template_part("template-parts/content", "none");
  endif;
  ?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="search-loader" class="search-loader" style="display: none;">
				<div class="spinner"></div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
