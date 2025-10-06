


<?php
/**
 * Complete solution for Hydrasearch ACF Flexible Content Table
 * 
 * This solution correctly maps the table_header flexible content field layouts
 * to their corresponding data values in table_row.
 */
global $table_header;
global $aeroquip_product_id;

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
            echo '<td>';
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