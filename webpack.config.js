const path = require('path');
const webpack = require('webpack');
const poststylus = require('poststylus');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const WebpackCleanupPlugin = require("webpack-cleanup-plugin");

module.exports = {
    context: __dirname + "/resources/app",
    entry: {
        index: './index.jsx',
        react: ["react"],
        reactDOM: ["react-dom"],
    },
    output: {
        publicPath: "/",
        path: __dirname + "/public",
        filename: 'js/[name].js',
        library: "[name]",
        pathinfo: true
    },
    devtool: 'source-map',
    resolve: {
        alias:{
            styles: path.resolve("resources/styles"),
            components: path.resolve("resources/app/components"),
            containers: path.resolve("resources/app/containers"),
            tests: path.resolve("resources/app/tests")

        },
        extensions: ['.js', '.jsx'],
    },

    externals: {
        'jquery': 'window',
        '$': 'window',
        'cheerio': 'window',
        'react/addons': true,
        'react/lib/ExecutionEnvironment': true,
        'react/lib/ReactContext': true
    },

    module: {
        loaders: [
            {test: /\.json$/, loader: 'json-loader'},
            {test: /\.js$/, exclude: /(node_modules|bower_components)/, loader: 'babel-loader'},
            {test: /\.jsx$/, exclude: /(node_modules|bower_components)/, loader: 'babel-loader'},
            {
                test: /\.styl/, loader: ExtractTextPlugin.extract({
                fallback: 'style-loader',
                loader: 'css-loader!stylus-loader'
            })
            },
            {
                test: /\.css/, loader: ExtractTextPlugin.extract({
                fallback: 'style-loader',
                loader: 'css-loader'
            })
            },

            {test: /\.svg/, loader: 'svg-url-loader'},
            {test: /\.svg$/, loader: 'url-loader?limit=65000&mimetype=image/svg+xml&name=fonts/[name].[ext]'},
            {
                test: /\.woff$/,
                loader: 'url-loader?limit=65000&mimetype=application/font-woff&name=fonts/[name].[ext]'
            },
            {
                test: /\.woff2$/,
                loader: 'url-loader?limit=65000&mimetype=application/font-woff2&name=fonts/[name].[ext]'
            },
            {
                test: /\.[ot]tf$/,
                loader: 'url-loader?limit=65000&mimetype=application/octet-stream&name=fonts/[name].[ext]'
            },
            {
                test: /\.eot$/,
                loader: 'url-loader?limit=65000&mimetype=application/vnd.ms-fontobject&name=fonts/[name].[ext]'
            },
            {
                test: /.*\.(gif|png|jpe?g|svg)$/i,
                loaders: ['file-loader', {
                    loader: 'image-webpack-loader',
                    query: {
                        progressive: true,
                        optimizationLevel: 7,
                        interlaced: false,
                        pngquant: {
                            quality: '65-90',
                            speed: 4
                        }
                    }
                }
                ]
            }

        ],
    },
    performance: {hints: false},
    plugins: [
        new webpack.DefinePlugin({
            'process.env.NODE_ENV': JSON.stringify('development')
        }),
        // new webpack.optimize.UglifyJsPlugin({
        //     compress: {
        //         warnings: false,
        //         screw_ie8: true
        //     },
        //     comments: false,
        //     sourceMap: false
        // }),
        new ManifestPlugin(),
        new ExtractTextPlugin({filename: 'styles/main.css', disable: false, allChunks: true}),
        new webpack.LoaderOptionsPlugin({
            options: {stylus: {use: [poststylus(['autoprefixer', 'rucksack-css', 'postcss-reporter'])]}}
        }),
        new LiveReloadPlugin(),
        new webpack.optimize.OccurrenceOrderPlugin(),
        new webpack.optimize.AggressiveMergingPlugin(),
        new webpack.NoEmitOnErrorsPlugin(),
        new webpack.optimize.CommonsChunkPlugin({
            names: ['react', "reactDOM"],
        }),
        // new WebpackCleanupPlugin({
        //     exclude: [
        //         "images/**/*",
        //         "index.php",
        //         ".htaccess",
        //         "favicon.ico",
        //         "manifest.json",
        //         "robots.txt",
        //         "web.config",
        //         "bower_components/**/*",
        //         "fonts/**/*"],
        // })
    ]
};