# WP Ted
Theme based on WP Bones, with adaptation of Gulp and Bower.

## Directory WP Ted ##

Inside that directory, it will generate the initial project structure and [install the transitive dependencies](#built-in-commands):
```
wp-ted
├── .gitignore
├── README.md
├── favicon.ico
├── favicon.png
├── screenshot.png
├── style.css
├── 404.php
├── archive-custom_type.php
├── archive.php
├── comments.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page-custom.php
├── page.php
├── search.php
├── searchform.php
├── sidebar.php
├── single-custom_type.php
├── single.php
├── taxonomy-custom_cat.php
├── alm_templates
│   └── blog.php
└── library
│   ├── .bowerrc
│   ├── admin.php
│   ├── bones.php
│   ├── bower.json
│   ├── custom-post-type.php
│   ├── gulpfile.json
│   ├── package.json
│   ├── wp_bootstrap_navwalker.php
│   ├── css
│   │   ├── editor-style.css
│   │   ├── ie.css
│   │   ├── login.css
│   │   ├── style.css
│   │   └── style.min.css
│   ├── images
│   │   ├── backgrounds
│   │   └── icons
│   │       ├── custom-post-icon.png
│   │       ├── nothing.gif
│   │       └── nothumb.gif
│   ├── js
│   │   └── script.min.js
│   ├── node_modules
│   ├── resources
│   │   ├── bower_components
│   │   └── js
│   │   │   └── script.js
│   │   └── sass
│   │       ├── style.scss
│   │       ├── mixins
│   │       │   └── _position.scss
│   │       ├── modules
│   │       │   ├── _animated.scss
│   │       │   ├── _app.scss
│   │       │   ├── _breakpoints.scss
│   │       │   ├── _normalize.scss
│   │       │   ├── _typography.scss
│   │       │   └── _vars.scss
│   │       └── partials
│   │           ├── _footer.scss
│   │           ├── _header.scss
│   │           ├── _main.scss
│   │           └── _sidebar.scss
│   └── translation
└── post-formats
```

## Built-in commands ##
1. Go to the folder *library*, run `cd library/`
2. Install packages **Node Modules**, run `npm install` or `yarn install`
4. Add packages **Node Modules**, run `npm install <package>` or `yarn add <package>`
3. Install packages for **Bower**, run `bower install`
4. Add packages **Bower**, run `bower install --save <package>`
4. Run `gulp`

> Welcome **WP Ted**
