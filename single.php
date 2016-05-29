<?php get_header(); ?>
	<section>
		<div>
			<?php if ( have_posts() ): ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'cf' ) ?> id="post-<?php the_ID() ?>">
					<div><?php get_template_part( 'post-formats/format', get_post_format() ) ?></div>
				</article>
				<?php endwhile ?>
			<?php else: ?>
				<article class="hentry cf" id="post-not-found">
					<div>
						<h1><?php _e( 'Oops, Post Not Found!', 'ted' ); ?></h1>
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'ted' ); ?></p>
						<p><?php _e( 'This is the error message in the custom posty type archive template.', 'ted' ); ?></p>
					</div>
				</article>
			<?php endif ?>
		</div>
		<?php get_sidebar() ?>
	</section>
<?php get_footer() ?>