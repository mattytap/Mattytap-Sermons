<?php
/**
 * Archive wrapper, for theme compatibility.
 *
 * @package SM/Views/Partials
 */

defined( 'ABSPATH' ) or exit;

$template = get_option( 'template' );

switch ( $template ) {
	case 'twentyeleven':
		echo '</div></div>';
		if ( is_archive() ) {
			if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
				get_sidebar();
			}
		}
		break;
	case 'twentytwelve':
		echo '</div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		break;
	case 'twentythirteen':
		echo '</div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		break;
	case 'twentyfourteen':
		echo '</div></div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar( 'content' );
			get_sidebar();
		}
		break;
	case 'twentyfifteen':
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	case 'twentysixteen':
		echo '</main></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		break;
	case 'twentyseventeen':
		echo '</main></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div>';
		break;
	case 'twentynineteen':
		echo '</div></div></main></div>';
		break;
	case 'twentytwentyfour':
		echo '</main></div></div>';
		break;
	case 'Divi':
		echo '</main>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div></div>';
		break;
	case 'salient':
		echo '</div></div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	case 'Avada':
		echo '</div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div>';
		break;
	case 'wpfc-morgan':
		echo '</div></section>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar( 'sermon' );
		}
		get_footer();
		break;
	case 'bb-theme':
		echo '</div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	case 'bb-theme-builder':
		echo '</div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	case 'oceanwp':
		echo '</div><!-- end of #content -->';
		echo '</div><!-- end of #primary -->';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div><!-- end of #content-wrap -->';
		break;
	case 'pro':
	case 'x':
		$fullwidth = get_post_meta( get_the_ID(), '_x_post_layout', true ); // phpcs:ignore

		echo '</div>';
		if ( 'on' != $fullwidth ) :
			if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
				get_sidebar();
			}
		endif;
		echo '</div>';
		break;
	case 'genesis':
		echo '</main>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div>';
		break;
	case 'maranatha':
		echo '</div></div></main>';
		break;
	case 'saved':
		echo '</div></div></main>';
		break;
	case 'brandon':
		echo '</div></div>';
		break;
	case 'hueman':
	case 'hueman-pro':
		echo '</div></section>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		break;
	case 'NativeChurch':
		echo '</div></div></div>';
		break;
	case 'betheme':
		echo '</div></div></div></div></div></div></div>';
		break;
	case 'dt-the7':
	case 'the7':
		echo '</div>';
		do_action( 'presscore_after_content' );
		break;
	case 'dunamis':
		$croma       = get_option( 'cromatic' );
		$sidebarrule = ( isset( $croma['cro_catsidebar'] ) ) ? esc_attr( $croma['cro_catsidebar'] ) : 3;

		echo '</div></div>';

		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			if ( $sidebarrule != 1 && $sidebarrule != 2 ) {
				echo '<div class="large-4 column">';
				get_sidebar();
				echo '</div>';
			}
		}

		echo '</div></div>';
		break;
	case 'exodoswp':
		echo '</div></div></div></div>';
		break;
	case 'kerygma':
		echo '</div><!-- #content -->';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div><!-- #page-wrap -->';
		get_footer();
		break;
	case 'uncode':
		if ( ! is_single() ) {
			$limit_width          = $limit_content_width = $the_content = $main_content = $layout = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_classes = $generic_body_content_block = '';
			$index_has_navigation = false;
			$sidebar_fill         = ot_get_option( '_uncode_' . $post_type . '_sidebar_fill' );
			$sidebar_bg_color     = ot_get_option( '_uncode_' . $post_type . '_sidebar_bgcolor' );
			$style                = ot_get_option( '_uncode_general_style' );
			$bg_color             = ot_get_option( '_uncode_general_bg_color' );
			$bg_color             = ( $bg_color == '' ) ? ' style-' . $style . '-bg' : ' style-' . $bg_color . '-bg';

			$the_content .= ob_get_clean();

			$the_content .=
				'</div>
				</div>
			</div>';

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
							$main_classes   .= ' std-block-padding';
						} else {
							$row_classes  .= ' no-top-padding';
							$main_classes .= ' double-top-padding';
						}
					} else {
						$row_classes           .= ' double-top-padding';
						$row_classes           .= ' double-bottom-padding';
						$sidebar_inner_padding .= $sidebar_bg_color . ' single-block-padding';
					}
				} else {
					$row_classes  .= ' col-std-gutter double-top-padding';
					$main_classes .= ' double-bottom-padding';
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

				$the_content = '<div class="post-content style-' . $style . $main_classes . '">' . $the_content . '</div>';

				$main_content = '<div class="col-lg-' . $main_size . '">
											' . $the_content . '
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
			} else {

				/** Create html without sidebar **/
				if ( $generic_body_content_block === '' ) {
					$the_content = '<div class="post-content un-no-sidebar-layout"' . $page_custom_width . '>' . uncode_get_row_template( $the_content, $limit_width, $limit_content_width, $style, '', 'double', true, 'double' ) . '</div>';
				} else {
					$the_content = '<div class="post-content un-no-sidebar-layout"' . $page_custom_width . '>' . $the_content . '</div>';
				}

			}

			/** Build and display navigation html **/
			$remove_pagination = ot_get_option( '_uncode_' . $post_type . '_remove_pagination' );
			if ( ! $index_has_navigation && $remove_pagination !== 'on' ) {
				$navigation_option = ot_get_option( '_uncode_' . $post_type . '_navigation_activate' );
				if ( $navigation_option !== 'off' ) {
					$navigation = uncode_posts_navigation();
					if ( ! empty( $navigation ) && $navigation !== '' ) {
						$navigation_content = uncode_get_row_template( $navigation, '', $limit_content_width, $style, ' row-navigation row-navigation-' . $style, true, true, true );
					}
				}
			}

			/** Display post html **/
			echo '<div class="page-body' . esc_attr( $bg_color ) . '">
          <div class="post-wrapper">
          	<div class="post-body">' . do_shortcode( $the_content ) . '</div>' .
			     wp_kses_post( $navigation_content ) . '
          </div>
        </div>';

			get_footer();
		} else {
			$the_content .= ob_get_clean();
			echo wp_kses_post( uncode_remove_p_tag( $the_content ) ) . '</div></div></div></article>';
		}
		break;
	case 'onepress':
		echo '</main></div>';
		$sm_onepress_layout = function_exists( 'onepress_get_layout' ) ? onepress_get_layout() : 'right-sidebar';
		if ( 'no-sidebar' !== $sm_onepress_layout && ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	case 'envo-royal':
		if ( is_singular() ) {
			echo '</div></article>';
			if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
				// single.php:24. Honours Envo Extra's per-post "hide sidebar" setting.
				do_action( 'envo_royal_sidebar' );
			}
		} else {
			echo '</div>';
			if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
				// archive.php:16. With no sidebar-right.php this loads sidebar.php.
				get_sidebar( 'right' );
			}
		}
		echo '</div>';
		break;
	case 'total':
		echo '</main></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div>';
		break;
	case 'mantra':
		if ( function_exists( 'cryout_after_content_hook' ) ) {
			// The Below Content widget area (single.php:68, archive.php:70).
			cryout_after_content_hook();
		}
		echo '</div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			// Mantra's sidebar.php reads the layout option itself, including one column.
			get_sidebar();
		}
		echo '</section>';
		break;
	case 'kubio':
		// Kubio's comments.php prints only the list. Its single template prints the form
		// separately, after the comments (template-parts/content/single.php lines 137 to 139).
		if (
			is_singular()
			&& comments_open()
			&& ! post_password_required()
			&& ! apply_filters( 'single-wpfc_sermon-disable-comments', false )
			&& wp_normalize_path( get_template_directory() . '/comments.php' ) === wp_normalize_path( locate_template( 'comments.php' ) )
		) {
			echo '<div class="wp-block wp-block-kubio-post-comments-form position-relative wp-block-kubio-post-comments-form__container kubio-single__k__single-oXoikmHxB-container kubio-local-542-container" data-kubio="kubio/post-comments-form">';
			comment_form();
			echo '</div>';
		}
		// Kubio draws no sidebar on posts or archives.
		echo '</div></div></div></div></div></div></div></div>';
		break;
	case 'twentytwenty':
		echo '</div></div></main>';
		// The theme prints its footer menus and widgets here, not in footer.php (singular.php:32).
		get_template_part( 'template-parts/footer-menus-widgets' );
		break;
	case 'twentytwentyone':
		echo '</div>';
		break;
	case 'generatepress':
		echo '</div>';
		do_action( 'generate_after_main_content' );
		echo '</main></div>';
		do_action( 'generate_after_primary_content_area' );
		// The theme's own sidebar logic, so its left, right, both and none settings apply (single.php:52).
		if ( ! apply_filters( 'sm_disable_sidebar', false ) && function_exists( 'generate_construct_sidebars' ) ) {
			generate_construct_sidebars();
		}
		break;
	case 'blocksy':
		echo '</section>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		do_action( is_singular() ? 'blocksy:single:container:bottom' : 'blocksy:archive:container:bottom' );
		echo '</div>';
		break;
	case 'neve':
		echo '</div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			// Neve's single.php:44 and index.php:223.
			do_action( 'neve_do_sidebar', is_singular() ? 'single-post' : 'blog-archive', 'right' );
		}
		echo '</div></div>';
		break;
	case 'popularfx':
		echo '</div></main>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			// sidebar.php prints nothing when popularfx_sidebar() says off.
			get_sidebar();
		}
		break;
	case 'lightning':
		if ( function_exists( 'lightning_is_g3' ) && lightning_is_g3() && function_exists( 'lightning_get_the_class_name' ) ) {
			// _g3/index.php:124-158.
			do_action( 'lightning_main_section_append', 'lightning_main_section_append' );
			echo '</div>';
			do_action( 'lightning_sub_section_before', 'lightning_sub_section_before' );
			if ( ! apply_filters( 'sm_disable_sidebar', false ) && function_exists( 'lightning_is_subsection' ) && lightning_is_subsection() ) {
				lightning_get_template_part( 'sidebar', get_post_type() );
			}
			do_action( 'lightning_sub_section_after', 'lightning_sub_section_after' );
			echo '</div>';
			do_action( 'lightning_site_body_append', 'lightning_site_body_append' );
			echo '</div>';

			if ( is_active_sidebar( 'footer-before-widget' ) ) {
				echo '<div class="site-body-bottom"><div class="container">';
				dynamic_sidebar( 'footer-before-widget' );
				echo '</div></div>';
			}

			do_action( 'lightning_site_footer_before', 'lightning_site_footer_before' );
			if ( apply_filters( 'lightning_is_site_footer', true, 'site_footer' ) ) {
				lightning_get_template_part( 'template-parts/site-footer' );
			}
			do_action( 'lightning_site_footer_after', 'lightning_site_footer_after' );
		} else {
			echo '</main></div>';
			if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
				get_sidebar();
			}
			echo '</div>';
		}
		break;
	case 'sydney':
		echo '</main></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			// Sydney's single.php:16 and archive.php:36; honours its sidebar toggles.
			do_action( 'sydney_get_sidebar' );
		}
		break;
	case 'hestia':
		echo '</div>';
		$hestia_sidebar = 'sidebar-right';
		if ( function_exists( 'hestia_get_blog_layout_default' ) ) {
			$hestia_sidebar = apply_filters( 'hestia_sidebar_layout', get_theme_mod( 'hestia_blog_sidebar_layout', hestia_get_blog_layout_default() ) );
		}
		if ( 'sidebar-right' === $hestia_sidebar && ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		if ( is_singular() ) {
			echo '</div></div></div></div></div>';
		} else {
			echo '</div></div></div></div>';
		}
		break;
	case 'twentyten':
		echo '</div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		break;
	case 'colibri-wp':
		echo '</div>';
		// Same test as SingleContent::printRightSidebarColumn(): the theme's sidebar filter and an active widget area.
		if ( ! apply_filters( 'sm_disable_sidebar', false ) && function_exists( 'colibriwp_theme' ) && apply_filters( 'colibriwp_theme_blog_sidebar_enabled', true, 'right' ) && is_active_sidebar( 'colibri-sidebar-1' ) ) {
			echo '<div data-colibri-main-sidebar-col="1" class="h-col h-col-12 h-col-lg-3 h-col-md-4 colibri-sidebar blog-sidebar-right">';
			get_sidebar();
			echo '</div>';
		}
		echo '</div></div></div></div></div>';
		break;
	case 'kadence':
		echo '</div></div></div></div>';
		if ( ! apply_filters( 'sm_disable_sidebar', false ) ) {
			get_sidebar();
		}
		echo '</div></div>';
		break;
	default:
		/*
		 * Without a sidebar.php, get_sidebar() falls back to WordPress's
		 * deprecated theme-compat sidebar. locate_template() finds that
		 * fallback too, so it doesn't count as the theme having one.
		 */
		$sm_theme_sidebar = locate_template( 'sidebar.php' );
		$sm_show_sidebar  = ! apply_filters( 'sm_disable_sidebar', false ) && $sm_theme_sidebar && false === strpos( wp_normalize_path( $sm_theme_sidebar ), '/' . WPINC . '/theme-compat/' );

		if ( ! has_filter( 'sm_templates_wrapper_end' ) ) {
			// The sidebar is the theme's own escaped output; kses would strip its forms and scripts (#86).
			echo '</main></div>';
			if ( $sm_show_sidebar ) {
				get_sidebar();
			}
			// Clears floated columns, so the theme's footer can't ride up behind the sermon.
			echo '<div class="wpfc-sermon-clear"></div></div>';
		} else {
			if ( SM_OB_ENABLED && $sm_show_sidebar ) {
				ob_start();
				get_sidebar();
				$sidebar = ob_get_clean();
			} else {
				$sidebar = '';
			}
			// Filtered markup belongs to whoever filtered it, so it keeps its escaping.
			echo wp_kses_post( apply_filters( 'sm_templates_wrapper_end', '</main></div>' . $sidebar . '</div>' ) );
		}
		break;
}
