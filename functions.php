<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
function blossom_coach_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Blossom Coach, use a find and replace
     * to change 'blossom-coach' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'blossom-coach', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'blossom-coach' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'blossom_coach_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 70,
        'width'       => 70,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description'
        ) ) );

    /**
     * Add support for custom header.
     */
    add_theme_support( 'custom-header', apply_filters( 'blossom_coach_custom_header_args', array(
        'default-image'  => esc_url( get_template_directory_uri() . '/images/banner-img.jpg' ),
        'video'          => true,
        'header-text'    => false,
    ) ) );

    register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/images/banner-img.jpg',
            'thumbnail_url' => '%s/images/banner-img.jpg',
            'description'   => __( 'Default Header Image', 'blossom-coach' ),
        ),
    ) );

    /**
     * Add Custom Images sizes.
     */
    add_image_size( 'blossom-coach-schema', 600, 60 );
    add_image_size( 'blossom-coach-slider', 1920, 700, true );
    add_image_size( 'blossom-coach-fullwidth', 1170, 578, true );
    add_image_size( 'blossom-coach-with-sidebar', 810, 500, true );
    add_image_size( 'blossom-coach-latest', 540, 400, true );

    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array( 'home', 'blog' ),

        // Default to a static front page and assign the front and posts pages.
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'primary' => array(
                'name' => __( 'Primary', 'blossom-coach' ),
                'items' => array(
                    'page_home',
                    'page_blog'
                )
            )
        ),
    );

    $starter_content = apply_filters( 'travel_agency_starter_content', $starter_content );

    add_theme_support( 'starter-content', $starter_content );

    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add theme support for excerpt
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'blossom_coach_setup' );
/**
 *	After theme Setup Hook
 */
function blossom_health_coach_theme_setup() {
	/**
	* Make child theme available for translation.
    * Translations can be filed in the /languages/ directory.
	*/
	load_child_theme_textdomain( 'blossom-health-coach', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'blossom_health_coach_theme_setup' );
/**
 * Dequeue unwanted plugin scripts and styles
 *
 */

/**
 *
 * function mfi_disable_scripts_styles() {

    wp_dequeue_script('font-awesome');
    wp_dequeue_script('v4-shims');

}
add_action('wp_print_scripts', 'mfi_disable_scripts_styles', 100);
 **/
/**
 * Enqueue scripts and styles.
 */

function blossom_health_coach_scripts() {
    wp_dequeue_script('blossom-coach-modal-js');
	if( blossom_coach_is_woocommerce_activated() ){
        $dependencies = array( 'blossom-coach-woocommerce', 'owl-carousel', 'animate', 'blossom-coach-google-fonts' );    
    }else{
        $dependencies = array( 'owl-carousel', 'animate', 'blossom-coach-google-fonts' );
    }
        
    wp_enqueue_style( 'blossom-health-coach-parent-style', get_template_directory_uri() . '/style.css', $dependencies );
    if ( is_front_page() ) {
        wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/slick/slick.css');
        wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css');
        /*wp_enqueue_style('parallax-theme', get_stylesheet_directory_uri() . '/locomotive/locomotive-scroll.css');*/
        wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/slick/slick.min.js', array(jquery), '1.0.0', true);
        wp_enqueue_script('parallax', get_stylesheet_directory_uri() . '/js/parlx.js', array(jquery),'2.0.4', true);
    }
}
add_action( 'wp_enqueue_scripts', 'blossom_health_coach_scripts' );

//Remove a function from the parent theme
function blossom_health_coach_remove_parent_filters(){ //Have to do it after theme setup, because child theme functions are loaded first
    remove_action( 'wp_enqueue_scripts', 'blossom_coach_dynamic_css', 99 );
    remove_action( 'customize_register', 'blossom_coach_customizer_theme_info' );
}
add_action( 'init', 'blossom_health_coach_remove_parent_filters' );

function blossom_health_coach_customize_register( $wp_customize ){

	/* THEME INFO */
	$wp_customize->add_section( 'theme_info', array(
		'title'       => __( 'Demo & Documentation' , 'blossom-health-coach' ),
		'priority'    => 6,
	) );
    
    /** Important Links */
	$wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
	$theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'blossom-health-coach' ),  '<a href="' . esc_url( 'https://blossomthemes.com/theme-demo/?theme=blossom-health-coach' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'blossom-health-coach' ),  '<a href="' . esc_url( 'https://docs.blossomthemes.com/docs/blossom-health-coach/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

	$wp_customize->add_control( new Blossom_Coach_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );

    /** Site Title Font */
    $wp_customize->add_setting( 
        'site_title_font', 
        array(
            'default' => array(                                         
                'font-family' => 'Montserrat',
                'variant'     => '700',
            ),
            'sanitize_callback' => array( 'Blossom_Coach_Fonts', 'sanitize_typography' )
        ) 
    );

    $wp_customize->add_control( 
        new Blossom_Coach_Typography_Control( 
            $wp_customize, 
            'site_title_font', 
            array(
                'label'       => __( 'Site Title Font', 'blossom-health-coach' ),
                'description' => __( 'Site title and tagline font.', 'blossom-health-coach' ),
                'section'     => 'title_tagline',
                'priority'    => 60, 
            ) 
        ) 
    );
    
    /** Site Title Font Size*/
    $wp_customize->add_setting( 
        'site_title_font_size', 
        array(
            'default'           => 40,
            'sanitize_callback' => 'blossom_coach_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Slider_Control( 
            $wp_customize,
            'site_title_font_size',
            array(
                'section'     => 'title_tagline',
                'label'       => __( 'Site Title Font Size', 'blossom-health-coach' ),
                'description' => __( 'Change the font size of your site title.', 'blossom-health-coach' ),
                'priority'    => 65,
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 200,
                    'step'  => 1,
                )                 
            )
        )
    );

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'blossom-health-coach' ),
            'priority' => 20,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Open Sans',
			'sanitize_callback' => 'blossom_coach_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Coach_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'blossom-health-coach' ),
                'description' => __( 'Primary font of the site.', 'blossom-health-coach' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_coach_get_all_fonts(),	
     		)
		)
	);
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'blossom_coach_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Coach_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'blossom-health-coach' ),
                'description' => __( 'Secondary font of the site.', 'blossom-health-coach' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_coach_get_all_fonts(),	
     		)
		)
	);

	$wp_customize->add_section( 'top_banner', array(
        'title'       => __( 'Top Banner' , 'blossom-health-coach' ),
        'priority'    => 55,
    ));

    $wp_customize->add_setting( 'top_banner_text' , array(
        'default'   => '',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_banner_text', array(
        'label'      => __( 'Top Banner Text', 'blossom-health-coach' ),
        'section'    => 'top_banner',
        'settings'   => 'top_banner_text',
        'type'       => 'text',
    ) ) );
}
add_action( 'customize_register', 'blossom_health_coach_customize_register', 40 );

function blossom_health_coach_remove_header_customize_register() {     
    global $wp_customize;
    $wp_customize->remove_setting( 'phone' );
    $wp_customize->remove_control( 'phone' );

    $wp_customize->remove_setting( 'email' );     
    $wp_customize->remove_control( 'email' );   
} 
add_action( 'customize_register', 'blossom_health_coach_remove_header_customize_register', 1000 );

function blossom_coach_page_start(){
    ?>
    <div class="top-banner-text">
        <p class="top-banner-wrapper"><?php echo wp_kses_post(get_theme_mod('top_banner_text')); ?></p>
    </div>
    <div id="page" class="site"><a aria-label="<?php esc_attr_e( 'skip to content', 'blossom-coach' ) ; ?>" class="skip-link" href="#content"><?php esc_html_e( 'Skip to Content', 'blossom-coach' ); ?></a>
    <?php
}
add_action( 'blossom_coach_before_header', 'blossom_coach_page_start', 20 );

function blossom_health_coach_site_branding() {
	$site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );
    $branding_class = '';
    if( has_custom_logo() || $site_title || $site_description || $header_text ) : 
        if( has_custom_logo() && ( $site_title || $site_description ) && $header_text ) {
            $branding_class = ' icon-text';
        }else{
            $branding_class = '';
        } ?>
		<div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="http://schema.org/Organization">
            <?php 
            if( has_custom_logo() ){
                echo '<div class="site-logo">';
                the_custom_logo();
                echo '</div><!-- .site-logo -->';
            } 
            ?>
            <?php if( $site_title || $site_description ) :
			    echo '<div class="site-title-wrap">';
				if ( is_front_page() ) : ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php endif; 
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php
                }
                echo '</div>';
            endif; ?>
        </div><!-- .site-branding -->
    <?php endif;
}

function blossom_coach_header(){     
    $ed_cart   = get_theme_mod( 'ed_shopping_cart', true ); 
    $ed_search = get_theme_mod( 'ed_header_search', false );
    ?>
    <header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader"> 
        <div class="header-t">
			<div class="wrapper">
				<div class="header-social">
					<?php 
						if( blossom_coach_social_links( false ) ){
	                		blossom_coach_social_links( true ); 
	                	} 
                	?>
				</div>
			<?php                
                
                blossom_health_coach_site_branding(); 
            
                echo '<div class="top-right">';
                if( $ed_search ) { ?> 
                	<div class="header-search">
				        <button aria-label="header search toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false"><i class="fa fa-search"></i></button>
				        <div class="header-search-form search-modal cover-modal" data-modal-target-string=".search-modal">
                            <div class="header-search-inner-wrap">
				                <?php get_search_form(); ?>
                                <button aria-label="search form close" class="close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false"></button>
                            </div>
				        </div><!-- .header-search-form -->
				    </div><!-- .header-search -->
                <?php } 
                if( blossom_coach_is_woocommerce_activated() && $ed_cart ) blossom_coach_wc_cart_count();
                echo '</div>';
            ?>
			</div><!-- .wrapper -->            				 
		</div><!-- .header-t -->

		<div class="main-header">
			<div class="wrapper">
				<div class="menu-wrap">
					<nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <button type="button" class="new-toggle-button" aria-expanded="false">
                            <span class="toggle-bar"></span>
                            <span class="toggle-bar"></span>
                            <span class="toggle-bar"></span>
                        </button>
                        <div class="primary-menu-list">
                            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'blossom-health-coach' ); ?>">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'primary',
                                        'menu_id'        => 'primary-menu',
                                        'menu_class'     => 'menu main-menu-modal',
                                        'fallback_cb'    => 'blossom_coach_primary_menu_fallback',
                                    ) );
                                ?>
                            </div>
                        </div>
                    </nav><!-- #site-navigation -->	
				</div>
			</div>
		</div>  
	</header><!-- .site-header -->
    <?php 
}

/** Overwriting Testimonial Widget */
add_filter( 'blossom_testimonial_widget_filter', 'blossom_health_testimonial_widget', 10, 3);
function blossom_health_testimonial_widget( $html, $args, $instance ){
	$obj = new BlossomThemes_Toolkit_Functions();
    $name   = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
    $designation   = ! empty( $instance['designation'] ) ? $instance['designation'] : '' ;        
    $testimonial = ! empty( $instance['testimonial'] ) ? $instance['testimonial'] : '';
	$image   = ! empty( $instance['image'] ) ? $instance['image'] : '';
	if( $image ){
            /** Added to work for demo testimonial compatible */
            $attachment_id = $image;
            if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
                $attachment_id = $obj->bttk_get_attachment_id( $image );
            }

            $icon_img_size = apply_filters('bttk_testimonial_icon_img_size','thumbnail');
            $image_array   = wp_get_attachment_image_src( $attachment_id, $icon_img_size);
            $image         = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_array[0]);
            $fimg_url      = $image_array[0]; 
    }
	?>
	<div class="bttk-testimonial-holder">
        <div class="bttk-testimonial-inner-holder">
            <?php if( $image ) { ?>
                <div class="img-holder">
                    <img src="<?php echo esc_url( $fimg_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
                </div>
            <?php } ?>

			<div class="testimonial-meta">
               <?php 
                    if( $name ) echo '<span class="name">' . esc_html( $name ) . '</span>';
                    if( isset( $designation ) && $designation!='' ){
                        echo '<span class="designation">' . esc_html( $designation ) . '</span>';
                    }
                ?>
            </div> 

            <div class="text-holder">                                                     
                <?php if( $testimonial ) echo '<div class="testimonial-content">' . wpautop( wp_kses_post( $testimonial ) ) . '</div>'; ?>
            </div>
        </div>
    </div>
<?php
}
// Add Customize Script
function blossom_health_coach_customize_script(){
    wp_enqueue_script( 'blossom-health-coach-customize', get_stylesheet_directory_uri() . '/js/customize.js', array( 'jquery', 'customize-controls', 'blossom-coach-customize' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blossom_health_coach_customize_script', 20 );

function blossom_coach_get_home_sections(){
    $ed_banner = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $sections = array( 
    	'service'     => array( 'sidebar' => 'service' ),       
        'about'       => array( 'sidebar' => 'about' ),
        'cta'         => array( 'sidebar' => 'cta' ),
        'testimonial' => array( 'sidebar' => 'testimonial' ),
        'client'      => array( 'sidebar' => 'client' ),
        'blog'        => array( 'section' => 'blog' ),
        'simple-cta'  => array( 'sidebar' => 'simple-cta' ),
        'contact'     => array( 'sidebar' => 'contact' ),
        'top-banner'  => array( 'sidebar' => 'top-banner' ),
    );
    
    $enabled_section = array();
    
    if( $ed_banner == 'static_nl_banner' || $ed_banner == 'slider_banner' ) array_push( $enabled_section, 'banner' );
    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
            if( get_theme_mod( 'ed_' . $v['section'] . '_section', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }  
    
    return apply_filters( 'blossom_coach_home_sections', $enabled_section );
}

/** Blossom Coach Fonts URL */
function blossom_coach_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'Open Sans' );
    $ig_primary_font    = blossom_coach_is_google_font( $primary_font );    
    $secondary_font     = get_theme_mod( 'secondary_font', 'Montserrat' );
    $ig_secondary_font  = blossom_coach_is_google_font( $secondary_font );    
    $site_title_font    = get_theme_mod( 'site_title_font', array( 'font-family'=>'Montserrat', 'variant'=>'700' ) );
    $ig_site_title_font = blossom_coach_is_google_font( $site_title_font['font-family'] );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'blossom-health-coach' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'blossom-health-coach' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'blossom-health-coach' );
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = blossom_coach_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
         
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = blossom_coach_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            
            if( ! empty( $site_title_font['variant'] ) ){
                $site_title_var = ':' . blossom_coach_check_varient( $site_title_font['font-family'], $site_title_font['variant'] );    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font['font-family'] . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
     
    return esc_url_raw( $fonts_url );
}

/** Blossom Health Coach Dynamic CSS */
function blossom_health_coach_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Open Sans' );
    $primary_fonts   = blossom_coach_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Montserrat' );
    $secondary_fonts = blossom_coach_get_fonts( $secondary_font, 'regular' );    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Montserrat', 'variant'=>'700' ) );
    $site_title_fonts     = blossom_coach_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 40 );
    
    $custom_css = '';
    $custom_css .= '
    
    /*Typography*/
    body,
    button,
    input,
    select,
    optgroup,
    textarea, section[class*="-section"] .widget_blossom_client_logo_widget .widget-title, .widget.widget_blossomthemes_stat_counter_widget .widget-title, .single .entry-meta, 
    .portfolio-text-holder .portfolio-img-title, 
    .widget_blossomtheme_featured_page_widget .featured_page_content h1, .widget_blossomtheme_featured_page_widget .featured_page_content h3, .widget_blossomtheme_featured_page_widget .featured_page_content h4, .widget_blossomtheme_featured_page_widget .featured_page_content h5, .widget_blossomtheme_featured_page_widget .featured_page_content h6 {
        font-family : ' . wp_kses_post( $primary_fonts['font'] ) . ';
    }
    
    .site-title, 
    .site-title-wrap .site-title{
        font-size   : ' . absint( $site_title_font_size ) . 'px;
        font-family : ' . wp_kses_post( $site_title_fonts['font'] ) . ';
        font-weight : ' . esc_html( $site_title_fonts['weight'] ) . ';
        font-style  : ' . esc_html( $site_title_fonts['style'] ) . ';
    }
    
    /*Typography*/
    h1, h2, h3, h4, h5, h6, 
    section[class*="-section"] .widget .widget-title,
    section[class*="-section"] .widget_blossomtheme_featured_page_widget .section-subtitle,
    .section-title, .comment-body b.fn, .comment-body .reply .comment-reply-link, .single .navigation .nav-links, 
    .site-header .header-search label.screen-reader-text, .btn-readmore, .btn-readmore:visited, .bttk-testimonial-holder .name, 
    .pricing-block .price, .entry-meta, #primary .widget_blossomtheme_featured_page_widget .section-subtitle, 
    .widget_blossomthemes_stat_counter_widget .hs-counter, .widget_bttk_description_widget .bttk-team-holder .name, 
    .bttk-team-inner-holder-modal .name, .page-header .subtitle, .dropcap, .error-404 .error-num, .error-404 a.bttn, 
    .related-portfolio-title,
    .woocommerce div.product form.cart .single_add_to_cart_button, .woocommerce div.product .cart .single_add_to_cart_button.alt,
    .button-wrap a,
    .banner-caption .blossomthemes-email-newsletter-wrapper form input[type="submit"], 
    .main-navigation ul li, .blog-section article .entry-meta, .btn-link, 
    button, input[type="button"], input[type="reset"], input[type="submit"] {
		font-family: ' . wp_kses_post( $secondary_fonts['font'] ) .';
	}';
    
    if( blossom_coach_is_woocommerce_activated() ) {
    	$custom_css .=' .woocommerce div.product .product_title,
    	.woocommerce div.product .woocommerce-tabs .panel h2{
			font-family: ' . wp_kses_post( $secondary_fonts['font'] ) . ';
    	}';    
    }
    
    wp_add_inline_style( 'blossom-coach', $custom_css );       
}

function blossom_coach_footer_bottom(){ ?>
<div class="bottom-footer">
    <div class="wrapper">
        <div class="header-social">
            <?php
            if( blossom_coach_social_links( false ) ){
                blossom_coach_social_links( true );
            }
            ?>
        </div>
        <div class="footer-copyright">
            <p>&copy;<span class="copy-year"><?php echo date("Y"); ?></span> <span class="copy-owner">FLOW</span></p>
        </div>
    </div>
</div>

<?php }

add_action( 'wp_enqueue_scripts', 'blossom_health_coach_dynamic_css', 100 );

/**
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

/**
 * Adds webp filetype to allowed mimes
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}
add_action( 'after_setup_theme', 'bkw_theme_setup' );
function bkw_theme_setup() {
    add_image_size( 'flow-logo-thumb', 360 ); // 300 pixels wide (and unlimited height)
}
/**
 * Content Start
 */
function blossom_coach_content_start(){
    $home_sections = blossom_coach_get_home_sections();



    if( !( is_front_page() && ! is_home() && $home_sections ) ){ ?>
        <div id="content" class="site-content">
        <?php
        if ( ! is_front_page() && ! is_home() ) blossom_coach_breadcrumb();
        if( is_archive() || is_search() ){ ?>
            <header class="page-header">
                <div class="wrapper">
                    <?php
                    if( is_archive() ){
                        if( is_author() ){ ?>
                            <div class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
                            <div class="author-content-wrap">
                                <h1 class="page-title">
                                    <?php printf( esc_html__( 'All posts by %1$s%2$s%3$s', 'blossom-coach' ), '<span class="vcard">', esc_html( get_the_author_meta( 'display_name' ) ), '</span>' );?>
                                </h1>
                            </div>
                            <?php
                        }else{
                            the_archive_title();
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        }
                    }

                    if( is_search() ){
                        echo '<h1 class="page-title">' . esc_html__( 'You Are Looking For', 'blossom-coach' ) . '</h1>';
                        get_search_form();
                    }
                    ?>
                </div><!-- .wrapper -->
            </header><!-- .page-header -->
            <?php
        } ?>
        <div class="wrapper">
        <?php
    }
}

function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );