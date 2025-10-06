<?php
echo "<h1>✅ Theme search.php is loading</h1>";

$template_file = WP_PLUGIN_DIR . '/search-optimizer-new/includes/search-page-template.php';
echo "<p>Trying to include: {$template_file}</p>";

if (file_exists($template_file)) {
    echo "<p>✅ File exists. Including now...</p>";
    include $template_file;
    exit;
} else {
    echo "<p>❌ File NOT found.</p>";
    exit;
}