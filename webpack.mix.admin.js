let mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

// mix
//   .setPublicPath(path.normalize('public_html/assets/admin'))
//   .options({
//     processCssUrls: false
//   })
//   .js('resources/assets/admin/js/admin.js', 'js/global.js')
//   .less('resources/assets/admin/less/admin.less', 'css/style.css')
// ;


mix
.react('resources/assets/js/app.js', 'public/js')
  .extract(['react'])
    .sass('resources/assets/sass/app.scss', 'public/css')
    .webpackConfig({
      node: {
          fs: "empty"
      },
  })
  .mergeManifest();