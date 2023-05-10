<?php

echo '<footer class="" style="">';
echo '<section class="pt-5 pb-5">';
echo '<div class="container">';
echo '<div class="row justify-content-center align-items-center">';
echo '<div class="col-lg-4 col-md-6 col-10 text-center">';
echo '<a href="' . home_url() . '/resources/">';

$logo = get_field('logo','options'); $logoFooter = get_field('logo_footer','options'); 

if($logoFooter){
echo wp_get_attachment_image($logoFooter['id'],'full',"",['class'=>'w-100 h-auto']); 
} elseif($logo) {
echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto']);
}

echo '</a>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

echo '<section class="position-relative bg-accent-dark" style="padding:50px 0;" id="">';

    $bgImg = get_sub_field('background_image');

    if($bgImg){
        echo wp_get_attachment_image($bgImg['id'],'full','',[
            'class'=>'w-100 h-100 position-absolute bg-img',
            'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
        ]);
    }

    echo '<div class="position-absolute" style="top:0px;left:0;" id="contact"></div>';
    echo '<div class="container">';
    echo '<div class="row justify-content-start align-items-start">';


    echo '<div class="col-lg-12 text-center pb-5 ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';

    echo '<h2 class="bold text-white mb-0 h1" style="letter-spacing:.2em;">ABOUT US</h2>';
    echo '<h3 class="bold h5" style="color:#b9b3be;">CONTACT</h3>';

    echo '</div>';



    echo '<div class="col-md-6 text-center pb-md-0 pb-5 ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';

    echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');

    echo '</div>';


    echo '<div class="col-md-4">';



    echo '<div class="text-white">';
    echo get_field('website_message','options');
    echo '</div>';

    echo '</div>';

    echo '<div class="col-12 pt-5 text-center">';
wp_nav_menu(array(
'menu' => 'footer',
'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center text-uppercase'
)); 

echo '<a href="https://insideoutcreative.io/" target="_blank" rel="noopener noreferrer" style="" class="">';
        echo '<img src="https://insideoutcreative.io/wp-content/uploads/2023/01/developed-by-inside-out-creative-gray.png" style="width:150px;" class="h-auto ml-2" alt="">';
        echo '</a>';



echo '</div>';

    echo '</div>';
    echo '</div>';

    echo '</section>';



echo '</footer>';

if(get_field('footer', 'options')) { the_field('footer', 'options'); }

wp_footer(); ?>
</body>
</html>