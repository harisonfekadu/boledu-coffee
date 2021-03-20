<div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify">
  <div class="dl_tab_content">
    <div class="tab_content_inner">
      <div class="dl_widget_icon sidebar_icon_bg_color_2">
        <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_elements.svg'; ?>"
          alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
      </div>
      <h4><?php esc_html_e('Elements', 'droit-elementor-addons');?></h4>
    </div>
  </div>
  <button id="of_save_widget" type="button" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_data" data-layout='_dl_elements'>
    <?php esc_html_e('Save Settings', 'droit-elementor-addons');?></button>
</div>
<div class="filter_nav_item dl_align_center">
  <div class="filter_menu">
    <span class="fiter-data active" data-filter="*"><?php esc_html_e('all', 'droit-elementor-addons');?></span>
    <span class="fiter-data bg_2" data-filter=".free"><?php esc_html_e('free', 'droit-elementor-addons');?></span>
    <span class="fiter-data bg_3" data-filter=".pro"><?php esc_html_e('pro', 'droit-elementor-addons');?></span>
  </div>
  <div class="check_value">
    <span class="bg_4 _remove_disabled"
      id="checkAll"><?php esc_html_e('Enable All', 'droit-elementor-addons');?></span>
    <span class="bg_5 _remove_disabled"
      id="disableAll"><?php esc_html_e('Disable All', 'droit-elementor-addons');?></span>
  </div>
</div>

<?php

$elements_map = \DROIT_ELEMENTOR\Droit_Elements::droit_addons_widget_map();

$_t_elelemts  = count($elements_map);
if ($_t_elelemts > 0):
    foreach ($elements_map as $elements):
        ?>
    <div class="dl_tab_content_wrapper">
      <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('droit_widget_ajax_nonce'); ?>" />
      <form id="droit-save-widget" class="posiasdtion_relative droit-save-widget" method="post"
        action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>">
        <div class="content_wrapper_flex">
          <?php
        foreach ($elements['elements'] as $_key => $element):

            $title            = isset($element['_title']) ? $element['_title'] : '';
            $icon             = isset($element['_icon']) ? $element['_icon'] : '';
            $icon_class       = isset($element['_icon_class']) ? $element['_icon_class'] : '';
            $is_pro           = isset($element['_droit_pro']) && $element['_droit_pro'] ? true : false;
            $pro_class        = isset($element['_droit_pro']) && $element['_droit_pro'] ? ' pro' : 'free';
            $is_pro_disabled  = isset($element['_droit_pro']) && $element['_droit_pro'] && !\DROIT_ELEMENTOR\Utils::droit_addons_has_pro() ? ' disabled' : '';
            $is_pro_data_type = isset($element['_droit_pro']) && $element['_droit_pro'] ? 'is_pro' : 'free';
            $is_pro_popup     = isset($element['_droit_pro']) && $element['_droit_pro'] && !\DROIT_ELEMENTOR\Utils::droit_addons_has_pro() ? ' pro_popup' : '';
            $widget_key       = \DROIT_ELEMENTOR\Utils::droit_get_options('widgets');
            $checked          = '';

            if (!empty($widget_key)) {
                if (in_array($element['_key'], $widget_key)) {
                    $checked = 'checked="checked"';
                }
            }
            ?>
            <div class="colum_space <?php echo esc_attr($pro_class); ?>">
              <div class="dl_tab_content dt_element_switch">
                <?php if ($is_pro): ?>
                <span
                  class="tricker <?php echo esc_attr($is_pro_popup); ?>"><?php esc_html_e('Pro', 'droit-elementor-addons');?></span>
                <?php endif;?>
              <div class="tab_content_inner">
                <div class="dl_widget_icon <?php echo esc_attr($icon_class); ?>">
                  <i class="<?php echo $icon; ?>"></i>
                </div>
                <label
                  for="droit-elementor-<?php echo esc_attr($element['_key']); ?>" class="<?php echo esc_attr($pro_class); ?>"><?php esc_html_e($title, 'droit-elementor-addons');?></label>
                <!-- Icon function here -->
              </div>
              <label class="switch <?php echo esc_attr($is_pro_popup); ?>">
                <input type="checkbox" class="widget_checkbox _remove_disabled <?php echo esc_attr($is_pro_popup); ?>"
                  <?php echo esc_attr($is_pro_disabled); ?> data-type="<?php echo esc_attr($is_pro_data_type); ?>"
                  id="droit-elementor-<?php echo esc_attr($element['_key']); ?>" <?php echo $checked; ?> name="widgets[]"
                  data-value="<?php echo esc_attr($element['_key']); ?>" value="<?php echo esc_attr($element['_key']); ?>">
               <span class="slider"></span>
              </label>
            </div>
          </div>
          <?php endforeach;?>
      </div>
      </form>
  </div>
  <?php endforeach;?>
<?php else: ?>
<?php
$error_message = sprintf(
    esc_html_e('Oops! no widget found!', 'droit-elementor-addons')
);
printf('<p>%1$s</p>', $error_message);
?>
<?php endif;?>
<div class="bottom-save-btn dl_d_flex dl_align_center dl_flex_justify">
  <button id="of_save_widget" type="button" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_data" data-layout='_dl_elements'>
    <?php esc_html_e('Save Settings', 'droit-elementor-addons');?></button>
</div>
