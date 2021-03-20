<div class="droit-tools">
    <div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify dl_mb_0">
        <div class="dl_tab_content">
            <div class="tab_content_inner">
                <div class="dl_widget_icon sidebar_icon_bg_color_3">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'sidebar_tools.svg'; ?>" alt="<?php echo DROIT_ELEMENTOR_PLUGIN_NAME; ?>">
                </div>
                <h4><?php esc_html_e('Manage Tools', 'droit-elementor-addons');?></h4>
            </div>
        </div>
    </div>
    <div class="dl_addons_element">
    <div class="dl_addons_container dl_p_0">
        <div class="dl_addons_row">
            <div class="dl_col_lg_6">
                <div class="dl_single_library_box">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'cache_regenerate_all.svg'; ?>" alt="Regenerate Assets" class="dl_box_icon">
                    <h5 class="title"><?php esc_html_e('Regenerate All', 'droit-elementor-addons'); ?></h5>
                    <p class="description"><?php esc_html_e('Having issues? Regenerate all and start from the scratch and create new elements.', 'droit-elementor-addons'); ?></p>
                    <button class="cu_btn dl_gradient_btn btn_1 dl-btn-small re-generate" data-type="all" data-nonce="<?php echo wp_create_nonce( 'droit_cache_nonce' );?>"><?php esc_html_e('Regenerate All', 'droit-elementor-addons'); ?></button>
                </div>
            </div>
            <div class="dl_col_lg_6">
                <div class="dl_single_library_box">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'cache_regenerate_page.svg'; ?>" alt="Regenerate Assets" class="dl_box_icon">
                    <h5 class="title"><?php esc_html_e('Regenerate Page', 'droit-elementor-addons'); ?></h5>
                    <p class="description"><?php esc_html_e('Page is acting fishy? Regenerate a specific page and start over the process.', 'droit-elementor-addons'); ?></p>
                    <button class="cu_btn dl_gradient_btn btn_1 dl-btn-small re-generate" data-type="page" data-nonce="<?php echo wp_create_nonce( 'droit_cache_nonce' );?>"><?php esc_html_e('Regenerate Page', 'droit-elementor-addons'); ?>
                        
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>