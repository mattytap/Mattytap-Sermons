<?php
/**
 * Archive wrapper, for theme compatibility.
 *
 * @package SM/Views/Partials
 */

defined( 'ABSPATH' ) or exit;

$template = get_option( 'template' );

/**
 * Allows to add additional classes to container div.
 *
 * @param string $template The theme ID.
 *
 * @return array The classes array.
 *
 * @since 2.15.0
 */
$additional_classes = apply_filters( 'sm_templates_additional_classes', array(), $template );
$additional_classes = implode( ' ', $additional_classes );

switch ( $template ) {
	case 'twentyeleven':
		echo '<div id="primary"><div id="content" role="main" class="wpfc-sermon-container wpfc-twentyeleven ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentytwelve':
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="wpfc-sermon-container wpfc-twentytwelve ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentythirteen':
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content wpfc-sermon-container wpfc-twentythirteen ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentyfourteen':
		echo '<div id="main-content" class="main-content"><div id="primary" class="content-area"><div id="content" class="site-content wpfc-sermon-container wpfc-twentyfourteen ' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'twentyfifteen':
		echo '<div id="primary" class="content-area"><div id="main" role="main" class="site-main wpfc-sermon-container wpfc-twentyfifteen ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentysixteen':
		echo '<div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-twentysixteen ' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'twentyseventeen':
		echo '<div class="wrap"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-twentyseventeen ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentynineteen':
		echo '<section id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-twentynineteen ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentytwentyfour':
		echo '<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-twentytwentyfour ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'Divi':
		echo '<div id="main-content"><div class="container"><div id="content-area" class="clearfix"><main id="left-area" class="wpfc-sermon-container wpfc-divi ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'salient':
		echo '<div class="container-wrap"><div class="container main-container"><div class="row"><div class="post-area col span_9"><div class="post-container wpfc-sermon-container wpfc-salient ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'Avada':
		echo '<div class=""><div class=""><div class="wpfc-sermon-container wpfc-avada ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'wpfc-morgan':
		echo '<section id="primary" class="content-area"><div id="content" class="wpfc-sermon-container site-content wpfc-morgan ' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'bb-theme':
		echo '<div class="container"><div class="row"><div class="wpfc-sermon-container fl-content fl-content-left col-md-8 wpfc-bb-theme' . esc_attr( $additional_classes ) . '">';
		break;
	case 'bb-theme-builder':
		echo '<div class="container"><div class="row"><div class="wpfc-sermon-container fl-content fl-content-left col-md-8 wpfc-bb-theme-builder ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'oceanwp':
		echo '<div id="content-wrap" class="container clr"><div id="primary" class="content-area clr"><div id="content" class="wpfc-sermon-container site-content clr wpfc-oceanwp ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'pro':
	case 'x':
		if ( function_exists( 'x_main_content_class' ) ) {
			ob_start();
			x_main_content_class();
			$additional_classes .= ob_get_clean();
		} else {
			$additional_classes .= 'x-main left'; // Use some default.
		}

		echo '<div class="x-container max width offset"><div class="' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'genesis':
		echo '<div class="content-sidebar-wrap"><main class="content wpfc-sermon-container wpfc-genesis ' . esc_attr( $additional_classes ) . '" id="genesis-content">';
		break;
	case 'maranatha':
		echo '<main id="maranatha-content"><div id="maranatha-content-inner" class="maranatha-centered-large maranatha-entry-content"><div id="maranatha-loop-multiple" class="maranatha-clearfix maranatha-loop-two-columns wpfc-sermon-container wpfc-maranatha ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'saved':
		echo '<main id="saved-content" class="saved-bg-contrast"><div id="saved-content-inner" class="saved-centered-large saved-entry-content"><div id="saved-loop-multiple" class="saved-clearfix saved-loop-entries saved-loop-three-columns wpfc-sermon-container wpfc-saved ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'brandon':
		echo '<div id="Content"><div class="content_wrapper clearfix wpfc-sermon-container wpfc-brandon ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'hueman':
	case 'hueman-pro':
		echo '<section class="content"><div class="pad hu-pad group wpfc-sermon-container wpfc-hueman ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'NativeChurch':
		echo '<div id="content" class="content full"><div class="container"><div class="row"><div class="col-md-12 posts-archive wpfc-sermon-container wpfc-NativeChurch ' . esc_attr( $additional_classes ) . '" id="content-col">';
		break;
	case 'betheme':
		echo '<div id="Content"><div class="content_wrapper clearfix"><!-- .sections_group --><div class="sections_group"><div class="section "><div class="section_wrapper clearfix"><div class="column one column_blog"><div class="blog_wrapper isotope_wrapper wpfc-sermon-container wpfc-betheme ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'dt-the7':
	case 'the7':
		echo '<div id="content" class="content" role="main">';
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		break;
	case 'dunamis':
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			$croma        = get_option( 'cromatic' );
			$sidebarrule  = isset( $croma['cro_catsidebar'] ) ? esc_attr( $croma['cro_catsidebar'] ) : 3;
			$sidebarclass = $sidebarrule == 2 ? 'large-12' : 'large-8';
			$padclass     = $sidebarrule == 1 ? 'croma_pad_left' : 'croma_pad_right';
			$padclass     = $sidebarrule == 2 ? '' : $padclass;
		} else {
			$sidebarclass = 'large-12';
			$padclass     = '';
		}

		get_template_part( 'inc/templates/cromaheader' );

		echo '<div class="main singleitem"><div class="row singlepage">';

		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			if ( $sidebarrule == 1 ) {
				echo '<div class="large-4 column">';
				get_sidebar();
				echo '</div>';
			}
		}

		echo '<div class="', esc_attr( $sidebarclass ), ' column">';
		echo '<div class=', esc_attr( $padclass ), '">';

		break;
	case 'exodoswp':
		if ( function_exists( 'exodoswp_redux' ) ) {
			$class = '';
			if ( exodoswp_redux( 'mt_blog_layout' ) == 'mt_blog_fullwidth' ) {
				$class = 'vc_row';
			} elseif ( exodoswp_redux( 'mt_blog_layout' ) == 'mt_blog_right_sidebar' or exodoswp_redux( 'mt_blog_layout' ) == 'mt_blog_left_sidebar' ) {
				$class = 'vc_col-md-9';
			}
			$sidebar = exodoswp_redux( 'mt_blog_layout_sidebar' );
		}
		echo '<div class="high-padding"><div class="container blog-posts"><div class="vc_row"><div class="col-md-12 main-content">';
		break;
	case 'kerygma':
		echo '<div id="page-wrap" class="clearfix"><div id="content" class="site-content" role="main">';
		break;
	case 'uncode':
		if ( ! is_single() ) {
			get_header();
			$limit_width          = $limit_content_width = $the_content = $main_content = $layout = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_classes = $generic_body_content_block = '';
			$index_has_navigation = false;

			if ( isset( $post->post_type ) ) {
				$post_type = $post->post_type . '_index';
			} else {
				global $wp_taxonomies;
				if ( isset( $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ] ) ) {
					$get_object = $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ];
					$post_type  = $get_object->object_type[0] . '_index';
				}
			}

			$tax                = ( isset( get_queried_object()->term_id ) ) ? get_queried_object()->term_id : '';
			$single_post_width  = ot_get_option( '_uncode_' . $post_type . '_single_width' );
			$single_text_length = ot_get_option( '_uncode_' . $post_type . '_single_text_length' );
			set_query_var( 'single_post_width', $single_post_width );
			if ( $single_text_length !== '' ) {
				set_query_var( 'single_text_length', $single_text_length );
			}

			/** Get general datas **/
			$style    = ot_get_option( '_uncode_general_style' );
			$bg_color = ot_get_option( '_uncode_general_bg_color' );
			$bg_color = ( $bg_color == '' ) ? ' style-' . $style . '-bg' : ' style-' . $bg_color . '-bg';

			/** Get page width info **/
			$generic_content_full = ot_get_option( '_uncode_' . $post_type . '_layout_width' );
			if ( $generic_content_full === '' ) {
				$main_content_full = ot_get_option( '_uncode_body_full' );
				if ( $main_content_full === '' || $main_content_full === 'off' ) {
					$limit_content_width = ' limit-width';
				}
			} else {
				if ( $generic_content_full === 'limit' ) {
					$generic_custom_width = ot_get_option( '_uncode_' . $post_type . '_layout_width_custom' );
					if ( isset( $generic_custom_width[0] ) && isset( $generic_custom_width[1] ) ) {
						if ( $generic_custom_width[1] === 'px' ) {
							$page_custom_width[0] = 12 * round( ( $generic_custom_width[0] ) / 12 );
						}
						if ( is_array( $generic_custom_width ) && ! empty( $generic_custom_width ) ) {
							$page_custom_width = ' style="max-width: ' . implode( '', $generic_custom_width ) . '; margin: auto;"';
						}
					} else {
						$limit_content_width = ' limit-width';
					}
				}
			}

			/** Collect header data **/
			$page_header_type = ot_get_option( '_uncode_' . $post_type . '_header' );
			if ( $page_header_type !== '' && $page_header_type !== 'none' ) {
				$metabox_data['_uncode_header_type'] = array( $page_header_type );
				$term_back                           = get_option( '_uncode_taxonomy_' . $tax );

				$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
				if ( is_author() ) {
					$user_uncode_meta = get_the_author_meta( 'user_uncode_meta', $author->ID );
				}

				if ( isset( $term_back['term_media'] ) && $term_back['term_media'] !== '' ) {
					$featured_image = $term_back['term_media'];
				} elseif ( isset( $user_uncode_meta['term_media'] ) && $user_uncode_meta['term_media'] !== '' ) {
					$featured_image = $user_uncode_meta['term_media'];
				} else {
					$featured_image = '';
				}
				$meta_data    = uncode_get_general_header_data( $metabox_data, $post_type, $featured_image );
				$metabox_data = $meta_data['meta'];
				$show_title   = $meta_data['show_title'];
			}

			/** Get layout info **/
			$activate_sidebar = ot_get_option( '_uncode_' . $post_type . '_activate_sidebar' );
			$sidebar_name     = ot_get_option( '_uncode_' . $post_type . '_sidebar' );

			if ( $activate_sidebar !== 'off' && is_active_sidebar( $sidebar_name ) ) {
				$layout = ot_get_option( '_uncode_' . $post_type . '_sidebar_position' );
				if ( $layout === '' ) {
					$layout = 'sidebar_right';
				}
				$sidebar          = ot_get_option( '_uncode_' . $post_type . '_sidebar' );
				$sidebar_style    = ot_get_option( '_uncode_' . $post_type . '_sidebar_style' );
				$sidebar_size     = ot_get_option( '_uncode_' . $post_type . '_sidebar_size' );
				$sidebar_sticky   = ot_get_option( '_uncode_' . $post_type . '_sidebar_sticky' );
				$sidebar_sticky   = ( $sidebar_sticky === 'on' ) ? ' sticky-element sticky-sidebar' : '';
				$sidebar_fill     = ot_get_option( '_uncode_' . $post_type . '_sidebar_fill' );
				$sidebar_bg_color = ot_get_option( '_uncode_' . $post_type . '_sidebar_bgcolor' );
				$sidebar_bg_color = ( $sidebar_bg_color !== '' ) ? ' style-' . $sidebar_bg_color . '-bg' : '';
				if ( $sidebar_style === '' ) {
					$sidebar_style = $style;
				}
			}

			/** Get breadcrumb info **/
			$generic_breadcrumb = ot_get_option( '_uncode_' . $post_type . '_breadcrumb' );
			$show_breadcrumb    = ( $generic_breadcrumb === 'off' ) ? false : true;
			if ( $show_breadcrumb ) {
				$breadcrumb_align = ot_get_option( '_uncode_' . $post_type . '_breadcrumb_align' );
			}

			/** Get title info **/
			$generic_show_title = ot_get_option( '_uncode_' . $post_type . '_title' );
			$show_title         = ( $generic_show_title === 'off' ) ? false : true;

			$posts_counter = $wp_query->post_count;

			/** Build header **/
			if ( $page_header_type !== '' && $page_header_type !== 'none' ) {
				$get_title    = uncode_archive_title();
				$get_subtitle = isset( get_queried_object()->description ) ? get_queried_object()->description : '';

				if ( ot_get_option( '_uncode_' . $post_type . '_custom_title_activate' ) === 'on' && ! is_category() && ! is_tax() ) {
					$get_title    = ot_get_option( '_uncode_' . $post_type . '_custom_title_text' );
					$get_subtitle = ot_get_option( '_uncode_' . $post_type . '_custom_subtitle_text' );
				}

				$get_title    = apply_filters( 'uncode_archive_title', $get_title );
				$get_subtitle = apply_filters( 'uncode_archive_subtitle', $get_subtitle );
				$page_header  = new unheader( $metabox_data, $get_title, $get_subtitle );

				$header_html = $page_header->html;
				if ( $header_html !== '' ) {
					echo '<div id="page-header">';
					echo wp_kses_post( uncode_remove_p_tag( $page_header->html ) );
					echo '</div>';
				}
			}
			// Theme-init call must fire at this mid-body DOM position, immediately
			// after the page-header div; deferring it to the footer queue would
			// change initialisation timing.
			wp_print_inline_script_tag( 'UNCODE.initHeader();' );

			/** Build breadcrumb **/

			if ( $show_breadcrumb ) {
				if ( $breadcrumb_align === '' ) {
					$breadcrumb_align = 'right';
				}
				$breadcrumb_align = ' text-' . $breadcrumb_align;

				$content_breadcrumb = uncode_breadcrumbs();
				$breadcrumb_title   = '<div class="breadcrumb-title h5 text-bold">' . uncode_archive_title() . '</div>';
				echo wp_kses_post( uncode_get_row_template( $breadcrumb_title . $content_breadcrumb, '', ( $page_custom_width !== '' ? ' limit-width' : $limit_content_width ), $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half' ) );
			}

			/** Build title **/

			if ( $show_title ) {
				$get_title     = uncode_archive_title();
				$title_content = '<div class="post-title-wrapper"><h1 class="post-title">' . $get_title . '</h1></div>';
			}

			$the_content                .= $title_content;
			$generic_body_content_block = ot_get_option( '_uncode_' . $post_type . '_content_block' );

			$the_content .=
				'<div id="index-' . wp_rand() . '" class="isotope-system">
				<div class="isotope-wrapper single-gutter">
					<div class="isotope-container isotope-layout style-masonry isotope-pagination" data-type="masonry" data-layout="masonry" data-lg="800">';

			ob_start();
		} else {
			get_header();

			/**
			 * DATA COLLECTION - START
			 *
			 */

			/** Init variables **/
			$limit_width  = $limit_content_width = $the_content = $main_content = $layout = $bg_color = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $media_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_content = $footer_classes = $content_after_body = '';
			$with_builder = false;

			$post_type = $post->post_type;

			/** Get general datas **/
			if ( isset( $metabox_data ) ) {
				if ( isset( $metabox_data['_uncode_specific_style'][0] ) && $metabox_data['_uncode_specific_style'][0] !== '' ) {
					$style = $metabox_data['_uncode_specific_style'][0];
					if ( isset( $metabox_data['_uncode_specific_bg_color'][0] ) && $metabox_data['_uncode_specific_bg_color'][0] !== '' ) {
						$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
					}
				} else {
					$style = ot_get_option( '_uncode_general_style' );
					if ( isset( $metabox_data['_uncode_specific_bg_color'][0] ) && $metabox_data['_uncode_specific_bg_color'][0] !== '' ) {
						$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
					} else {
						$bg_color = ot_get_option( '_uncode_general_bg_color' );
					}
				}
			}
			$bg_color = ( $bg_color == '' ) ? ' style-' . $style . '-bg' : ' style-' . $bg_color . '-bg';


			/** Get page width info **/
			$boxed = ot_get_option( '_uncode_boxed' );

			$page_content_full = ( isset( $metabox_data['_uncode_specific_layout_width'][0] ) ) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
			if ( $page_content_full === '' ) {

				/** Use generic page width **/
				$generic_content_full = ot_get_option( '_uncode_' . $post_type . '_layout_width' );
				if ( $generic_content_full === '' ) {
					$main_content_full = ot_get_option( '_uncode_body_full' );
					if ( $main_content_full === '' || $main_content_full === 'off' ) {
						$limit_content_width = ' limit-width';
					}
				} else {
					if ( $generic_content_full === 'limit' ) {
						$generic_custom_width = ot_get_option( '_uncode_' . $post_type . '_layout_width_custom' );
						if ( $generic_custom_width[1] === 'px' ) {
							$generic_custom_width[0] = 12 * round( ( $generic_custom_width[0] ) / 12 );
						}
						if ( is_array( $generic_custom_width ) && ! empty( $generic_custom_width ) ) {
							$page_custom_width = ' style="max-width: ' . implode( "", $generic_custom_width ) . '; margin: auto;"';
						}
					}
				}
			} else {

				/** Override page width **/
				if ( $page_content_full === 'limit' ) {
					$limit_content_width = ' limit-width';
					$page_custom_width   = ( isset( $metabox_data['_uncode_specific_layout_width_custom'][0] ) ) ? unserialize( $metabox_data['_uncode_specific_layout_width_custom'][0], array( 'allowed_classes' => false ) ) : '';
					if ( is_array( $page_custom_width ) && ! empty( $page_custom_width ) && $page_custom_width[0] !== '' ) {
						if ( $page_custom_width[1] === 'px' ) {
							$page_custom_width[0] = 12 * round( ( $page_custom_width[0] ) / 12 );
						}
						$page_custom_width = ' style="max-width: ' . implode( "", $page_custom_width ) . '; margin: auto;"';
					} else {
						$page_custom_width = '';
					}
				}
			}

			$media          = get_post_meta( $post->ID, '_uncode_featured_media', 1 );
			$media_display  = get_post_meta( $post->ID, '_uncode_featured_media_display', 1 );
			$featured_image = get_post_thumbnail_id( $post->ID );
			if ( $featured_image === '' ) {
				$featured_image = $media;
			}

			/** Collect header data **/
			if ( isset( $metabox_data['_uncode_header_type'][0] ) && $metabox_data['_uncode_header_type'][0] !== '' ) {
				$page_header_type = $metabox_data['_uncode_header_type'][0];
				if ( $page_header_type !== 'none' ) {
					$meta_data    = uncode_get_specific_header_data( $metabox_data, $post_type, $featured_image );
					$metabox_data = $meta_data['meta'];
					$show_title   = $meta_data['show_title'];
				}
			} else {
				$page_header_type = ot_get_option( '_uncode_' . $post_type . '_header' );
				if ( $page_header_type !== '' && $page_header_type !== 'none' ) {
					$metabox_data['_uncode_header_type'] = array( $page_header_type );
					$meta_data                           = uncode_get_general_header_data( $metabox_data, $post_type, $featured_image );
					$metabox_data                        = $meta_data['meta'];
					$show_title                          = $meta_data['show_title'];
				}
			}

			/** Get layout info **/
			if ( isset( $metabox_data['_uncode_active_sidebar'][0] ) && $metabox_data['_uncode_active_sidebar'][0] !== '' ) {
				if ( $metabox_data['_uncode_active_sidebar'][0] !== 'off' ) {
					$layout           = ( isset( $metabox_data['_uncode_sidebar_position'][0] ) ) ? $metabox_data['_uncode_sidebar_position'][0] : '';
					$sidebar          = ( isset( $metabox_data['_uncode_sidebar'][0] ) ) ? $metabox_data['_uncode_sidebar'][0] : '';
					$sidebar_size     = ( isset( $metabox_data['_uncode_sidebar_size'][0] ) ) ? $metabox_data['_uncode_sidebar_size'][0] : 4;
					$sidebar_sticky   = ( isset( $metabox_data['_uncode_sidebar_sticky'][0] ) && $metabox_data['_uncode_sidebar_sticky'][0] === 'on' ) ? ' sticky-element sticky-sidebar' : '';
					$sidebar_fill     = ( isset( $metabox_data['_uncode_sidebar_fill'][0] ) ) ? $metabox_data['_uncode_sidebar_fill'][0] : '';
					$sidebar_style    = ( isset( $metabox_data['_uncode_sidebar_style'][0] ) ) ? $metabox_data['_uncode_sidebar_style'][0] : $style;
					$sidebar_bg_color = ( isset( $metabox_data['_uncode_sidebar_bgcolor'][0] ) && $metabox_data['_uncode_sidebar_bgcolor'][0] !== '' ) ? ' style-' . $metabox_data['_uncode_sidebar_bgcolor'][0] . '-bg' : '';
				}
			} else {
				$activate_sidebar = ot_get_option( '_uncode_' . $post_type . '_activate_sidebar' );
				$sidebar_name     = ot_get_option( '_uncode_' . $post_type . '_sidebar' );

				if ( $activate_sidebar !== 'off' && is_active_sidebar( $sidebar_name ) ) {
					$layout = ot_get_option( '_uncode_' . $post_type . '_sidebar_position' );
					if ( $layout === '' ) {
						$layout = 'sidebar_right';
					}
					$sidebar          = ot_get_option( '_uncode_' . $post_type . '_sidebar' );
					$sidebar_style    = ot_get_option( '_uncode_' . $post_type . '_sidebar_style' );
					$sidebar_size     = ot_get_option( '_uncode_' . $post_type . '_sidebar_size' );
					$sidebar_sticky   = ot_get_option( '_uncode_' . $post_type . '_sidebar_sticky' );
					$sidebar_sticky   = ( $sidebar_sticky === 'on' ) ? ' sticky-element sticky-sidebar' : '';
					$sidebar_fill     = ot_get_option( '_uncode_' . $post_type . '_sidebar_fill' );
					$sidebar_bg_color = ot_get_option( '_uncode_' . $post_type . '_sidebar_bgcolor' );
					$sidebar_bg_color = ( $sidebar_bg_color !== '' ) ? ' style-' . $sidebar_bg_color . '-bg' : '';
				}
			}
			if ( $sidebar_style === '' ) {
				$sidebar_style = $style;
			}

			/** Get breadcrumb info **/
			$generic_breadcrumb = ot_get_option( '_uncode_' . $post_type . '_breadcrumb' );
			$page_breadcrumb    = ( isset( $metabox_data['_uncode_specific_breadcrumb'][0] ) ) ? $metabox_data['_uncode_specific_breadcrumb'][0] : '';
			if ( $page_breadcrumb === '' ) {
				$breadcrumb_align = ot_get_option( '_uncode_' . $post_type . '_breadcrumb_align' );
				$show_breadcrumb  = ( $generic_breadcrumb === 'off' ) ? false : true;
			} else {
				$breadcrumb_align = ( isset( $metabox_data['_uncode_specific_breadcrumb_align'][0] ) ) ? $metabox_data['_uncode_specific_breadcrumb_align'][0] : '';
				$show_breadcrumb  = ( $page_breadcrumb === 'off' ) ? false : true;
			}

			/** Get title info **/
			$generic_show_title = ot_get_option( '_uncode_' . $post_type . '_title' );
			$page_show_title    = ( isset( $metabox_data['_uncode_specific_title'][0] ) ) ? $metabox_data['_uncode_specific_title'][0] : '';
			if ( $page_show_title === '' ) {
				$show_title = ( $generic_show_title === 'off' ) ? false : true;
			} else {
				$show_title = ( $page_show_title === 'off' ) ? false : true;
			}

			/** Get media info **/
			$generic_show_media = ot_get_option( '_uncode_' . $post_type . '_media' );
			$page_show_media    = ( isset( $metabox_data['_uncode_specific_media'][0] ) ) ? $metabox_data['_uncode_specific_media'][0] : '';
			if ( $page_show_media === '' ) {
				$show_media = ( $generic_show_media === 'off' ) ? false : true;
			} else {
				$show_media = ( $page_show_media === 'off' ) ? false : true;
			}

			if ( ! $show_media && $featured_image !== '' ) {
				$generic_show_featured_media = ot_get_option( '_uncode_' . $post_type . '_featured_media' );
				$page_show_featured_media    = ( isset( $metabox_data['_uncode_specific_featured_media'][0] ) && $metabox_data['_uncode_specific_featured_media'][0] !== '' ) ? $metabox_data['_uncode_specific_featured_media'][0] : $generic_show_featured_media;

				if ( $page_show_featured_media === 'on' ) {
					$media = $featured_image;
				}
			} else {
				$page_show_featured_media = false;
			}

			$show_media = $page_show_featured_media && $page_show_featured_media !== 'off' ? true : $show_media;


			/** Build header **/
			if ( $page_header_type !== '' && $page_header_type !== 'none' ) {
				$page_header = new unheader( $metabox_data, $post->post_title, $post->post_excerpt );

				$header_html = $page_header->html;
				if ( $header_html !== '' ) {
					echo '<div id="page-header">';
					echo wp_kses_post( uncode_remove_p_tag( $page_header->html ) );
					echo '</div>';
				}

				if ( ! empty( $page_header->poster_id ) && $page_header->poster_id !== false && $media !== '' ) {
					$media = $page_header->poster_id;
				}
			}
			// Theme-init call must fire at this mid-body DOM position, immediately
			// after the page-header div; deferring it to the footer queue would
			// change initialisation timing.
			wp_print_inline_script_tag( 'UNCODE.initHeader();' );
			/** Build breadcrumb **/

			if ( $show_breadcrumb && ! is_front_page() && ! is_home() ) {
				if ( $breadcrumb_align === '' ) {
					$breadcrumb_align = 'right';
				}
				$breadcrumb_align = ' text-' . $breadcrumb_align;

				$content_breadcrumb = uncode_breadcrumbs();
				$breadcrumb_title   = '<div class="breadcrumb-title h5 text-bold">' . get_the_title() . '</div>';
				echo wp_kses_post( uncode_get_row_template( $breadcrumb_title . $content_breadcrumb, '', ( $page_custom_width !== '' ? ' limit-width' : $limit_content_width ), $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half' ) );
			}

			/** Build title **/

			if ( $show_title ) {
				$title_content .= apply_filters( 'uncode_before_body_title', '' );
				$title_content .= '<div class="post-title-wrapper"><h1 class="post-title">' . get_the_title() . '</h1>';
				$title_content .= uncode_post_info() . '</div>';
				$title_content .= apply_filters( 'uncode_after_body_title', '' );
			}

			/** JetPack related posts **/

			if ( shortcode_exists( 'jetpack-related-posts' ) ) {
				$related_content = do_shortcode( '[jetpack-related-posts]' );
				if ( $related_content !== '' ) {
					if ( ! $with_builder ) {
						$the_content .= $related_content;
					} else {
						$the_content .= uncode_get_row_template( $related_content, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width );
					}
				}
			}

			/** Build post after block **/
			$content_after_body        = '';
			$page_content_blocks_after = array(
				'above' => '_pre',
				'below' => ''
			);

			foreach ( $page_content_blocks_after as $order => $pre ) {

				$content_after_body_build = '';

				$page_content_block_after = ( isset( $metabox_data[ '_uncode_specific_content_block_after' . $pre ][0] ) ) ? $metabox_data[ '_uncode_specific_content_block_after' . $pre ][0] : '';
				if ( $page_content_block_after === '' ) {
					$generic_content_block_after = ot_get_option( '_uncode_' . $post_type . '_content_block_after' . $pre );
					$content_block_after         = $generic_content_block_after !== '' ? $generic_content_block_after : false;
				} else {
					$content_block_after = $page_content_block_after !== 'none' ? $page_content_block_after : false;
				}

				if ( $content_block_after !== false ) {
					$content_block_after      = apply_filters( 'wpml_object_id', $content_block_after, 'post' );
					$content_after_body_build = get_post_field( 'post_content', $content_block_after );
					if ( class_exists( 'Vc_Base' ) ) {
						$vc = new Vc_Base();
						$vc->addShortcodesCustomCss( $content_block_after );
					}
					if ( has_shortcode( $content_after_body_build, 'vc_row' ) ) {
						$content_after_body_build = '<div class="post-after row-container">' . $content_after_body_build . '</div>';
					} else {
						$content_after_body_build = '<div class="post-after row-container">' . uncode_get_row_template( $content_after_body_build, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width ) . '</div>';
					}
					if ( class_exists( 'RP4WP_Post_Link_Manager' ) ) {
						if ( is_array( RP4WP::get()->settings ) ) {
							$automatic_linking_post_amount = RP4WP::get()->settings[ 'general_' . $post_type ]->get_option( 'automatic_linking_post_amount' );
						} else {
							$automatic_linking_post_amount = RP4WP::get()->settings->get_option( 'automatic_linking_post_amount' );
						}
						$uncode_related    = new RP4WP_Post_Link_Manager();
						$related_posts     = $uncode_related->get_children( $post->ID, false );
						$related_posts_ids = array();
						foreach ( $related_posts as $key => $value ) {
							if ( isset( $value->ID ) ) {
								$related_posts_ids[] = $value->ID;
							}
						}
						$archive_query = '';
						$regex         = '/\[uncode_index(.*?)\]/';
						$regex_attr    = '/(.*?)=\"(.*?)\"/';
						preg_match_all( $regex, $content_after_body_build, $matches, PREG_SET_ORDER );
						foreach ( $matches as $key => $value ) {
							$index_found = false;
							if ( isset( $value[1] ) ) {
								preg_match_all( $regex_attr, trim( $value[1] ), $matches_attr, PREG_SET_ORDER );
								foreach ( $matches_attr as $key_attr => $value_attr ) {
									switch ( trim( $value_attr[1] ) ) {
										case 'auto_query':
											if ( $value_attr[2] === 'yes' ) {
												$index_found = true;
											}
											break;
										case 'loop':
											$archive_query = $value_attr[2];
											break;
									}
								}
							}
							if ( $index_found ) {
								if ( $archive_query === '' ) {
									$archive_query = ' loop="size:10|by_id:' . implode( ',', $related_posts_ids ) . '|post_type:' . $post->post_type . '"';
								} else {
									$parse_query          = uncode_parse_loop_data( $archive_query );
									$parse_query['by_id'] = implode( ',', $related_posts_ids );
									if ( ! isset( $parse_query['order'] ) ) {
										$parse_query['order'] = 'none';
									}
									$archive_query = ' loop="' . uncode_unparse_loop_data( $parse_query ) . '"';
								}
								$value[1] = preg_replace( '#\s(loop)="([^"]+)"#', $archive_query, $value[1], - 1, $index_count );
								if ( $index_count === 0 ) {
									$value[1] .= $archive_query;
								}
								$replacement              = '[uncode_index' . $value[1] . ']';
								$content_after_body_build = str_replace( $value[0], $replacement, $content_after_body_build );
							}
						}
					}
				}

				$content_after_body .= $content_after_body_build;

			}

			/** Build post footer **/

			$page_show_share = ( isset( $metabox_data['_uncode_specific_share'][0] ) ) ? $metabox_data['_uncode_specific_share'][0] : '';
			if ( $page_show_share === '' ) {
				$generic_show_share = ot_get_option( '_uncode_' . $post_type . '_share' );
				$show_share         = ( $generic_show_share === 'off' ) ? false : true;
			} else {
				$show_share = ( $page_show_share === 'off' ) ? false : true;
			}

			if ( $show_share ) {
				$footer_content = '<div class="post-share">
	          						<div class="detail-container margin-auto">
													<div class="share-button share-buttons share-inline only-icon"></div>
												</div>
											</div>';
			}

			if ( $layout === 'sidebar_right' || $layout === 'sidebar_left' ) {

				/** Build structure with sidebar **/

				if ( $sidebar_size === '' ) {
					$sidebar_size = 4;
				}
				$main_size  = 12 - $sidebar_size;
				$expand_col = '';

				/** Collect paddings data **/

				$footer_classes = ' no-top-padding double-bottom-padding';

				if ( $sidebar_bg_color !== '' ) {
					if ( $sidebar_fill === 'on' ) {
						$sidebar_inner_padding .= ' std-block-padding';
						$sidebar_padding       .= $sidebar_bg_color;
						$expand_col            = ' unexpand';
						if ( $limit_content_width === '' ) {
							$row_classes    .= ' no-h-padding col-no-gutter no-top-padding';
							$footer_classes = ' std-block-padding no-top-padding';
							if ( ! $with_builder ) {
								$main_classes .= ' std-block-padding';
							}
						} else {
							$row_classes .= ' no-top-padding';
							if ( ! $with_builder ) {
								$main_classes .= ' double-top-padding';
							}
						}
					} else {
						$row_classes           .= ' double-top-padding';
						$row_classes           .= ' double-bottom-padding';
						$sidebar_inner_padding .= $sidebar_bg_color . ' single-block-padding';
					}
				} else {
					if ( $with_builder ) {
						if ( $limit_content_width === '' ) {
							$row_classes .= ' col-std-gutter no-top-padding';
							if ( $boxed !== 'on' ) {
								$row_classes .= ' no-h-padding';
							}
						} else {
							$row_classes .= ' col-std-gutter no-top-padding';
						}
						$sidebar_inner_padding .= ' double-top-padding';
					} else {
						$row_classes  .= ' col-std-gutter double-top-padding';
						$main_classes .= ' double-bottom-padding';
					}
				}

				$row_classes           .= ' no-bottom-padding';
				$sidebar_inner_padding .= ' double-bottom-padding';

				/** Build sidebar **/

				$sidebar_content = "";
				ob_start();
				if ( $sidebar !== '' ) {
					dynamic_sidebar( $sidebar );
				} else {
					dynamic_sidebar( 1 );
				}
				$sidebar_content = ob_get_clean();

				/** Create html with sidebar **/

				if ( $footer_content !== '' ) {
					if ( $limit_content_width === '' ) {
						$footer_content = uncode_get_row_template( $footer_content, $limit_width, $limit_content_width, $style, '', false, true, '' );
					}
					$footer_content = '<div class="post-footer post-footer-' . $style . ' style-' . $style . $footer_classes . '">' . $footer_content . '</div>';
				}

				$the_content = '<div class="post-content style-' . $style . $main_classes . '">' . $the_content . '</div>';

				$main_content = '<div class="col-lg-' . $main_size . '">
											' . $the_content . $content_after_body . $footer_content . '
										</div>';

				$the_content = '<div class="row-container">
        							<div class="row row-parent un-sidebar-layout' . $row_classes . $limit_content_width . '"' . $page_custom_width . '>
												<div class="row-inner">
													' . ( ( $layout === 'sidebar_right' ) ? $main_content : '' ) . '
													<div class="col-lg-' . $sidebar_size . '">
														<div class="uncol style-' . $sidebar_style . $expand_col . $sidebar_padding . ( ( $sidebar_fill === 'on' && $sidebar_bg_color !== '' ) ? '' : $sidebar_sticky ) . '">
															<div class="uncoltable' . ( ( $sidebar_fill === 'on' && $sidebar_bg_color !== '' ) ? $sidebar_sticky : '' ) . '">
																<div class="uncell' . $sidebar_inner_padding . '">
																	<div class="uncont">
																		' . $sidebar_content . '
																	</div>
																</div>
															</div>
														</div>
													</div>
													' . ( ( $layout === 'sidebar_left' ) ? $main_content : '' ) . '
												</div>
											</div>
										</div>';
			}

			$the_content = '<div class="post-content un-no-sidebar-layout"' . $page_custom_width . '>';

			/** Build and display navigation html **/
			$navigation_option = ot_get_option( '_uncode_' . $post_type . '_navigation_activate' );
			if ( $navigation_option !== 'off' ) {
				$generic_index = true;
				if ( isset( $metabox_data['_uncode_specific_navigation_index'][0] ) && $metabox_data['_uncode_specific_navigation_index'][0] !== '' ) {
					$navigation_index = $metabox_data['_uncode_specific_navigation_index'][0];
					$generic_index    = false;
				} else {
					$navigation_index = ot_get_option( '_uncode_' . $post_type . '_navigation_index' );
				}
				if ( $navigation_index !== '' ) {
					$navigation_index_label = ot_get_option( '_uncode_' . $post_type . '_navigation_index_label' );
					$navigation_index_link  = get_permalink( $navigation_index );
					$navigation_index_btn   = '<a class="btn btn-link text-default-color" href="' . esc_url( $navigation_index_link ) . '">' . ( $navigation_index_label === '' ? get_the_title( $navigation_index ) : esc_html( $navigation_index_label ) ) . '</a>';
				} else {
					$navigation_index_btn = '';
				}
				$navigation_nextprev_title = ot_get_option( '_uncode_' . $post_type . '_navigation_nextprev_title' );
				$navigation                = uncode_post_navigation( $navigation_index_btn, $navigation_nextprev_title, $navigation_index, $generic_index );
				if ( $page_custom_width !== '' ) {
					$limit_content_width = ' limit-width';
				}
				if ( ! empty( $navigation ) && $navigation !== '' ) {
					$navigation_content = uncode_get_row_template( $navigation, '', $limit_content_width, $style, ' row-navigation row-navigation-' . $style, true, true, true );
				}
			}

			/** Display post html **/
			echo '<article id="post-' . (int) get_the_ID() . '" class="' . esc_attr( implode( ' ', get_post_class( 'page-body' . $bg_color ) ) ) . '">
          <div class="post-wrapper">
          	<div class="post-body">';

			ob_start();
		}
		break;
	case 'onepress':
		// OnePress's own markup (single.php and archive.php), so its sidebar layout setting applies.
		$sm_onepress_layout = function_exists( 'onepress_get_layout' ) ? onepress_get_layout() : 'right-sidebar';
		echo '<div id="content" class="site-content">';
		if ( function_exists( 'onepress_breadcrumb' ) ) {
			onepress_breadcrumb();
		}
		echo '<div id="content-inside" class="container ' . esc_attr( $sm_onepress_layout ) . '"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-onepress ' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'envo-royal':
		// Envo Royal's own markup (single.php:4-8, archive.php:4-5). Its header already opens .container.
		$sm_envo_columns = '12';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) && function_exists( 'envo_royal_main_content_width_columns' ) ) {
			// Echoes 9 with the right sidebar active, else 12 (functions.php:337).
			ob_start();
			envo_royal_main_content_width_columns();
			$sm_envo_columns = (string) absint( ob_get_clean() );
		}
		if ( is_singular() ) {
			echo '<div class="row single-post"><article class="col-md-' . esc_attr( $sm_envo_columns ) . '"><div class="single-post-content wpfc-sermon-container wpfc-envo-royal ' . esc_attr( $additional_classes ) . '">';
		} else {
			echo '<div class="row"><div class="col-md-' . esc_attr( $sm_envo_columns ) . ' wpfc-sermon-container wpfc-envo-royal ' . esc_attr( $additional_classes ) . '">';
		}
		break;
	case 'total':
		// Total's own page markup (inc/hooks/single.php and archive.php), so its container and sidebar CSS apply.
		if ( is_singular() ) {
			if ( function_exists( 'total_single_header' ) ) {
				// The theme's title bar and breadcrumbs, as single.php prints them.
				total_single_header();
			}
			$sm_total_container = function_exists( 'total_content_container_class' ) ? total_content_container_class() : 'ht-container';
		} else {
			if ( function_exists( 'total_archive_header' ) ) {
				// The archive title bar and breadcrumbs, as archive.php prints them.
				total_archive_header();
			}
			$sm_total_container = 'ht-container';
		}
		echo '<div class="' . esc_attr( $sm_total_container ) . ' ht-clearfix"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-total ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'mantra':
		// Mantra's own markup (single.php:12-15, archive.php:17-20). Its #primary is the sidebar, so we mustn't use that id.
		echo '<section id="container"><div id="content" role="main" class="wpfc-sermon-container wpfc-mantra ' . esc_attr( $additional_classes ) . '">';
		if ( function_exists( 'cryout_before_content_hook' ) ) {
			// Breadcrumbs and the Above Content widget area.
			cryout_before_content_hook();
		}
		break;
	case 'kubio':
		// Kubio's own section, boxed container and content column.
		// Single: template-parts/content/single.php lines 1 to 7. Archive: template-parts/content/index.php lines 1 to 7.
		// Kubio has no sidebar, and its archive masonry grid is for its own cards, so neither is reproduced.
		if ( is_singular() ) {
			echo '<div id="content"><div class="wp-block wp-block-kubio-query-layout position-relative wp-block-kubio-query-layout__outer kubio-single__k__single-lAFSH8Xo9x-outer kubio-local-521-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/query-layout"><div class="position-relative wp-block-kubio-query-layout__inner kubio-single__k__single-lAFSH8Xo9x-inner kubio-local-521-inner h-section-grid-container h-section-boxed-container"><div class="wp-block wp-block-kubio-row position-relative wp-block-kubio-row__container kubio-single__k__single-baLWB4dRKjp-container kubio-local-522-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row"><div class="position-relative wp-block-kubio-row__inner kubio-single__k__single-baLWB4dRKjp-inner kubio-local-522-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0"><div class="wp-block wp-block-kubio-column position-relative wp-block-kubio-column__container kubio-single__k__single-kxeqsSpdy-n-container kubio-local-523-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column"><div class="position-relative wp-block-kubio-column__inner kubio-single__k__single-kxeqsSpdy-n-inner kubio-local-523-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-0 h-px-md-3 v-inner-md-0 h-px-3 v-inner-0"><div class="position-relative wp-block-kubio-column__align kubio-single__k__single-kxeqsSpdy-n-align kubio-local-523-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start wpfc-sermon-container wpfc-kubio ' . esc_attr( $additional_classes ) . '">';
		} else {
			echo '<div id="content"><div class="wp-block wp-block-kubio-query-layout position-relative wp-block-kubio-query-layout__outer kubio-index__k__1MCYzfcZN-outer kubio-local-184-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/query-layout" id="blog-layout"><div class="position-relative wp-block-kubio-query-layout__inner kubio-index__k__1MCYzfcZN-inner kubio-local-184-inner h-section-grid-container h-section-boxed-container"><div class="wp-block wp-block-kubio-row position-relative wp-block-kubio-row__container kubio-index__k__baLWB4dRKjp-container kubio-local-185-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-3 gutters-row-v-0" data-kubio="kubio/row"><div class="position-relative wp-block-kubio-row__inner kubio-index__k__baLWB4dRKjp-inner kubio-local-185-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-3 gutters-col-v-0"><div class="wp-block wp-block-kubio-column position-relative wp-block-kubio-column__container kubio-index__k__kxeqsSpdy-n-container kubio-local-186-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column"><div class="position-relative wp-block-kubio-column__inner kubio-index__k__kxeqsSpdy-n-inner kubio-local-186-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-0 h-px-md-2 v-inner-md-0 h-px-2 v-inner-0"><div class="position-relative wp-block-kubio-column__align kubio-index__k__kxeqsSpdy-n-align kubio-local-186-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start wpfc-sermon-container wpfc-kubio ' . esc_attr( $additional_classes ) . '">';
		}
		break;
	case 'twentytwenty':
		// Twenty Twenty's singular.php:15 and template-parts/content.php:28. The column is the theme's own .section-inner.thin (58rem).
		echo '<main id="site-content"><div class="post-inner"><div class="section-inner thin wpfc-sermon-container wpfc-twentytwenty ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentytwentyone':
		// Twenty Twenty-One opens #primary and #main in header.php. Its post column is the .default-max-width utility (style.css:695).
		echo '<div class="default-max-width wpfc-sermon-container wpfc-twentytwentyone ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'generatepress':
		// GeneratePress's single.php:14-22 and archive.php:68-76. Its attribute helper adds the layout classes, including the old float grid.
		if ( function_exists( 'generate_do_attr' ) ) {
			echo '<div ';
			generate_do_attr( 'content' );
			echo '><main ';
			generate_do_attr( 'main' );
			echo '>';
		} else {
			echo '<div id="primary" class="content-area"><main id="main" class="site-main">';
		}
		do_action( 'generate_before_main_content' );
		// The theme's content box, as in content-single.php:13.
		echo '<div class="inside-article wpfc-sermon-container wpfc-generatepress ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'blocksy':
		// Blocksy opens main in header.php. This is template-parts/archive.php:146-156, and the plain-container branch of template-parts/single.php:58-63.
		$sm_blocksy_class = 'ct-container';
		$sm_blocksy_attrs = array();
		if ( is_singular() && function_exists( 'blocksy_get_page_structure' ) && 'narrow' === blocksy_get_page_structure() ) {
			$sm_blocksy_class = 'ct-container-narrow';
		}
		if ( ! apply_filters( 'sm_disable_sidebar', false ) && function_exists( 'blocksy_sidebar_position_attr' ) ) {
			$sm_blocksy_attrs = blocksy_sidebar_position_attr( array( 'array' => true ) );
		}
		if ( function_exists( 'blocksy_get_v_spacing' ) ) {
			$sm_blocksy_attrs = array_merge( $sm_blocksy_attrs, blocksy_get_v_spacing( array( 'array' => true ) ) );
		}
		echo '<div class="' . esc_attr( $sm_blocksy_class ) . '"';
		foreach ( $sm_blocksy_attrs as $sm_attr => $sm_value ) {
			echo ' ' . esc_attr( $sm_attr ) . '="' . esc_attr( $sm_value ) . '"';
		}
		echo '>';
		do_action( is_singular() ? 'blocksy:single:container:top' : 'blocksy:archive:container:top' );
		echo '<section class="wpfc-sermon-container wpfc-blocksy ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'neve':
		// Neve's single.php:9-18 and index.php:63-97, so its container and sidebar settings apply.
		$neve_context = is_singular() ? 'single-post' : 'blog-archive';
		$neve_outer   = is_singular() ? 'single-post-container' : 'archive-container';
		$neve_inner   = is_singular() ? 'nv-single-post-wrap col' : 'nv-index-posts blog col';
		echo '<div class="' . esc_attr( apply_filters( 'neve_container_class_filter', 'container', $neve_context ) . ' ' . $neve_outer ) . '"><div class="row">';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			// Prints only when the Customizer puts the sidebar on the left.
			do_action( 'neve_do_sidebar', $neve_context, 'left' );
		}
		echo '<div class="' . esc_attr( $neve_inner ) . ' wpfc-sermon-container wpfc-neve ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'popularfx':
		// PopularFX's single.php and archive.php: a bare main, sidebar beside it.
		// Its content box is the .article class on each post, so our container carries it.
		echo '<main id="primary" class="site-main"><div class="article wpfc-sermon-container wpfc-popularfx ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'lightning':
		if ( function_exists( 'lightning_is_g3' ) && lightning_is_g3() && function_exists( 'lightning_get_the_class_name' ) ) {
			// Lightning G3 prints its site header, page header and breadcrumb from _g3/index.php:43-104,
			// not header.php, so the wrapper prints them through the theme's own parts and hooks.
			do_action( 'lightning_site_header_before', 'lightning_site_header_before' );
			if ( apply_filters( 'lightning_is_site_header', true, 'site_header' ) ) {
				lightning_get_template_part( 'template-parts/site-header' );
			}
			do_action( 'lightning_site_header_after', 'lightning_site_header_after' );

			do_action( 'lightning_page_header_before', 'lightning_page_header_before' );
			if ( apply_filters( 'lightning_is_page_header', true, 'page_header' ) ) {
				lightning_get_template_part( 'template-parts/page-header' );
			}
			do_action( 'lightning_page_header_after', 'lightning_page_header_after' );

			do_action( 'lightning_breadcrumb_before', 'lightning_breadcrumb_before' );
			if ( apply_filters( 'lightning_is_breadcrumb_position_normal', true, 'breadcrumb_position_normal' ) && apply_filters( 'lightning_is_breadcrumb', true, 'breadcrumb' ) && class_exists( '\VektorInc\VK_Breadcrumb\VkBreadcrumb' ) ) {
				$lightning_breadcrumb = new \VektorInc\VK_Breadcrumb\VkBreadcrumb();
				$lightning_breadcrumb->the_breadcrumb(
					array(
						'id_outer'        => 'breadcrumb',
						'class_outer'     => 'breadcrumb',
						'class_inner'     => 'container',
						'class_list'      => 'breadcrumb-list',
						'class_list_item' => 'breadcrumb-list__item',
					)
				);
			}
			do_action( 'lightning_breadcrumb_after', 'lightning_breadcrumb_after' );

			do_action( 'lightning_site_body_before', 'lightning_site_body_before' );
			echo '<div class="' . esc_attr( lightning_get_the_class_name( 'site-body' ) ) . '">';
			do_action( 'lightning_site_body_prepend', 'lightning_site_body_prepend' );
			echo '<div class="' . esc_attr( lightning_get_the_class_name( 'site-body-container' ) ) . ' container">';
			echo '<div class="' . esc_attr( lightning_get_the_class_name( 'main-section' ) ) . ' wpfc-sermon-container wpfc-lightning ' . esc_attr( $additional_classes ) . '" id="main" role="main">';
			do_action( 'lightning_main_section_prepend', 'lightning_main_section_prepend' );
		} else {
			// Lightning G2 prints its site header from header.php; keep the generic markup for now.
			echo '<div class="wrap"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container wpfc-lightning ' . esc_attr( $additional_classes ) . '">';
		}
		break;
	case 'sydney':
		// Sydney's sydney_single_template() and sydney_archive_template() (inc/extras.php),
		// inside the container and row its header.php opens.
		if ( function_exists( 'sydney_sidebar_position' ) ) {
			$sydney_classes = sydney_sidebar_position();
			if ( is_singular() ) {
				$sydney_classes .= ' ' . apply_filters( 'sydney_content_area_class', get_theme_mod( 'fullwidth_single' ) ? 'fullwidth' : 'col-md-9' );
			} else {
				$sydney_classes .= ' archive-wrapper ' . ( function_exists( 'sydney_blog_layout' ) ? sydney_blog_layout() : '' ) . ' ' . apply_filters( 'sydney_content_area_class', 'col-md-9' );
			}
		} else {
			$sydney_classes = 'col-md-9';
		}
		echo '<div id="primary" class="content-area ' . esc_attr( $sydney_classes ) . '">';
		if ( is_singular() && function_exists( 'sydney_yoast_seo_breadcrumbs' ) ) {
			// Prints only when Yoast breadcrumbs are available.
			sydney_yoast_seo_breadcrumbs();
		}
		echo '<main id="main" class="post-wrap wpfc-sermon-container wpfc-sydney ' . esc_attr( $additional_classes ) . '" role="main">';
		break;
	case 'hestia':
		// Hestia's single.php:11-16 with template-parts/content-single.php:11-22, and archive.php:55-72.
		$hestia_sidebar = 'sidebar-right';
		if ( function_exists( 'hestia_get_blog_layout_default' ) ) {
			$hestia_sidebar = apply_filters( 'hestia_sidebar_layout', get_theme_mod( 'hestia_blog_sidebar_layout', hestia_get_blog_layout_default() ) );
		}
		$hestia_main = function_exists( 'hestia_layout' ) ? hestia_layout() : 'main main-raised';
		if ( is_singular() ) {
			// The hero, with the title in the default header layout.
			do_action( 'hestia_before_single_post_wrapper' );
			$hestia_col = apply_filters( 'hestia_filter_single_post_content_classes', 'col-md-8 single-post-container' );
			echo '<div class="' . esc_attr( $hestia_main ) . '"><div class="blog-post blog-post-wrapper"><div class="container"><div class="section section-text"><div class="row">';
		} else {
			// The hero, with the archive title.
			do_action( 'hestia_before_archive_content' );
			$hestia_col = apply_filters( 'hestia_filter_archive_content_classes', 'col-md-8 archive-post-wrap' );
			echo '<div class="' . esc_attr( $hestia_main ) . '"><div class="hestia-blogs" data-layout="' . esc_attr( $hestia_sidebar ) . '"><div class="container"><div class="row">';
		}
		if ( 'sidebar-left' === $hestia_sidebar && ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '<div class="' . esc_attr( $hestia_col ) . ' wpfc-sermon-container wpfc-hestia ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'twentyten':
		// Twenty Ten's own single.php and archive.php markup (single.php:12-13).
		echo '<div id="container"><div id="content" role="main" class="wpfc-sermon-container wpfc-twentyten ' . esc_attr( $additional_classes ) . '">';
		break;
	case 'kadence':
		// Kadence's own page markup (template-parts/content/single.php), so its layout settings apply.
		if ( function_exists( 'Kadence\kadence' ) ) {
			// Kadence loads its content styles from the page template, not the header.
			\Kadence\kadence()->print_styles( 'kadence-content' );
		}
		echo '<div id="primary" class="content-area"><div class="content-container site-container"><div id="main" class="site-main"><div class="content-wrap"><div class="entry content-bg single-entry"><div class="entry-content-wrap wpfc-sermon-container wpfc-kadence ' . esc_attr( $additional_classes ) . '">';
		break;
	default:
		echo wp_kses_post( apply_filters( 'sm_templates_wrapper_start', '<div class="wrap"><div id="primary" class="content-area"><main id="main" class="site-main wpfc-sermon-container ' . esc_attr( $additional_classes ) . '">' ) );
		break;
}
