$('.content-image-carousel').owlCarousel({
    // center: true,
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    // autoHeight: false,
    // autoHeightClass: 'owl-height',
    // stagePadding:170,
    autoplay: true,
    autoplayTimeout: 3500,
    autoplaySpeed: 5000, // this seems to make it autoscroll
    autoplayHoverPause: false,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    // navText : ["<img src='/wp-content/uploads/2021/07/Arrow-Left-Blair-ITC.png' />","<img src='/wp-content/uploads/2021/07/Arrow-Right-Blair-ITC.png' />"],
    items: 1
    // responsive: {
    //     0: {
    //         items: 2
    //     },
    //     600: {
    //         items: 3
    //     },
    //     1000: {
    //         items: 4
    //     }
    // }
});

$('.timeline-carousel').owlCarousel({
    // center: true,
    loop: true,
    margin: 0,
    nav: true,
    dots: false,
    // autoHeight: false,
    // autoHeightClass: 'owl-height',
    // stagePadding:170,
    autoplay: false,
    autoplayTimeout: 3500,
    autoplaySpeed: 5000, // this seems to make it autoscroll
    autoplayHoverPause: false,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    // navText : ["<img src='/wp-content/uploads/2021/07/Arrow-Left-Blair-ITC.png' />","<img src='/wp-content/uploads/2021/07/Arrow-Right-Blair-ITC.png' />"],
    // items: 1
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2,
            slideBy: 2
        },
        1000: {
            items: 3,
            slideBy: 3
        }
    }
});