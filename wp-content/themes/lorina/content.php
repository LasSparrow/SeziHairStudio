<?php
/**
 * Template part for displaying posts
 *
 * @package Lorina
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( get_post_format() == 'video' ) {
		$video_content = apply_filters( 'the_content', get_the_content() );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $video_content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $video_content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		if ( ! empty( $video ) ) {

			$first_video = true;
			foreach ( $video as $video_html ) {
				if ( $first_video ) {
					echo '<div class="entry-video">';
						echo $video_html;
					echo '</div>';
					$first_video = false;
				}
			}
		} else {
			lorina_post_thumbnail();
		}
	} else {
		lorina_post_thumbnail();
	}
	?>

	<header class="entry-header">
		<?php
		if ( !get_the_title() ) {
		?>
			<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( 'No Title', 'lorina' ); ?></a></h2>
		<?php
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorina' ),
			'after'  => '</div>',
		) );
		if ( 'post' === get_post_type()) : ?>
			<a class="more-tag button" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Continue Reading', 'lorina' ); ?></a>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<div class="entry-meta">
		<?php
		lorina_entry_cats();
		?>
	</div><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
