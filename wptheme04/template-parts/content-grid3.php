<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wptheme04
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-md-4 col-sm-6 post-item">

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		the_post_thumbnail('img300x200', array(
			'alt' => the_title_attribute( array(
				'echo' => false,
			) ),
		) );
		?>
	</a>

	<?php  the_title( '<h2 class="post-title match-height"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

	<p class="p-excerpt"><?php echo get_the_excerpt(); ?></p>

</article><!-- #post-<?php the_ID(); ?> -->
