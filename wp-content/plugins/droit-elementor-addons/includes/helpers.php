<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */

use DROIT_ELEMENTOR\Utils as Droit_Utils;

defined('ABSPATH') || die();
 /**
 * plugin url
 * @param  string  $path  file path
 * @return string
 * Feature added by : DroitLab Team
 * @since : 1.0.0
*/
function droit_addons_protocol( $path = '' ) {
    $url = plugins_url( $path, DROIT_EL_ADDONS_FILE );

    if ( is_ssl()
    and 'http:' == substr( $url, 0, 5 ) ) {
      $url = 'https:' . substr( $url, 5 );
    }
    return $url;
  }

/**
 * Elementor Mode Change
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function is_droit() {
    return true;
}

/**
 * Load Elementor Plugins file
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_core_elementor() {
    return \Elementor\Plugin::instance();
}

/**
 * Load Elementor Links attribute
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_addons_link( $settings_key, $is_echo = true ) {
    if ( $is_echo == true ) {
        echo !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
    } else {
        $output = !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
        $output .= $settings_key['is_external'] == true ? 'target="_blank"' : '';
        $output .= $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        return $output;
    }
}
/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function droit_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'img' => [
            'src' => [],
            'alt' => [],
            'height' => [],
            'width' => [],
        ],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ( $level === 'advanced' ) {
        $advanced = [
            'acronym' => [
                'title' => [],
            ],
            'q' => [
                'cite' => [],
            ],
            'img' => [
                'src' => [],
                'alt' => [],
                'height' => [],
                'width' => [],
            ],
            
            'time' => [
                'datetime' => [],
            ],
            'cite' => [
                'title' => [],
            ],
            'a' => [
                'href' => [],
                'title' => [],
                'class' => [],
                'id' => [],
            ],
        ];

        $allowed_html = array_merge( $allowed_html, $tags );
    }

    return $allowed_html;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function droit_addons_kses( $string = '', $level = 'basic' ) {
    return wp_kses( $string, droit_allowed_html_tags( $level ) );
}
/**
 * Title Tag
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_title_tag( $title_tag ){
    $title_tag_array = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6','div', 'span', 'p' );

    if( in_array( $title_tag, $title_tag_array ) ) {
        return $title_tag;
    }
    else {
        return 'h4';
    }
}
/**
 * Text Shorten
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_shorten_text($text , $no_of__limit){
    $chars_limit = $no_of__limit;
    $chars_text = strlen($text);
    $text = $text." ";
    $text = substr($text,0,$chars_limit);
    $text = substr($text,0,strrpos($text,' '));
    if ($chars_text > $chars_limit){
        $text = $text."...";
    }
    return $text;
}
/**
 * Load More
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_excerpt_more($more) {
        return '...';
    }
add_filter('excerpt_more', 'droit_excerpt_more');

/**
 * Render Pro Message
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function _droit_render_pro_message(){
    $output = '';
    
    $output .= '<div class="dl_element_pro_singup_from">';
        $output .= '<div class="dl_element_pro_popup">';
            $output .= '<img src="' . DROIT_EL_ADDONS_IMAGE . 'pro_icon.svg" alt="#" class="dl_box_img">';
            $output .= '<h4 class="dl_popup_title">'.esc_html__("Go Premium with Droit Pro", "droit-elementor-addons").'</h4>';
            $output .= '<p class="dl_popup_desc">'.esc_html__("Enjoy additional and exclusive features to create a stunning website with premium
                Droit Pro", "droit-elementor-addons").'</p>';
            $output .= '<a href="'.Droit_Utils::droit_addons_pro_link().'" target="_blank" class="cu_btn dl_gradient_btn">'.esc_html__("Get Premium Version", "droit-elementor-addons").'</a>';
        $output .= '</div>';
    $output .= '</div>';

    echo $output;
}

function _droit_render_permission_message(){
    $output = '';
    
    $output .= '<div class="dl_element_pro_singup_from">';
        $output .= '<div class="dl_element_pro_popup dl_permission_message">';
            $output .= '<p class="dl_popup_desc">'.esc_html__("Oops!... you don't have permission to edit anything.", "droit-elementor-addons").'</p>';
        $output .= '</div>';
    $output .= '</div>';

    echo $output;
}
/**
 * Render Pro Icon
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function _droit_get_icon(){
    $output = '';
    $output .= '<img src="' . DROIT_EL_ADDONS_IMAGE . 'section_icon.svg" alt="DL" class="dl-section-icon">';
    return $output;
}

/**
 * Text Parse
 * Feature added by : DroitLab Team
 * @since : 1.0.0
 */
function droit_parse_text_editor( $content ) {  
    $content = shortcode_unautop( $content );
    $content = do_shortcode( $content );
    $content = wptexturize( $content );

    if ( $GLOBALS['wp_embed'] instanceof \WP_Embed ) {
        $content = $GLOBALS['wp_embed']->autoembed( $content );
    }

    return $content;
}

//Remove function after solve theme plugins
function droit_addons_script_debug(){
    return (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG);
}