<?php

if(have_rows('sign_up_content','options')): while(have_rows('sign_up_content','options')): the_row();
echo '<section class="position-relative" style="padding:100px 0px;border-top:125px solid black;">';

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12">';

echo get_sub_field('content');

echo '</div>';
echo '</div>';
echo '</div>';

echo '</section>';
endwhile; endif;

?>