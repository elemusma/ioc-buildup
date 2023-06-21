<?php

if(get_field('has_to_sign_up') == 'Yes') {

    if(is_user_logged_in()){
        echo get_template_part('partials/content-builder');
    } else {
        echo get_template_part('partials/sign-up-content');
    }

} else {

    echo get_template_part('partials/content-builder');
    
}

?>