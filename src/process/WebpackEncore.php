<?php declare(strict_types=1);
/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 */
namespace Process;


use Process\Encore\DataProvider;
use Process\Encore\Contracts\EntryData;
use Process\Encore\Processor;
use Process\Encore\Render;


class WebpackEncore
{

    /**
     * @var Processor
     */
    private $processor;


    /**
     * WebpackEncore constructor.
     */
    public function __construct()
    {
        $this->processor = new Processor(new DataProvider());
    }

    /**
     * Reset Processor
     * @return void
     */
    public function reset(): void
    {
        $this->processor->reset();
    }

    /**
     * Encore Entry CssFiles
     * @param string $section
     * @return array
     * @throws Encore\Exceptions\ProcessorException
     */
    public function cssFiles(string $section): array
    {
        /**
         * @var EntryData $entryData
         */
        $entryData = $this->processor->getEntryPointCssData($section);

        return $entryData->getEntryFiles();
    }

    /**
     * Encore Entry JsFiles
     * @param string $section
     * @return array
     * @throws Encore\Exceptions\ProcessorException
     */
    public function jsFiles(string $section): array
    {
        /**
         * @var EntryData $entryData
         */
        $entryData = $this->processor->getEntryPointJsData($section);

        return $entryData->getEntryFiles();
    }

    /**
     * Encore Entry ScriptTags
     * @param string $section
     * @return string|null
     * @throws Encore\Exceptions\ProcessorException
     */
    public function scriptTags(string $section): ?string
    {
        return Render::renderScriptTags(
            $this->processor->getEntryPointJsData($section)
        );
    }

    /**
     * Encore Entry LinkTags
     * @param string $section
     * @return string|null
     * @throws Encore\Exceptions\ProcessorException
     */
    public function linkTags(string $section): ?string
    {
        return Render::renderLinkTags(
            $this->processor->getEntryPointCssData($section)
        );
    }

    /**
     * Asset
     * @param $name
     * @return string|null
     */
    public function asset($name) : ?string
    {
        $manifestData = $this->processor->getManifestData();
        return $manifestData[$name] ?? null;
    }
}