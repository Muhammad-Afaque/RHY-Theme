<?php
global $components_table_header;
global $hydrasearch_product_id;

if (have_rows('components_table_row', $hydrasearch_product_id)) {
   while (have_rows('components_table_row', $hydrasearch_product_id)) {
       the_row();

       // Get columns data first to check if empty 
       $columns = get_sub_field('column');

       // Skip if columns are empty
       if (empty($columns) || !is_array($columns)) {
           continue;
       }

       echo '<tr>';
       $acf_fc_layout = get_row_layout();
       $search_key = 'acf_fc_layout';
       $unique_components_table_header = array_unique($components_table_header);
      
       // Get the permalink for the current product
       $product_permalink = get_permalink($hydrasearch_product_id);

       if (!empty($unique_components_table_header)) {
           foreach ($unique_components_table_header as $index => $column) {
               // Find the first matching column and render its content
               $result = array_filter($columns, function ($item) use ($search_key, $column) {
                   return isset($item[$search_key]) && $item[$search_key] == $column;
               });

               echo '<td>';
               if (!empty($result)) {
                   $item = reset($result); // Get the first matched item
                   if (isset($item['content']) && !empty($item['content'])) {
                       // Wrap content with permalink
                       echo '' .
                            esc_html($item['content']) .
                            '';
                   } else {
                       echo '-';
                   }
               } else {
                   echo '-';
               }
               echo '</td>';
           }
       }
       echo '</tr>';
   }
}
?>