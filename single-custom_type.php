<?php get_header(); ?>
	<section>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<article <?php post_class( 'cf' ) ?> id="post-<?php the_ID() ?>">
					<h1 class="single-title custom-post-type-title"><?php the_title() ?></h1>
					<p><?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'ted' ), get_the_time( 'Y-m-j' ), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) ), get_the_term_list( $post->ID, 'custom_cat', ' ', ', ', '' )) ?></p>
					<div>
						<?php the_content() ?>
					</div>
					<div>
						<?php wp_link_pages( array('before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ted' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' )) ?>
					</div>
					<div class="tags">
						<?php echo get_the_term_list( get_the_ID(), 'custom_tag', '<span class="tags-title">' . __( 'Custom Tags:', 'ted' ) . '</span> ', ', ') ?>
					</div>
					<div>
						<?php comments_template() ?>
					</div>
				</article>
			<?php endwhile ?>
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
