<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$priority = 0;

/**
 * Footer general
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'sfg_1',
	'section' => 'section_footer_general',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'footer_show',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Footer Show', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'show' => esc_html__( 'Show', 'gilber' ),
		'hide' => esc_html__( 'Hide', 'gilber' ),
	),
	'default' => 'show',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'footer_layout',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Footer Layout', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'default' => esc_html__( 'Default', 'gilber' ),
		'template' => esc_html__( 'Template', 'gilber' ),
	),
	'default' => 'default',
	'active_callback' => array(
		array(
			'setting' => 'footer_show',
			'operator' => '==',
			'value' => 'show',
		)
	)
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'footer_fixed',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Footer Fixed', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'enable' => esc_html__( 'Enable', 'gilber' ),
		'disable' => esc_html__( 'Disable', 'gilber' )
	),
	'active_callback' => array(
		array(
			'setting' => 'footer_show',
			'operator' => '==',
			'value' => 'show',
		),
		array(
			'setting' => 'footer_layout',
			'operator' => '==',
			'value' => 'default',
		)
	),
	'default' => 'enable',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'footer_locales',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Footer Locales', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'show' => esc_html__( 'Show', 'gilber' ),
		'hide' => esc_html__( 'Hide', 'gilber' )
	),
	'active_callback' => array(
		array(
			'setting' => 'footer_show',
			'operator' => '==',
			'value' => 'show',
		),
		array(
			'setting' => 'footer_layout',
			'operator' => '==',
			'value' => 'default',
		)
	),
	'default' => 'hide',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'footer_template',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Footer Template', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_get_elementor_templates(),
	'active_callback' => array(
		array(
			'setting' => 'footer_show',
			'operator' => '==',
			'value' => 'show'
		),
		array(
			'setting' => 'footer_layout',
			'operator' => '==',
			'value' => 'template',
		)
	)
) );

VLT_Options::add_field( array(
	'type' => 'editor',
	'settings' => 'footer_copyright',
	'section' => 'section_footer_general',
	'label' => esc_html__( 'Copyright', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => '<p>© Gilber. 2020</p>',
	'active_callback' => array(
		array(
			'setting' => 'footer_show',
			'operator' => '==',
			'value' => 'show',
		),
		array(
			'setting' => 'footer_layout',
			'operator' => '==',
			'value' => 'default',
		)
	)
) );