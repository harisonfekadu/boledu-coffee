<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined( 'ABSPATH' ) || die();

if ( !class_exists( 'Feedback' ) ) {
    class Feedback {
        use Traits\Server;

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct() {

            add_action( 'admin_footer', [$this, 'droit_addons_feedback_dialog'] );

            add_action( 'admin_footer', [$this, 'droit_addons_feedback_dialog_scripts'] );

            add_action( 'wp_ajax_droit_elementor_reason_handler', [$this, 'droit_elementor_submit_reason'] );
            add_action( 'wp_ajax_nopriv_droit_elementor_reason_handler', [$this, 'droit_elementor_submit_reason'] );
        }
        /**
         * Droit Elementor Feedback dialog script,
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_feedback_dialog_scripts() {

            /* global $pagenow;
            $screen = get_current_screen();
            if ('plugins.php' != $pagenow) {
            return;
            }*/
            $min_suffix = \DROIT_ELEMENTOR\Utils::droit_addons_script_debug_enabled() ? '.' : '.min';

            wp_enqueue_style( "droit-feedback", droit_addons_protocol( '/assets/plugins/css/feedback.min.css' ), [], DROIT_EL_ADDONS_VERSION );

            wp_enqueue_script( "droit-feedback", droit_addons_protocol( '/assets/plugins/js/feedback.min.js' ), ['jquery'], DROIT_EL_ADDONS_VERSION, true );
        }
        public function droit_elementor_submit_reason() {

            /*if (!isset($_POST['reason_key'])) {
            wp_send_json_error();
            }*/

            /*$deactive_user = wp_get_current_user();

            $data = array(
            'reason_key'   => sanitize_text_field($_POST['reason_key']),
            'reason_message' => isset($_REQUEST['reason_message']) ? trim(sanitize_text_field($_REQUEST['reason_message'])) : '',
            'site'        => $this->droit_addons_site_name(),
            'url'         => esc_url(home_url()),
            'admin_email' => get_option('admin_email'),
            'user_email'  => $deactive_user->user_email,
            'first_name'  => $deactive_user->first_name,
            'last_name'   => $deactive_user->last_name,
            'server'      => $this->droit_addons_serverinfo(),
            'wp'          => $this->droit_addons_wpinfo(),
            'ip_address'  => $this->droit_addons_ip_address(),
            'theme'       => get_stylesheet(),
            'version'     => $this->client->project_version,
            );*/
            if ( !isset( $_POST['reason_key'] ) ) {
                wp_send_json_error();
            }
            /* $reply_email = 'abusayedrussell@gmail.com';
            $to          = $reply_email;
            $subject     = 'Feedback';
            $body        = 'Lorem Ipsum';
            $headers[]   = 'From: ' . ucfirst(get_bloginfo('name')) . ' <droitlab@gmail.com> ';
            $headers[]   = 'Reply-To: ' . $reply_email . ' <droitlab@gmail.com>';
            $headers[]   = 'Content-Type: text/html: charset=UTF-8';

            wp_mail($to, $subject, $body, $headers);*/
            $do_blog = false;
            $current = get_option( 'active_plugins', [] );
            $plugin = 'droit-elementor-addons/plugins.php';

            $key = array_search( $plugin, $current );
            unset( $current[$key] );
            update_option( 'active_plugins', $current );

            wp_send_json_success();
            exit();

        }
        /**
         * Drot Elementor Feedback reasons,
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        private function droit_elementor_deactivate_reasons() {
            global $pagenow;

            if ( 'plugins.php' != $pagenow ) {
                return;
            }
            $droit_deactivate_reasons = [
                [
                    'id'                => 'no_longer_needed',
                    'title'             => __( 'I no longer need the plugin', 'droit-elementor-addons' ),
                    'type'              => '',
                    'input_placeholder' => '',
                ],
                [
                    'id'                => 'found_a_better_plugin',
                    'title'             => __( 'I found a better plugin', 'droit-elementor-addons' ),
                    'type'              => 'text',
                    'input_placeholder' => __( 'Please share which plugin', 'droit-elementor-addons' ),
                ],
                [
                    'id'                => 'couldnt_get_the_plugin_to_work',
                    'title'             => __( 'I couldn\'t get the plugin to work', 'droit-elementor-addons' ),
                    'type'              => '',
                    'input_placeholder' => '',
                ],
                [
                    'id'                => 'temporary_deactivation',
                    'title'             => __( 'It\'s a temporary deactivation', 'droit-elementor-addons' ),
                    'type'              => '',
                    'input_placeholder' => '',
                ],
                [
                    'id'                => 'droit_el_pro',
                    'title'             => __( 'I have Droit Elementor Addons Pro', 'droit-elementor-addons' ),
                    'type'              => 'alert',
                    'input_placeholder' => __( 'Wait! Don\'t deactivate Droit Elementor Addons. You have to activate both Droit Elementor Addons and Droit Elementor Addons Pro in order for the plugin to work.', 'droit-elementor-addons' ),
                ],

                [
                    'id'                => 'other',
                    'title'             => __( 'Other', 'droit-elementor-addons' ),
                    'type'              => 'textarea',
                    'input_placeholder' => __( 'Please share the reason', 'droit-elementor-addons' ),
                ],
            ];
            return $droit_deactivate_reasons;
        }
        /**
         * Drot Elementor Feedback popup,
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_feedback_dialog() {
            global $pagenow;

            if ( 'plugins.php' != $pagenow ) {
                return;
            }
            $droit_el_reasons = $this->droit_elementor_deactivate_reasons();
            ?>

<div class="dl_popup droit-elementor-deactive-dialog">
  <div id="droit-elementor-deactive-dialog" class="dl_popup_box">
    <div class="dl_popup_logo">
      <img src="<?php echo DROIT_EL_ADDONS_IMAGE . '/dl_logo.png'; ?>" alt="DroitLab Elementor Addons">
      <i class="ti-close">&times;</i>
    </div>
    <div class="dl_popup_content">
      <h5>
        <?php echo __( 'If you have a moment, please share why you are deactivating elementor:', 'droit-elementor-addons' ); ?>
      </h5>
      <?php foreach ( $droit_el_reasons as $reason ): ?>
      <div class="dl_single_item" data-type="<?php echo esc_attr( $reason['type'] ); ?>"
        data-placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>">
        <input id="droit-el-<?php echo $reason['id']; ?>" class="radio" type="radio" name="reason_key"
          value="<?php echo $reason['id']; ?>" />
        <label for="droit-el-<?php echo $reason['id']; ?>"><?php echo esc_html( $reason['title'] ); ?></label>
      </div>
      <?php endforeach;?>
      <div class="text-center btn_area deactive-submit-button">
        <button
          class="reason_btn btn_1 droit-elementor-submit-reason"><?php _e( 'Submit and Deactivate', 'droit-elementor-addons' );?></button>
        <p><a href="#" class="dialog-skip-deactive"><?php _e( 'Skip & Deactive', 'droit-elementor-addons' );?></a></p>
      </div>
    </div>
  </div>
</div>

<div class="dl_popup droit-elementor-process-dialog">
  <div id="droit-elementor-deactive-dialog" class="dl_popup_box">
    <div class="dl_popup_logo">
      <img src="<?php echo DROIT_EL_ADDONS_IMAGE . '/dl_logo.png'; ?>" alt="DroitLab Elementor Addons">
    </div>
    <div class="dl_popup_content">
      <div class="progress_bar">
        <div class="loading">
          <div class="loading_letter">P</div>
          <div class="loading_letter">r</div>
          <div class="loading_letter">o</div>
          <div class="loading_letter">c</div>
          <div class="loading_letter">e</div>
          <div class="loading_letter">s</div>
          <div class="loading_letter">s</div>
          <div class="loading_letter">i</div>
          <div class="loading_letter">n</div>
          <div class="loading_letter">g</div>
          <div class="loading_letter">.</div>
          <div class="loading_letter">.</div>
          <div class="loading_letter">.</div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
    }
}