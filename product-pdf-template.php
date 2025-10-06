<?php
if (!defined('ABSPATH')) exit;

global $post;
$post_id = get_the_ID();
setup_postdata($post);

$product = function_exists('wc_get_product') ? wc_get_product($post_id) : null;
$is_in_stock = $product ? $product->is_in_stock() : false;
$sku = get_field('sku') ?: get_post_meta($post_id, '_sku', true);

// Helper to embed images for Dompdf
function dompdf_embed_image($url) {
    if (empty($url)) return '';
    $type = pathinfo($url, PATHINFO_EXTENSION);
    $data = @file_get_contents($url);
    if (!$data) return '';
    $base64 = base64_encode($data);
    return 'data:image/' . $type . ';base64,' . $base64;
}

// Load image
$img_url = get_the_post_thumbnail_url($post_id, 'full');
if (!$img_url && ($imgs = get_field('images'))) {
  $first = reset($imgs);
  $img_url = $first['image']['url'] ?? '';
}
$img_src = dompdf_embed_image($img_url);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo esc_html(get_the_title()); ?></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      font-size: 12px;
      color: #222;
    }
    h1, h2, h3 {
      color: #003366;
      margin-bottom: 8px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      font-size: 12px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 6px;
      text-align: left;
    }
    th {
      background: #f0f0f0;
    }
    .header {
      margin-bottom: 25px;
    }
    .header-table td {
      vertical-align: top;
    }
    .contact-info {
      font-size: 11px;
      color: #555;
    }
    .product-image {
      text-align: center;
      margin: 20px 0;
    }
    .product-image img {
      max-width: 300px;
      max-height: 250px;
    }
    .section {
      margin-top: 25px;
    }
    .note {
      font-size: 11px;
      color: #a00;
      margin-top: 20px;
    }
    .watermark {
      position: fixed;
      top: 40%;
      left: 20%;
      font-size: 70px;
      color: rgba(180,180,180,0.1);
      transform: rotate(-30deg);
      z-index: 0;
    }
  </style>
</head>
<body>

<!-- Watermark -->
<div class="watermark">HYDRASEARCH</div>

<!-- Header -->
<!-- Header -->
<div class="header">
  <table class="header-table" width="100%">
    <tr>
      <?php
      $logo_url = 'https://recreational.hydrasearch.com/wp-content/uploads/2025/07/logo.png';
      $logo_src = dompdf_embed_image($logo_url);
      if (!empty($logo_src)): ?>
        <td align="right">
          <img src="<?php echo esc_attr($logo_src); ?>" alt="Logo" style="margin-top:1rem;margin-left:1rem;max-height: 50px;">
        </td>
      <?php endif; ?>
      <td>
        <!-- <h2>HYDRASEARCH</h2> -->
        <div class="contact-info"style="position:relative;">
          <a style="position:relative;top:1rem;left:1rem;text-decoration:none;color:#000;" href="mailto:information@hydrasearch.com">information@hydrasearch.com</a><br>
          <a style="position:relative;top:1.5rem;left:1rem;text-decoration:none;color:#000;" href="tel:+14106438900">+1.410.643.8900</a>
        </div>
      </td>
      
    </tr>
  </table>
</div>

<!-- Title & SKU -->
<h1><?php echo esc_html(get_the_title()); ?></h1>
<?php if ($sku): ?>
  <p><strong>SKU:</strong> <?php echo esc_html($sku); ?></p>
<?php endif; ?>
<?php if ($is_in_stock && $product && $product->get_price_html()): ?>
  <p><strong>Price:</strong> <?php echo wp_kses_post($product->get_price_html()); ?></p>
<?php endif; ?>

<!-- Product Image -->
<div class="product-image">
  <?php if (!empty($img_src)): ?>
    <img src="<?php echo esc_attr($img_src); ?>" alt="Product Image">
  <?php else: ?>
    <p><em>No image available</em></p>
  <?php endif; ?>
</div>

<!-- Description -->
<div class="section">
  <h2>Description</h2>
  <ul style="padding-left: 15px;">
    <?php if ($desc = get_field('product_description')): ?>
      <li><?php echo esc_html($desc); ?></li>
    <?php endif; ?>
    <?php if ($pn = get_field('pn_number')): ?>
      <li>Part Number: <?php echo esc_html($pn); ?></li>
    <?php endif; ?>
    <?php if ($mil = get_field('mil_number')): ?>
      <li>Mil Number: <?php echo esc_html($mil); ?></li>
    <?php endif; ?>
    <?php if ($fh = get_field('following_hose')): ?>
      <li>Following Hose: <?php echo esc_html($fh); ?></li>
    <?php endif; ?>
    <?php if ($htf = get_field('hose_to_flange')): ?>
      <li><?php echo esc_html(get_field('hose_to_flange_heading')); ?>: <?php echo esc_html($htf); ?></li>
    <?php endif; ?>
  </ul>
</div>

<!-- Specification Table -->
  <?php if (have_rows('table_row')): ?>
  <div class="section">
    <h2>Specification Table</h2>
    <table>
      <?php while (have_rows('table_row')): the_row(); 
        if (have_rows('column')): while (have_rows('column')): the_row();
          $label = get_sub_field('label') ?: get_row_layout();
          $content = get_sub_field('content') ?: '-';
      ?>
        <tr>
          <th><?php echo esc_html($label); ?></th>
          <td><?php echo esc_html($content); ?></td>
        </tr>
      <?php endwhile; endif; endwhile; ?>
    </table>
  </div>
  <?php endif; ?>

<!-- Components Table -->
<?php if (have_rows('components_table')): ?>
  <div class="section">
    <h2>Components Table</h2>
    <table>
      <?php while (have_rows('components_table')): the_row(); 
        $rows = get_sub_field('row');
        if (is_array($rows)):
          $headers = array_shift($rows);
          foreach ($headers as $i => $hdr): ?>
            <tr>
              <th><?php echo esc_html($hdr); ?></th>
              <td>
                <?php
                  $vals = array_column($rows, $i);
                  echo esc_html(implode(', ', array_map(fn($v) => $v ?: '-', $vals)));
                ?>
              </td>
            </tr>
          <?php endforeach;
        endif;
      endwhile; ?>
    </table>
  </div>
<?php endif; ?>

<!-- FAQs -->
<?php if (have_rows('faqs')): ?>
  <div class="section">
    <h2>FAQs</h2>
    <?php while (have_rows('faqs')): the_row(); ?>
      <p><strong><?php echo esc_html(get_sub_field('question')); ?></strong><br>
         <?php echo wp_kses_post(get_sub_field('answer')); ?></p>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<!-- Note -->
<?php if ($note = get_field('sub_note')): ?>
  <div class="note"><strong>Note:</strong> <?php echo esc_html($note); ?></div>
<?php endif; ?>

</body>
</html>
