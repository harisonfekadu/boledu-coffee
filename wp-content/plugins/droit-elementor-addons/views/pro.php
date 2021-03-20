<?php $pro_link_check = \DROIT_ELEMENTOR\Utils::droit_addons_pro_link(); ?>
<div class="dl_addons_element">
    <div class="dl_addons_container">
        <div class="dl_addons_row">
            <div class="dl_col_lg_12">
                <div class="dl_element_addons_dashboard_intro pro_banner">
                    <h2 class="title"><?php echo esc_html_e('Get Droit Elementor Addons Pro', 'droit-elementor-addons'); ?></h2>
                    <p class="description">Purchase the premium version of Droit Elementor Addons to get <br> additional and exclusive features.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="dl_addons_container">
        <div class="dl_addons_row">
            <div class="dl_col_lg_12">
                <div class="dl_single_library_box">
                    <img src="<?php echo DROIT_EL_ADDONS_IMAGE . 'Tabs.svg'; ?>" alt="pro" class="dl_box_icon">
                    <h5 class="title"><?php echo esc_html_e('Pro is coming soon, subscribe for Pro', 'droit-elementor-addons'); ?></h5>
                    <p class="description"><?php echo esc_html_e('Get additional features and widgets with the premium version of the plugin. Turn on automatic updates from the WordPress dashboard and enjoy updates without any hassle.', 'droit-elementor-addons'); ?></p>
                        <div class="dl_subscription_info_box dl_border_radius dl_subscribe_style_one dl_pt_50 dl_pb_60">
                             <?php include('form-data.php'); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dl_addons_container">
        <div class="dl_addons_row">
            <div class="dl_col_lg_12">
                <div class="dl_kit_section_title dl_mb_15">
                    <h5 class="title"><?php echo esc_html_e('Premium Elements ', 'droit-elementor-addons'); ?></h5>
                    <p class="description"><?php echo esc_html_e('Have a look at the premium elements you will get to level up your website. ', 'droit-elementor-addons'); ?></p>
                </div>
            </div>
        </div>
        <div class="dl_addons_row">
        	<?php
				$elements_map = DROIT_ELEMENTOR\Droit_Elements::droit_addons_widget_map();
				$_t_elelemts  = count($elements_map);
				if ($_t_elelemts > 0):
				foreach ($elements_map as $elements):

        		foreach ($elements['elements'] as $_key => $element) :
        		$title            = isset($element['_title']) ? $element['_title'] : '';
        		 $icon             = isset($element['_icon']) ? $element['_icon'] : '';
        		 $demo_url             = isset($element['_demo_url']) ? $element['_demo_url'] : '';
        		if($element['_droit_pro'] == true):
				?>
	            	<div class="dl_col_lg_3 dl_col_sm_6">
		                <a href="<?php echo esc_url($demo_url); ?>" class="dl_pro_widget_list" target="_blank">
		                    <i class="droit_icon <?php echo $icon; ?>"></i>
		                    <h4 class="title"><?php esc_html_e($title, 'droit-elementor-addons');?></h4>
		                </a>
	            	</div>
	            <?php endif; ?>
			 <?php endforeach; endforeach;?>
			<?php else: ?>
			 <?php
				$error_message = sprintf(
				    esc_html_e('Oops! no addons found!', 'droit-elementor-addons')
				);
				printf('<p>%1$s</p>', $error_message);
			?>
    <?php endif; ?>

        </div>
    </div>
</div>
