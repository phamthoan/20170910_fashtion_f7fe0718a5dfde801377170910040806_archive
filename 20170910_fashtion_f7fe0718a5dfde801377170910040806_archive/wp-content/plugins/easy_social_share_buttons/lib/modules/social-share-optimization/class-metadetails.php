<?php
/**
 * @package EasySocialShareButtons\SocialShareOptimization
 * @author appscreo
 * @since 4.2
 * @version 4.0
 *
 * Generate and store require from social share optimization tags post details: title,
 * description and image
 */


class ESSB_FrontMetaDetails {

	/**
	 * Title
	 * @var string
	 */
	public $title = null;
	
	/**
	 * Description
	 * @var string
	 */
	public $description = null;
	
	/**
	 * Image URL
	 * @var string
	 */
	public $image = null;
	
	/**
	 * URL
	 * @var string
	 */
	public $url = null;

	
	public static $instance;
	
	public function __construct() {

		// code runs only when we are not inside WordPress administration
		if (!is_admin()) {
			// stop Jetpack tags
			if (class_exists ( 'JetPack' )) {
				add_filter ( 'jetpack_enable_opengraph', '__return_false', 99 );
				add_filter ( 'jetpack_enable_open_graph', '__return_false', 99 );
			}
			
			// try to stop Yoast SEO from generating double tags
			if (defined('WPSEO_VERSION')) {
				global $wpseo_og;
				if (isset($wpseo_og)) {
					remove_action( 'wpseo_head', array( $wpseo_og, 'opengraph' ), 30 );
				}
			}
		}
	}	
	
	public static function get_instance() {
		if ( ! ( self::$instance instanceof self ) ) {
			self::$instance = new self();
		}
	
		return self::$instance;
	}
	
	/**
	 * Detect running WordPress SEO plugin to get settings that are set for SEO on post
	 * 
	 * @return boolean
	 */
	public function wpseo_detected () {
		return defined('WPSEO_VERSION') ? true: false;
	}
	
	/**
	 * Generate title
	 * 
	 * @return string
	 */
	public function title() {
		
		if (!isset($this->title)) {
			if (is_front_page()) {
				$this->title = essb_option_value('sso_frontpage_title');
			}
			else if (is_single () || is_page ()) {
				 $this->title = get_post_meta ( get_the_ID(), 'essb_post_og_title', true );
				 
				 // import SEO details
				 if (empty($this->title) && $this->wpseo_detected()) {
				 	$this->title = get_post_meta( get_the_ID(), '_yoast_wpseo_opengraph-title' , true );
				 }
				 if (empty($this->title) && $this->wpseo_detected()) {
				 	$this->title = get_post_meta( get_the_ID(), '_yoast_wpseo_title' , true );
				 }
				 
				 if (empty($this->title)) {
				 	$this->title = trim( essb_core_convert_smart_quotes( htmlspecialchars_decode(get_the_title ())));;
				 }
			}
			else {
				$this->title = get_bloginfo('name');
			}
		}
		
		return $this->title;
	}
	
	/**
	 * Generate URL
	 * 
	 * @return string
	 */
	public function url() {
		if (!isset($this->url)) {
			if (is_front_page()) {
				$this->url = get_bloginfo('url');
			}
			else if (is_single () || is_page ()) {
				$this->url = get_permalink(get_the_ID());
			}
			else {
				$this->url = get_bloginfo('url');
			}
		}
		
		return $this->url;
	}
	
	/**
	 * Generate description
	 * 
	 * @return string
	 */
	public function description() {
		if (!isset($this->description)) {
			if (is_front_page()) {
				$this->description = essb_option_value('sso_frontpage_description');
			}
			else if (is_single () || is_page ()) {
				 $this->description = get_post_meta ( get_the_ID(), 'essb_post_og_desc', true );
				 
				 // import SEO details
				 if (empty($this->description) && $this->wpseo_detected()) {
				 	$this->description = get_post_meta( get_the_ID(), '_yoast_wpseo_opengraph-description' , true );
				 }
				 if (empty($this->title) && $this->wpseo_detected()) {
				 	$this->description = get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc' , true );
				 }
				 
				 if (empty($this->description)) {
				 	easy_share_deactivate();
				 	$this->description = trim( essb_core_convert_smart_quotes( htmlspecialchars_decode(essb_core_get_post_excerpt(get_the_ID()))));
				 	easy_share_reactivate();
				 }
			}
			else {
				$this->description = get_bloginfo('description');
			}
		}
		
		return $this->description;
	}
	
	/**
	 * Generate Image
	 * 
	 * @return string
	 */
	public function image() {
		if (!isset($this->image)) {
			if (is_front_page()) {
				$this->image = essb_option_value('sso_frontpage_image');
			}
			else if (is_single () || is_page ()) {
				$this->image = get_post_meta ( get_the_ID(), 'essb_post_og_image', true );
					
				// import SEO details
				if (empty($this->image) && $this->wpseo_detected()) {
					$this->image = get_post_meta( get_the_ID(), '_yoast_wpseo_opengraph-image' , true );
				}

				if (empty($this->image)) {
					$this->image = essb_core_get_post_featured_image(get_the_ID());
				}
			}
			else {
				$this->image = essb_option_value('sso_frontpage_image');
			}
		}
		
		return $this->image;
	}
	
	/**
	 * Generate additional images that customer can choose on post
	 * @return array
	 */
	public function additional_images() {
		$image_list = array();
		
		if (is_single () || is_page ()) {
			$fb_image1 = get_post_meta ( get_the_ID(), 'essb_post_og_image1', true );
			$fb_image2 = get_post_meta ( get_the_ID(), 'essb_post_og_image2', true );
			$fb_image3 = get_post_meta ( get_the_ID(), 'essb_post_og_image3', true );
			$fb_image4 = get_post_meta ( get_the_ID(), 'essb_post_og_image4', true );
			
			if (!empty($fb_image1) && is_string($fb_image1)) {
				$image_list[] = $fb_image1;
			}

			if (!empty($fb_image2) && is_string($fb_image2)) {
				$image_list[] = $fb_image2;
			}
			
			if (!empty($fb_image3) && is_string($fb_image3)) {
				$image_list[] = $fb_image3;
			}
				
			if (!empty($fb_image4) && is_string($fb_image4)) {
				$image_list[] = $fb_image4;
			}
				
		}
		
		return $image_list;
	}
}