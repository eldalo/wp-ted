<?php get_header() ?>
	<section>
		<div>
			<h1 class="archive-title h2"><?php post_type_archive_title() ?></h1>
			<?php if (have_posts()): ?>
				<?php while (have_posts()) : the_post(); ?>
				<article <?php post_class('cf') ?> id="post-<?php the_ID() ?>">
					<div>
						<h3 class="h2">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>
						</h3>
						<p class="byline vcard"><?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'ted' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'ted' ) ), get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?></p>
					</div>
					<div><?php the_excerpt() ?></div>
				</article>
				<?php endwhile ?>
				<?php ted_page_navi() ?>
			<?php else: ?>
				<article class="hentry cf" id="post-not-found">
					<div>
						<h1><?php _e('Oops, Post Not Found!', 'ted'); ?></h1>
						<p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'ted'); ?></p>
						<p><?php _e('This is the error message in the custom posty type archive template.', 'ted'); ?></p>
					</div>
				</article>
			<?php endif ?>
		</div>
		<?php get_sidebar() ?>
	</section>
<?php get_footer() ?>
