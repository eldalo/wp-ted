<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes() ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes() ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes() ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes() ?> class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php wp_title('') ?></title>

        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- 
        <meta name="msapplication-TileColor" content="#">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/library/images/icons/favicon.ico">
        <meta name="theme-color" content="#"> 
        -->

        <?php wp_head() ?>
    </head>
    <body <?php body_class() ?>>