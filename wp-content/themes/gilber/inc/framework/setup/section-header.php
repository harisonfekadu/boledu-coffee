<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$priority = 0;

/**
 * Header general
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'shg_1',
	'section' => 'section_header_general',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'navigation_show',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Header Show', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'show' => esc_html__( 'Show', 'gilber' ),
		'hide' => esc_html__( 'Hide', 'gilber' ),
	),
	'default' => 'show',
) );

VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'shg_2',
	'section' => 'section_header_general',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Navigation', 'gilber' ) . '</div>',
	'priority' => $priority++,
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'navigation_opaque',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Navigation Opaque', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'enable' => esc_html__( 'Enable', 'gilber' ),
		'disable' => esc_html__( 'Disable', 'gilber' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
	'default' => 'disable',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'navigation_transparent',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Transparent', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'enable' => esc_html__( 'Enable', 'gilber' ),
		'disable' => esc_html__( 'Disable', 'gilber' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
	'default' => 'enable',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'navigation_transparent_always',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Transparent Always', 'gilber' ),
	'description' => esc_html__( 'Transparent also after page scrolled down.', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'enable' => esc_html__( 'Enable', 'gilber' ),
		'disable' => esc_html__( 'Disable', 'gilber' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
	'default' => 'disable',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'navigation_sticky',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Sticky', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'enable' => esc_html__( 'Enable', 'gilber' ),
		'disable' => esc_html__( 'Disable', 'gilber' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
	'default' => 'enable',
) );

VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'shg_3',
	'section' => 'section_header_general',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Logo', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'image',
	'settings' => 'navigation_logo',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Logo', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => '',
) );

VLT_Options::add_field( array(
	'type' => 'dimension',
	'settings' => 'navigation_logo_height',
	'section' => 'section_header_general',
	'label' => esc_html__( 'Logo Height', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => '',
	'output' => array(
		array(
			'element' => '.vlt-header .vlt-navbar-logo img',
			'property' => 'height'
		)
	)
) );

/**
 * Offcanvas menu
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'som_1',
	'section' => 'section_offcanvas_menu',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Locales', 'gilber' ) . '</div>',
	'priority' => $priority++,
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		)
	),
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'offcanvas_menu_locales',
	'section' => 'section_offcanvas_menu',
	'label' => esc_html__( 'Locales Show', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'show' => esc_html__( 'Show', 'gilber' ),
		'hide' => esc_html__( 'Hide', 'gilber' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		),
	),
	'default' => 'hide',
) );

VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'som_2',
	'section' => 'section_offcanvas_menu',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Socials', 'gilber' ) . '</div>',
	'priority' => $priority++,
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		)
	),
) );

VLT_Options::add_field( array(
	'type' => 'repeater',
	'settings' => 'offcanvas_menu_socials_list',
	'section' => 'section_offcanvas_menu',
	'label' => esc_html__( 'Social List', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'row_label' => array(
		'type' => 'text',
		'value' => esc_html__( 'social', 'gilber' )
	),
	'fields' => array(
		'social_class' => array(
			'type' => 'text',
			'label' => esc_html__( 'Social Class', 'gilber' ),
		),
		'social_url' => array(
			'type' => 'text',
			'label' => esc_html__( 'Social Url', 'gilber' )
		),
	),
	'default' => '',
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		)
	),
) );

VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'som_3',
	'section' => 'section_offcanvas_menu',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Copyright', 'gilber' ) . '</div>',
	'priority' => $priority++,
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		)
	),
) );

VLT_Options::add_field( array(
	'type' => 'editor',
	'settings' => 'offcanvas_menu_copyright',
	'section' => 'section_offcanvas_menu',
	'label' => esc_html__( 'Copyright', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => '<p>© 2020 Copiright.<br>All rights reserved.</p>',
	'active_callback' => array(
		array(
			'setting' => 'navigation_show',
			'operator' => '==',
			'value' => 'show',
		)
	),
) );