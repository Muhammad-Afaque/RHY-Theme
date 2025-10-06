<?php
/*
 * Template Name: Front Home Page
 */
get_header(); ?>

<section id="hero_section" style="background-color: #00254D; position: relative; overflow: hidden;">
  <video id="videobcg_hero"
         playsinline
         autoplay
         muted
         loop
         preload="auto"
         poster="https://recreational.hydrasearch.com/wp-content/uploads/2025/08/Group-268.webp"
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 0;">

    <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydrasearch_recreational_optmized.mp4" type="video/webm">
    <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydrasearch_recreational_optmized.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="container-fluid" style="position: relative; z-index: 1;">
    <div class="row justify-content-center">
      <div class="col-md-9 text-center text-white">
        <h1>Specializing in Manufacturing</h1>
        <p>Above or Below the Waterline – We’ve Got the Hardware That Keeps Boats Going.
</p>
        <a class="CTAHomePage" href="https://hydrasearch.com/about-us/">Read More</a>
      </div>
    </div>

    <div class="container">
      <div class="social_media_icons">
  <ul>
          <li><a href="https://www.facebook.com/hydrasearchcompanyllc"
       target="_blank"
       rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta.svg" alt=""></a></li>
          <li><a href="https://x.com/HydraSearch"
       target="_blank"
       rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt=""></a></li>
          <li><a href="https://www.youtube.com/channel/UCMCpH9qxCyODKT2AO2aO7aQ/featured"
       target="_blank"
       rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitterX.svg" alt=""></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="ClientsWeWorkWith" > 
    <div class="container-small">
        <div class="row">
            <div id="logoslider" style="display: flex;justify-content: center;">
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">

                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">

                </div>
            </div>
        </div>
    </div>
</section>
<section id="ClientsWeWorkWithMobile" >
    <div class="container-small">
        <div class="row">
            <div  id="logoslider_mobile" >
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="certification" class="d-none">
    <div class="container">
        <div class="row">
            <h2>Our Brands</h2>
        </div>
        <div class="row d-flex justify-content-center ">
            <div class="col-md-2 certColumn">
                <img src="https://recreational.hydrasearch.com/wp-content/themes/defense/assets/images/buckAlgonquin.svg">
                <!-- <div class="cardCertHover">
                    <a href="https://recreational.hydrasearch.com/wp-content/uploads/2025/08/Hydrasearch-17760603-Final-Certificate_11-20-23.pdf">
                        <img src="https://recreational.hydrasearch.com/wp-content/themes/defense/assets/images/arrow-right-up.svg">
                        Explore
                    </a>
                </div> -->
            </div>

            <div class="col-md-2 certColumn">
                <img src="https://recreational.hydrasearch.com/wp-content/themes/defense/assets/images/arcticSteel.svg">

            </div>
            <div class="col-md-2 certColumn">
                <img src="https://recreational.hydrasearch.com/wp-content/themes/defense/assets/images/proMar.svg">
            </div>
        </div>
    </div>
</section>



<section id="CaseStudies" class="d-none">
    <div class="container-fluid">
        <div class="row">
            <div class="case_study_slider">
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_1.png);">
                    <div class="onImageHover">
                        <h4>Innovative Sea Water Strainers & Marine Accessories</h4>
                        <a href="https://hydrasearch.com/about-us/" class="Visit">See our efforts</a>
                    </div>
                </div>

                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_2.png);">
                    <!-- <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_2.png"
                        alt="" class="logo"> -->
                    <div class="onImageHover">
                        <h4>Quality Aquatic Equipment for a Healthier, More Vibrant Environment</h4>
                        <a href="https://hydrasearch.com/about-us/" class="Visit">See our efforts</a>
                    </div>
                </div>
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_3.png);">
                    <div class="onImageHover">
                        <h4>Innovative Sea Water Strainers & Marine Accessories</h4>
                        <a href="https://hydrasearch.com/about-us/" class="Visit">See our efforts</a>
                    </div>
                </div>
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_4.png);">
                    <div class="onImageHover">
                        <h4>Quality Aquatic Equipment for a Healthier, More Vibrant Environment</h4>
                        <a href="https://hydrasearch.com/about-us/" class="Visit">See our efforts</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section id="OurMission">
    <div class="container">
        <div class="row">
            <h2>
                Why Hydrasearch?
            </h2>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="cardSvg">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/trust.svg" alt="">
                    <h4>Trust</h4>
                    <p>
                        Quality and service you can trust
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardSvg">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/deal.svg" alt="">
                    <h4>Commitment</h4>
                    <p>
                        Your mission is our commitment
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardSvg">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/partnership.svg"
                        alt="">
                    <h4>Partnership</h4>
                    <p>
                        Building relationships for mutual growth
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardSvg">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/USAMap.svg" alt="">
                    <h4>USA Manufacturer</h4>
                    <p>
                        Proud US Manufacturer
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="marquee">
    <div class="marqueeParent">
        <div class="marquee">
            <div>
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Hydrasearch</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />
                <span>Your Mission is Our Commitment</span>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydravector.svg" />

			</div>
		</div>
        </div>
</section>




<section id="OurProduct"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/OurProduct.png');">
    
    <div class="container">
        <div class="row">
            <div class="product_title">
                <h2>Our Products</h2>
            </div>

            <div class="product-section">
                <div class="product-slider">
                    <?php
                    $args = [
                        'post_type'      => 'product',
                        'posts_per_page' => 8,
                        'orderby'        => ['menu_order' => 'ASC', 'date' => 'DESC'],
                        'order'          => 'DESC',
                    ];

                    $product_query = new WP_Query($args);

                    if ($product_query->have_posts()):
                        while ($product_query->have_posts()): $product_query->the_post();
                    ?>
                        <div class="product-card">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full', ['alt' => get_the_title()]);
                                } else {
                                    echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/placeholder.png') . '" alt="Placeholder Image">';
                                }
                                ?>
                            </a>

                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <a href="<?php the_permalink(); ?>" class="btn">View More</a>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                    ?>
                        <div class="product-card">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/wholeis1.png'); ?>" alt="Product Not Found">
                            <h5>No Products Found</h5>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="dex_btn">
                    <a href="https://recreational.hydrasearch.com/collection/commercial-recreational/">Discover More</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="certification">
    <div class="container">
        <div class="row">
            <h2>Certifications</h2>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-2 certColumn">
                <img src="https://recreational.hydrasearch.com/wp-content/themes/defense/assets/images/ISO%209001%20logo%20Red-Gray.png" alt="ISO">
                <div class="cardCertHover">
                    <a href="https://recreational.hydrasearch.com/wp-content/uploads/2025/08/Hydrasearch-17760603-Final-Certificate_11-20-23.pdf">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-right-up.svg" alt="Explore">
                        Explore
                    </a>
                </div>
            </div>
			<div class="col-md-1"></div>
			<div class="col-md-2 certColumn">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/AS9100D.png" alt="AS9100D Certification">
                <div class="cardCertHover">
                    <a href="https://recreational.hydrasearch.com/wp-content/uploads/2025/08/Hydrasearch-17760603-Final-Certificate_11-20-23.pdf">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-right-up.svg" alt="Explore">
                        Explore
                    </a>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 certColumn">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rina.png" alt="RINA Certification">
                <div class="cardCertHover">
                    <a href="https://recreational.hydrasearch.com/wp-content/uploads/2025/08/Hydrasearch_Company_LLC_-_RINA_Certification.pdf">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-right-up.svg" alt="Explore">
                        Explore
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>

