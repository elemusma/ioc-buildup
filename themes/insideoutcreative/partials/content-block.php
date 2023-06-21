<?php

echo '<div class="col-lg-9 text-center pb-4 ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';
echo '<div data-aos="fade-up">';
echo get_sub_field('content');
echo '</div>';
echo '</div>';

?>