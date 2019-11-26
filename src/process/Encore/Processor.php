<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */
declare(strict_types=1);

namespace Process\Encore;

use Process\Encore\Contracts\DataGather;
use Process\Encore\Contracts\EntryData;
use Process\Encore\Exceptions\ProcessorException;

/**
 * Class Processor
 * @package Process\Encore
 */
class Processor
{

    /**
     *  const string FILE_FORMAT_JS
     */
    const FILE_FORMAT_JS = 'js';

    /**
     *  const string FILE_FORMAT_CSS
     */
    const FILE_FORMAT_CSS = 'css';

    /**
     * @var DataGather $dataObject
     */
    private $dataObject;

    /**
     * @var array $entryPoints
     */
    private $entryPoints = [];

    /**
     * @var array $manifest
     */
    private $manifest = [];

    /**
     * @var array $integrity
     */
    private $integrity = [];

    /**
     * @var array $flatData
     */
    private $flatData = [];

    /**
     * @var array $formattedData
     */
    private $formattedData = [];

    /**
     * Encore constructor.
     * @param DataGather $dataObject
     */
    public function __construct(DataGather $dataObject)
    {
        $this->dataObject = $dataObject;
    }

    public function reset()
    {
        $this->formattedData = $this->flatData = [];
    }

    /**
     *  Load and cache files data
     */
    private function loadData(): void
    {

        if (empty($this->entryPoints) || empty($this->manifest)) { // load once

            $this->dataObject->load();

            $this->entryPoints =
                $this->dataObject->getEntryPointsData();

            $this->manifest =
                $this->dataObject->getManifestData();

            $this->integrity = new Integrity(
                $this->dataObject->getIntegrityData()
            );

        }
    }

    /**
     * Process EntryPoints Data
     * @param string $section
     * @param string $fileType
     * @return void
     * @throws ProcessorException
     */
    private function processEntryPointsData(
        string $section,
        string $fileType
    ): void {

        $this->loadData();

        if (!isset($this->entryPoints[$section])) {
            throw new ProcessorException("$section does not exists!");
        }

        foreach ($this->entryPoints[$section] as $extFileType => $files) {

            if ($fileType != $extFileType) {
                continue;
            }

            if (empty($this->formattedData[$fileType])) {

                $this->formattedData[$fileType][$section] =
                $this->flatData[$fileType] = $files;

            } else {

                $diff = array_values(array_diff($files, $this->flatData[$fileType]));
                $this->flatData[$fileType] = array_merge($this->flatData[$fileType], $diff);
                $this->formattedData[$fileType][$section] = $diff;

            }
        }
    }

    /**
     * Get EntryPoints JsData by Section
     * @param string $section
     * @return EntryData
     * @throws ProcessorException
     */
    public function getEntryPointJsData(string $section): EntryData
    {
        $this->processEntryPointsData($section, self::FILE_FORMAT_JS);

        return new EntryPointData(
            $this->formattedData[self::FILE_FORMAT_JS][$section] ?? [],
            $this->integrity
        );
    }

    /**
     * Get EntryPoints CssFiles by Section
     * @param string $section
     * @return EntryData
     * @throws ProcessorException
     */
    public function getEntryPointCssData(string $section): EntryData
    {
        $this->processEntryPointsData($section, self::FILE_FORMAT_CSS);

        return new EntryPointData(
            $this->formattedData[self::FILE_FORMAT_CSS][$section] ?? [],
            $this->integrity
        );
    }

    /**
     * Get manifest data
     * @return array
     */
    public function getManifestData() : array
    {
        $this->loadData();
        return $this->manifest;
    }

}