const path = require("path");
//Webpack Analyzer
const WebpackBundleAnalyzer = require("webpack-bundle-analyzer")
  .BundleAnalyzerPlugin;
//Is it in development mod
let devMode = process.env.devMode || true;

module.exports = {
  entry: path.resolve("./app.js"),
  mode: devMode ? "development" : "production",
  output: {
    filename: "app.js",
    path: path.resolve("./dist"),
    chunkFilename: "[name].js" //< Used to specify custom chunk name 
  },
  resolve: {
    extensions: [".js", ".json"]
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/, ///< using babel-loader for converting ES6 to browser supported javascript
        loader: "babel-loader",
        exclude: [/node_modules/]
      }
    ]
  },
 //Add Analyzer Plugin alongside your other plugins...
 plugins: [
   new WebpackBundleAnalyzer(),
  //  new webpack.optimize.CommonsChunkPlugin('vendor', 'vendor.js', Infinity)
]
};