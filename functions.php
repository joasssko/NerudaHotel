<?php if ( function_exists('add_theme_support') ) {
add_theme_support('post-thumbnails');
	//add_image_size('squareBox', 650, 650, true );
	
}
/* 
add_filter('image_size_names_choose', 'my_image_sizes');
	function my_image_sizes($sizes) {
	$addsizes = array(
		"col-6" => 'Media columna'
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
*/
add_post_type_support('page', 'excerpt');
;?>
<?php
/* if(is_single()){
	add_filter( 'show_admin_bar', '__return_false' );
} */
?>
<?php
/* Add support for wp_nav_menu() */
function register_my_menu() {
	register_nav_menu( 'primary', 'Menú principal');
	//register_nav_menu( 'secondary', 'Menú footer');
	//register_nav_menu( 'lang', 'Menú idiomas');
}
add_action( 'init', 'register_my_menu' );
?>
<?php 

function wpcontent_svg_mime_type( $mimes = array() ) {
  $mimes['svg']  = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'wpcontent_svg_mime_type' );

function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img { 
               width: 100% !important; 
               height: auto !important; 
          }
          </style>';
 }
 add_action('admin_head', 'fix_svg');

?>
<?php
function call_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://code.jquery.com/jquery-1.10.0.min.js');
    wp_register_script('core', get_template_directory_uri() . '/js/core.js');

    wp_enqueue_script('jquery');
    wp_enqueue_script('core');
}
 
add_action('wp_enqueue_scripts', 'call_scripts');
?>
<?php

//Post type register


add_action('init', 'hoteles_register');
function galerias_register() {
    $args = array(
        'labels' => array(
                'name' => 'Hoteles',
                'singular_name' => 'Hotel'
            ),
        'public' => true,
		'menu_position' => 5, 
        '_builtin' => false,
        'capability_type' => 'post',
		'has_archive' => 'hoteles',
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'hoteles'),
        'supports' => array('title', 'editor' , 'excerpt' , 'thumbnail' )
    );
    register_post_type('hoteles', $args);
    flush_rewrite_rules();
}

/* add_action('init', 'videos_register');
function videos_register() {
    $args = array(
        'labels' => array(
                'name' => 'Videos',
                'singular_name' => 'Video'
            ),
        'public' => true,
		'menu_position' => 5, 
        '_builtin' => false,
        'capability_type' => 'post',
		'has_archive' => 'false',
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'videos'),
        'supports' => array('title', 'editor' , 'excerpt' , 'thumbnail' )
    );
    register_post_type('videos', $args);
    flush_rewrite_rules();
} */


//register_taxonomy("regiones", array('rutas'), array("hierarchical" => true, "label" => "Regiones", "singular_label" => "Región", "rewrite" => true));


/* add_action('wp_ajax_cargaGaleria', 'cargaGaleria');
add_action('wp_ajax_nopriv_cargaGaleria', 'cargaGaleria');
function cargaGaleria(){
	
	$id = $_GET['id'];
	
	$galeria = get_field('galeria' , $id);
	
	foreach($galeria as $image): ?>
		
		<div class="col-md-3 col-esp col-xs-6 col-sm-4">
			<a class="galeria-<?php echo $id ?>" href="<?php echo $image['url']?>" rel="shadowbox['galeria-<?php echo $id ?>']"><img src="<?php echo $image['sizes']['squareBox']?>" alt="" class="img-responsive"></a>
			
		</div>
		
	<?php endforeach;
	
	die;
} */


?>
<?php 
function my_custom_login_logo() {
    echo '<style type="text/css">
		body{ background-color:#3a3a3a;}
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important;
		background-size: 120px;
		height: 120px;
		margin: 0px auto 0px;
		width: 120px;
	}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');?>
<?php 
function SuperAdmin() {
	echo '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">';
	//echo '<link href="'.get_bloginfo('template_directory').'/admin/bootstrap.css" rel="stylesheet">';
	/* echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,800,400' rel='stylesheet' type='text/css'>" */;
	echo '<style type="text/css">
	/* body{ font-family: Open sans, helvetica neue, helvetica, arial , sans-serif} */
	.wp-admin #adminmenu, .wp-admin #adminmenuback, .wp-admin #adminmenuwrap{ background-color:#006893 !important}
	#adminmenu .wp-has-current-submenu .wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open, #adminmenu .wp-has-current-submenu.opensub .wp-submenu, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu, .no-js li.wp-has-current-submenu:hover .wp-submenu{background-color:#2c3e50 !important}
	.wp-core-ui .button-primary{background-color:#0073aa !important;}
    #adminmenu li .awaiting-mod span, #adminmenu li span.update-plugins span {display: block; padding: 0 6px; background-color: #2c3e50; border-radius: 50%; }
	</style>';
}
add_action('admin_head', 'SuperAdmin');
?>
<?php 
/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
?>
<?php 
//add_filter( 'jpeg_quality', create_function( '', 'return 75;' ) );



// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

return $headers;
}


?>
<?php add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );?>