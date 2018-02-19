<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php 
		$header_image_meta = graduate_header_image_meta_option();
		if ( ! $header_image_meta || is_front_page() ) :
			if ( ! get_header_image() ) :
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
			endif;
		endif;
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php graduate_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
		<?php if ( is_array( $header_image_meta ) ) {
			$header_image_meta = $header_image_meta[1];
		} 
		if ( 'show-both' == $header_image_meta && has_post_thumbnail() ) { ?>
			<div class="blog-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</div>
		<?php } 
			$post_tags = get_the_tags();
			if ($post_tags) {
				esc_html_e( 'TAGS: ', 'graduate' );
			  foreach( $post_tags as $tag ) {
			    echo '<a class="tags" href="' . esc_url( get_tag_link($tag->term_id) ) . '">' . esc_html( $tag->name ) . '</a>'; 
			  }
			}
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'graduate' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'graduate' ),
				'after'  => '</div>',
			) );

		?>
	</div><!-- .entry-content -->
	<?php
		/**
		 * Hook graduate_author_profile
		 *  
		 * @hooked graduate_get_author_profile 
		 */
		 do_action( 'graduate_author_profile' );
	?>
</article><!-- #post-## -->
