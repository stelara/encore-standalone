<?php declare(strict_types=1);
/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 */

$encore = new Process\WebpackEncore();

/**
 * View Helper
 * Link tags , display link tags by section
 * @param $section
 * @return string|null
 */
$linkTags = function ($section) use ($encore)
{
    return $encore->linkTags($section);
};

/**
 * View Helper
 * Script tags , display script tags by section
 * @param $section
 * @return string|null
 */
$scriptTags = function ($section) use ($encore)
{
    return $encore->scriptTags($section);
};

/**
 * View Helper
 * Js files , get all js files by section as array
 * @param $section
 * @return array
 */
$jsFiles = function ($section) use ($encore)
{
    return $encore->jsFiles($section);
};

/**
 * View Helper
 * Css files , get all css files by section as array
 * @param $section
 * @return array
 */
$cssFiles = function ($section) use ($encore)
{
    return $encore->cssFiles($section);
};

/**
 * View Helper
 * Asset , return asset by path
 * @param $path
 * @return string|null
 */
$asset = function ($path) use ($encore)
{
    return $encore->asset($path);
};