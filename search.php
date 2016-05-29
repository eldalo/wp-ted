<?php get_header() ?>
    <section>
        <div>
            <h1 class="archive-title"><span><?php _e( 'Search Results for:', 'ted' ) ?></span> <?php echo esc_attr( get_search_query() ) ?></h1>
            <?php if ( have_posts() ): ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class( 'cf' ) ?> id="post-<?php the_ID() ?>">
                    <h3 class="search-title entry-title">
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a>
                    </h3>
                    <p><?php printf( __( 'Posted %1$s by %2$s', 'ted' ), '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>', '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>' ) ?></p>
                    <div><?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'ted' ) . '</span>' ) ?></div>
                </article>
                <div>
                    <?php if ( get_the_category_list(', ') != '' ): ?>
                        <?php printf( __( 'Filed under: %1$s', 'ted' ), get_the_category_list(', ') ) ?>
                    <?php endif ?>
                    <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'ted' ) . '</span> ', ', ', '</p>' ) ?>
                </div>
                <?php endwhile ?>
                <?php ted_page_navi() ?>
            <?php else: ?>
                <article class="hentry cf" id="post-not-found">
                    <div>
                        <h1><?php _e( 'Sorry, No Results.', 'ted' ); ?></h1>
                        <p><?php _e( 'Try your search again.', 'ted' ); ?></p>
                        <p><?php _e( 'This is the error message in the search.php template.', 'ted' ); ?></p>
                    </div>
                </article>
            <?php endif ?>
        </div>
        <?php get_sidebar() ?>
    </section>
<?php get_footer() ?>
