<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Coach
 */
    
    /**
     * After Content
     * 
     * @hooked blossom_coach_content_end        - 20
     * @hooked blossom_coach_newsletter_section - 25
    */
    do_action( 'blossom_coach_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked blossom_coach_footer_start  - 20
     * @hooked blossom_coach_footer_top    - 30
     * @hooked blossom_coach_footer_bottom - 40
     * @hooked blossom_coach_back_to_top   - 45
     * @hooked blossom_coach_footer_end    - 50
    */
    do_action( 'blossom_coach_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_coach_page_end - 20
    */
    do_action( 'blossom_coach_after_footer' );

    wp_footer();
    ?>
<?php
if ( is_front_page() ) {
    ?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        var viewHt = $(window).height(),
            viewWd = $(window).width();
        console.log(viewHt + ' height' + viewWd + 'width');
        $('.testimonial-section .wrapper').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            dots:true,
            nextArrow: false,
            prevArrow: false,
            slidesToShow: 3,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }
            ]
        });
        if ( viewWd < 1024 ) {
            $('.parallax').parlx({
                settings: {
                    height: viewHt,
                },
            });
        } else {
            $('.parallax').parlx({
                settings: {
                    height: 700,
                },
            });
        }
    });
</script>
<?php
}
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.new-toggle-button').click(function() {
            $(this).toggleClass('active');
            $('.primary-menu-list').toggleClass('active');
        });
    });
</script>
</body>
</html>