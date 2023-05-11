<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 

if(get_field('header', 'options')) { the_field('header', 'options'); }

if(get_field('custom_css')) { 
?> 
<style>
<?php the_field('custom_css'); ?>
</style>
<?php 
}
wp_head(); 
?>
</head>
<body <?php body_class(); ?>>
<?php
if(get_field('body','options')) { the_field('body','options'); }
// echo '<div class="blank-space"></div>';
// echo '<header class="position-fixed pt-3 pb-3 z-3 w-100" style="top:0;left:0;">';

// echo '<div class="nav">';
// echo '<div class="container-fluid">';
// echo '<div class="row align-items-center">';

// echo '<div class="col-lg-3 col-6 text-center">';
echo '<a href="' . home_url() . '" class="position-fixed z-1" style="top:25px;left:35px;">';

$logo = get_field('logo','options'); 
if($logo){
echo wp_get_attachment_image($logo['id'],'full',"",[
    'class'=>'h-auto',
    'style'=>'width:205px;max-width:100%;transition:all 1s ease-in-out;','id'=>'logo-main'
]); 
}

echo '</a>';
// echo '</div>';

// echo '<div class="col-lg-4 col-6 desktop-hidden">';
// echo '<a id="navToggle" class="nav-toggle">';
// echo '<div>';
// echo '<div class="line-1 bg-accent"></div>';
// echo '<div class="line-2 bg-accent"></div>';
// echo '<div class="line-3 bg-accent"></div>';
// echo '</div>';
// echo '</a>';
// echo '</div>';
// echo '<div id="navMenuOverlay" class="position-fixed z-2"></div>';
// echo '<div class="col-lg-4 col-md-8 col-11 nav-items bg-white desktop-hidden" id="navItems">';

// echo '<div class="pt-5 pb-5">';
// echo '<div class="close-menu">';
// echo '<div>';
// echo '<span id="navMenuClose" class="close h1">X</span>';
// echo '</div>';
// echo '</div>';
// echo '<a href="' . home_url() . '">';

// $logo = get_field('logo','options'); 
// if($logo){
// echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto','style'=>'max-width:250px;']);
// }

// echo '</a>';
// echo '</div>';
// wp_nav_menu(array(
// 'menu' => 'primary',
// 'menu_class'=>'menu list-unstyled mb-0'
// )); 
// echo '</div>';
// echo '</div>';
// echo '</div>';
// echo '</div>';

// echo '</header>';

// echo '<section class="hero position-relative">';
// $globalPlaceholderImg = get_field('global_placeholder_image','options');
// if(is_page()){
// if(has_post_thumbnail()){
// the_post_thumbnail('full', array('class' => 'w-100 h-100 bg-img position-absolute'));
// } else {
// echo wp_get_attachment_image($globalPlaceholderImg['id'],'full','',['class'=>'w-100 h-100 bg-img position-absolute']);
// }
// } else {
// echo wp_get_attachment_image($globalPlaceholderImg['id'],'full','',['class'=>'w-100 h-100 bg-img position-absolute']);
// }

// echo '</section>';

?>