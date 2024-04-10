$(document).ready(function () {
    $(".banner-home").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1000,
        navText: [
            `
      <svg width="60" height="100" viewBox="0 0 60 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g opacity="0.5">
        <rect opacity="0.2" width="60" height="100" fill="black"/>
        <g clip-path="url(#clip0_3953_599)">
        <rect width="24" height="24" transform="translate(18 38)" fill="white" fill-opacity="0.01"/>
        <path d="M35.6792 42.1325V40.0619C35.6792 39.8825 35.473 39.7833 35.3337 39.8932L23.2587 49.3244C23.1561 49.4042 23.0731 49.5064 23.016 49.6231C22.9589 49.7399 22.9292 49.8681 22.9292 49.9981C22.9292 50.128 22.9589 50.2563 23.016 50.373C23.0731 50.4898 23.1561 50.592 23.2587 50.6717L35.3337 60.103C35.4756 60.2128 35.6792 60.1137 35.6792 59.9342V57.8637C35.6792 57.7325 35.6176 57.6066 35.5158 57.5262L25.873 49.9994L35.5158 42.47C35.6176 42.3896 35.6792 42.2637 35.6792 42.1325Z" fill="white"/>
        </g>
        </g>
        <defs>
        <clipPath id="clip0_3953_599">
        <rect width="24" height="24" fill="white" transform="translate(18 38)"/>
        </clipPath>
        </defs>
      </svg>
      `,
            `
      <svg width="60" height="100" viewBox="0 0 60 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.2" width="60" height="100" fill="black"/>
        <g clip-path="url(#clip0_3953_604)">
        <rect width="24" height="24" transform="translate(18 38)" fill="white" fill-opacity="0.01"/>
        <path d="M36.7955 49.3256L24.7205 39.8943C24.689 39.8695 24.6511 39.8541 24.6111 39.8498C24.5712 39.8455 24.5309 39.8526 24.4948 39.8703C24.4587 39.8879 24.4283 39.9153 24.4071 39.9494C24.386 39.9835 24.3748 40.0229 24.375 40.0631V42.1336C24.375 42.2649 24.4366 42.3908 24.5384 42.4711L34.1813 50.0006L24.5384 57.5301C24.4339 57.6104 24.375 57.7363 24.375 57.8676V59.9381C24.375 60.1176 24.5813 60.2167 24.7205 60.1068L36.7955 50.6756C36.8982 50.5955 36.9812 50.4931 37.0383 50.3762C37.0954 50.2592 37.1251 50.1308 37.1251 50.0006C37.1251 49.8704 37.0954 49.742 37.0383 49.625C36.9812 49.5081 36.8982 49.4057 36.7955 49.3256Z" fill="white"/>
        </g>
        <defs>
        <clipPath id="clip0_3953_604">
        <rect width="24" height="24" fill="white" transform="translate(18 38)"/>
        </clipPath>
        </defs>
      </svg>


      `,
        ],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });
    AOS.init();
    $(document).ready(function () {
        var owl = $(".slider_banner_homepage");
        owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            nav: true,
        });
        $(".play").on("click", function () {
            owl.trigger("play.owl.autoplay", [1000]);
        });
        $(".stop").on("click", function () {
            owl.trigger("stop.owl.autoplay");
        });

        $(".product_cate1_slider").owlCarousel({
            items: 5,
            loop: false,
            margin: 5,
            nav: true,
            navText: [
                "<img src='/images/HomePage/chevron_left.svg'>",
                "<img src='/images/HomePage/chevron_right.svg'>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 5,
                },
            },
        });
    });

    $(".product_slider_cell").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1500,
        autoplayTimeout: 8000,
        autoplayHoverPause: true,
        navText: [
            '<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>',
        ],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });
});
