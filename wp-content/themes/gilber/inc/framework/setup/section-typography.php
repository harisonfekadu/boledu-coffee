<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$priority = 0;

/**
 * General fonts
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'primary_font',
	'section' => 'typography_fonts',
	'label' => esc_html__( 'Primary Font', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy'
	),
	'output' => array(
		array(
			'choice' => 'font-family',
			'element' => ':root',
			'property' => '--pf',
			'context' => array( 'editor', 'front' ),
		)
	)
) );

/**
 * Body typography
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'base_typography',
	'section' => 'typography_text',
	'label' => esc_html__( 'Base Typography', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => 'regular',
		'font-size' => '1rem',
		'line-height' => '1.8',
		'color' => '#999999',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'body'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper',
			'context' => array( 'editor' ),
		),
	)
) );

/**
 * Heading typography
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h1_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H1 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '5rem',
		'line-height' => '1.1',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'h1, .h1'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h1, .edit-post-visual-editor.editor-styles-wrapper .editor-post-title__input',
			'context' => array( 'editor' ),
		),
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h2_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H2 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '4rem',
		'line-height' => '1.1',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'h2, .h2'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h2',
			'context' => array( 'editor' ),
		),
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h3_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H3 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '3.125rem',
		'line-height' => '1.35',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'h3, .h3'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h3',
			'context' => array( 'editor' ),
		),
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h4_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H4 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '1.75rem',
		'line-height' => '1.5',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'h4, .h4'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h4',
			'context' => array( 'editor' ),
		),
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h5_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H5 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '1.375rem',
		'line-height' => '1.5',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'h5, .h5'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h5',
			'context' => array( 'editor' ),
		),
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_h6_titles',
	'section' => 'typography_headings',
	'label' => esc_html__( 'H6 Titles', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '600',
		'font-size' => '.9375rem',
		'line-height' => '1.1',
		'color' => '#ffffff',
		'letter-spacing' => '1px',
		'text-transform' => 'uppercase'
	),
	'output' => array(
		array(
			'element' => 'h6, .h6'
		),
		array(
			'element' => '.edit-post-visual-editor.editor-styles-wrapper h6',
			'context' => array( 'editor' ),
		),
	)
) );

/**
 * Blockquote typography
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'blockquote_typography',
	'section' => 'typography_blockquote',
	'label' => esc_html__( 'Blockquote', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '700',
		'font-size' => '1.25rem',
		'line-height' => '1.8',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'blockquote'
		),
		array(
			'element' => '.wp-block-quote, .wp-block-pullquote',
			'context' => array( 'editor' ),
		),
	)
) );

/**
 * Button typography
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_button',
	'section' => 'typography_buttons',
	'label' => esc_html__( 'Button Typography', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '.75rem',
		'line-height' => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'uppercase'
	),
	'output' => array(
		array(
			'element' => '.vlt-btn'
		)
	)
) );

/**
 * Input typography
 */
VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_input',
	'section' => 'typography_input',
	'label' => esc_html__( 'Input Typography', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => 'regular',
		'font-size' => '1rem',
		'letter-spacing' => '0',
		'line-height' => '1.8',
		'color' => '#ffffff',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => '
				input[type="text"],
				input[type="date"],
				input[type="email"],
				input[type="password"],
				input[type="tel"],
				input[type="url"],
				input[type="search"],
				input[type="number"],
				textarea,
				select
			'
		)
	)
) );

VLT_Options::add_field( array(
	'type' => 'typography',
	'settings' => 'typography_label',
	'section' => 'typography_input',
	'label' => esc_html__( 'Label Typography', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => gilber_add_custom_choice(),
	'default' => array(
		'font-family' => 'Gilroy',
		'variant' => '500',
		'font-size' => '1rem',
		'line-height' => '1.8',
		'color' => '#ffffff',
		'letter-spacing' => '0',
		'text-transform' => 'none'
	),
	'output' => array(
		array(
			'element' => 'label'
		)
	)
) );