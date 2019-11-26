<?php
/**
 *
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */
declare(strict_types=1);

namespace Process\Encore;

use JsonException;
use Process\Encore\Contracts\DataGather;
use Process\Encore\Exceptions\DataProviderException;

/**
 * Class DataProvider
 * @package Process\Encore
 */
final class DataProvider implements DataGather
{

    /**
     * @const string EntryPoints file
     */
    const ENTRYPOINTS = 'entrypoints.json';

    /**
     * @const string EntryPoints entry array key
     */
    const ENTRYPOINTS_ENTRY_KEY = 'entrypoints';

    /**
     * @const string EntryPoints integrity array key
     */
    const ENTRYPOINTS_INTEGRITY_KEY = 'integrity';

    /**
     * @const string Manifest file
     */
    const MANIFEST = 'manifest.json';

    /**
     * @var string $encoreConfigPath ;
     */
    private $encoreConfigPath;

    /**
     * @var array $entryPointsData
     */
    private $entryPointsData = [];

    /**
     * @var array $manifestData
     */
    private $manifestData = [];

    /**
     * Provider constructor.
     * @param string $encoreConfigPath
     */
    public function __construct(string $encoreConfigPath = ASSETS_ENCORE_CONFIG_PATH)
    {
        $this->encoreConfigPath = $encoreConfigPath;
    }

    /**
     * Fetch files data
     * Could be cached for performance improvement
     * @return array
     */
    protected function fetchData(): array
    {
        $entryPointsFile    = $this->encoreConfigPath .
            DIRECTORY_SEPARATOR . self::ENTRYPOINTS;
        $manifestFile       = $this->encoreConfigPath .
            DIRECTORY_SEPARATOR . self::MANIFEST;
        $entryPointsContent = $manifestContent = [];

        $returnData         = [
            'entryPoints' => $entryPointsContent,
            'manifest'    => $manifestContent
        ];

        if (!file_exists($entryPointsFile) || !is_readable($entryPointsFile) ||
            !file_exists($manifestFile) || !is_readable($manifestFile)){
            return $returnData;
        }

        $entryPointsContent = file_get_contents($entryPointsFile);
        $manifestContent    = file_get_contents($manifestFile);

        $returnData['entryPoints'] = $entryPointsContent;
        $returnData['manifest']    = $manifestContent;

        return $returnData;
    }

    /**
     * Load EntryPoints and manifest files
     * @return void
     * @throws DataProviderException
     */
    public function load(): void
    {
        [
            'entryPoints' => $entryPoints,
            'manifest'    => $manifest

        ] = $this->fetchData();

        if (empty($entryPoints) || empty($manifest)) {
            return;
        }

        try {

            $this->entryPointsData = json_decode($entryPoints,
                true,512,JSON_THROW_ON_ERROR);
            $this->manifestData    = json_decode($manifest,
                true,512,JSON_THROW_ON_ERROR);

        } catch (JsonException $e) {

            throw new DataProviderException($e->getMessage());
        }

    }

    /**
     * Get EntryPoints file content as array
     * @return array
     */
    public function getEntryPointsData(): array
    {
        return $this->entryPointsData[self::ENTRYPOINTS_ENTRY_KEY] ?? [];
    }

    public function getIntegrityData(): array
    {
        return $this->entryPointsData[self::ENTRYPOINTS_INTEGRITY_KEY] ?? [];
    }

    /**
     * Get Manifest file content as array
     * @return array
     */
    public function getManifestData(): array
    {
        return $this->manifestData;
    }
}