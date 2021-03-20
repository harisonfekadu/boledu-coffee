<div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify">
  <div class="dl_tab_content">
    <div class="tab_content_inner">
      <div class="dl_widget_icon sidebar_icon_bg_color_6">
        <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_api.svg'; ?>"
          alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
      </div>
      <h4><?php esc_html_e('Api Data', 'droit-elementor-addons');?></h4>
    </div>
  </div>
  <button id="of_save_widget" type="button" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_api" data-layout='_dl_api'>
    <?php esc_html_e('Save Settings', 'droit-elementor-addons');?></button>
</div>
    <div class="dl_tab_content_wrapper">
      <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('droit_api_ajax_nonce'); ?>" />
      <form id="droit-save-api" class="posiasdtion_relative droit-save-api" method="post"
        action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>">
        <?php  
        $api_key = \DROIT_ELEMENTOR\Utils::get_settings_options('api_data'); 
        $is_pro_active  = !\DROIT_ELEMENTOR\Utils::droit_addons_has_pro() ? ' disabled' : '';
        ?>
        <div class="content_wrapper_flex">
          <div class="dl_api_container">
              <div class="dl_api">
                  <div class="dl_api_item">
                      <div class="dl_api_item_title">
                          <h3 class="dl_api_title"><?php esc_html_e('Mailchimp', 'droit-elementor-addons');?><span>(Pro)</span></h3>
                      </div>
                      <div class="dl_api_panel" style="display: block;">
                          <div class="dl_api_inner dl_api_inner_form">
                             <input type="text" name="api_data[mailchimp]" placeholder="Mailchimp api here." value="<?php echo esc_attr( isset($api_key['mailchimp']) ? $api_key['mailchimp'] : '' );?>" <?php echo esc_attr($is_pro_active); ?> />
                          </div>
                      </div>
                  </div>
                  <div class="dl_api_item">
                      <div class="dl_api_item_title">
                          <h3 class="dl_api_title"><?php esc_html_e('Get Response', 'droit-elementor-addons');?><span>(Pro)</span></h3>
                      </div>
                      <div class="dl_api_panel">
                          <div class="dl_api_inner dl_api_inner_form">
                             <input type="text" name="api_data[response]" placeholder="Campaign api here." value="<?php echo esc_attr( isset($api_key['response']) ? $api_key['response'] : '' );?>" <?php echo esc_attr($is_pro_active); ?> />
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </form>
  </div>

<div class="bottom-save-btn dl_d_flex dl_align_center dl_flex_justify">
  <button id="of_save_widget" type="button" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_api" data-layout='_dl_api'>
    <?php esc_html_e('Save Settings', 'droit-elementor-addons');?></button>
</div>