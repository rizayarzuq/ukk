<?php
/**
 * Template part for displaying team.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

$options = graduate_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>">
	<div class="column-wrapper">
		<div class="team-members">
			<div class="image-wrapper">
				<a href="<?php the_permalink(); ?>">
					<?php 
					if( has_post_thumbnail() ) :
						the_post_thumbnail( $size = 'graduate_trending_courses', $attr = array( 'alt' => esc_attr( get_the_title() ) ) );
					else :
		                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title() ) . '">';
					endif;
					?>
				</a>
			</div><!--.image-wrapper-->
			<div class="team-content">
				<a href="<?php the_permalink(); ?>"><h2 class="name"><?php the_title(); ?></h2></a>
				<?php if( function_exists( 'tp_team_designation' ) ) : ?>
					<p class="post"><?php tp_team_designation(); ?></p>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html( $options['read_more_text'] ); ?></a>
			</div><!--.team-content-->
		</div>
	</div><!--.column-wrapper-->
</article><!-- #post-## -->
