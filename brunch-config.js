exports.files = {
    javascripts: {
        joinTo: {
            'js/vendor.js': /^(?!app)/,
            'js/app.js': /^app/
        }
    },
    stylesheets: {joinTo: 'css/app.css'}
};

exports.plugins = {
    browserSync: {
        proxy: "http://vccw.dev/",
        port: 3333,
        logLevel: "debug",
        browser: "google chrome canary"
    },
    babel: {
        presets: ['latest']
    },
    sass: {
        options: {
            precision: 8,
            includePaths: [
                'node_modules/ladda/css',
                'node_modules/roboto-fontface/css/roboto/sass',
                'node_modules/font-awesome/scss',
            ]
        }
    },
    postcss: {
        processors: [
            require('autoprefixer')(['last 8 versions']),
        ],
    },
    cleancss: {
        keepSpecialComments: 0,
        removeEmpty: true,
        // ignored: /non_minimize\.css/,
    },
    copycat: {
        fonts: [
            "app/assets/fonts/",
            "node_modules/roboto-fontface/fonts/",
            "node_modules/font-awesome/fonts/",
        ],
        'fonts/noticia-text': [
            "node_modules/typeface-noticia-text/files/"
        ],
        img: ["app/assets/img/"],
        verbose: true,
        onlyChanged: true
    }
};

exports.npm = {
    styles: {
        "pace-progress": ['themes/blue/pace-theme-minimal.css'],
        "animate.css": ['animate.css'],
        "aos": ['dist/aos.css'],
        "featherlight": ['release/featherlight.min.css'],
        "better-share-button": ["dist/share-button.css"],
    },
    globals: {
        AOS: "aos"
    },
    aliases: {
        "janimate": "janimate/dist/janimate.js",
    },
    static: [
        "node_modules/janimate/dist/janimate.js",
    ],
};

exports.modules = {
    autoRequire: {
        'js/app.js': [
            'quick-sidebar-fix',
            'glossary-lightbox',
            'share-button',
            'theme'
        ]
    }
};