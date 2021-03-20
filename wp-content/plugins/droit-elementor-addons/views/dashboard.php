<div id="wrapper">
  <div class="dl_elementor_addons_pack dl_sidebar_tab">
        <div class="dl-notice-show">
          <?php do_action('dl_notice'); ?>
        </div>
    <div class="dl_elementor_addon_content dl_d_flex">
      <div class="dl_tab_menu_content">
        <div class="sticky_sldebar">
          <h4 class="droit-logo-text"><?php esc_html_e( 'Droit Elementor Addons', 'droit-elementor-addons' );?></h4>
          <div class="tab-menu tab_left_content">
            <a href="#dashboard" class="tab-menu-link active" data-content="droit_dashboard">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_1">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_dashboard.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Dashboard', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Find all information', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#elements" class="tab-menu-link" data-content="droit_elements">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_2">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_elements.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Elements', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Control all the widgets', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#api" class="tab-menu-link" data-content="droit_api">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_6">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_api.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Api', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Added Api here', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#tools" class="tab-menu-link" data-content="droit_tools">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_3">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_tools.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Tools', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Regenerate assets', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <?php $data_content = \DROIT_ELEMENTOR\Utils::droit_addons_has_pro() ? 'upgrade' : 'pro'; ?>
            <a href="#<?php echo $data_content; ?>" class="tab-menu-link" data-content="droit_<?php echo $data_content; ?>">
              <div class="dl_tab_content">
              <?php if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()): ?>
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_5">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_pro.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Subscribe for Pro', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Pro is coming soon', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              <?php elseif(\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()): ?>
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_5">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_pro.svg'; ?>"
                      alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Upgrade', 'droit-elementor-addons' );?></h4>
                    <span><?php esc_html_e( 'Get premium features', 'droit-elementor-addons' );?></span>
                  </div>
                </div>
              <?php endif; ?>
              </div>
            </a>
           <?php do_action('droit/dashboard/tab/button'); ?>
          </div>
        </div>
      </div>
      <div class="tab-bar">
        <div class="tab-bar-content active" id="droit_dashboard">
            <?php include_once 'main.php';?>
        </div>
        <div class="tab-bar-content" id="droit_elements">
            <?php include_once 'elements.php';?>
        </div>
        <div class="tab-bar-content" id="droit_api">
            <?php include_once 'droit_api.php';?>
        </div>
        <div class="tab-bar-content" id="droit_tools">
            <?php include_once 'reset_tool.php';?>
        </div>
        <div class="tab-bar-content" id="droit_<?php echo $data_content; ?>">
        <?php 
          if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()): 
              include_once(DROIT_EL_ADDONS_DIR_PATH . 'views/' . $data_content . '.php');
             elseif (\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()):
              include_once(DROIT_EL_ADDONS_DIR_PATH . 'views/' . $data_content . '.php');
          endif;
         ?>
        </div>
        <?php do_action('droit/dashboard/tab/content'); ?>
      </div>
    </div>
  </div>
</div>
<?php include_once 'modal.php';?>