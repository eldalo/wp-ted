<?php $category = get_the_terms(get_the_ID(), 'blog_cat') ?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <article class="categoria-blog categoria-<?php echo $category[0]->slug ?>">
        <figure>
            <a href="<?php the_permalink() ?>">
                <i></i>
                <?php the_post_thumbnail('full') ?>
            </a>
        </figure>
        <div class="info">
            <h2><?php the_title() ?></h2>  
            <p><?php echo wp_trim_words( get_the_content(), 20, '...' );?></p>
            <a href="<?php the_permalink() ?>" class="btn-mas">VER MÁS</a>
        </div>
    </article>
</div>
