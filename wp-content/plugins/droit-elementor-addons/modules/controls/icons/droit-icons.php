<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */

namespace DROIT_ELEMENTOR\Module\Controls\Icons;

defined( 'ABSPATH' ) || exit;

class Droit_Icons{

	 /**
     * Constructor
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
	public function __construct(){
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, '__droit_icon_font']);
		//self::__generate_font();
	}

	/**
     * Icons
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
	public function __droit_icon_font( $font ){
        $custom_fonts['dlicons'] = [
			'name' => 'dlicons',
			'label' => __( 'Droit - Icons', 'droit-elementor-addons' ),
			'url' => droit_addons_protocol( 'modules/controls/icons/assets/dlicons.css' ),
			'prefix' => 'dlicon-',
			'displayPrefix' => 'dlicon',
			'labelIcon' => 'dlicon dlicon-DL',
			'ver' => DROIT_EL_ADDONS_VERSION,
			'fetchJson' => droit_addons_protocol( 'modules/controls/icons/assets/dlicons.js' ),
			'native' => true,
		];
        return  array_merge($font, $custom_fonts);
    }

    public static function __generate_font(){
    	$css_source = '';
        global $wp_filesystem;
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
        $css_file =  DROIT_EL_ADDONS_DIR_PATH . '/modules/controls/icons/assets/dlicons.css';
        if ( $wp_filesystem->exists( $css_file ) ) {
            $css_source = $wp_filesystem->get_contents( $css_file );
        } 
        
        preg_match_all( "/\.(dlicon-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
        $iconList = [];
        foreach ( $matches as $match ) {
            $icon = str_replace('dlicon-', '', $match[1]);
            $icons = explode(' ', $icon);
            $iconList[] = current($icons);
        }
        $icons = new \stdClass();
        $icons->icons = $iconList;
        $icon_data = json_encode($icons);
        $file = DROIT_EL_ADDONS_DIR_PATH . '/modules/controls/icons/assets/dlicons.js';
        global $wp_filesystem;
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
        if ( $wp_filesystem->exists( $file ) ) {
            $content =  $wp_filesystem->put_contents( $file, $icon_data) ;
        } 
        
    }
}
