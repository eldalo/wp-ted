        <footer>
            <div>
                <nav>
                    <?php wp_nav_menu([ 'container' => false, 'menu' => __( 'The Main Footer', 'bonestheme' ), 'theme_location' => 'footer-nav' ]) ?>
                </nav>
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
