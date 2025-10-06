<?php
global $table_header;
if (!isset($table_header) || !is_array($table_header)) {
    $table_header = [];
}
echo '<tr>';
if (have_rows('table_header')) {
    while (have_rows('table_header')) {
        the_row();
        global $table_header;
        $acf_fc_layout = get_row_layout();
        array_push($table_header, $acf_fc_layout);
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