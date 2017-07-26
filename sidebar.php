<aside>
    <?php if (is_active_sidebar('sidebar1')): ?>
        <?php dynamic_sidebar('sidebar1') ?>
    <?php else: ?>
        <div class="no-widgets">
            <p><?php _e('This is a widget ready area. Add some and they will appear here.', 'ted') ?></p>
        </div>
    <?php endif ?>
</aside>