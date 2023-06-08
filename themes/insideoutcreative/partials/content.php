<?php

if(have_rows('builder_repeater')): while(have_rows('builder_repeater')): the_row();
$layout = get_sub_field('layout');

if($layout == 'Documents & Resources'){
    // start of resources
    if(have_rows('documents_resources_repeater')): while(have_rows('documents_resources_repeater')): the_row();

    // $img = get_sub_field('image');
    $title = get_sub_field('title');

    echo '<section class="position-relative" style="">';

    echo get_template_part('partials/bg-img');

    // echo '<div class="position-absolute w-100 h-100" style="background:#707070;top:0;left:0;mix-blend-mode:multiply;pointer-events:none;"></div>';
        
    if($title){
        echo '<div class="position-absolute" style="top:50%;left:50%;transform:translate(-50%,-80%);">';
        echo '<h1 class="text-white bold" style="font-size:5vw;margin:0;">' . $title . '</h1>';
        echo '</div>';
    }
    echo '<div class="container-fluid">';
    echo '<div class="row row-resources justify-content-between">';

    if(have_rows('links')): 
        $linksCounter = 0;
        while(have_rows('links')): the_row();
        $linksCounter++;

        if ($linksCounter > 4){
            $linksCounter = 1;
        }
    $link = get_sub_field('link');

    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';


    echo '<a href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '" class="col-lg-3 col-md-6 col-resources" style="padding-top:150px;padding-bottom:100px;text-decoration:none;min-height:50vh;" data-aos="fade-up" data-aos-delay="' . $linksCounter . '00">';
    echo '<div class="position-absolute bg-accent w-100 h-100 col-resources-overlay" style="top:0;left:0;opacity:0;transition:all .25s ease-in-out;"></div>';
    // echo '<div>';

    echo '<div class="d-flex justify-content-center position-relative z-3 h-100" style="">';
    echo '<div class="p-2 mr-3 d-flex align-items-center justify-content-center" style="border-radius:50%;border:1px solid var(--accent-secondary);height:35px;min-width:35px;">';
    echo '<div style="width:15px;height:18px;">';
    echo '<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 448 512"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>';
    echo '</div>';
    echo '</div>';

    echo '<div class="" style="padding-left:15px;">';
    echo '<span class="text-white " style="font-size:1.25rem;">' . esc_html( $link_title ) . '</span>';
    echo '<div class="bg-accent mt-3" style="height:8px;width:75px;margin-top:10px;"></div>';

    echo '<div class="resources-col-description text-white pt-2 small">';
    echo get_sub_field('description');
    echo '</div>';
    echo '</div>';


    echo '</div>';
    // echo '</div>';

    echo '</a>';

        endwhile; 
    endif;

    echo '</div>';
    echo '</div>';
    echo '</section>';
    endwhile; endif;
    // end of resources
} elseif ($layout == 'Content'){
    if(have_rows('content_group')): while(have_rows('content_group')): the_row();

    echo '<section class="position-relative content-section ' . get_sub_field('classes') . '" style="padding:50px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

    // $bgImg = get_sub_field('background_image');

    // if($bgImg){
    //     echo wp_get_attachment_image($bgImg['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img',
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
    //     ]);
    // }

    // if(have_rows('background_image')): while(have_rows('background_image')): the_row();

    //     $image = get_sub_field('image');
    //     echo wp_get_attachment_image($image['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img' . get_sub_field('image_col_classes'),
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;' . get_sub_field('image_col_style')
    //     ]);

    // endwhile; endif;

    echo get_template_part('partials/bg-img');

    echo '<div class="container-fluid">';

    echo '<div class="row justify-content-center">';

        echo get_template_part('partials/content-block');

    echo '</div>';

    echo '</div>';

    echo '</section>';

    endwhile; endif;
} elseif ($layout == 'Content + Image') {
    if(have_rows('content_+_image')): while(have_rows('content_+_image')): the_row();

    echo '<section class="position-relative content-image-section bg-accent-dark text-white ' . get_sub_field('classes') . '" style="padding:50px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

    // $bgImg = get_sub_field('background_image');
    $imgSide = get_sub_field('image_side');

    // if(have_rows('background_image')): while(have_rows('background_image')): the_row();

    //     $image = get_sub_field('image');
    //     echo wp_get_attachment_image($image['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img' . get_sub_field('image_col_classes'),
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;' . get_sub_field('image_col_style')
    //     ]);

    // endwhile; endif;

    echo get_template_part('partials/bg-img');

    echo '<div class="container-fluid">';

        if(have_rows('content_top_group')): while(have_rows('content_top_group')): the_row();
            echo '<div class="row justify-content-center">';
            echo '<div class="col-lg-9 text-center ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';
            echo '<div data-aos="fade-up">';
            echo get_sub_field('content');
            echo '</div>';
            echo '</div>';
            echo '</div>';
        endwhile; endif;

        if($imgSide == 'Left'){
            echo '<div class="row row-content justify-content-center ' . get_sub_field('row_classes') . '" style="' . get_sub_field('row_style') . '">';
            // echo '</div>';
        } else {
            echo '<div class="row row-content flex-lg-row-reverse justify-content-center ' . get_sub_field('row_classes') . '" style="' . get_sub_field('row_style') . '">';

        }

    $gallery = get_sub_field('gallery');
    if( $gallery ): 
    echo '<div class="col-lg-4 pt-lg-0 pt-5 col-img ' . get_sub_field('image_col_classes') . '" style="' . get_sub_field('image_col_style') . '">';
    if($imgSide == 'Left'){
        echo '<div data-aos="fade-right" class="h-100">';
        // echo </div>
    } else {
        echo '<div data-aos="fade-left" class="h-100">';
    }
    echo '<div class="content-image-carousel owl-carousel owl-theme h-100">';
    foreach( $gallery as $image ):
    echo '<div class="col h-100">';
    
    echo wp_get_attachment_image($image['id'], 'full','',[
        'class'=>'h-100',
        'style'=>'object-fit:cover;object-position:top;'
    ] );
    
    echo '</div>';
    endforeach; 
    echo '</div>'; // end of carousel
    echo '</div>'; // end of data-aos
    echo '</div>'; // end of col-lg-6
    endif;

        echo '<div class="col-1"></div>';

        echo '<div class="col-lg-3 pt-lg-0 pt-5 ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';
        if($imgSide == 'Left'){
            echo '<div data-aos="fade-left">';
            // echo </div>
        } else {
            echo '<div data-aos="fade-right">';
        }
        if(have_rows('content_middle_group')): while(have_rows('content_middle_group')): the_row();
            echo get_sub_field('content');
        endwhile; endif;
            echo '</div>'; // end of data aos

        echo '</div>';
        echo '</div>';

        if(have_rows('content_bottom_group')): while(have_rows('content_bottom_group')): the_row();
            echo '<div class="row justify-content-center">';
            echo '<div class="col-lg-9 text-center ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';
            echo '<div data-aos="fade-up">';
            echo get_sub_field('content');
            echo '</div>';
            echo '</div>';
            echo '</div>';
        endwhile; endif;

        echo '</div>';


    echo '</section>';

    endwhile; endif;

} elseif ($layout == 'Videos') {
    if(have_rows('videos_group')): while(have_rows('videos_group')): the_row();

    echo '<section class="position-relative content-section ' . get_sub_field('classes') . '" style="padding:50px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

    // $bgImg = get_sub_field('background_image');

    // if($bgImg){
    //     echo wp_get_attachment_image($bgImg['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img',
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
    //     ]);
    // }

    echo get_template_part('partials/bg-img');


    echo '<div class="container">';
    if(get_sub_field('content')) {
        echo '<div class="row justify-content-center">';
        echo '<div class="col-lg-9 text-center pb-5 ' . get_sub_field('content_col_classes') . '" style="' . get_sub_field('content_col_style') . '">';

        echo '<div data-aos="fade-up">';
        echo get_sub_field('content');
        echo '</div>';

        echo '</div>';
        echo '</div>';
    }

    if(have_rows('videos_repeater')):
        echo '<div class="row justify-content-center">';
        $videosCounter = 0;
        while(have_rows('videos_repeater')): the_row();
        $videosCounter++;

        if ($videosCounter > 2){
            $videosCounter = 1;
        }

        echo '<div class="col-md-6 text-center pt-2 pb-2 ' . get_sub_field('video_classes') . '" style="' . get_sub_field('video_style') . '" data-aos="fade-up" data-aos-delay="' . $videosCounter . '00">';

        echo '<div class="video">';
        echo get_sub_field('video_url');
        echo '</div>';

        echo '</div>';

        endwhile;
        echo '</div>';
    endif;

    echo '</div>';

    
    echo '</section>';

    endwhile; endif;
} elseif ($layout == 'Gallery') { 
    if(have_rows('gallery_group')): while(have_rows('gallery_group')): the_row();

    echo '<section class="position-relative gallery-section ' . get_sub_field('classes') . '" style="background:#ebebeb;padding:25px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

    // $bgImg = get_sub_field('background_image');

    // if($bgImg){
    //     echo wp_get_attachment_image($bgImg['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img',
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
    //     ]);
    // }

    echo get_template_part('partials/bg-img');

    $gallery = get_sub_field('gallery');
    if( $gallery ): 
    echo '<div class="container">';
    echo '<div class="row justify-content-center">';
    $galleryCounter = 0;
    foreach( $gallery as $image ):
        $galleryCounter++;

        if ($galleryCounter > 4){
            $galleryCounter = 1;
        }
    echo '<div class="col-lg-3 col-md-4 col-6 col col-portfolio mt-3 mb-3 overflow-h d-flex align-items-center justify-content-center text-center">';
    echo '<div data-aos="fade-up" data-aos-delay="' . $galleryCounter . '00">';
    // echo '<div class="position-relative">';
    echo '<a href="' . $image['description'] . '" target="_blank">';
    echo wp_get_attachment_image($image['id'], 'full','',[
        'class'=>'h-auto',
        'style'=>'width:90%;object-fit:contain;'
    ] );
    echo '</a>';
    // echo '</div>';
    echo '</div>';
    echo '</div>';
    endforeach; 
    echo '</div>';
    echo '</div>';
    endif;

    echo '</section>';
    endwhile; endif;
} elseif ($layout == 'Image') {
    if(have_rows('image_group')): while(have_rows('image_group')): the_row();
    
    echo '<section class="position-relative image-section ' . get_sub_field('classes') . '" style="padding:50px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';
    
    // $bgImg = get_sub_field('background_image');
    
    // if($bgImg){
        //     echo wp_get_attachment_image($bgImg['id'],'full','',[
            //         'class'=>'w-100 h-100 position-absolute bg-img',
            //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
            //     ]);
            // }
            
            echo get_template_part('partials/bg-img');
            
            $image = get_sub_field('image');
            
            echo '<div data-aos="fade-up">';
            echo wp_get_attachment_image($image['id'], 'full','',[
                'class'=>'w-100 h-auto ' . get_sub_field('image_col_classes'),
                'style'=>'' . get_sub_field('image_col_classes')
            ]);
            echo '</div>';
            
            echo '</section>';
        endwhile; endif;
} elseif ($layout == 'About Story'){
    if(have_rows('about_story_group')): while(have_rows('about_story_group')): the_row();

    wp_enqueue_style('about-story', get_theme_file_uri('/css/sections/about-story.css'));

    if(have_rows('sections')): while(have_rows('sections')): the_row();
$image = get_sub_field('image');
$label = get_sub_field('label');
$dataAos = get_sub_field('data_aos');
$background = get_sub_field('background');
$section = sanitize_title_with_dashes($label);
$content = get_sub_field('content');


echo '<section id="section-' . $section . '" class="full-height pt-5 pb-5 position-relative overflow-h section-full d-flex align-items-center" style="min-height:100vh;">';
echo '<div class="container">';
    echo '<div class="row align-items-center">';
    echo '<div class="col-md-6" data-aos="<?php echo $dataAos; ?>" data-aos-delay="200" style="background:' . $background . '">';
echo '<div class="text-white" style="margin-bottom:-1rem;">';
 echo $content;
echo '</div>';
echo '</div>';

        echo '<div class="col-md-6">';
            echo '<div class="position-relative">';
            echo '<div style="background: #9bbec7;top: -25px;right: 20px;position: absolute;height: 65%;width: 65%;opacity:.25;"></div>';
            echo '<div style="background: #e2c391;width: 25%;height: 90%;position: absolute;bottom: -20px;right: -35px;opacity:85%;z-index: 0 !important;"></div>';
            echo '<div class="position-relative z-1">';
                echo wp_get_attachment_image($image['id'],'full', '',['class'=>'w-100 h-auto img-bg','style'=>'object-fit:contain;top:0;left:0;']);
            echo '</div>';
            echo '</div>';
        echo '</div>';



    echo '</div>';
echo '</div>';



echo '</section>';


endwhile; 
endif;


if(have_rows('sections')):
echo '<div class="position-fixed side-navbar" style="top:25%;right:25px;transform:translate(0, 50%);z-index:2;">';
echo '<ul class="list-unstyled text-right mr-md-4 mr-0">';
$sectionLis = 0;
while(have_rows('sections')): the_row();
$label = get_sub_field('label');
$section = sanitize_title_with_dashes($label);
$rowIndex=get_row_index();

$sectionLis++;
// if($rowIndex == '1'){}

if($sectionLis == 1){
    echo '<li id="anchor-section-' . $section . '" class="mt-2 mb-2 position-relative active">';
    // echo '</li>';
} else {
    echo '<li id="anchor-section-' . $section . '" class="mt-2 mb-2 position-relative">';

}
echo '<a href="#section-' . $section . '" class="pl-md-5 pl-2 pr-2 text-white position-relative h5" style="transition:all .1s ease-in-out;">';
echo $label;
echo '</a>';
echo '</li>';

endwhile;
echo '</ul>';
echo '</div>';

endif;

wp_enqueue_script('about-story-js', get_theme_file_uri('/js/about-story.js'));
    
    endwhile; endif;
} elseif($layout == 'Instagram'){
    if(have_rows('instagram_group')): while(have_rows('instagram_group')): the_row();
echo '<section class="" style="padding:75px 0;">';
    // start of instagram
// query the user media
$fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
$token = $GLOBALS['instagram'];
$limit = 9;

$json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
$json_feed = @file_get_contents($json_feed_url);
$contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);

echo "<div class='container'>";
echo '<div class="row">';
foreach($contents["data"] as $post){

$username = isset($post["username"]) ? $post["username"] : "";
// $likes = isset($post["likes"]) ? $post["likes"] : "";
// $comments = isset($post["comments"]) ? $post["comments"] : "";
$caption = isset($post["caption"]) ? $post["caption"] : "";
$media_url = isset($post["media_url"]) ? $post["media_url"] : "";
$permalink = isset($post["permalink"]) ? $post["permalink"] : "";
$media_type = isset($post["media_type"]) ? $post["media_type"] : "";

echo '<a href="' . $permalink . '" target="_blank" class="col-lg-4 col-md-6 p-1 col-instagram" style="">';
echo '<div class="position-relative" style="overflow:hidden;">';


if($media_type=="VIDEO"){
echo '<video controls  style="height:350px;object-fit:cover;" class="w-100 d-block">';
echo '<source src=' . $media_url . ' type="video/mp4">';
echo 'Your browser does not support the video tag.';
echo '</video>';
}

else{
echo '<img src=' . $media_url . ' class="w-100" style="height:350px;object-fit:cover;" />';
}
echo '<div class="position-absolute w-100 h-100 col-instagram-overlay" style="opacity:0;top:0;left:0;background:black;"></div>';

echo '<div class="text-white position-absolute col-instagram-text" style="top:50%;left:50%;transform:translate(-50%,0%);opacity:0;">View on Instagram</div>';
echo '</div>';
echo '</a>';
// echo '<div class="ig_post_details">';
// echo '<div>';
// echo '<strong>@' . $username . '</strong> ' . $caption . '';
// echo '</div>';
// echo '<div class="ig_view_link">';
// echo '<a href=' . $permalink . ' target="_blank">View on Instagram</a>';
// echo '</div>';
// echo '</div>';

}

echo '</div>';
echo '</div>';
// end of instagram
echo '</section>';
    endwhile; endif;
} elseif ($layout == 'Timeline Carousel'){
    if(have_rows('timeline_carousel_group')): while(have_rows('timeline_carousel_group')): the_row();
    wp_enqueue_style('timeline-carousel', get_theme_file_uri('/css/sections/timeline-carousel.css'));
    echo '<section class="position-relative timeline-carousel-section ' . get_sub_field('classes') . '" style="' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

    // $bgImg = get_sub_field('background_image');

    // if($bgImg){
    //     echo wp_get_attachment_image($bgImg['id'],'full','',[
    //         'class'=>'w-100 h-100 position-absolute bg-img',
    //         'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
    //     ]);
    // }

    if(have_rows('timeline_carousel_repeater')):
    echo '<div class="timeline-carousel owl-carousel owl-theme arrows-middle">';
    while(have_rows('timeline_carousel_repeater')): the_row();
    $image = get_sub_field('image');

    echo '<div class="position-relative col-timeline-carousel" style="padding-top:500px;">';

    echo wp_get_attachment_image($image['id'],'full','',[
        'class'=>'position-absolute w-100 h-100',
        'style'=>'top:0;left:0;'
    ]);

    echo '<div class="position-absolute bg-black w-100 h-100 overlay-hover" style="top:0;left:0;opacity:.75;pointer-events:none;transition:all .25s ease-in-out;"></div>';
    echo '<div class="position-absolute w-100 h-50" style="background: rgb(0,0,0);
    background: linear-gradient(0deg, rgba(0,0,0,1) 45%, rgba(255,255,255,0) 100%);bottom:0;left:0;opacity:.75;pointer-events:none;transition:all .25s ease-in-out;"></div>';
    
    echo '<div class="position-relative p-4 text-white">';
    echo '<h2 class="bold">' . get_sub_field('title') . '</h2>';
    echo get_sub_field('content');
    echo '</div>';
    
    echo '</div>';
    endwhile;
    echo '</div>';
    endif;

    echo '</section>';
    endwhile; endif;

} elseif($layout == 'Courses'){
    if(have_rows('courses_group')): while(have_rows('courses_group')): the_row();
        echo '<section class="position-relative timeline-carousel-section ' . get_sub_field('classes') . '" style="padding:125px 0;background:#fafafa;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

        echo get_template_part('partials/bg-img');

        echo '<div class="container">';

        echo '<div class="row row-content justify-content-center ' . get_sub_field('row_classes') . '" style="' . get_sub_field('row_style') . '">';


        echo get_template_part('partials/content-block');


        if(have_rows('courses_repeater')): 
            while(have_rows('courses_repeater')): the_row();
            $img = get_sub_field('image');
            $link = get_sub_field('link');
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            // echo '<a class="bg-accent btn" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '</a>';

                echo '<a class="col-lg-4 mb-5 courses-col" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">';

                echo '<div class="position-relative h-100 bg-white overflow-h courses-col-hover" style="border-radius:8px;padding-bottom:100px;border:1px solid #fafafa;">';

                    echo wp_get_attachment_image($img['id'],'full','',[
                        'class'=>'w-100',
                        'style'=>'height:200px;object-fit:cover;object-position:top;'
                    ]);

                    echo '<div class="p-4">';
                    echo '<span class="course-title bold">' . esc_html( $link_title ) . '</span>';
                    echo '<div class="text-gray small">';
                    echo get_sub_field('description');
                    echo '</div>';

                    // echo '<div class="position-relative">';
                    echo '<div class="d-flex justify-content-between position-absolute" style="bottom:1.5rem;left:1.5rem;">';
                    echo wp_get_attachment_image(270,'full','',[
                        'class'=>'',
                        'style'=>'width:25px;height:25px;border-radius:50%;'
                    ]);
                    echo '<p class="mb-0 ml-2">Michael Zuber</p>';
                    echo '</div>';

                    echo '<div class="position-absolute" style="bottom:1.5rem;right:1.5rem;">';
                    echo '<span class="course-price"><strong>$</strong>' . get_sub_field('price') . '</span>';
                    echo '</div>';
                    // echo '</div>';

                    echo '</div>';


                echo '</div>';

                echo '</a>';
            endwhile; 
        endif;
        
        echo '</div>';

        echo '</div>';

        echo '</section>';
    endwhile; endif;
} elseif($layout == 'Content Plain'){
    if(have_rows('content_plain_group')): while(have_rows('content_plain_group')): the_row();
        echo '<section class="position-relative timeline-carousel-section ' . get_sub_field('classes') . '" style="padding:125px 0;background:#fafafa;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

        echo get_template_part('partials/bg-img');

        echo '<div class="container">';

        echo '<div class="row row-content justify-content-center ' . get_sub_field('row_classes') . '" style="' . get_sub_field('row_style') . '">';

        echo '<div class="col-lg-9 ' . get_sub_field('column_classes') . '" style="' . get_sub_field('column_style') . '">';

        echo get_sub_field('content');

        echo '</div>';
        echo '</div>';
        echo '</div>';
    echo '</section>';
endwhile; endif;
} elseif($layout == 'Two Columns'){
    if(have_rows('two_columns_group')): while(have_rows('two_columns_group')): the_row();

    echo '<section class="position-relative timeline-carousel-section ' . get_sub_field('classes') . '" style="padding:125px 0;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';

        echo get_template_part('partials/bg-img');

        echo '<div class="container">';

        echo '<div class="row row-content justify-content-center ' . get_sub_field('row_classes') . '" style="' . get_sub_field('row_style') . '">';

        if(have_rows('column_left')): while(have_rows('column_left')): the_row();
        echo '<div class="col-lg-6 ' . get_sub_field('column_classes') . '" style="' . get_sub_field('column_style') . '" data-aos="fade-up">';

        echo get_sub_field('content');

        echo '</div>';
        endwhile; endif;

        if(have_rows('column_right')): while(have_rows('column_right')): the_row();
        echo '<div class="col-lg-6 ' . get_sub_field('column_classes') . '" style="' . get_sub_field('column_style') . '" data-aos="fade-up">';

        echo get_sub_field('content');

        echo '</div>';
        endwhile; endif;



        echo '</div>';
        echo '</div>';
    echo '</section>';

    endwhile; endif;
} elseif( $layout == 'Process' ) {
    if(have_rows('process_group')): while(have_rows('process_group')): the_row();
    
        echo '<section class="position-relative process-section ' . get_sub_field('classes') . '" style="background:#464646;padding:75px 0;border-top:75px solid black;border-bottom:75px solid black;' . get_sub_field('style') . '" id="' . get_sub_field('id') . '">';
    
        echo get_template_part('partials/borders-gold');
    
        $bgImg = get_sub_field('background_image');
    
        if($bgImg){
            echo wp_get_attachment_image($bgImg['id'],'full','',[
                'class'=>'w-100 h-100 position-absolute bg-img',
                'style'=>'top:0;left:0;object-fit:cover;pointer-events:none;'
            ]);
        }
    
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-12 text-center text-white pb-5">';
    
        echo '<div data-aos="fade-up">';
        echo get_sub_field('content_top');
        echo '</div>';
    
        echo '</div>';
        echo '</div>';
    
        // $pages = get_sub_field('pages');
    
        if(have_rows('columns_repeater')):
            echo '<div class="row justify-content-center">';
            $pagesCounter=0;
            while(have_rows('columns_repeater')): the_row();
    
            $pagesCounter++;
            // sprintf("%02d", $pagesCounter)
    
            echo '<div class="col-lg-4 col-md-6 text-white mb-5 col-services" style="text-decoration:none;">';
            echo '<div class="h-100" data-aos="fade-up" data-aos-delay="' . $pagesCounter . '50">';
            // echo '<a href="' . get_the_permalink() . '" class="col-lg-4 col-md-6 text-white mb-5 col-services" style="text-decoration:none;">';
            echo '<div class="position-relative pl-5 pr-5 h-100 col-services-hover" style="padding-top:100px;padding-bottom:100px;">';
    
    
            // start of hover box
            echo '<div class="hover-box bg-accent-dark position-absolute w-100 h-100 z-1 d-flex align-items-center justify-content-center pl-5 pr-5 col-services-hover-content" style="border:6px solid #fbcf02;top:0;left:0;transition:all .25s ease-in-out;">';
    
            echo '<div>';
            echo get_sub_field('content_hover');
            echo '</div>';
    
            echo '</div>';
            // end of hover box
    
    
            echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:0;mix-blend-mode:overlay;opacity:.28;border:2px solid var(--accent-primary);"></div>';
    
            echo '<div class="position-relative pb-3 h-100">';
    
            echo '<span class="cormorant-garamond h1">' . sprintf("%02d", $pagesCounter) . '</span>';
    
            echo '<h3 class="mb-5 d-block coromant-garamond pt-5 pl-5" style="font-size:30px;letter-spacing:0em;">' . get_sub_field('title') . '</h3>';
    
            echo '<span class="mb-5 d-block coromant-garamond pl-5 h4" style="">' . get_sub_field('subtitle') . '</span>';
    
            
    
    
            
            echo '</div>';
    
            echo '<div class="d-flex align-items-end position-absolute">';
            echo '<div style="height: 35px;
            width: 35px;
            border: 1px solid var(--accent-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 15px;">';
            echo '<span class="plus-sign">&plus;</span>';
            echo '</div>';
    
            echo '<div class="position-relative">';
            echo '<h6 class="font-italic">More Information</h6>';
    
            echo '<div class="position-absolute" style="border-bottom:8px solid var(--accent-primary);width:75px;bottom:-15px;left:0;"></div>';
    
            echo '</div>';
            echo '</div>';
    
            echo '</div>';
            echo '</div>';
            echo '</div>'; // end of col
            // echo '</a>';
            endwhile;
                
                echo '</div>';
            endif;
        
            echo '<div class="row">';
        echo '<div class="col-12 text-center pb-5">';
    
        echo '<div data-aos="fade-up">';
        echo get_sub_field('content_bottom');
        echo '</div>';
    
        echo '</div>';
        echo '</div>';
    
        echo '</div>';
        
        echo '</section>';
    
    endwhile; endif;
    } elseif ( $layout == 'Contact' ) {
    echo '<section class="pb-5 position-relative" style="overflow:hidden;padding-top:150px;">';

        echo get_template_part('partials/bg-img');

    echo '<div class="container pb-4">';
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-9">';
    echo '<div class="content position-relative pt-5 pb-5 p-4">';
    echo '<div class="position-absolute bg-white" style="opacity:.75;width:100%;height:100%;top:0;left:0;"></div>';
    echo '<div class="position-relative">';
    if(have_posts()) : while(have_posts()): the_post(); the_content(); endwhile; else:
    echo '<p>Sorry, no posts matched your criteria.</p>';
    endif;
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
    }

endwhile; endif; // end of builder_repeater
?>