<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        // Get all required fields
        $product_data = [
            'pn_number' => get_field('pn_number'),
            'sku' => get_field('sku'),
            'mil_number' => get_field('mil_number'),
            'product_description' => '', // This field isn't in the aeroquip ACF but included for compatibility
            'following_hose' => get_field('following_hose'),
            'hose_to_flange_heading' => get_field('hose_to_flange_heading'),
            'hose_to_flange' => get_field('hose_to_flange'),
            'types' => get_field('types'),
            'flange_per' => get_field('flange_per'),
            'family_logo' => get_field('family_logo'),
            'images' => get_field('images')
        ];

        $post_id = get_the_ID();
        $term_obj_list = get_the_terms($post_id, 'aeroquip-collection'); // Assuming you have this taxonomy
        $current_term = null;
        if (!empty($term_obj_list) && !is_wp_error($term_obj_list)) {
            $current_term = end($term_obj_list);
        }
        
        // Get title parts if available
        $title_parts = get_field('title_parts');
        $title_parts_text = '';
        if (!empty($title_parts)) {
            $headings = [];
            foreach ($title_parts as $part) {
                if (!empty($part['heading'])) {
                    $headings[] = $part['heading'];
                }
            }
            $title_parts_text = implode(' - ', $headings);
        }
        ?>

        <!-- Breadcrumbs Section -->
        <section id="menu_list">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo home_url(); ?>">Home</a></li>
                        <?php
                        // Get all terms associated with this post for the collection taxonomy
                        $terms = get_the_terms($post_id, 'aeroquip-collection');
                        
                        if ($terms && !is_wp_error($terms)) {
                            // Find the term with the most ancestors (deepest in hierarchy)
                            $deepest_term = null;
                            $max_depth = -1;
                            
                            foreach ($terms as $term) {
                                $ancestors = get_ancestors($term->term_id, 'aeroquip-collection');
                                $depth = count($ancestors);
                                if ($depth > $max_depth) {
                                    $max_depth = $depth;
                                    $deepest_term = $term;
                                }
                            }
                            
                            if ($deepest_term) {
                                // Get ancestors of the deepest term
                                $ancestors = get_ancestors($deepest_term->term_id, 'aeroquip-collection');
                                $ancestors = array_reverse($ancestors); // Reverse to get top-down hierarchy
                                
                                // Display ancestors
                                foreach ($ancestors as $ancestor_id) {
                                    $ancestor = get_term($ancestor_id, 'aeroquip-collection');
                                    if ($ancestor && !is_wp_error($ancestor)) {
                                        echo '<li><i class="fa-solid fa-chevron-right"></i></li>';
                                        echo '<li><a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
                                    }
                                }
                                
                                // Display the current term
                                echo '<li><i class="fa-solid fa-chevron-right"></i></li>';
                                echo '<li><a href="' . esc_url(get_term_link($deepest_term)) . '">' . esc_html($deepest_term->name) . '</a></li>';
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
        <div class="container my-5">
            <div class="row">
                <!-- Product Image Section -->
                <div class="col-md-4 product_img_column">
                    <?php if (!empty($product_data['images'])): ?>
                        <div class="product_gallery">
                            <?php foreach ($product_data['images'] as $image): ?>
                                <img src="<?php echo esc_url($image['image']['url']); ?>"
                                    alt="<?php echo esc_attr($image['image']['name']); ?>"
                                    class="product-img img-fluid rounded"/>
                            <?php endforeach; ?>
                        </div>
                        
                        <?php 
                        // Only show thumbnail slider if there's more than one image
                        if (count($product_data['images']) > 1): 
                        ?>
                            <!-- Image Slider Thumbnails -->
                            <div class="thumbnail-slider">
                                <?php foreach ($product_data['images'] as $image): ?>
                                    <div class="nav-img">
                                        <img src="<?php echo esc_url($image['image']['url']); ?>"
                                            alt="<?php echo esc_attr($image['image']['name']); ?>"
                                            class="product-img img-fluid rounded"/>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- If no images in ACF repeater, show the featured image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="product_gallery">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="product-img img-fluid rounded" />
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="col-md-1">
                    <a href="#!" class="shareIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M15 5.83334C15.6454 5.96715 16.1323 6.19049 16.5237 6.56324C17.5 7.49318 17.5 8.98992 17.5 11.9833C17.5 14.9768 17.5 16.4734 16.5237 17.4034C15.5474 18.3333 13.976 18.3333 10.8333 18.3333H9.16667C6.02397 18.3333 4.45262 18.3333 3.47631 17.4034C2.5 16.4734 2.5 14.9768 2.5 11.9833C2.5 8.98992 2.5 7.49318 3.47631 6.56324C3.86765 6.19049 4.35458 5.96715 5 5.83334" stroke="#141414" stroke-width="1.25" stroke-linecap="round" />
                            <path d="M10.0211 1.6671L10 11.6667M10.0211 1.6671C9.88558 1.66149 9.74925 1.70993 9.62775 1.81243C8.87242 2.45005 7.5 4.10738 7.5 4.10738M10.0211 1.6671C10.1426 1.67214 10.2635 1.72063 10.3723 1.81257C11.1276 2.45031 12.5 4.10738 12.5 4.10738" stroke="#141414" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="#!" class="favIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.2187 3.32846C13.9839 1.95769 12.0335 2.51009 10.8618 3.39001C10.3813 3.7508 10.1412 3.93119 9.99984 3.93119C9.8585 3.93119 9.61834 3.7508 9.13784 3.39001C7.96619 2.51009 6.01574 1.95769 3.78104 3.32846C0.848228 5.12745 0.184604 11.0624 6.94944 16.0695C8.23794 17.0232 8.88217 17.5 9.99984 17.5C11.1175 17.5 11.7618 17.0232 13.0503 16.0695C19.8151 11.0624 19.1514 5.12745 16.2187 3.32846Z" stroke="#141414" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                </div>

                <!-- Product Details Section -->
                <div class="col-md-6 mt-4 mt-md-0 product_det">
                    <?php if ($product_data['sku']): ?>
                        <span><?php echo esc_html($product_data['sku']); ?></span>
                    <?php endif; ?>

                    <?php if ($title_parts_text): ?>
                        <h2 class="product-title"><?php echo esc_html($title_parts_text); ?></h2>
                    <?php else: ?>
                        <h2 class="product-title"><?php echo get_the_title(); ?></h2>
                    <?php endif; ?>

                    <?php
                    $details = array_filter([
                        $product_data['mil_number'],
                        $product_data['types'],
                        $product_data['hose_to_flange']
                    ]);
                    if (!empty($details)): ?>
                        <h5>( <?php echo esc_html(implode(', ', $details)); ?> )</h5>
                    <?php endif; ?>

                    <h3>Description:</h3>
                    <p class="product-description">
                        <?php if ($product_data['pn_number']): ?>
                            Equal to product P/N <?php echo esc_html($product_data['pn_number']); ?>,
                        <?php endif; ?>
                        <br/>
                        Use with the following hose:
                        <?php echo esc_html($product_data['following_hose']); ?>
                    </p>

                    <button class="req-info-btn" product-id="<?php echo esc_attr($post_id); ?>">
                        Get a Quote
                        <div class="loader-spin"></div>
                    </button>

                    <!-- Product Categories Section -->
                    <div class="cate_div_parent">
                        <!-- Type/Group/Class Section -->
                        <?php if ($product_data['types']): ?>
                        <div class="cate_div">
                            <div class="cate_header">
                                <h4 class="category-heading">Type / Group / Class</h4>
                                <i class="fa-solid fa-plus toggle-btn"></i>
                            </div>
                            <ul class="expand-list">
                                <li class="d-flex align-items-baseline justify-content-between">
                                    <span><?php echo esc_html($product_data['types']); ?></span>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <!-- Related Products -->
                        <?php 
                        $related_products = get_field('products');
                        if ($related_products): ?>
                            <div class="cate_div">
                                <div class="cate_header">
                                    <h4 class="category-heading">Related Products</h4>
                                    <i class="fa-solid fa-plus toggle-btn"></i>
                                </div>
                                <ul class="expand-list">
                                    <?php foreach ($related_products as $related): ?>
                                        <li class="d-flex align-items-baseline justify-content-between">
                                            <span><?php echo esc_html($related->post_title); ?></span>
                                            <a href="<?php echo get_permalink($related->ID); ?>" class="view">View</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Specifications Section -->
                        <?php if (have_rows('table_header')): ?>
                            <div class="cate_div d-none">
                                <div class="cate_header">
                                    <h4 class="specifications-heading">Specification</h4>
                                    <i class="fa-solid fa-plus toggle-btn"></i>
                                </div>
                                <ul class="expand-list">
                                    <?php
                                    while (have_rows('table_header')):
                                        the_row();
                                        $current_layout = get_row_layout();
                                        $field_obj = get_field_object('table_header');
                                        $layouts = $field_obj['layouts'];

                                        foreach ($layouts as $layout) {
                                            if ($current_layout === $layout['name']) {
                                                $label = $layout['label'];
                                                $content = get_sub_field('content');
                                                if (!empty($content)) {
                                                    echo "<li><span>{$label}:</span> <span>{$content}</span></li>";
                                                }
                                            }
                                        }
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
            <!-- Specifications Table from Related Products -->
            <?php 
            $related_products = get_field('products');
            if ($related_products && !empty(get_field('table_header'))): 
            ?>
            <section class="dimensions-table mt-3">
                <div class="container">
                    <div class="row">
                        <h3 class="product-title mb-4">Dimensions Table</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <?php
                                    if (have_rows('table_header')):
                                        while (have_rows('table_header')):
                                            the_row();
                                            $current_layout = get_row_layout();
                                            $field_obj = get_field_object('table_header');
                                            $layouts = $field_obj['layouts'];

                                            foreach ($layouts as $layout) {
                                                if ($current_layout === $layout['name']) {
                                                    echo "<th class='text-center'>{$layout['label']}</th>";
                                                }
                                            }
                                        endwhile;
                                        reset_rows();
                                    endif;
                                    ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                // Global variables needed for the table data function
                                global $table_header;
                                global $aeroquip_product_id;
                                
                                // Process data from related products
                                foreach ($related_products as $related_product) {
                                    $aeroquip_product_id = $related_product->ID;
                                    
                                    // Get the table header layouts from ACF
                                    $headers = get_field('table_header', $aeroquip_product_id);
                                    $header_layouts = array();
                                    
                                    // Process headers to get the correct order and labels
                                    if (!empty($headers)) {
                                        foreach ($headers as $header) {
                                            if (isset($header['acf_fc_layout'])) {
                                                $header_layouts[] = $header['acf_fc_layout'];
                                            }
                                        }
                                    }
                                    
                                    // If we have table rows to display
                                    if (have_rows('table_row', $aeroquip_product_id)) {
                                        // First pass to collect all row data properly
                                        $all_rows = array();
                                        
                                        while (have_rows('table_row', $aeroquip_product_id)) {
                                            the_row();
                                            
                                            // Get the column data
                                            $columns = get_sub_field('column');
                                            
                                            if (empty($columns) || !is_array($columns)) {
                                                continue;
                                            }
                                            
                                            // Build a proper row data structure
                                            $row_data = array();
                                            
                                            // Process each entry in the columns array
                                            foreach ($columns as $column) {
                                                // Check if this is a properly structured flexible content field entry
                                                if (is_array($column) && isset($column['acf_fc_layout']) && isset($column['content'])) {
                                                    $field_name = $column['acf_fc_layout'];
                                                    $field_value = $column['content'];
                                                    
                                                    // Add to row data
                                                    $row_data[$field_name] = $field_value;
                                                }
                                            }
                                            
                                            // Only add if we have part_number (or other essential data)
                                            if (!empty($row_data) && isset($row_data['part_number'])) {
                                                $all_rows[] = $row_data;
                                            }
                                        }
                                        
                                        // Now render the rows based on the header layout order
                                        foreach ($all_rows as $row_data) {
                                            $product_permalink = get_permalink($aeroquip_product_id);
                                            
                                            echo '<tr>';
                                            
                                            // Use either the header layouts or the detected fields if header layouts are not defined
                                            $display_columns = !empty($header_layouts) ? $header_layouts : array_keys($row_data);
                                            
                                            foreach ($display_columns as $column_name) {
                                                echo '<td class="text-center">';
                                                if (isset($row_data[$column_name]) && !empty($row_data[$column_name])) {
                                                    echo '<a href="' . esc_url($product_permalink) . '" target="_blank" rel="noopener">' .
                                                        esc_html($row_data[$column_name]) .
                                                        '</a>';
                                                } else {
                                                    echo '&nbsp;'; // Empty cell placeholder
                                                }
                                                echo '</td>';
                                            }
                                            
                                            echo '</tr>';
                                        }
                                    }
                                }
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
                                            <thead>
                                            <tr>
                                                <?php
                                                $first_row = true;
                                                while (have_rows('row')):
                                                    the_row();
                                                    $row_layout = get_row_layout();
                                                    
                                                    // Get the max columns based on the current layout
                                                    $max_columns = 3; // Default for Table_with_Three_Columns
                                                    if (strpos($row_layout, 'Four') !== false) $max_columns = 4;
                                                    else if (strpos($row_layout, 'Five') !== false) $max_columns = 5;
                                                    else if (strpos($row_layout, 'Six') !== false) $max_columns = 6;
                                                    else if (strpos($row_layout, 'Seven') !== false) $max_columns = 7;
                                                    else if (strpos($row_layout, 'Eight') !== false) $max_columns = 8;
                                                    else if (strpos($row_layout, 'Nine') !== false) $max_columns = 9;
                                                    else if (strpos($row_layout, 'Ten') !== false) $max_columns = 10;
                                                    else if (strpos($row_layout, 'Eleven') !== false) $max_columns = 11;
                                                    else if (strpos($row_layout, 'Twelve') !== false) $max_columns = 12;
                                                    else if (strpos($row_layout, 'Thirteen') !== false) $max_columns = 13;
                                                    else if (strpos($row_layout, 'Fourteen') !== false) $max_columns = 14;
                                                    else if (strpos($row_layout, 'Fifteen') !== false) $max_columns = 15;
                                                    else if (strpos($row_layout, 'Sixteen') !== false) $max_columns = 16;
                                                    else if (strpos($row_layout, 'Seventeen') !== false) $max_columns = 17;
                                                    else if (strpos($row_layout, 'Eighteen') !== false) $max_columns = 18;
                                                    else if (strpos($row_layout, 'Nineteen') !== false) $max_columns = 19;
                                                    
                                                    for ($i = 1; $i <= $max_columns; $i++) {
                                                        $value = get_sub_field('column_' . $i);
                                                        if ($value && $first_row) {
                                                            echo '<th class="text-center">' . esc_html($value) . '</th>';
                                                        }
                                                    }
                                                    $first_row = false;
                                                    break;
                                                endwhile;
                                                reset_rows();
                                                ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $first_row = true;
                                            while (have_rows('row')):
                                                the_row();
                                                $row_layout = get_row_layout();
                                                $max_columns = 3; // Default for Table_with_Three_Columns
                                                if (strpos($row_layout, 'Four') !== false) $max_columns = 4;
                                                else if (strpos($row_layout, 'Five') !== false) $max_columns = 5;
                                                else if (strpos($row_layout, 'Six') !== false) $max_columns = 6;
                                                else if (strpos($row_layout, 'Seven') !== false) $max_columns = 7;
                                                else if (strpos($row_layout, 'Eight') !== false) $max_columns = 8;
                                                else if (strpos($row_layout, 'Nine') !== false) $max_columns = 9;
                                                else if (strpos($row_layout, 'Ten') !== false) $max_columns = 10;
                                                else if (strpos($row_layout, 'Eleven') !== false) $max_columns = 11;
                                                else if (strpos($row_layout, 'Twelve') !== false) $max_columns = 12;
                                                else if (strpos($row_layout, 'Thirteen') !== false) $max_columns = 13;
                                                else if (strpos($row_layout, 'Fourteen') !== false) $max_columns = 14;
                                                else if (strpos($row_layout, 'Fifteen') !== false) $max_columns = 15;
                                                else if (strpos($row_layout, 'Sixteen') !== false) $max_columns = 16;
                                                else if (strpos($row_layout, 'Seventeen') !== false) $max_columns = 17;
                                                else if (strpos($row_layout, 'Eighteen') !== false) $max_columns = 18;
                                                else if (strpos($row_layout, 'Nineteen') !== false) $max_columns = 19;
                                                
                                                if (!$first_row):
                                                    echo '<tr>';
                                                    for ($i = 1; $i <= $max_columns; $i++) {
                                                        $value = get_sub_field('column_' . $i);
                                                        if ($value) {
                                                            echo '<td class="text-center">' . esc_html($value) . '</td>';
                                                        } else {
                                                            echo '<td class="text-center">-</td>';
                                                        }
                                                    }
                                                    echo '</tr>';
                                                endif;
                                                $first_row = false;
                                            endwhile;
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

        <!-- Spacer if needed -->
        <div style="margin-bottom: 5rem;"></div>
       
        <?php
    }
}

get_footer();