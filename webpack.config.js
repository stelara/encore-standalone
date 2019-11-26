const Encore    = require('@symfony/webpack-encore');
const dotenv    = require('dotenv');
const env       = dotenv.config();
const outputPath = 'www/static/';
const publicPath = '/static';

if (env.error) {
    throw env.error;
}

Encore.configureRuntimeEnvironment(env.parsed.APP_ENV);

Encore
    .setOutputPath(outputPath)
    .setPublicPath(publicPath)
    .cleanupOutputBeforeBuild()

    .addEntry('app', './assets/js/app.js')
    .addEntry('page', './assets/js/page.js')
    .addEntry('page1', './assets/js/page1.js')
    .addStyleEntry('onlyCss','./assets/css/only_css.scss')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]'
    })
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableIntegrityHashes(!Encore.isProduction())
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    .enableSassLoader()
    .configureDefinePlugin(options => {
        options['process.env'].INTERNAL_FRONTEND_DEPENDENCY =
            JSON.stringify(env.parsed.INTERNAL_FRONTEND_DEPENDENCY);
    });

if (Encore.isProduction()) {
    //Enable CDN
    //Encore.setPublicPath(process.env.MAIN_CDN);
    //Encore.setManifestKeyPrefix('static/');
}

module.exports = Encore.getWebpackConfig();