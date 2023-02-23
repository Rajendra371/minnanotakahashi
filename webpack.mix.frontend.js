let { mix } = require('laravel-mix');
require('laravel-mix-merge-manifest');

// mix
//   .setPublicPath(path.normalize('public_html/assets/website'))
//   .less('resources/assets/website/less/website.less', 'css/style.css')
//   .options({
//     processCssUrls: false
//   })
//   .js('resources/assets/website/js/website.js', 'js/global.js')
// ;

mix
.react('resources/assets/js/frontend/app.js', 'public/js/frontend')
  .extract(['react'])
    .sass('resources/assets/sass/app.scss', 'public/css/frontend')
    .webpackConfig({
      node: {
          fs: "empty"
      },
  })
  .mergeManifest();