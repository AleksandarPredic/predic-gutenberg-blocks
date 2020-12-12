const path = require( 'path' );
const webpack = require( 'webpack' );
const ESLintPlugin = require('eslint-webpack-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');
const MiniCssExtractPluginBlocks = require('mini-css-extract-plugin');
const MiniCssExtractPluginEditor = require('mini-css-extract-plugin');

const production = 'production' === process.env.NODE_ENV;

const commonScssConfig = [
  {
    loader: "css-loader",
    options: {
      sourceMap: true,
      minimize: production
    }
  },

  {
    loader: "postcss-loader",
    options: {
      ident: 'postcss',
      sourceMap: true,
      plugins: [
        require('autoprefixer')({
          'browsers': ['> 1%', 'last 2 versions']
        }),
      ],
      minimize: production
    }
  },
  { loader: "sass-loader",
    options: {
      sourceMap: true,
      sassOptions: {
        outputStyle: production ? 'compressed' : 'nested',
      },
    }
  },
];

module.exports = {
  mode: production ? 'production' : 'development',
  entry: {
    './assets/js/editor.blocks' : './blocks/index.js',
    './assets/js/frontend.blocks' : './blocks/frontend.js',
  },
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].js',
  },
  watch: ! production,
  // https://webpack.js.org/configuration/devtool/
  devtool: production ? 'none' : 'inline-cheap-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: [
          {
            loader: 'babel-loader',
          }
        ],
      },
      {
        test: /style\.s?css$/,
        use: [
          MiniCssExtractPluginBlocks.loader,
          ...commonScssConfig
        ],
      },
      {
        test: /editor\.s?css$/,
        use: [
          MiniCssExtractPluginEditor.loader,
          ...commonScssConfig
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPluginBlocks({
      filename: './assets/css/blocks.style.css',
    } ),
    new MiniCssExtractPluginEditor({
      filename: './assets/css/blocks.editor.css',
    } ),
    new ESLintPlugin({
      overrideConfigFile: 'eslintrc.json',
    }),
    new StylelintPlugin({
      configFile: 'stylelintrc.json',
      files: [
        './blocks/**/*.scss'
      ]
    })
  ],
};
