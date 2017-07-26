<?php get_header() ?>
	<section>
		<h1 class="archive-title h2"><span><?php _e( 'Posts Categorized:', 'ted' ) ?></span> <?php single_cat_title() ?></h1>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<article <?php post_class('cf') ?> id="post-<?php the_ID() ?>">
					<h3 class="h2">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>
					</h3>
					<p><?php printf( __('Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'ted'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'ted')), ted_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'custom_cat', "", ", ", "" )) ?></p>
					<div>
						<?php the_excerpt('<span class="read-more">' . __( 'Read More &raquo;', 'ted' ) . '</span>') ?>
					</div>
				</article>
			<?php endwhile ?>
			<?php ted_page_navi() ?>
		<?php else: ?>
			<article class="hentry cf" id="post-not-found">
				<div>
					<h1><?php _e('Oops, Post Not Found!', 'ted') ?></h1>
					<p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'ted') ?></p>
					<p><?php _e('This is the error message in the custom posty type archive template.', 'ted') ?></p>
				</div>
			</article>
		<?php endif ?>
		<?php get_sidebar() ?>
	</section>
<?php get_footer() ?>
