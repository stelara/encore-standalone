<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */

declare(strict_types=1);

/**
 * Load Composer autoload
 */
require dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';;

/**
 * Load DotEnv
 */
(Dotenv\Dotenv::create(dirname(__DIR__)))->load();

define('APP_ENV', getenv('APP_ENV'));

// Report all PHP errors
ini_set('display_errors', 'On');
error_reporting(-1);



