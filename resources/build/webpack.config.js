const path = require('path');
const webpack = require("webpack");
const merge = require("webpack-merge");
const CleanPlugin = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const StyleLintPlugin = require("stylelint-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const FriendlyErrorsWebpackPlugin = require("friendly-errors-webpack-plugin");

const desire = require("./util/desire");
const config = require("./config");

console.log(config.paths);
console.log(path.join(path.join(config.paths.root + ''), 'node_modules/jquery/**/*'));
console.log(path.join(path.join(config.paths.root, '../../'), 'plugins/acf/**/*'));

// const assetsFilenames = config.enabled.cacheBusting ? config.cacheBusting : "[name]";
const assetsFilenames = "[name]";

const chunkNames = config.enabled.chunkBusting ? config.cacheBusting : "[id]";

let webpackConfig = {
  mode: config.env.production ? "production" : "development",
  context: config.paths.assets,
  entry: config.entry,
  devtool: config.enabled.sourceMaps
    ? "source-map"
    : "cheap-module-eval-source-map",
  output: {
    path: config.paths.dist,
    publicPath: config.publicPath,
    filename: `scripts/${assetsFilenames}.js`
  },
  stats: {
    hash: false,
    version: false,
    timings: false,
    children: false,
    errors: false,
    errorDetails: false,
    warnings: false,
    chunks: false,
    modules: false,
    reasons: false,
    source: false,
    publicPath: false
  },
  module: {
    rules: [
      {
        enforce: "pre",
        test: /\.js$/,
        include: config.paths.assets,
        // use: "eslint"
      },
      {
        enforce: "pre",
        test: /\.(js|s?[ca]ss)$/,
        include: config.paths.assets,
        loader: "import-glob"
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            cacheDirectory: true,
            presets: ["@babel/preset-env"]
          }
        }
      },
      {
        test: /\.css$/,
        include: config.paths.assets,
        use: [
          {
            loader: config.env.production ? MiniCssExtractPlugin.loader : "style-loader"
          },
          {
            loader: "cache"
          },
          {
            loader: "css-loader"
          },
          {
            loader: "css",
            options: {sourceMap: config.enabled.sourceMaps}
          },
          {
            loader: "postcss",
            options: {
              config: {path: __dirname, ctx: config},
              sourceMap: config.enabled.sourceMaps
            }
          }
        ]
      },
      {
        test: /\.scss$/,
        include: config.paths.assets,
        use: [
          {
            loader: config.env.production
              ? MiniCssExtractPlugin.loader
              : "style-loader"
          },
          {loader: "cache"},
          {
            loader: "css",
            options: {sourceMap: config.enabled.sourceMaps}
          },
          {
            loader: "postcss",
            options: {
              config: {path: __dirname, ctx: config},
              sourceMap: config.enabled.sourceMaps
            }
          },
          {
            loader: "resolve-url",
            options: {sourceMap: config.enabled.sourceMaps}
          },
          {
            loader: "sass",
            options: {
              sourceMap: config.enabled.sourceMaps,
              // sourceComments: false
            }
          }
        ]
      },
      {
        test: /\.(ttf|otf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: config.paths.assets,
        loader: "url",
        options: {
          limit: 4096,
          name: `[path]${assetsFilenames}.[ext]`
        }
      },
      {
        test: /\.(ttf|otf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: /node_modules/,
        loader: "url",
        options: {
          limit: 4096,
          outputPath: "vendor/",
          name: `${config.cacheBusting}.[ext]`
        }
      }
    ]
  },
  resolve: {
    modules: [config.paths.assets, "node_modules"],
    enforceExtension: false
  },
  resolveLoader: {
    moduleExtensions: ["-loader"]
  },
  externals: {
    jquery: "jQuery"
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        styles: {
          name: 'styles',
          test: /\.css$/,
          chunks: 'all',
          enforce: true,
        },
      },
    },
  },
  plugins: [
    new CleanPlugin([config.paths.dist], {
      root: config.paths.root,
      verbose: false
    }),
    new CopyWebpackPlugin([
      {
        from: config.copy.images,
        to: `[path]${assetsFilenames}.[ext]`,
        cache: true
      },
      {
        from: path.join(path.join(config.paths.root, '../../../../'), 'node_modules/jquery/**/*'),
        to: `dir/dir/dir/dir/dir/dir`,
        // toType: 'dir'
      },
      {
        from: path.join(path.join(config.paths.root, '../../../../'), 'node_modules/fancybox/**/*'),
        to: `dir/dir/dir/dir/dir/dir`,
        // toType: 'dir'
      },
      {
        from: path.join(path.join(config.paths.root, '../../../../'), 'node_modules/slick-carousel/**/*'),
        to: `dir/dir/dir/dir/dir/dir`,
        // toType: 'dir'
      },
      {
        from: path.join(path.join(config.paths.root, '../../../../'), 'node_modules/chosen-js/**/*'),
        to: `dir/dir/dir/dir/dir/dir`,
        // toType: 'dir'
      },
    ]),
    new MiniCssExtractPlugin({
      filename: `styles/${assetsFilenames}.css`,
      chunkFilename: `styles/${chunkNames}.css`
    }),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery",
      Popper: "popper.js/dist/umd/popper.js"
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: config.enabled.optimize,
      // debug: config.enabled.watcher,
      stats: {colors: true}
    }),
    new webpack.LoaderOptionsPlugin({
      test: /\.s?css$/,
      options: {
        output: {path: config.paths.dist},
        context: config.paths.assets
      }
    }),
    new webpack.LoaderOptionsPlugin({
      test: /\.js$/,
      options: {
        eslint: {failOnWarning: false, failOnError: true}
      }
    }),
    // new StyleLintPlugin({
    //   failOnError: !config.enabled.watcher,
    //   syntax: "scss"
    // }),
    new FriendlyErrorsWebpackPlugin()
  ]
}; /** Let's only load dependencies as needed */

/* eslint-disable global-require */
if (config.enabled.optimize) {
  webpackConfig = merge(webpackConfig, require("./webpack.config.optimize"));
}

if (config.env.production) {
  webpackConfig.optimization.noEmitOnErrors = true;
  webpackConfig.plugins.push(
    new webpack.DefinePlugin({
      "process.env.NODE_ENV": JSON.stringify(process.env.NODE_ENV)
    })
  );
}

if (config.enabled.cacheBusting) {
  const WebpackAssetsManifest = require("webpack-assets-manifest");

  webpackConfig.plugins.push(
    new WebpackAssetsManifest({
      output: "assets.json",
      space: 2,
      writeToDisk: false,
      assets: config.manifest,
      replacer: require("./util/assetManifestsFormatter")
    })
  );
}

// if (config.enabled.watcher) {
//   // webpackConfig.entry = require("./util/addHotMiddleware")(webpackConfig.entry);
//   webpackConfig = merge(webpackConfig, require("./webpack.config.watch"));
// }

/**
 * During installation via sage-installer (i.e. composer create-project) some
 * presets may generate a preset specific config (webpack.config.preset.js) to
 * override some of the default options set here. We use webpack-merge to merge
 * them in. If you need to modify Sage's default webpack config, we recommend
 * that you modify this file directly, instead of creating your own preset
 * file, as there are limitations to using webpack-merge which can hinder your
 * ability to change certain options.
 */
module.exports = merge.smartStrategy({
  "module.loaders": "replace"
})(webpackConfig, desire(`${__dirname}/webpack.config.preset`));
