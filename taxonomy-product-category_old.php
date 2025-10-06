<?php
get_header();
?>
    <!-- Header -->
    <section id="menu_list">
        <div class="container">
            <div class="row">
                <?php
                $queried = get_queried_object();
                $term_parent = $queried->parent;
                $tax = $queried->taxonomy;
                if (function_exists('category_breadcrumbs'))
                    category_breadcrumbs("product-category");
                $category_image = get_field('category_image', $queried);
                ?>
            </div>
        </div>
    </section>
    <section id="marine">
        <div class="container">
            <div class="row">
                <?php if ($category_image) { ?>
                    <div class="col-lg-6">
                        <div class="img_hous d-flex">
                            <img src="<?php echo $category_image['url']; ?>" alt="">
                            <!--                            <div class="icn">-->
                            <!--                                <i class="fa-solid fa-upload"></i>-->
                            <!--                                <i class="fa-regular fa-heart"></i>-->
                            <!--                            </div>-->
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-6">
                    <div class="marine_div">
                        <?php
                        $current_term = single_term_title("", false);
                        $sku = get_field('sku', $queried);
                        $sizes = get_field('sizes', $queried);
                        $description = get_field('description', $queried);
                        $category_description_for_seo = get_field('category_description_for_seo', $queried);
                        if ($current_term) {
                            echo '<h2>' . $current_term . '</h2>';
                        }
                        if ($sku) {
                            echo '<h3>' . $sku . '</h3>';
                        }
                        if ($sizes) {
                            echo '<h5>Sizes: ' . $sizes . '</h5>';
                        }
                        if ($description) {
                            echo '<h4>Description:</h4>';
                            echo '<p>' . $description . '</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <p><?php echo $category_description_for_seo; ?></p>
        <!-- <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3"><input class="cat_spn" type="text" id="tax-sku-search" placeholder="SKU Search" data-tax="<?php echo $tax; ?>"></div>
  </div> -->
    </div>
    <section id="pc_detail">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $pn_number = get_field('pn_number');
                $sku = get_field('sku');
                $mil_number = get_field('mil_number');
                $aeroquip_product = get_field('aeroquip_product');
                $aeroquip_post_type = '';
                $aeroquip_id = null;
                if ($aeroquip_product && is_object($aeroquip_product)) {
                    global $aeroquip_id;
                    $aeroquip_post_type = $aeroquip_product->post_type;
                    $aeroquip_id = $aeroquip_product->ID;
                }
                //                 print_r($aeroquip_post_type);
                $following_hose = get_field('following_hose');
                $following_hose_second = get_field('following_hose_second');
                $hose_to_flange_heading = get_field('hose_to_flange_heading');
                $hose_to_flange = get_field('hose_to_flange');
                $types = get_field('types');
                $flange_per = get_field('flange_per');
                $images = get_field('images');
                $hydrasearch_products = get_field('products');
                $aeroquip_products = get_field('products', $aeroquip_id);
                $post_id = get_the_ID();
                $feature_image = get_the_post_thumbnail_url();
                $feature_permalink = get_permalink();
                $index = $wp_query->current_post;
                $class = '';
                if ($index === 0) {
                    $class = 'container-fluid p-0 postChild';
                } else {
                    $class = 'container-fluid p-0 postChild';
                }
                ?>
                <div class="<?php echo $class; ?>">

                    <div class="row p-5">
                        <div class="col-lg-6 set_pc">
                            <div class="pc_Img">
                                <img src="<?php echo $feature_image; ?>" alt="">
                            </div>
                            <div style="margin-left: 15%" class=" my-auto text-left">
                                <?php
                                if ($pn_number) {
                                    echo '<p>Equals to ' . $pn_number . '</p>';
                                }

                                echo '<p>';
                                categories_list($post_id);
                                echo '</p>';
                                if ($mil_number) {
                                    echo '<h6>' . $mil_number . '</h6>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text_pc">
                                <?php
                                if ($following_hose) {
                                    echo '<p><strong>Use with the following hose:</strong>' . $following_hose . '</p>';
                                }
                                if ($types) {
                                    echo '<p>' . $types . ' <span> ';
                                }
                                if ($flange_per) {
                                    echo $flange_per . '</span></p>';
                                }
                                ?>
                                <div class="req-info-wrapper">
                                    <button class="req-info-btn" product-id="<?php echo $post_id; ?>">Request
                                        Information
                                        <div class="loader-spin"></div>
                                    </button>
                                    <div class="tab-container">
                                    <span class="tab-navigation">
                                        <select id="select-box" class="select-box">
                                            <option value="0-<?php echo $post_id; ?>" post-id="<?php echo $post_id; ?>"
                                                    selected>View Details
                                                &nbsp; &#10095;</option>
                                            <option class="d-none" value="1-<?php echo $post_id; ?>" post-id="<?php echo $post_id; ?>">
                                                &#128065; &nbsp;
                                                Hydrasearch</option>
                                            <option class="d-none" value="2-<?php echo $post_id; ?>"
                                                    post-id="<?php echo $aeroquip_id; ?>">
                                                &#128065; &nbsp;
                                                Aeroquip</option>
                                            <option  value="3-<?php echo $post_id; ?>" post-id="<?php echo $post_id; ?>">
                                                &#128065; &nbsp; Compare
                                            </option>
                                        </select>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div id="tab-0-<?php echo $post_id; ?>" class="tab-content">
                    </div>
                    <div id="tab-1-<?php echo $post_id; ?>" class="tab-content">
                        <table>
                            <?php get_template_part('template-parts/tables/hydrasearch', 'table_header'); ?>
                            <?php
                            if ($hydrasearch_products) {
                                foreach ($hydrasearch_products as $hydrasearch_product) {
                                    if ($hydrasearch_product) {
                                        global $hydrasearch_product_id;
                                        $hydrasearch_product_id = $hydrasearch_product->ID;
                                    }
                                    get_template_part('template-parts/tables/hydrasearch', 'table_row');
                                }
                            }
                            ?>
                        </table>
                         <select name="See Components" id="components-postID" class="select-box-components">
                            <option value="SeeAll" selected>See Components</option>
							 <option value="components-<?php echo $post_id; ?>">Components</option>
							
                        </select> 

                        <div id="tab-components-<?php echo $post_id; ?>" class="components tab-content">
                            <?php if (have_rows('components_table')): ?>
                                <?php while (have_rows('components_table')): the_row(); ?>
                                    <?php if (have_rows('row')): ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <?php
                                                $first_row = true;
                                                while (have_rows('row')): the_row();
                                                    echo '<tr>';
                                                    for ($i = 1; $i <= 19; $i++) {
                                                        $value = get_sub_field('column_' . $i);
                                                        if ($value) {
                                                            if ($first_row) {
                                                                echo '<td class="text-center"><strong>' . esc_html($value) . '</strong></td>';
                                                            } else {
                                                                echo '<td class="text-center">' . esc_html($value) . '</td>';
                                                            }
                                                        }
                                                    }
                                                    echo '</tr>';
                                                    $first_row = false;
                                                endwhile;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="tab-2-<?php echo $post_id; ?>" class="tab-content">
                        <table class="mt-3">
                            <?php get_template_part('template-parts/tables/aeroquip', 'table_header'); ?>
                            <?php
                            if (!empty($aeroquip_products) && is_array($aeroquip_products)) {
                                foreach ($aeroquip_products as $aeroquip_product) {
                                    if ($aeroquip_product && is_object($aeroquip_product)) {
                                        global $aeroquip_product_id;
                                        $aeroquip_product_id = $aeroquip_product->ID;
                                        get_template_part('template-parts/tables/aeroquip', 'table_row');
                                    }
                                }
                            }
                            ?>
                        </table>
                        <select name="See Components" id="Tab09" class="select-box-components">
                            <option value="SeeAll" selected>See Components</option>
							<option value="components-<?php echo $aeroquip_id; ?>" >Components</option>
							
                        </select>
                        <div id="tab-components-<?php echo $aeroquip_id; ?>" class="components tab-content">
                            <?php if (have_rows('components_table', $aeroquip_id)): ?>
                                <?php while (have_rows('components_table', $aeroquip_id)): the_row(); ?>
                                    <?php if (have_rows('row')): ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <?php
                                                $first_row = true;
                                                while (have_rows('row')): the_row();
                                                    echo '<tr>';
                                                    for ($i = 1; $i <= 19; $i++) {
                                                        $value = get_sub_field('column_' . $i);
                                                        if ($value) {
                                                            if ($first_row) {
                                                                echo '<td class="text-center"><strong>' . esc_html($value) . '</strong></td>';
                                                            } else {
                                                                echo '<td class="text-center">' . esc_html($value) . '</td>';
                                                            }
                                                        }
                                                    }
                                                    echo '</tr>';
                                                    $first_row = false;
                                                endwhile;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="tab-3-<?php echo $post_id; ?>" class="tab-content compare">
                        <div class="row">
                            <div id="makeme100" class="col-12 ">
                           <img class="svg-logo " src="<?php echo get_template_directory_uri() . '/assets/images/hydrasearch-logo.svg'; ?>" alt="hydrasearch-logo">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                if ($sku) {
                                                    echo '<h3 class="familyName">' . $sku . '</h3>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-8 d-flex flex-wrap align-content-center">

                                                <?php
                                                if ($aeroquip_post_type === 'aeroquip') {
                                                    if ($pn_number) {
                                                        echo '<div class="equalComparison"><h5>Equal to Aeroquip <span class="skus_compare">' . $pn_number . '</span></h5></div>';
                                                    }
                                                } else {
                                                    echo '';
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <?php
                                        if ($hose_to_flange_heading) {
                                            echo '<h2 class="productName">' . $hose_to_flange_heading . '</h2>';
                                        }
                                        if ($hose_to_flange) {
                                            echo '<h5 class="Description">' . $hose_to_flange . '</h5>';
                                        }
                                        if ($mil_number) {
                                            echo '<h3 class="skus_compar">' . $mil_number . ',</h3>';
                                        }
                                        if ($types) {
                                            echo '<h4 class="group">' . $types . '</h4>';
                                        }
                                        if ($flange_per) {
                                            echo '<h4 class="group-detail">' . $flange_per . '</h4>';
                                        }
                                        if ($following_hose) {
                                            echo '<h4 class="relatedFamilies"><strong>For use with the following hose:</strong>' . $following_hose . '</h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php if ($feature_image) { ?>
                                        <img src="<?php echo $feature_image; ?>" alt="plug">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row" >
                                    <?php
                                    if (!empty($images)) {
                                        foreach ($images as $image) {
                                            echo '<div class="col-md-4"><img src="' . $image['image']['url'] . '" alt="plug"></div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <table class="table table-responsive">
                                    <?php get_template_part('template-parts/tables/hydrasearch', 'table_header'); ?>
                                    <?php
                                    if ($hydrasearch_products) {
                                        foreach ($hydrasearch_products as $hydrasearch_product) {
                                            if ($hydrasearch_product) {
                                                global $hydrasearch_product_id;
                                                $hydrasearch_product_id = $hydrasearch_product->ID;
                                            }
                                            get_template_part('template-parts/tables/hydrasearch', 'table_row');
                                        }
                                    }
                                    ?>
                                </table>
                                <select name="SeeAll" id="Tab09">
                                    <!--                <option value="SeeAll" selected>See All</option>-->
                                    <option value="Components">Components</option>
                                </select>

                                <?php if (have_rows('components_table')): ?>
                                    <?php while (have_rows('components_table')): the_row(); ?>
                                        <?php if (have_rows('row')): ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <?php
                                                    $first_row = true;
                                                    while (have_rows('row')): the_row();
                                                        echo '<tr>';
                                                        for ($i = 1; $i <= 19; $i++) {
                                                            $value = get_sub_field('column_' . $i);
                                                            if ($value) {
                                                                if ($first_row) {
                                                                    echo '<td class="text-center"><strong>' . esc_html($value) . '</strong></td>';
                                                                } else {
                                                                    echo '<td class="text-center">' . esc_html($value) . '</td>';
                                                                }
                                                            }
                                                        }
                                                        echo '</tr>';
                                                        $first_row = false;
                                                    endwhile;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
<?php
get_footer();