<?php if (post_password_required()) return; ?>
<?php if (have_comments()): ?>
  <h3 class="h2" id="comments-title"><?php comments_number( __( '<span>No</span> Comments', 'ted' ), __( '<span>One</span> Comment', 'ted' ), __( '<span>%</span> Comments', 'ted' ) ) ?></h3>
  <section class="commentlist">
    <?php wp_list_comments( array( 'style' => 'div', 'short_ping' => true, 'callback' => 'ted_comments', 'type' => 'all', 'reply_text' => __('Reply', 'ted'), 'page' => '', 'per_page' => '' ) ) ?>
  </section>
  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    <div class="comment-nav-prev">
      <?php previous_comments_link( __( '&larr; Previous Comments', 'ted' ) ) ?>
    </div>
    <div class="comment-nav-next">
      <?php next_comments_link( __( 'More Comments &rarr;', 'ted' ) ) ?>
    </div>
  <?php endif ?>
  <?php if (!comments_open()): ?>
    <p class="no-comments"><?php _e('Comments are closed.' , 'ted') ?></p>
  <?php endif ?>
<?php endif ?>
<?php comment_form() ?>
