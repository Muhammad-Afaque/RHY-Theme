<?php
global $components_table_header;
if (!isset($components_table_header) || !is_array($components_table_header)) {
    $components_table_header = [];
}
echo '<tr>';
if (have_rows('components_table_header')) {
    while (have_rows('components_table_header')) {
        $conlum = the_row();

        $acf_fc_layout = get_row_layout();
        array_push($components_table_header, $acf_fc_layout);
        if (have_rows($acf_fc_layout)) {
            while (have_rows($acf_fc_layout)) {
                the_row();
                $nested_acf_fc_layout = get_row_layout();

                $content = get_sub_field('content');
                echo '<th>' . esc_html($content) . '</th>';
            }
        } else {
            $content = get_sub_field('content');
            echo '<th>' . esc_html($content) . '</th>';
        }
    }
}
echo '</tr>';
?>