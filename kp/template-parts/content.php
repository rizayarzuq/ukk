<?php
/**
 * Template for content - posts
 *
 * @package compact-one
 */

?>

	<?php cyberchimps_featured_image(); ?>

	<!-- Display Title -->
	<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

	<div class="magazine-metadata">
		<i aria-hidden="true" class="fa fa-calendar"></i> <a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?></a>
			<?php
			echo " <br />by ";
			the_author_posts_link();
			echo " in ";
			the_category( ', ' );
			?>
	</div>

	<div class="entry">
		<?php
			add_filter( 'the_excerpt', 'compact_one_excerpt_read_more', 21 );
			the_excerpt();
			remove_filter( 'the_excerpt', 'compact_one_excerpt_read_more', 21 );
		?>
	</div>
	<?php edit_post_link( __( 'Edit', 'compact-one' ), '<span class="edit-link">', '</span>' ); ?>
