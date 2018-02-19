<?php
/**
 * Template part for displaying custom post type posts.
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
		endif; ?>
		<div class="entry-meta">
			<?php graduate_posted_on(); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
			<?php 
			 if ( is_array( $header_image_meta ) ) {
				$header_image_meta = $header_image_meta[1];
			} 
			if ( 'show-both' == $header_image_meta && has_post_thumbnail() ) : ?>
				<div class="blog-image">
					<?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
				</div>
			<?php
			endif;
				$post_type = get_query_var( 'post_type' );
				switch ( $post_type ) {
					case 'tp-class': ?>
						<p class="tp-education-meta entry-meta">
							<?php  
							if ( class_exists( 'TP_Education' ) ) :
								// class age group
								tp_class_age_group();

								// class size
								tp_class_size();

								if ( get_post_meta( get_the_id(), 'tp_class_cost_value', true ) != '' ) : 
	                         
	                                // class cost
	                                tp_class_cost();    

	                                // class period
	                                tp_class_period();
	                            
	                            endif; 
                            endif;
                            ?>
						</p><!-- .tp-education-meta -->
					<?php break;

					case 'tp-event': ?>
						<p class="tp-education-meta entry-meta">
							<?php  
							if ( class_exists( 'TP_Education' ) ) :
								// event date
								tp_event_date();

								// event start time
								tp_event_start_time();

								// event end time
								tp_event_end_time();

								// event location
								tp_event_location();
							endif;
							?>
						</p><!-- .tp-education-meta -->
					<?php break;

					case 'tp-excursion': ?>
						<p class="tp-education-meta entry-meta">
							<?php  
							if ( class_exists( 'TP_Education' ) ) :
								// excursion start date
								tp_excursion_start_date();

								// excursion end date
								tp_excursion_end_date();

								// event end time
								tp_event_end_time();

								// excursion location
								tp_excursion_location();
							endif;
							?>
						</p><!-- .tp-education-meta -->
					<?php break;

					case 'tp-affiliation': ?>
						<p class="tp-education-meta entry-meta">
							<?php  
							if ( class_exists( 'TP_Education' ) ) :
								// team designation
								tp_affiliation_link();
							endif;
							?>
						</p><!-- .tp-education-meta -->
					<?php break;
					
					default:
					break;
				}

				?>

		<?php 
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
