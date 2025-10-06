<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defense
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main>
    <header id="masthead" class="site-header">
        <div class="fullBG">
            <div class="container">
                <div class="row justify-content-between">

                    <div class="mobile_data_parent row align-items-center">
                        <div class="mobile_data col-md-4 d-flex flex-row align-items-center ">
                            <a href="tel:410.643.8900"><i class="fa-solid fa-phone"></i>410.643.8900</a>&nbsp;
                            &nbsp;&nbsp;
                            <a href="mailto:recreational@hydrasearch.com">
								<i class="fa fa-envelope"aria-hidden="true"></i>recreational@hydrasearch.com</a>
                        </div>

                        <!-- Right Side - User Area -->
                        <div class="col-md-8" id="distributorMenu">
                            <?php $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                            <div class="header-user-section">
                                <!-- Search Form (Visible to all users) -->
                                <form role="search" method="get" action="">
                                    <div class="search-form-container">
                                        <div class="search-form-wrapper" style="position: relative;">
                                            <input type="search" id="site-search-input" name="s"
                                                   placeholder="Search here..." value="" class="search-field"
                                                   autocomplete="off" required>
                                        </div>
                                        <button type="submit" class="search-submit">
                                            <span>Search</span>
                                        </button>
                                        <div id="live-search-results" class="lso-dropdown"></div>
                                    </div>
                                </form>

                                <?php if (is_user_logged_in()):
                                    $current_user = wp_get_current_user();
                                    $customer_id = hydra_get_customer_id($current_user->ID);
                                    $cart_count = WC()->cart->get_cart_contents_count();
                                    ?>
                                    <!-- Apps Grid -->
                                    <div class="apps-menu d-flex flex-row align-items-center">
                                        <button type="button"
                                                class="apps-toggle"
                                                onclick="toggleApps()"
                                                data-bs-toggle="popover"
                                                data-bs-placement="right"
                                                data-bs-trigger="hover"
                                                data-bs-content="Settings">
                                            <i class="fa fa-gear"></i>
                                        </button>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                                                popoverTriggerList.forEach(function (popoverTriggerEl) {
                                                    new bootstrap.Popover(popoverTriggerEl);
                                                });
                                            });
                                        </script>

                                        <div class="apps-dropdown" id="appsDropdown">
                                            <a href="<?php echo wc_get_page_permalink("myaccount"); ?>">My Profile</a>
                                            <a href="<?php echo wc_get_account_endpoint_url("edit-account"); ?>">Edit
                                                Profile</a>
                                            <a href="<?php echo wc_get_account_endpoint_url("orders"); ?>">Order
                                                History</a>
                                            <a href="<?php echo wc_get_cart_url(); ?>">Shopping Cart</a>
                                            <a href="<?php echo home_url("/support"); ?>">Support</a>
                                        </div>
                                    </div>

                                    <!-- User Info -->
                                    <div class="user-info">
                                        <span class="customer-id">
											<?php echo esc_html($current_user->first_name); ?>
										</span>
										<span class="user-role">
											<?php echo esc_html(ucfirst($current_user->roles[0])); ?>
										</span>
                                    </div>

                                    <!-- User Avatar -->
                                    <div class="user-avatar">
                                        <button onclick="toggleUserMenu()">
                                            <?php echo get_avatar($current_user->ID, 32); ?>
                                        </button>
                                        <div class="user-menu" id="userMenu">
                                            <div class="user-info-header">
                                                <strong><?php echo $current_user->display_name; ?></strong>
                                                <span><?php echo $customer_id; ?></span>
                                            </div>
                                            <a href="<?php echo wc_get_page_permalink("myaccount"); ?>">Dashboard</a>
                                            <a href="<?php echo wc_get_account_endpoint_url("edit-account"); ?>">Settings</a>
                                            <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
                                        </div>
                                    </div>

                                <?php else: ?>
                                    <!-- Guest Actions -->
                                    <div class="guest-actions d-flex align-items-center">
                                        <a href="<?php echo wc_get_page_permalink("myaccount"); ?>" class="login-btn">
                                            <i class="fa fa-sign-in"></i> Login
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div> <!-- /.header-user-section -->
                        </div> <!-- /.col-md-8 -->
                    </div>

                </div>
            </div>
        </div>

        <?php
        function generate_commercial_mega_menu()
        {
            $parent_term = get_term_by("slug", "commercial-recreational", "collection");
            if (!$parent_term || is_wp_error($parent_term)) {
                return "";
            }

            $child_terms = get_terms([
                "taxonomy" => "collection",
                "parent" => $parent_term->term_id,
                "hide_empty" => true,
            ]);
            if (empty($child_terms)) {
                return "";
            }

            $term_chunks = array_chunk($child_terms, 12);
            ob_start(); ?>

            <li class="mega-drop-down">
                <a href="<?php echo esc_url(get_term_link($parent_term)); ?>">
                    <?php echo esc_html($parent_term->name); ?>
                    <i class="fa-solid fa-chevron-down"></i>
                </a>
                <div class="mega-menu">
                    <div class="mega-menu-wrap">
                        <div class="mega-slider-container">
                            <div class="mega-pagination-track">
                                <?php foreach ($term_chunks as $i => $chunk): ?>
                                    <div class="mega-menu-page"
                                         data-page="<?php echo $i; ?>"<?php echo $i === 0 ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                        <div class="category-grid">
                                            <?php foreach ($chunk as $term):
                                                $acf = get_fields("term_" . $term->term_id);
                                                $icon = !empty($acf["thumbnail_for_category"]) ? esc_url($acf["thumbnail_for_category"]) : "https://recreational.hydrasearch.com/wp-content/uploads/2025/04/directions_boat.webp";
                                                ?>
                                                <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                                   class="menu-card">
                                                    <img src="<?php echo $icon; ?>"
                                                         alt="<?php echo esc_attr($term->name); ?>">
                                                    <h4><?php echo esc_html($term->name); ?></h4>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Navigation buttons -->
                            <div class="mega-pagination-nav">
                                <button id="megaPrevBtn" disabled>Previous</button>
                                <button id="megaNextBtn" <?php echo count($term_chunks) <= 1 ? "disabled" : ""; ?>>
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php return ob_get_clean();
        } ?>

        <div id="codepen_mega_menu" class="container sticky-top">
            <div class="content">
                    <span style="padding-right: 4.813em;">
                        <?php echo the_custom_logo(); ?>
                    </span>

                    <button class="btn btn-primary d-block d-md-none" type="button" data-bs-toggle="modal"
                            data-bs-target="#mobileMenuModal" aria-label="Open Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="exo-menu">
						<li><a href="https://hydrasearch.com">Home</a></li>
                        <?php echo generate_commercial_mega_menu(); ?>


                        <!-- I know this isn't the cleanest implementation — please forgive the chaos. 
                           - Afaque   - Chachu yeah bat to galat hay-->
                        <!-- ///////////////////////////////////// -->
						

                        <li class="mega-drop-down">
                            <a href="https://defense.hydrasearch.com/">
                                Defense<i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <div class="mega-menu" style="width: 70%;left: 60px;">
                                <div class="mega-menu-wrap-1"
                                     style="background: #fff;margin-top: 0.7rem;border-radius: 25px;">
                                    <div class="mega-slider-container-1">
                                        <div class="mega-menu-page-1" style="display: block;">
                                            <div class="category-grid" style="grid-template-columns: repeat(2, 1fr);">
                                                <a class="menu-card"
                                                   href="https://defense.hydrasearch.com/collection/defense/marine-hose-fittings/">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="23"
                                                         viewBox="0 0 20 23" fill="none">
                                                        <path d="M1.95 18.2256L0.05 11.5256C0 11.3256 0.0208333 11.0923 0.1125 10.8256C0.204167 10.5589 0.4 10.3756 0.7 10.2756L2 9.82559V5.22559C2 4.67559 2.19583 4.20475 2.5875 3.81309C2.97917 3.42142 3.45 3.22559 4 3.22559H7V1.22559C7 0.942253 7.09583 0.704753 7.2875 0.513086C7.47917 0.321419 7.71667 0.225586 8 0.225586H12C12.2833 0.225586 12.5208 0.321419 12.7125 0.513086C12.9042 0.704753 13 0.942253 13 1.22559V3.22559H16C16.55 3.22559 17.0208 3.42142 17.4125 3.81309C17.8042 4.20475 18 4.67559 18 5.22559V9.82559L19.3 10.2756C19.65 10.4089 19.8583 10.6048 19.925 10.8631C19.9917 11.1214 20 11.3423 19.95 11.5256L18.05 18.2256C17.3833 18.2256 16.7667 18.0964 16.2 17.8381C15.6333 17.5798 15.1167 17.2506 14.65 16.8506C14.4667 16.6673 14.25 16.5756 14 16.5756C13.75 16.5756 13.5333 16.6673 13.35 16.8506C12.8833 17.2506 12.3667 17.5798 11.8 17.8381C11.2333 18.0964 10.6333 18.2256 10 18.2256C9.83333 18.2256 9.675 18.2173 9.525 18.2006C9.375 18.1839 9.225 18.1589 9.075 18.1256C8.59167 18.0256 8.13333 17.8506 7.7 17.6006C7.26667 17.3506 6.86667 17.0589 6.5 16.7256C6.36667 16.5923 6.19583 16.5256 5.9875 16.5256C5.77917 16.5256 5.60833 16.5923 5.475 16.7256C5.00833 17.1756 4.46667 17.5381 3.85 17.8131C3.23333 18.0881 2.6 18.2256 1.95 18.2256ZM10 22.2256C9.31667 22.2256 8.6375 22.1423 7.9625 21.9756C7.2875 21.8089 6.63333 21.5589 6 21.2256C5.36667 21.5589 4.71667 21.8089 4.05 21.9756C3.38333 22.1423 2.7 22.2256 2 22.2256H1C0.716667 22.2256 0.479167 22.1298 0.2875 21.9381C0.0958333 21.7464 0 21.5089 0 21.2256C0 20.9423 0.0958333 20.7048 0.2875 20.5131C0.479167 20.3214 0.716667 20.2256 1 20.2256H2C2.6 20.2256 3.2 20.1423 3.8 19.9756C4.4 19.8089 4.95833 19.5673 5.475 19.2506C5.64167 19.1506 5.81667 19.1006 6 19.1006C6.18333 19.1006 6.35833 19.1506 6.525 19.2506C6.89167 19.4839 7.3125 19.6756 7.7875 19.8256C8.2625 19.9756 8.71667 20.0756 9.15 20.1256C9.28333 20.1423 9.425 20.1548 9.575 20.1631C9.725 20.1714 9.86667 20.1756 10 20.1756C10.6 20.1756 11.2 20.1006 11.8 19.9506C12.4 19.8006 12.9583 19.5673 13.475 19.2506C13.6417 19.1506 13.8167 19.1006 14 19.1006C14.1833 19.1006 14.3583 19.1506 14.525 19.2506C15.0417 19.5839 15.6 19.8298 16.2 19.9881C16.8 20.1464 17.4 20.2256 18 20.2256H19C19.2833 20.2256 19.5208 20.3214 19.7125 20.5131C19.9042 20.7048 20 20.9423 20 21.2256C20 21.5089 19.9042 21.7464 19.7125 21.9381C19.5208 22.1298 19.2833 22.2256 19 22.2256H18C17.3 22.2256 16.6167 22.1423 15.95 21.9756C15.2833 21.8089 14.6333 21.5589 14 21.2256C13.3667 21.5589 12.7125 21.8089 12.0375 21.9756C11.3625 22.1423 10.6833 22.2256 10 22.2256ZM4 9.17559L9.375 7.42559C9.575 7.35892 9.78333 7.32559 10 7.32559C10.2167 7.32559 10.425 7.35892 10.625 7.42559L16 9.17559V5.22559H4V9.17559Z"
                                                              fill="#2B5677" style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">Marine Hose &amp; Fitting</h4>
                                                </a>
                                                <a class="menu-card"
                                                   href="https://defense.hydrasearch.com/collection/defense/underway-replenishment-products/">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                                                         viewBox="0 0 20 11" fill="none">
                                                        <path d="M3.325 10C2.84167 10 2.49167 10.1042 2.275 10.3125C2.05833 10.5208 1.75833 10.6667 1.375 10.75C0.991667 10.8333 0.666667 10.7958 0.4 10.6375C0.133333 10.4792 0 10.2417 0 9.925C0 9.675 0.108333 9.43333 0.325 9.2C0.541667 8.96667 0.883333 8.73333 1.35 8.5C1.43333 8.45 1.65417 8.35417 2.0125 8.2125C2.37083 8.07083 2.84167 8 3.425 8C4.34167 8 4.95833 8.16667 5.275 8.5C5.59167 8.83333 6.05833 9 6.675 9C7.29167 9 7.75417 8.83333 8.0625 8.5C8.37083 8.16667 9.00833 8 9.975 8C10.9417 8 11.5958 8.16667 11.9375 8.5C12.2792 8.83333 12.7583 9 13.375 9C13.9917 9 14.4417 8.83333 14.725 8.5C15.0083 8.16667 15.625 8 16.575 8C16.9583 8 17.3292 8.04583 17.6875 8.1375C18.0458 8.22917 18.4083 8.36667 18.775 8.55C19.1917 8.76667 19.5 8.99167 19.7 9.225C19.9 9.45833 20 9.69167 20 9.925C20 10.2417 19.8667 10.4792 19.6 10.6375C19.3333 10.7958 19.0083 10.8333 18.625 10.75C18.2417 10.6667 17.9375 10.5208 17.7125 10.3125C17.4875 10.1042 17.1417 10 16.675 10C16.0583 10 15.5958 10.1667 15.2875 10.5C14.9792 10.8333 14.3417 11 13.375 11C12.4083 11 11.7542 10.8333 11.4125 10.5C11.0708 10.1667 10.5917 10 9.975 10C9.35833 10 8.89583 10.1667 8.5875 10.5C8.27917 10.8333 7.63333 11 6.65 11C5.66667 11 5.025 10.8333 4.725 10.5C4.425 10.1667 3.95833 10 3.325 10ZM3.325 6C2.85833 6 2.5125 6.10417 2.2875 6.3125C2.0625 6.52083 1.75833 6.66667 1.375 6.75C0.991667 6.83333 0.666667 6.79583 0.4 6.6375C0.133333 6.47917 0 6.24167 0 5.925C0 5.675 0.108333 5.43333 0.325 5.2C0.541667 4.96667 0.883333 4.73333 1.35 4.5C1.43333 4.45 1.65417 4.35417 2.0125 4.2125C2.37083 4.07083 2.84167 4 3.425 4C4.34167 4 4.95833 4.16667 5.275 4.5C5.59167 4.83333 6.05833 5 6.675 5C7.29167 5 7.75417 4.83333 8.0625 4.5C8.37083 4.16667 9.00833 4 9.975 4C10.9417 4 11.5958 4.16667 11.9375 4.5C12.2792 4.83333 12.75 5 13.35 5C13.95 5 14.4 4.83333 14.7 4.5C15 4.16667 15.6167 4 16.55 4C17.1333 4 17.6042 4.07083 17.9625 4.2125C18.3208 4.35417 18.5417 4.45 18.625 4.5C19.1083 4.75 19.4583 4.9875 19.675 5.2125C19.8917 5.4375 20 5.675 20 5.925C20 6.24167 19.8625 6.47917 19.5875 6.6375C19.3125 6.79583 18.9833 6.83333 18.6 6.75C18.2167 6.66667 17.9167 6.52083 17.7 6.3125C17.4833 6.10417 17.1417 6 16.675 6C16.0583 6 15.5958 6.16667 15.2875 6.5C14.9792 6.83333 14.3417 7 13.375 7C12.4083 7 11.7542 6.83333 11.4125 6.5C11.0708 6.16667 10.5917 6 9.975 6C9.35833 6 8.90417 6.16667 8.6125 6.5C8.32083 6.83333 7.68333 7 6.7 7C5.71667 7 5.0625 6.83333 4.7375 6.5C4.4125 6.16667 3.94167 6 3.325 6ZM3.325 2C2.85833 2 2.5125 2.10417 2.2875 2.3125C2.0625 2.52083 1.75833 2.66667 1.375 2.75C0.991667 2.83333 0.666667 2.79583 0.4 2.6375C0.133333 2.47917 0 2.24167 0 1.925C0 1.675 0.108333 1.43333 0.325 1.2C0.541667 0.966667 0.883333 0.733333 1.35 0.5C1.43333 0.45 1.65417 0.354167 2.0125 0.2125C2.37083 0.0708333 2.84167 0 3.425 0C4.34167 0 4.95833 0.166667 5.275 0.5C5.59167 0.833333 6.05833 1 6.675 1C7.29167 1 7.75417 0.833333 8.0625 0.5C8.37083 0.166667 9.00833 0 9.975 0C10.9417 0 11.5958 0.166667 11.9375 0.5C12.2792 0.833333 12.75 1 13.35 1C13.95 1 14.4 0.833333 14.7 0.5C15 0.166667 15.6167 0 16.55 0C17.1333 0 17.6042 0.0708333 17.9625 0.2125C18.3208 0.354167 18.5417 0.45 18.625 0.5C19.1083 0.75 19.4583 0.9875 19.675 1.2125C19.8917 1.4375 20 1.675 20 1.925C20 2.24167 19.8625 2.47917 19.5875 2.6375C19.3125 2.79583 18.9833 2.83333 18.6 2.75C18.2167 2.66667 17.9167 2.52083 17.7 2.3125C17.4833 2.10417 17.1417 2 16.675 2C16.0583 2 15.5958 2.16667 15.2875 2.5C14.9792 2.83333 14.3417 3 13.375 3C12.4083 3 11.7542 2.83333 11.4125 2.5C11.0708 2.16667 10.5917 2 9.975 2C9.35833 2 8.90417 2.16667 8.6125 2.5C8.32083 2.83333 7.68333 3 6.7 3C5.71667 3 5.0625 2.83333 4.7375 2.5C4.4125 2.16667 3.94167 2 3.325 2Z"
                                                              fill="#2B5677" style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">Underway Replenishment Products</h4>
                                                </a>
                                                <a href="https://defense.hydrasearch.com/collection/defense/technical-products-valves-fittings/"
                                                   class="menu-card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                                         viewBox="0 0 24 25" fill="none" style="fill: #01254c;">
                                                        <mask id="mask0_6681_8736"
                                                              style="mask-type:alpha;fill: #01254c;"
                                                              maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                              height="25">
                                                            <rect y="0.225586" width="24" height="24"
                                                                  fill="#D9D9D9"></rect>
                                                        </mask>
                                                        <g mask="url(#mask0_6681_8736)">
                                                            <path d="M10.7 15.7256L10.85 16.4506C10.9 16.6839 11.0125 16.8714 11.1875 17.0131C11.3625 17.1548 11.5667 17.2256 11.8 17.2256H12.2C12.4333 17.2256 12.6375 17.1506 12.8125 17.0006C12.9875 16.8506 13.1 16.6589 13.15 16.4256L13.3 15.7256C13.5 15.6423 13.6875 15.5548 13.8625 15.4631C14.0375 15.3714 14.2167 15.2589 14.4 15.1256L15.125 15.3506C15.3417 15.4173 15.5542 15.4089 15.7625 15.3256C15.9708 15.2423 16.1333 15.1089 16.25 14.9256L16.45 14.5756C16.5667 14.3756 16.6083 14.1589 16.575 13.9256C16.5417 13.6923 16.4333 13.5006 16.25 13.3506L15.7 12.8756C15.7333 12.6423 15.75 12.4256 15.75 12.2256C15.75 12.0256 15.7333 11.8089 15.7 11.5756L16.25 11.1006C16.4333 10.9506 16.5417 10.7631 16.575 10.5381C16.6083 10.3131 16.5667 10.1006 16.45 9.90059L16.225 9.52559C16.1083 9.34225 15.95 9.20892 15.75 9.12559C15.55 9.04225 15.3417 9.03392 15.125 9.10059L14.4 9.32559C14.2167 9.19225 14.0375 9.07975 13.8625 8.98809C13.6875 8.89642 13.5 8.80892 13.3 8.72559L13.15 8.00059C13.1 7.76725 12.9875 7.57975 12.8125 7.43809C12.6375 7.29642 12.4333 7.22559 12.2 7.22559H11.8C11.5667 7.22559 11.3625 7.30059 11.1875 7.45059C11.0125 7.60059 10.9 7.79225 10.85 8.02559L10.7 8.72559C10.5 8.80892 10.3125 8.89642 10.1375 8.98809C9.9625 9.07975 9.78333 9.19225 9.6 9.32559L8.875 9.10059C8.65833 9.03392 8.44583 9.04225 8.2375 9.12559C8.02917 9.20892 7.86667 9.34225 7.75 9.52559L7.55 9.87559C7.43333 10.0756 7.39167 10.2923 7.425 10.5256C7.45833 10.7589 7.56667 10.9506 7.75 11.1006L8.3 11.5756C8.26667 11.8089 8.25 12.0256 8.25 12.2256C8.25 12.4256 8.26667 12.6423 8.3 12.8756L7.75 13.3506C7.56667 13.5006 7.45833 13.6881 7.425 13.9131C7.39167 14.1381 7.43333 14.3506 7.55 14.5506L7.775 14.9256C7.89167 15.1089 8.05 15.2423 8.25 15.3256C8.45 15.4089 8.65833 15.4173 8.875 15.3506L9.6 15.1256C9.78333 15.2589 9.9625 15.3714 10.1375 15.4631C10.3125 15.5548 10.5 15.6423 10.7 15.7256ZM12 14.2256C11.45 14.2256 10.9792 14.0298 10.5875 13.6381C10.1958 13.2464 10 12.7756 10 12.2256C10 11.6756 10.1958 11.2048 10.5875 10.8131C10.9792 10.4214 11.45 10.2256 12 10.2256C12.55 10.2256 13.0208 10.4214 13.4125 10.8131C13.8042 11.2048 14 11.6756 14 12.2256C14 12.7756 13.8042 13.2464 13.4125 13.6381C13.0208 14.0298 12.55 14.2256 12 14.2256ZM5 21.2256C4.45 21.2256 3.97917 21.0298 3.5875 20.6381C3.19583 20.2464 3 19.7756 3 19.2256V5.22559C3 4.67559 3.19583 4.20475 3.5875 3.81309C3.97917 3.42142 4.45 3.22559 5 3.22559H19C19.55 3.22559 20.0208 3.42142 20.4125 3.81309C20.8042 4.20475 21 4.67559 21 5.22559V19.2256C21 19.7756 20.8042 20.2464 20.4125 20.6381C20.0208 21.0298 19.55 21.2256 19 21.2256H5Z"
                                                                  fill="#2B5677" style="fill: #01254c;"></path>
                                                        </g>
                                                    </svg>
                                                    <h4 style="margin: 0;">Valves, pipe &amp; tube fittings</h4>
                                                </a>
                                                <a href="https://defense.hydrasearch.com/collection/defense/aerospace-hose-fittings/"
                                                   class="menu-card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                         viewBox="0 0 25 25" fill="none">
                                                        <mask id="mask0_6681_8751" style="mask-type:alpha"
                                                              maskUnits="userSpaceOnUse" x="0" y="0" width="25"
                                                              height="25">
                                                            <rect x="0.5" y="0.225586" width="24" height="24"
                                                                  fill="#D9D9D9"></rect>
                                                        </mask>
                                                        <g mask="url(#mask0_6681_8751)">
                                                            <path d="M11.2753 10.6256L5.02534 7.92559C4.62534 7.74225 4.37951 7.44642 4.28784 7.03809C4.19618 6.62975 4.30868 6.26725 4.62534 5.95059L5.02534 5.55059C5.15868 5.41725 5.32118 5.31725 5.51284 5.25059C5.70451 5.18392 5.90034 5.16725 6.10034 5.20059L15.1003 6.80059L18.2003 3.67559C18.5837 3.29225 19.0545 3.10059 19.6128 3.10059C20.1712 3.10059 20.642 3.29225 21.0253 3.67559C21.4087 4.05892 21.6003 4.52975 21.6003 5.08809C21.6003 5.64642 21.4087 6.11725 21.0253 6.50059L17.9253 9.62559L19.5003 18.6006C19.5337 18.8006 19.5212 19.0006 19.4628 19.2006C19.4045 19.4006 19.3087 19.5673 19.1753 19.7006L18.7753 20.0756C18.4587 20.3923 18.092 20.5089 17.6753 20.4256C17.2587 20.3423 16.9587 20.1006 16.7753 19.7006L14.1003 13.4506L11.5503 15.9756L12.1003 19.0756C12.1337 19.2423 12.1253 19.4048 12.0753 19.5631C12.0253 19.7214 11.942 19.8589 11.8253 19.9756L11.4003 20.4006C11.167 20.6339 10.8795 20.7256 10.5378 20.6756C10.1962 20.6256 9.94201 20.4506 9.77534 20.1506L7.95034 16.7756L4.57534 14.9506C4.27534 14.7839 4.10034 14.5298 4.05034 14.1881C4.00034 13.8464 4.09201 13.5589 4.32534 13.3256L4.75034 12.9006C4.86701 12.7839 5.00451 12.7006 5.16284 12.6506C5.32118 12.6006 5.48368 12.5923 5.65034 12.6256L8.72535 13.1506L11.2753 10.6256Z"
                                                                  fill="#2B5677" style="fill: #01254c;"></path>
                                                        </g>
                                                    </svg>
                                                    <h4 style="margin: 0;">Aerospace Hose &amp; Fittings</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mega-drop-down">
                            <a href="#!">
                                Resources<i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <div class="mega-menu" style="width: 70%;/*! background: red; */">
                                <div class="mega-menu-wrap-1"
                                     style="background: #fff;margin-top: 0.7rem;border-radius: 25px;left: 69px;position: relative;">
                                    <div class="mega-slider-container-1">
                                        <div class="mega-menu-page-1" style="display: block;">
                                            <div class="category-grid" style="grid-template-columns: repeat(2, 1fr);">
                                                <a class="menu-card" href="https://hydrasearch.com/literature/">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-book-reader"
                                                         viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                                                         style="width: 26px;height: 24px;">
                                                        <path d="M352 96c0-53.02-42.98-96-96-96s-96 42.98-96 96 42.98 96 96 96 96-42.98 96-96zM233.59 241.1c-59.33-36.32-155.43-46.3-203.79-49.05C13.55 191.13 0 203.51 0 219.14v222.8c0 14.33 11.59 26.28 26.49 27.05 43.66 2.29 131.99 10.68 193.04 41.43 9.37 4.72 20.48-1.71 20.48-11.87V252.56c-.01-4.67-2.32-8.95-6.42-11.46zm248.61-49.05c-48.35 2.74-144.46 12.73-203.78 49.05-4.1 2.51-6.41 6.96-6.41 11.63v245.79c0 10.19 11.14 16.63 20.54 11.9 61.04-30.72 149.32-39.11 192.97-41.4 14.9-.78 26.49-12.73 26.49-27.06V219.14c-.01-15.63-13.56-28.01-29.81-27.09z"
                                                              style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">Literature</h4>
                                                </a>
                                                <a class="menu-card"
                                                   href="https://hydrasearch.com/find-a-distributor/">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-atlas"
                                                         viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"
                                                         style="visibility: ;width: 26px;height: 24px;">
                                                        <path d="M318.38 208h-39.09c-1.49 27.03-6.54 51.35-14.21 70.41 27.71-13.24 48.02-39.19 53.3-70.41zm0-32c-5.29-31.22-25.59-57.17-53.3-70.41 7.68 19.06 12.72 43.38 14.21 70.41h39.09zM224 97.31c-7.69 7.45-20.77 34.42-23.43 78.69h46.87c-2.67-44.26-15.75-71.24-23.44-78.69zm-41.08 8.28c-27.71 13.24-48.02 39.19-53.3 70.41h39.09c1.49-27.03 6.53-51.35 14.21-70.41zm0 172.82c-7.68-19.06-12.72-43.38-14.21-70.41h-39.09c5.28 31.22 25.59 57.17 53.3 70.41zM247.43 208h-46.87c2.66 44.26 15.74 71.24 23.43 78.69 7.7-7.45 20.78-34.43 23.44-78.69zM448 358.4V25.6c0-16-9.6-25.6-25.6-25.6H96C41.6 0 0 41.6 0 96v320c0 54.4 41.6 96 96 96h326.4c12.8 0 25.6-9.6 25.6-25.6v-16c0-6.4-3.2-12.8-9.6-19.2-3.2-16-3.2-60.8 0-73.6 6.4-3.2 9.6-9.6 9.6-19.2zM224 64c70.69 0 128 57.31 128 128s-57.31 128-128 128S96 262.69 96 192 153.31 64 224 64zm160 384H96c-19.2 0-32-12.8-32-32s16-32 32-32h288v64z"
                                                              style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">Distributor Portal</h4>
                                                </a>
                                                <a class="menu-card"
                                                   href="https://hydrasearch.com/supplier-information">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-info-circle"
                                                         viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                                                         style="width: 26px;height: 24px;">
                                                        <path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"
                                                              style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">Supplier Information</h4>
                                                </a>
                                                <a class="menu-card" href="https://hydrasearch.com/news/">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-newspaper"
                                                         viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"
                                                         style="width: 26px;height: 24px;">
                                                        <path d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z"
                                                              style="fill: #01254c;"></path>
                                                    </svg>
                                                    <h4 style="margin: 0;">News</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ///////////////////////////////////// -->

                        <?php
                        $menu_items = [
                            "About Us" => "https://hydrasearch.com/about-us/",
                            // "Find a Distributor" => "https://hydrasearch.com/find-a-distributor/",
                            // "Literature"         => "https://hydrasearch.com/literature/",
                            "Contact Us" => "https://hydrasearch.com/contact-us",
                        ];
                        foreach ($menu_items as $label => $url): ?>
                            <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a></li>
                        <?php endforeach; ?>
                        <a href="<?php echo wc_get_cart_url(); ?>"
   class="header-link cart-link d-flex flex-row align-items-center">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-count"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>
</a>

                    </ul>
            </div>
        </div>
    </header>
<script>
	document.addEventListener('DOMContentLoaded', function () {
    const pages = document.querySelectorAll('.mega-menu-page');
    const nextBtn = document.getElementById('megaNextBtn');
    const prevBtn = document.getElementById('megaPrevBtn');
    let currentPage = 0;


    function updatePages() {
        pages.forEach((page, index) => {
            page.style.display = (index === currentPage) ? 'block' : 'none';
        });

        prevBtn.disabled = currentPage === 0;
        nextBtn.disabled = currentPage === pages.length - 1;

    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (currentPage < pages.length - 1) {
                currentPage++;
                updatePages();
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                updatePages();
            }
        });
    }

    updatePages(); // initial call
});</script>