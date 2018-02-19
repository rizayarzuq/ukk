<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CT Corporate
 */


if ( ! function_exists( 'ct_corporate_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function ct_corporate_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation','ct-corporate' ); ?></h2>
			<div class="nav-links clearfix">
				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous">
					<?php next_posts_link( __( '<i class="fa fa-long-arrow-left post-arrow"></i>Older posts','ct-corporate' ) ); ?>
				</div>
				<?php else :  ?>
					<div class="nav-previous disabled">
						<a href="#">
							<i class="fa fa-long-arrow-left post-arrow"></i><?php esc_html_e( 'No Older posts','ct-corporate' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next">
					<?php previous_posts_link( __( 'Newer posts <i class="fa fa-long-arrow-right post-arrow"></i> ','ct-corporate' ) ); ?></div>
				<?php else :  ?>
					<div class="nav-next disabled">
					<a href="#"> <i class="fa fa-long-arrow-right post-arrow"></i><?php esc_html_e( 'No Newer post','ct-corporate' ); ?></a></div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'ct_corporate_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function ct_corporate_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$prev_post = get_adjacent_post(false, '', true);
		 $next_post = get_adjacent_post(false, '', false);
		if ( ! $next_post && ! $prev_post ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation','ct-corporate' ); ?></h2>
			<div class="nav-links clearfix">

                <?php $next_post = get_adjacent_post(false, '', false); if(!empty($next_post)) : ?>
                   <div class="nav-previous">
                        <?php
                            echo '<a href="' . esc_url(get_permalink($next_post->ID)) . '" title="' . esc_attr( $next_post->post_title ) . '" rel="prev"><i class="fa fa-long-arrow-left post-arrow"></i>' . wp_kses_post(ct_corporate_limit_title(($next_post->post_title), 29)) . '</a>';
                        ?>
                    </div>
                    <?php else : ?>
                   <div class="nav-previous disabled">
                       <a href="#"><i class="fa fa-long-arrow-left post-arrow"></i><?php esc_html_e( 'No Previous post','ct-corporate' ); ?></a>
                    </div>
                <?php endif; ?>

                <?php $prev_post = get_adjacent_post(false, '', true);
                    if(!empty($prev_post)) : ?>
                    <div class="nav-next">
                        <?php
                            echo '<a href="' . esc_url( get_permalink($prev_post->ID) ) . '" title="' . esc_attr($prev_post->post_title) . '" rel="next">' . wp_kses_post(ct_corporate_limit_title($prev_post->post_title, 32)). '<i class="fa fa-long-arrow-right post-arrow"></i></a>';
                        ?>
                    </div>
                    <?php else : ?>
                    <div class="nav-next disabled">
    					<a href="#"><?php esc_html_e( 'No Newer post ','ct-corporate' ); ?><i class="fa fa-long-arrow-right post-arrow"></i>
    					</a>
    				</div>

                <?php endif; ?>


			</div>
			<!-- End .nav-links -->
		</nav><!-- End .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'ct_corporate_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function ct_corporate_posted_on() {

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		} else {
			$time_string = '<time class="entry-date published updated" datetime="%3$s">%4$s</time>';
		}

		$time_strings = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$archive_year  = get_the_time( 'Y' );
			$archive_month = get_the_time( 'm' );
			$archive_day   = get_the_time( 'd' );

		$posted_on = sprintf(
			_x( 'On%s', 'post date','ct-corporate' ),
			'<a href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) . '" rel="bookmark"> ' . $time_strings . '</a>'
		);

		$byline = sprintf(
			_x( 'by %s', 'post author','ct-corporate' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author() ) . '</a></span>'
		);

if (  'post' == get_post_type() ) {
		echo '<span class="byline"> ' . $byline . '</span><span class="meta-sep"> / </span><span class="posted-on">' . $posted_on . '</span>';
}
		if ( true == get_post_format() &&  'post' == get_post_type() ) {
			echo '<span class="meta-sep"> / </span><span class="post-format">
						<span class="cat-links">In <a class="entry-format" href="' .esc_url( get_post_format_link( get_post_format() ) ) .'">'. esc_html(get_post_format_string( get_post_format() )) .'</span></a>
					</span>';
			}
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ','ct-corporate' ) );
			if ( $categories_list && ct_corporate_categorized_blog() ) {
				printf( '<span class="meta-sep"> / </span><span class="cat-links"> In ' .esc_html__( ' %1$s','ct-corporate' ) . '</span>', wp_kses_post($categories_list) );
			}
		}
	}
endif;

if ( ! function_exists( 'ct_corporate_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ct_corporate_entry_footer() {
		// Hide category and tag text for pages.
		?><div class="footer-meta-wrap clearfix"><?php
		if ( 'post' == get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ' ','ct-corporate' ) );
			if ( $tags_list ) {
				if ( is_singular() ) {
					printf( '<span class="tags-links tagcloud">' . esc_html__( 'Posted in %1$s','ct-corporate' ) . '</span>', wp_kses_post($tags_list) );
				}
			}
		}

		if ( ! is_single() && ! is_page() &&  ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment','ct-corporate' ), __( '<i class="fa fa-comments-o"></i> 1 Comment','ct-corporate' ), __( '<i class="fa fa-comments-o"></i> % Comments','ct-corporate' ) );
			echo '</span>';
		}

		edit_post_link( __( 'Edit','ct-corporate' ), '<span class="edit-link btn"><i class="fa fa-pencil"></i> ', '</span>' );
		?></div>

		<?php
		if ( is_single() ){ ?>
			<div class="post-author">
				<div class="author-img text-center">
					<?php echo (get_avatar( get_the_author_meta( 'ID' ), 60 ));?>
				</div>
				<div class="author-desc">
					<h5><?php esc_html_e('Article By','ct-corporate'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"><?php the_author_meta('display_name'); ?></a></h5>
					<p><?php the_author_meta('description'); ?></p>

					<div class="author-links">
						<a class="author-link-posts upper" title="<?php esc_html_e('Author archive','ct-corporate'); ?>" href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><i class="fa fa-archive"></i> <?php esc_html_e('Author archive','ct-corporate'); ?></a>

								<?php $author_url = get_the_author_meta('user_url');

								$author_url = preg_replace('#^https?://#', '', rtrim($author_url,'/'));

								if (!empty($author_url)) : ?>

									<a class="upper author-link-website" title="<?php esc_html_e('Author website','ct-corporate'); ?>" href="<?php echo esc_url( get_the_author_meta('user_url') ); ?>"><i class="fa fa-globe"></i> <?php esc_html_e('Author website','ct-corporate'); ?></a>

								<?php endif;

								$author_mail = get_the_author_meta('email');

								$show_mail = get_the_author_meta('showemail');

								if ( !empty($author_mail) && ($show_mail == "yes") ) : ?>

									<a class="upper author-link-mail" title="<?php echo esc_attr($author_mail); ?>" href="mailto:<?php echo esc_url(antispambot($author_mail)); ?>"><?php echo esc_html($author_mail); ?></a>

								<?php endif; ?>
					</div>
					<!-- Author-links -->

				</div>
				<!-- Author Desc -->
			</div>
			<!-- Post Author -->
		<?php }

		//RELATED POSTS
	if ( !class_exists( 'Jetpack' )){
		if ( is_single() ) {
			global $post;
			$tags = wp_get_post_tags( $post->ID );
			if ( $tags ) {
				$related_tags = array();
				foreach ($tags as $key => $value) {
					$related_tags[] = $value->term_id;
				}
				$args=array(
					'tag__in'        => $related_tags,
					'post__not_in'   => array( $post->ID ),
					'posts_per_page' => 3,
				);
				$my_query = new WP_Query( $args );
				if( $my_query->have_posts() ) {
					?>
					<div class="related-post-wrap therwrap">
						<div class="row">
							<?php
								echo sprintf( esc_attr(__('%1$sRelated Posts%2$s','ct-corporate')), '<div class="col-md-12"><h4>', '</h4></div>' );
								while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
									<div class="col-md-4 col-sm-4">
										<div class="tags_related_post">
											<?php
											if ( has_post_thumbnail() ) {
												echo sprintf( esc_attr(__( 'Related Posts %1$s%2$s%3$s','ct-corporate' )),
													'<a title="'.esc_attr( get_the_title( $post->ID ) ).'" class="related_post_thumbnail" href="'.esc_url( get_permalink($post->ID) ).'">',
													esc_url( get_the_post_thumbnail( $post->ID ) ),
													'</a>'
												);
											}

											echo sprintf( esc_attr(__( 'Related Posts %1$s%2$s%3$s','ct-corporate' )),
												'<a href="'.esc_url( get_permalink( $post->ID ) ).'" rel="related_posts" title="'.esc_attr( get_the_title( $post->ID ) ).'">',
												esc_html( get_the_title( $post->ID ) ),
												'</a>' );
										?>
										</div>
									</div>

									<?php
									endwhile; ?>
					</div>
					<?php
					wp_reset_query();
				} else { ?>
					<div class="related-post-wrap thedwrap ">
						<div class="row">
							<?php
								echo sprintf( esc_html__('%1$sRelated Posts%2$s','ct-corporate'), '<div class="col-md-12"><h4>', '</h4></div>' );
								$count_related_posts = 3;
								for ( $i=0; $i < $count_related_posts ; $i++ ) {
									echo '<div class="col-md-4 col-sm-4"><a href="#" class="related_post_thumbnail">
										<div class="tags_related_post">
										<img src="'.esc_url( get_template_directory_uri() ).'/img/CTCorporate.png">
										<a href="#" rel="related_posts" title="'.esc_html__('CT Corporate', 'ct-corporate').'">
										Related Posts
										</a>
										</div></a></div>';
							} ?>
						</div>
					</div>
				<?php
				}
			}
		}
	}
	}
endif;

if ( ! function_exists( 'ct_corporate_archive_title' ) ) :
	/**
	 * Shim for `ct_corporate_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function ct_corporate_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s','ct-corporate' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s','ct-corporate' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s','ct-corporate' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s','ct-corporate' ), get_the_date( _x( 'Y', 'yearly archives date format','ct-corporate' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s','ct-corporate' ), get_the_date( _x( 'F Y', 'monthly archives date format','ct-corporate' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s','ct-corporate' ), get_the_date( _x( 'F j, Y', 'daily archives date format','ct-corporate' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title','ct-corporate' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title','ct-corporate' );
			} else {
				$title = _x( 'Standard', 'post format archive title','ct-corporate' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s','ct-corporate' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s','ct-corporate' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives','ct-corporate' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo wp_kses_post($before) . wp_kses_post($title) . wp_kses_post($after);
		}
	}
endif;

if ( ! function_exists( 'ct_corporate_archive_description' ) ) :
	/**
	 * Shim for `ct_corporate_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function ct_corporate_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo wp_kses_post($before) . wp_kses_post($description) . wp_kses_post($after);
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ct_corporate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ct_corporate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ct_corporate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ct_corporate_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ct_corporate_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ct_corporate_categorized_blog.
 */
function ct_corporate_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ct_corporate_categories' );
}
add_action( 'edit_category', 'ct_corporate_category_transient_flusher' );
add_action( 'save_post', 'ct_corporate_category_transient_flusher' );


if( !function_exists( 'ct_corporate_post_thumbnail' ) ) :
	/***
	* Display post thumbnail
	*
	* Warp post thumbnail in index view in an anchor element, or a div element
	* on a single view
	*
	*/
	function ct_corporate_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if( is_singular() ) :
			?>
				<div class="featured-image">
						<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
				</div>
			<?php else : ?>
				<?php if ( has_post_thumbnail() ) :?>
					<div class="featured-image archive-thumb">
						<a title="<?php the_title(); ?>" href="<?php echo esc_url( get_permalink() ); ?>" class="post-thumbnail">
							<?php the_post_thumbnail( 'custom_post_size', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
							<div class="share-mask">
					        	<div class="share-wrap">
						          	<div class="share-content">
							            <!-- <span><i class="fa fa-eye fa-3x"></i></span> -->
							            <h2><?php esc_html_e( 'Read More','ct-corporate');?></h2>
						          	</div>
					        	</div>
					      	</div>
						</a>
					</div>
				<?php endif; ?>
			<?php
		endif;
	}
endif;


if ( !function_exists( 'ct_corporate_post_content' ) ) :
	/*
	* Displays the post content on single page or
	* excerpt on index page
	*
	*
	*/
	
	function ct_corporate_post_content() {
		if ( !get_the_content() ) {
			return;
		}
		if ( is_singular() || is_page() ) :
			the_content();
			else :
				if ( has_post_format( array( 'video', 'audio' ) ) ) :
					the_content();
					else :
						the_excerpt();
				endif;
		endif;
	}
endif;