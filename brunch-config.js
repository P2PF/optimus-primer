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
  babel: {presets: ['latest']},
  sass: {
    options: {
      precision: 8,
      includePaths: [
        'node_modules/ladda/css',
        'node_modules/roboto-fontface'
      ]
    }
  },
  postcss: {
    processors: [
      require('autoprefixer')(['last 8 versions']),
    ],
  },
  copycat: {
    fonts: [
      "app/assets/fonts/",
      "node_modules/roboto-fontface/fonts/"
    ],
    img: ["app/assets/img/"],
    verbose: true,
    onlyChanged: true
  }
};

exports.npm = {
  styles: {
    "pace-progress": ['themes/blue/pace-theme-minimal.css'],
    "aos": ['dist/aos.css']
  },
  globals: {
    AOS: "aos"
  },
  aliases: {
  },
  static: [
  ],
};

exports.modules = {
  autoRequire: {
  }
};