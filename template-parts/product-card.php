<?php
$post_id = isset($args['id']) ? $args['id'] : get_the_ID();
setup_postdata(get_post($post_id));

$post_title  = get_the_title($post_id);
$sku_product = get_field('sku', $post_id);
$images      = get_field('images', $post_id);
$title_parts = get_field('title_parts', $post_id);
?>

<div class="col-md-4">
  <div class="card card-box mb-4">
    <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="exempt_style">
      <?php
     if (has_post_thumbnail($post_id)) {
  echo get_the_post_thumbnail($post_id, 'full');
} else {
  echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="No image">';
}

      ?>
    </a>
    <div class="card-body">
      <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="exempt_style">
        <h5 class="card-title product-title">
          <?php
          if ($title_parts) {
            foreach ($title_parts as $part) {
              echo esc_html($part['heading']) . ' ';
            }
          }
          echo esc_html(wp_trim_words(wp_strip_all_tags($post_title), 8, '…'));
          ?>
        </h5>
      </a>
      <p><?php echo esc_html($sku_product); ?></p>
      <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="btn btn-sm btn-primary mt-2">View More</a>
    </div>
  </div>
</div>

<?php wp_reset_postdata(); ?>