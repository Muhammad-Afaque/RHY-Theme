<?php
/*
 * Template Name: Home Page
 *
 */
get_header(); ?>
<section id="hero_section" style="background-color: #00254D; position: relative; overflow: hidden;">
  <video id="videobcg_hero"
         playsinline
         autoplay
         muted
         loop
         preload="auto"
         poster="/wp-content/uploads/2025/08/Group-268.webp"
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">

    <source src="/wp-content/uploads/2025/08/hydrasearch_recreational_optmized.webm" type="video/webm">
    <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hydrasearch_recreational_optmized.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="container-fluid" style="position: relative; z-index: 1;">
    <div class="row justify-content-center">
      <div class="col-md-9 text-center text-white">
        <h1>Specializing in Manufacturing</h1>
        <p>Innovative solutions for ice management, weed control,<br>and stunning water features for your waterways</p>
        <a class="CTAHomePage" href="#">Read More</a>
      </div>
    </div>

    <div class="container">
      <div class="social_media_icons">
        <ul>
          <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/insta.svg" alt="Instagram" loading="lazy"></a></li>
          <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/facebook.svg" alt="Facebook" loading="lazy"></a></li>
          <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/twitterX.svg" alt="Twitter" loading="lazy"></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="ClientsWeWorkWith">
    <div class="container-small">
        <div class="row">
            <div style="display: flex;justify-content: center;">
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/weedAway.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>PROMAR</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/IceEater.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>ICE EATER</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <!--<div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/weedAway.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>PROMAR</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/IceEater.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>ICE EATER</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div> -->



            </div>
        </div>
    </div>
</section>
<section id="ClientsWeWorkWithMobile">
    <div class="container-small">
        <div class="row">
            <div  id="logoslider" >
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/weedAway.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>PROMAR</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/IceEater.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>ICE EATER</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/weedAway.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/buckAlgonquin.svg"
                        alt="" class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arcticSteel.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>WEEDS WAY</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/proMar.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>PROMAR</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>

                <div class="slide">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/IceEater.svg" alt=""
                        class="logo">
                    <div class="onImageHover">
                        <h4>ICE EATER</h4>
                        <a href="#" class="Visit">Visit Site</a>
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>
<section id="CaseStudies">
    <div class="container-fluid">
        <div class="row">
            <div class="case_study_slider">
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_1.png);">
                    <div class="onImageHover">
                        <h4>Innovative Sea Water Strainers & Marine Accessories</h4>
                        <a href="#" class="Visit">See our efforts</a>
                    </div>
                </div>

                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_2.png);">
                    <!-- <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_2.png"
                        alt="" class="logo"> -->
                    <div class="onImageHover">
                        <h4>Quality Aquatic Equipment for a Healthier, More Vibrant Environment</h4>
                        <a href="#" class="Visit">See our efforts</a>
                    </div>
                </div>
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_3.png);">
                    <div class="onImageHover">
                        <h4>Innovative Sea Water Strainers & Marine Accessories</h4>
                        <a href="#" class="Visit">See our efforts</a>
                    </div>
                </div>
                <div class="slide"
                    style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/case_study_4.png);">
                    <div class="onImageHover">
                        <h4>Quality Aquatic Equipment for a Healthier, More Vibrant Environment</h4>
                        <a href="#" class="Visit">See our efforts</a>
                    </div>
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
</section>
<section id="weedManagement">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="bgImgWithHoverAnimation"
                    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/weedFarm.png')">
                    <div id="overlay"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="pristine_column">
                    <div class="heading">Weed Management for Pristine Waterways</div>
                    <p>Advanced aquatic solutions for effective weed control, enhancing water quality and aesthetics</p>
                    <a href="#">

                        Read More

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="achievement">
    <div class="container">
        <div class="row achievementParent">
            <div class="col-md-3 col-sm-12">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/MissionFocusedcopy.png"
                    alt="">
            </div>
            <div class="col-md-3 col-sm-12">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Defense_Grade.png" alt="">
            </div>
            <div class="col-md-3 col-sm-12">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/QualityAssurance.png"
                    alt="">
            </div>
            <div class="col-md-3 col-sm-12">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/InnovativeEngineering.png"
                    alt="">
            </div>
        </div>
    </div>
</section>
<section id="postListin">
    <div class="container-fluid p-0">
        <div class="row ">
            <div class="col-md-6 p-0 ">
                <div class="colum-post">
                    <div class="card mb-3" >
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/post1.png"
                                    class="" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">October 14, 2023</small>
                                    </p>
                                    <h5 class="card-title">Elevate your projects with our trusted expertise and
                                        cutting-edge solutions.</h5>
                                    <a href="#!">Join With Us</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" >
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/post1.png"
                                    class="" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">October 14, 2023</small>
                                    </p>
                                    <h5 class="card-title">Elevate your projects with our trusted expertise and
                                        cutting-edge solutions.</h5>
                                    <a href="#!">Join With Us</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" >
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/post1.png"
                                    class="" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">October 14, 2023</small>
                                    </p>
                                    <h5 class="card-title">Elevate your projects with our trusted expertise and
                                        cutting-edge solutions.</h5>
                                    <a href="#!">Join With Us</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="featured_post">
                    <div class="card mb-3">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/post_img_featured.png"
                            class="img-fluid" alt="...">
                        <div class="card-body">
                            <div class="content">
                                <h5 class="card-title">Drive Success with Hydrasearch’s Proven Solutions</h5>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
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
<section id="JoinForces">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2>Lead the Way in Aquatic Engineering and Innovation.</h2>
                <p>Join forces with Hydrasearch and elevate your projects with our trusted expertise and cutting-edge
                    solutions. Let's achieve excellence together.</p>
                <a href="#">Contact us</a>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 d-flex flex-column justify-content-between align-items-center p-0">
                        <div class="item">
                            <a href="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250&w=250"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250&w=250"
                                    alt="Mountain reflection on lake"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/302804/pexels-photo-302804.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/302804/pexels-photo-302804.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="sun coming through trees"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/4827/nature-forest-trees-fog.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/4827/nature-forest-trees-fog.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="fog rolling over pine trees"></a>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-between align-items-center p-sm-0">
                        <div class="item">
                            <a href="https://images.pexels.com/photos/206673/pexels-photo-206673.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/206673/pexels-photo-206673.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="country house in the woods"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/206673/pexels-photo-206673.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/206673/pexels-photo-206673.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="country house in the woods"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/443446/pexels-photo-443446.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/443446/pexels-photo-443446.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="lake view between two trees with mountain in the background"></a>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex flex-column justify-content-between align-items-center p-0">
                        <div class="item">
                            <a href="https://images.pexels.com/photos/38136/pexels-photo-38136.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/38136/pexels-photo-38136.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="forest with a focus on an old oak tree"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/414171/pexels-photo-414171.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/414171/pexels-photo-414171.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="lake in a valley"></a>
                        </div>
                        <div class="item">
                            <a href="https://images.pexels.com/photos/129105/pexels-photo-129105.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                data-fancybox="gallery"><img
                                    src="https://images.pexels.com/photos/129105/pexels-photo-129105.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    alt="tree top view looking out over forest"></a>
                        </div>
                    </div>
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
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/AS9100D.png">
                <div class="cardCertHover">
                    <a href="#!">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-right-up.svg">
                        Explore
                    </a>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 certColumn">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rina.png">
                <div class="cardCertHover">
                    <a href="#!">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-right-up.svg">
                        Explore
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<section id="OurProduct"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/OurProduct.png');">
    <div class="container">
        <div class="row">
            <h2>Our Products</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="product">
                    <div class="box">
                        <div class="product_info"
                            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featuredImgProduct.png');">
                            <div class="inner_text">
                                <h3 class="product_title">ICE EATER</h3>
                                <p class="product_category">P1000/50</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner_hover_box"
                        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/inner_hover_box_1.png');">
                        <div class="slide-in-bottom">
                            <a href="#" class="Visit">Buy now</a>
                        </div>

                    </div>
                    <span class="dot">

                    </span>
                </div>
                <div class="product">
                    <div class="box">
                        <div class="product_info"
                            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featuredImgProduct.png');">
                            <div class="inner_text">
                                <h3 class="product_title">ICE EATER</h3>
                                <p class="product_category">P1000/50</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner_hover_box"
                        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/inner_hover_box_1.png');">
                        <div class="slide-in-bottom">
                            <a href="#" class="Visit">Buy now</a>
                        </div>

                    </div>
                    <span class="dot">

                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product">
                    <div class="box">
                        <div class="product_info_tall"
                            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featuredImgProduct.png');">
                            <div class="inner_text">
                                <h3 class="product_title">ICE EATER</h3>
                                <p class="product_category">P1000/50</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner_hover_box"
                        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/inner_hover_box_1.png');">
                        <div class="slide-in-bottom">
                            <a href="#" class="Visit">Buy now</a>
                        </div>

                    </div>
                    <span class="dot">

                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product">
                    <div class="box">
                        <div class="product_info"
                            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featuredImgProduct.png');">
                            <div class="inner_text">
                                <h3 class="product_title">ICE EATER</h3>
                                <p class="product_category">P1000/50</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner_hover_box"
                        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/inner_hover_box_1.png');">
                        <div class="slide-in-bottom">
                            <a href="#" class="Visit">Buy now</a>
                        </div>

                    </div>
                    <span class="dot">

                    </span>
                </div>
                <div class="product">
                    <div class="box">
                        <div class="product_info"
                            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featuredImgProduct.png');">
                            <div class="inner_text">
                                <h3 class="product_title">ICE EATER</h3>
                                <p class="product_category">P1000/50</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner_hover_box"
                        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/inner_hover_box_1.png');">
                        <div class="slide-in-bottom">
                            <a href="#" class="Visit">Buy now</a>
                        </div>

                    </div>
                    <span class="dot">

                    </span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <a class="Visit_Store" href="#">Visit Store</a>
        </div>
    </div>

</section>
	
	<script>
  document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('videobcg_hero');
    if (window.innerWidth < 768 && video) {
      video.remove();
      return;
    }
    if (video) {
      video.addEventListener('canplay', function () {
        video.play();
      });
    }
  });
</script>



<?php
get_footer(); ?>