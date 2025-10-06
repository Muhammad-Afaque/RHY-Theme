<?php
// Get the requested URL path
$request_uri = $_SERVER['REQUEST_URI'];

// 1. If the URL starts with '/collection/defense'
if (strpos($request_uri, '/collection/commercial-recreational') === 0) {
    wp_redirect('/collection/commercial-recreational', 301);
    exit;
}

// 2. If the URL starts with '/product'
if (strpos($request_uri, '/product') === 0) {
    wp_redirect('/collection/commercial-recreational', 301);
    exit;
}

// 3. If the URL contains the word 'defense' anywhere (fallback catch-all)
if (strpos($request_uri, 'commercial-recreational') !== false) {
    wp_redirect('/collection/commercial-recreational', 301);
    exit;
}
// 3. If the URL contains the word 'recreational' anywhere (fallback catch-all)
if (strpos($request_uri, 'recreational') !== false) {
    wp_redirect('/collection/commercial-recreational', 301);
    exit;
}

// 4. Final fallback: redirect ALL other 404s to homepage
wp_redirect(home_url(), 301);

// If none matched, show the default 404 page
get_header();
?>

<h1>Page Not Found</h1>
<p>Sorry, we couldn't find what you were looking for.</p>

<?php get_footer(); ?>
