 ## Encore-Webpack standalone integration (without Symfony and Twig)
 ### Install
 * yarn install (install js dependencies)
 * composer install (install php dependencies)
 * composer dev-compile (compile assets)
 * composer serve (open your browser http://localhost:8900 )
 * composer test (run unit tests)
 
 ```php
 $section   = 'app' // section defined into webpack.config.js
 $path      = 'static/images/new_section/hallstatt-4579234_640.jpg'
 $encore    = new Process\WebpackEncore();
 
 $encore->linkTags($section);
 $encore->scriptTags($section);
 
 $encore->jsFiles($section);
 $encore->cssFiles($section);
 
 $encore->asset($path);
```
 
 
 ### How to configure webpack
 webpack.config.js
 
 ### More about Encore
 https://symfony.com/doc/current/frontend/encore/installation.html
 

