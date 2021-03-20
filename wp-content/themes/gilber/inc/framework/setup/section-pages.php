<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$priority = 0;

/**
 * Blog page
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'sb_1',
	'section' => 'section_blog',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'blog_layout',
	'section' => 'section_blog',
	'label' => esc_html__( 'Blog Layout', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'default' => esc_html__( 'Default', 'gilber' ),
	),
	'default' => 'default',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'blog_type_pagination',
	'section' => 'section_blog',
	'label' => esc_html__( 'Type Pagination', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'none' => esc_html__( 'None', 'gilber' ),
		'paged' => esc_html__( 'Paged', 'gilber' ),
		'numeric' => esc_html__( 'Numeric', 'gilber' ),
	),
	'default' => 'numeric',
) );

VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'sb_2',
	'section' => 'section_blog',
	'default' => '<div class="kirki-separator">' . esc_html__( 'Page Title', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'text',
	'settings' => 'blog_title',
	'section' => 'section_blog',
	'label' => esc_html__( 'Blog Title', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => esc_html__( 'Recent News', 'gilber' ),
) );

/**
 * Archive page
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'sa_1',
	'section' => 'section_archive',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'archive_layout',
	'section' => 'section_archive',
	'label' => esc_html__( 'Archive Layout', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'default' => esc_html__( 'Default', 'gilber' ),
	),
	'default' => 'default',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'archive_type_pagination',
	'section' => 'section_archive',
	'label' => esc_html__( 'Type Pagination', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'none' => esc_html__( 'None', 'gilber' ),
		'paged' => esc_html__( 'Paged', 'gilber' ),
		'numeric' => esc_html__( 'Numeric', 'gilber' ),
	),
	'default' => 'paged',
) );

/**
 * Search page
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'ss_1',
	'section' => 'section_search',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'search_layout',
	'section' => 'section_search',
	'label' => esc_html__( 'Search Layout', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'default' => esc_html__( 'Default', 'gilber' ),
	),
	'default' => 'default',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'search_type_pagination',
	'section' => 'section_search',
	'label' => esc_html__( 'Type Pagination', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'none' => esc_html__( 'None', 'gilber' ),
		'paged' => esc_html__( 'Paged', 'gilber' ),
		'numeric' => esc_html__( 'Numeric', 'gilber' ),
	),
	'default' => 'paged',
) );

/**
 * Single post
 */
VLT_Options::add_field( array(
	'type' => 'custom',
	'settings' => 'ssp_1',
	'section' => 'section_single_post',
	'default' => '<div class="kirki-separator">' . esc_html__( 'General', 'gilber' ) . '</div>',
	'priority' => $priority++,
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'comment_placement',
	'section' => 'section_single_post',
	'label' => esc_html__( 'Comment Placement', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'top' => esc_html__( 'Top', 'gilber' ),
		'bottom' => esc_html__( 'Bottom', 'gilber' )
	),
	'default' => 'bottom',
) );

VLT_Options::add_field( array(
	'type' => 'select',
	'settings' => 'show_share_post',
	'section' => 'section_single_post',
	'label' => esc_html__( 'Post Share', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'choices' => array(
		'show' => esc_html__( 'Show', 'gilber' ),
		'hide' => esc_html__( 'Hide', 'gilber' )
	),
	'default' => 'hide',
) );

/**
 * Page 404
 */
VLT_Options::add_field( array(
	'type' => 'text',
	'settings' => 'error_title',
	'section' => 'section_404',
	'label' => esc_html__( 'Error Title', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => esc_html__( 'Page not found', 'gilber' ),
) );

VLT_Options::add_field( array(
	'type' => 'textarea',
	'settings' => 'error_subtitle',
	'section' => 'section_404',
	'label' => esc_html__( 'Error Subtitle', 'gilber' ),
	'priority' => $priority++,
	'transport' => 'auto',
	'default' => esc_html__( 'We are sorry. But the page you are looking for cannot be found.', 'gilber' ),
) );