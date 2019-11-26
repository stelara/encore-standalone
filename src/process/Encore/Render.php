<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */
declare(strict_types=1);

namespace Process\Encore;

use \Exception;
use Process\Encore\Contracts\EntryData;

/**
 * Class Render
 * @package Process\Encore
 */
class Render
{

    /**
     * HTML tags in use
     * const array HTML_TAGS
     */
    const HTML_TAGS = [
        'script' => [
            'html'             => '<script %s></script>',
            'sourceFileAttrib' => 'src'
        ],
        'link'   => [
            'html'             => '<link rel="stylesheet" %s>',
            'sourceFileAttrib' => 'href'
        ]
    ];

    /**
     * Tag Builder
     * @param EntryData $entryData
     * @param string $tagType
     * @return string
     */
    private static function tagBuilder(
        EntryData $entryData,
        string $tagType
    ): string {

        $files = $entryData->getEntryFiles();

        if (empty($files)) {
            return '';
        }

        $integrity = $entryData->getIntegrity();
        $tag       = self::HTML_TAGS[$tagType];
        $htmlTags  = $attribs = [];

        foreach ($files as $file) {

            if ($integrity->hasIntegrity() && (null !== $hash = $integrity->lookUp($file))) {
                $attribs['integrity']   = $hash;
                $attribs['crossorigin'] = 'anonymous';
            }

            $attribs[$tag['sourceFileAttrib']] = $file;

            $htmlTags[] = sprintf($tag['html'],
                self::attributesToString($attribs));
        }

        return implode(' ', $htmlTags);
    }

    /**
     * AttributesToString
     * @param array $attributes
     * @return string
     */
    private static function attributesToString(array $attributes): string
    {
        return implode(' ', array_map(function ($attr, $value) {

            return sprintf('%s="%s"', $attr,
                filter_var($value, FILTER_SANITIZE_STRING));

        }, array_keys($attributes), $attributes));
    }

    /**
     * Render Script Tags
     * @param EntryData $entryData
     * @return string
     */
    public static function renderScriptTags(EntryData $entryData): string
    {
        return self::tagBuilder($entryData, 'script');
    }

    /**
     * Render LinkTags
     * @param EntryData $entryData
     * @return string
     */
    public static function renderLinkTags(EntryData $entryData): string
    {
        return self::tagBuilder($entryData, 'link');
    }
}