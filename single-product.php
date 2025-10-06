<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        // Get all required fields with existence checks
        $product_data = [
            'pn_number' => get_field('pn_number') ?: '',
            'sku' => get_field('sku') ?: '',
            'mil_number' => get_field('mil_number') ?: '',
            'product_description' => get_field('product_description') ?: '',
            'following_hose' => get_field('following_hose') ?: '',
            'hose_to_flange_heading' => get_field('hose_to_flange_heading') ?: '',
            'hose_to_flange' => get_field('hose_to_flange') ?: '',
            'types' => get_field('types') ?: '',
            'flange_per' => get_field('flange_per') ?: '',
            'images' => get_field('images') ?: []
        ];

        $post_id = get_the_ID();
        $term_obj_list = get_the_terms($post_id, 'collection');
        $current_term = null;
        if (!empty($term_obj_list) && !is_wp_error($term_obj_list)) {
            $current_term = end($term_obj_list);
        }

        $taxonomy_terms = get_the_terms($post_id, 'category');
        $is_aeroquip = false;
        $is_hydrasearch = false;

        // Check if the product belongs to specific taxonomies
        if (!empty($taxonomy_terms) && !is_wp_error($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {
                if (isset($term->slug)) {
                    if (strtolower($term->slug) === 'aeroquip') {
                        $is_aeroquip = true;
                    } elseif (strtolower($term->slug) === 'hydrasearch') {
                        $is_hydrasearch = true;
                    }
                }
            }
        }
        ?>

        <!-- Breadcrumbs Section -->

        <section id="menu_list">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                        <?php
                        // Get all terms associated with this post for the collection taxonomy
                        $terms = get_the_terms($post_id, 'collection');

                        if (!empty($terms) && !is_wp_error($terms)) {
                            // Find the term with the most ancestors (deepest in hierarchy)
                            $deepest_term = null;
                            $max_depth = -1;

                            foreach ($terms as $term) {
                                if (isset($term->term_id)) {
                                    $ancestors = get_ancestors($term->term_id, 'collection');
                                    $depth = count($ancestors);
                                    if ($depth > $max_depth) {
                                        $max_depth = $depth;
                                        $deepest_term = $term;
                                    }
                                }
                            }

                            if ($deepest_term && isset($deepest_term->term_id)) {
                                // Get ancestors of the deepest term
                                $ancestors = get_ancestors($deepest_term->term_id, 'collection');
                                $ancestors = array_reverse($ancestors); // Reverse to get top-down hierarchy

                                // Display ancestors
                                foreach ($ancestors as $ancestor_id) {
                                    $ancestor = get_term($ancestor_id, 'collection');
                                    if ($ancestor && !is_wp_error($ancestor) && isset($ancestor->name)) {
                                        echo '<li><i class="fa-solid fa-chevron-right"></i></li>';
                                        echo '<li><a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
                                    }
                                }

                                // Display the current term
                                if (isset($deepest_term->name)) {
                                    echo '<li><i class="fa-solid fa-chevron-right"></i></li>';
                                    echo '<li><a href="' . esc_url(get_term_link($deepest_term)) . '">' . esc_html($deepest_term->name) . '</a></li>';
                                }
                            }
                        }
                        ?>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li><?php echo esc_html(get_the_title()); ?></li>
                    </ul>
                </div>
            </div>
        </section>


        <!-- Main Product Section -->
        <div class="container  mb-5">
            <div class="row">
                <!-- Product Image Section -->
                <div class="col-md-6 product_img_column">
                  <div id="thumbnailSlider">
						
					
					<div class="slider-container">
    <div class="main-image">
        <?php
        $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
        $featured_image_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
        $image_output = [];

        // Add featured image first if it exists
        if (!empty($featured_image_url)) {
            $image_output[] = [
                'url' => $featured_image_url,
                'alt' => !empty($featured_image_alt) ? $featured_image_alt : get_the_title()
            ];
        }

        // Add other images from ACF
        if (!empty($product_data['images']) && is_array($product_data['images'])) {
            foreach ($product_data['images'] as $image) {
                if (isset($image['image']) && is_array($image['image']) && !empty($image['image']['url'])) {
                    $image_output[] = [
                        'url' => $image['image']['url'],
                        'alt' => isset($image['image']['name']) ? $image['image']['name'] : get_the_title()
                    ];
                }
            }
        }

        // Output current image
        if (!empty($image_output)) {
            echo '<img id="currentImage" src="' . esc_url($image_output[0]['url']) . '" alt="' . esc_attr($image_output[0]['alt']) . '">';
        }
        ?>
    </div>

    <div class="thumbnails">
        <?php
        if (!empty($image_output)) {
            foreach ($image_output as $index => $img) {
                $is_active = $index === 0 ? 'active' : '';
                echo '<img class="thumbnail ' . $is_active . '" src="' . esc_url($img['url']) . '" data-full="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '">';
            }
        }
        ?>
    </div>
</div>
						</div>
                </div>


                <!-- Product Details Section -->
                <div class="col-md-6 mt-4 mt-md-0 product_det">
                    <?php if (!empty($product_data['sku'])): ?>
                        <span><?php echo esc_html($product_data['sku']); ?></span>
                    <?php endif; ?>

                    <?php if (get_the_title()): ?>
                        <h1 class="product-title"><?php echo esc_html(get_the_title()); ?></h1>
                    <?php endif; ?>
                    <!-- 					 <div class="pdf-buttons mt-3">
						<a href="<?php echo esc_url(home_url('/download-product-pdf/?product_id=' . get_the_ID())); ?>" class="btn btn-primary" >Download PDF</a>
						<a href="<?php echo esc_url(home_url('/print-product-pdf/?product_id=' . get_the_ID())); ?>" class="btn btn-secondary" target="_blank">Print View</a>
					</div> -->

                    <div class="right-buttons  mt-3" style="display: flex;justify-content: end;">
                        <a class="print-btn" style="text-align: center; font-family: Franklin Gothic Condensed Demi; font-size: 1.25rem; font-style: normal; font-weight: 400; line-height: 125%;
               background: #fff; justify-content: center; align-items: center; gap: 0.625rem; text-decoration: none;
               display: inline-flex; cursor: pointer; color: #000; border: none; padding: 0.625rem 1.25rem; border-radius: 3.125rem;"
                           href="<?php echo esc_url(home_url('/print-product-pdf/?product_id=' . get_the_ID())); ?>"
                           target="_blank">
                            <img src="https://defense.hydrasearch.com/wp-content/uploads/2025/07/print.svg"
                                 alt="Print Icon" style="width: 1.25rem; height: auto;">
                            Print
                        </a>

                        <a href="<?php echo esc_url(home_url('/download-product-pdf/?product_id=' . get_the_ID())); ?>"
                           class="download-btn" style="text-align: center; font-family: Franklin Gothic Condensed Demi; font-size: 1.25rem; font-style: normal; font-weight: 400; line-height: 125%;
               background: #fff; justify-content: center; align-items: center; gap: 0.625rem; text-decoration: none;
               display: inline-flex; cursor: pointer; color: #000; border: none; padding: 0.625rem 1.25rem; border-radius: 3.125rem;">
                            <img src="https://defense.hydrasearch.com/wp-content/uploads/2025/07/download.svg"
                                 alt="Download Icon" style="width: 1.25rem; height: auto;">
                            Download PDF
                        </a>

                    </div>
                    <?php
                    $details = array_filter([
                        $product_data['mil_number'],
                        $product_data['types'],
                        $product_data['hose_to_flange']
                    ]);
                    if (!empty($details)): ?>
                        <h5>( <?php echo esc_html(implode(', ', $details)); ?> )</h5>
                    <?php endif; ?>
           <?php if (!empty($product_data['pn_number']) || !empty($product_data['following_hose'])): ?>
    <h3>Description:</h3>
    <p class="product-description">
        <?php if (!empty($product_data['pn_number'])): ?>
            <?php if ($is_aeroquip): ?>
                Equal to Hydrasearch <?php echo esc_html($product_data['pn_number']); ?>,
            <?php elseif ($is_hydrasearch): ?>
                Equal to Aeroquip <?php echo esc_html($product_data['pn_number']); ?>,
            <?php else: ?>
                Equal to Aeroquip <?php echo esc_html($product_data['pn_number']); ?>,
            <?php endif; ?>
		  <br/>
        <?php endif; ?>

        <?php if (!empty($product_data['following_hose'])): ?>
          
            Use with the following hose:
            <?php echo esc_html($product_data['following_hose']); ?>
        <?php endif; ?>
    </p>
					   <?php
                    $product_description = get_the_content();
                    if (!empty($product_description)) {
                        echo wp_kses_post($product_description);
                    }
                    ?>
<?php endif; ?>


                <?php
				// Add this code after your product title and before description
				if (class_exists('WooCommerce') && function_exists('wc_get_product')) {
					$product = wc_get_product(get_the_ID());

					if ($product && is_object($product)) {
						$price = $product->get_price();

						if (!is_null($price) && floatval($price) > 0) {
							echo '<div class="woocommerce-product-price">';
							echo $product->get_price_html();
							echo '</div>';
						} else {
							echo '<style>.quantity,.woocommerce-single-product-summary { display: none; } </style>';
							
							echo '<div><br>';
					if (class_exists('QBP_Frontend')) {
											echo QBP_Frontend::render_quote_button();
										}
		
					echo '</div>';
						}
					}
				}
				?>

                    <?php
					
                    // Simple WooCommerce add to cart integration
                    if (class_exists('WooCommerce') && function_exists('wc_get_product')) {
                        $product = wc_get_product(get_the_ID());

                        if ($product && is_object($product)) {
                            echo '<div class="woocommerce-single-product-summary">';
                            woocommerce_template_single_add_to_cart();
                            echo '</div>';
                        } else {
                     
							if (class_exists('QBP_Frontend')) {
								echo QBP_Frontend::render_quote_button();
							}
					
                        }
                    } else {
                        if (class_exists('QBP_Frontend')) {
								echo QBP_Frontend::render_quote_button();
							}
                    }
                    ?>


                    <!-- Product Categories Section -->
                    <div class="cate_div_parent">
                        <!-- Specifications Section -->
                        <?php if (have_rows('table_row')): ?>
                            <div class="cate_div d-none">
                                <div class="cate_header">
                                    <h4 class="specifications-heading">Specification</h4>
                                    <i class="fa-solid fa-plus toggle-btn"></i>
                                </div>
                                <ul class="expand-list">
                                    <?php
                                    while (have_rows('table_row')):
                                        the_row();
                                        if (have_rows('column')):
                                            while (have_rows('column')):
                                                the_row();
                                                $current_layout = get_row_layout();
                                                $field_obj = get_field_object('table_row');

                                                if ($field_obj && isset($field_obj['layouts']['layout_676c34f724f43']['sub_fields'][0]['layouts'])) {
                                                    $layouts = $field_obj['layouts']['layout_676c34f724f43']['sub_fields'][0]['layouts'];

                                                    foreach ($layouts as $layout) {
                                                        if ($current_layout === $layout['name'] && isset($layout['label'])) {
                                                            $label = $layout['label'];
                                                            $content = get_sub_field('content');
                                                            if (!empty($content)) {
                                                                echo "<li><span>" . esc_html($label) . ":</span> <span>" . esc_html($content) . "</span></li>";
                                                            }
                                                        }
                                                    }
                                                }
                                            endwhile;
                                        endif;
                                    endwhile;
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Files Section -->
                        <?php if (have_rows('files')): ?>
                            <div class="cate_div">
                                <div class="cate_header">
                                    <h4 class="category-heading">Download</h4>
                                    <i class="fa-solid fa-plus toggle-btn"></i>
                                </div>
                                <ul class="expand-list">
                                    <?php
                                    while (have_rows('files')):
                                        the_row();
                                        $file_name = get_sub_field('file_name');
                                        $file = get_sub_field('file');
                                        if (!empty($file) && is_array($file) && !empty($file['url'])):
                                            ?>
                                            <li class="d-flex align-items-baseline justify-content-between">
                                                <span>File Name: <?php echo !empty($file_name) ? esc_html($file_name) : 'Download'; ?></span>
                                                <span>
                                                    <a href="<?php echo esc_url($file['url']); ?>" class="view"
                                                       target="_blank">View</a>
                                                    <a href="<?php echo esc_url($file['url']); ?>" class="view"
                                                       download>Download</a>
                                                </span>
                                            </li>
                                        <?php
                                        endif;
                                    endwhile;
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tables Section -->
        <section id="tables_view">
            <!-- Specifications Table -->
            <?php if (have_rows('table_row')): ?>
                <section class="dimensions-table mt-3">
                    <div class="container">
                        <div class="row">
                            <h3 class="product-title mb-4">Specification Table</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                    if (have_rows('table_row')):
                                        while (have_rows('table_row')): the_row();
                                            if (have_rows('column')):
                                                while (have_rows('column')): the_row();
                                                    $current_layout = get_row_layout();
                                                    $field_obj = get_field_object('table_row');
                                                    $content = get_sub_field('content');
                        
                                                    // Format content
                                                    if ($content === '' || $content === null) {
                                                        $display_value = '-';
                                                    } else {
                                                        if (strpos($content, "'") === 0) {
                                                            // Value starts with a single quote, format it
                                                            $formatted = ltrim($content, "'");
                                                            $display_value = esc_html($formatted) . "''";
                                                        } else {
                                                            // Leave value as is
                                                            $display_value = esc_html($content);
                                                        }
                                                    }
                        
                                                    $label = '';
                                                    if ($field_obj && isset($field_obj['layouts']['layout_676c34f724f43']['sub_fields'][0]['layouts'])) {
                                                        $layouts = $field_obj['layouts']['layout_676c34f724f43']['sub_fields'][0]['layouts'];
                                                        foreach ($layouts as $layout) {
                                                            if ($current_layout === $layout['name'] && isset($layout['label'])) {
                                                                $label = $layout['label'];
                                                                break;
                                                            }
                                                        }
                                                    }
                        
                                                    echo "<tr><th class='text-start'>" . esc_html($label) . "</th><td>" . $display_value . "</td></tr>";
                                                endwhile;
                                            endif;
                                        endwhile;
                                    endif;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Components Table -->
            <?php if (have_rows('components_table')): ?>
                <section class="components-table mt-3">
                    <div class="container">
                        <div class="row">
                            <h3 class="product-title mb-4">Components Table</h3>
                            <div class="table-responsive">
                                <?php while (have_rows('components_table')): the_row(); ?>
                                    <?php if (have_rows('row')): ?>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <?php
                                            $first_row = true;
                                            $labels = [];
                                            $data_rows = [];

                                            while (have_rows('row')): the_row();
                                                $row_data = [];
                                                for ($i = 1; $i <= 19; $i++) {
                                                    $val = get_sub_field('column_' . $i);
                                                    if ($first_row && !empty($val)) {
                                                        $labels[$i] = esc_html($val);
                                                    } else {
                                                        $row_data[$i] = (!empty($val) ? esc_html($val) : '-');
                                                    }
                                                }
                                                if (!$first_row) {
                                                    $data_rows[] = $row_data;
                                                }
                                                $first_row = false;
                                            endwhile;

                                            // Render table vertically
                                            foreach ($labels as $i => $label) {
                                                echo '<tr>';
                                                echo '<th class="text-start">' . $label . '</th>';
                                                echo '<td class="text-center">';
                                                $values = array_column($data_rows, $i);
                                                echo implode(', ', $values);
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </section>

        <!-- FAQs Section -->
        <?php if (have_rows('faqs') && get_field('faqs')): ?>
            <section id="faq" style="padding-bottom: 90px;">
                <div class="container">
                    <div class="row">
                        <h3 class="product-title">FAQs</h3>
                    </div>
                    <div class="row">
                        <div class="accordion" id="accordionExample">
                            <?php
                            $faq_counter = 1;
                            while (have_rows('faqs')): the_row();
                                $question = get_sub_field('question');
                                $answer = get_sub_field('answer');

                                if (!empty($question) && !empty($answer)):
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo $faq_counter; ?>">
                                            <button class="accordion-button <?php echo ($faq_counter !== 1) ? 'collapsed' : ''; ?>"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?php echo $faq_counter; ?>"
                                                    aria-expanded="<?php echo ($faq_counter === 1) ? 'true' : 'false'; ?>"
                                                    aria-controls="collapse<?php echo $faq_counter; ?>">
                                                <?php echo esc_html($question); ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $faq_counter; ?>"
                                             class="accordion-collapse collapse <?php echo ($faq_counter === 1) ? 'show' : ''; ?>"
                                             aria-labelledby="heading<?php echo $faq_counter; ?>"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php echo wp_kses_post($answer); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $faq_counter++;
                                endif;
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <!-- Spacer div when no FAQs exist -->
            <div style="margin-bottom: 5rem;"></div>
        <?php endif; ?>

        <?php
    }
}

get_footer();
?>