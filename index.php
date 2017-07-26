<?php get_header() ?>
	<section>
		<div>
			<?php if (have_posts()): ?>
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('cf') ?> id="post-<?php the_ID() ?>">
						<h1 class="h2 entry-title">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>
						</h1>
						<p><?php printf(__( 'Posted', 'ted' ).' %1$s %2$s', '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>', '<span class="by">'.__( 'by', 'ted').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>') ?></p>
						<div>
							<?php the_content() ?>
						</div>
						<div>
							<?php comments_number(__( '<span>No</span> Comments', 'ted' ), __( '<span>One</span> Comment', 'ted' ), __( '<span>%</span> Comments', 'ted' )) ?>
						</div>
						<div>
							<?php printf('<p class="footer-category">' . __('filed under', 'ted' ) . ': %1$s</p>' , get_the_category_list(', ') ) ?>
							<?php the_tags('<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'ted' ) . '</span> ', ', ', '</p>' ) ?>
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
		</div>
		<?php get_sidebar() ?>
	</section>
<?php get_footer() ?>
