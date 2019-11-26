<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */

namespace Process\Encore;


use Process\Encore\Contracts\EntryData;

class EntryPointData implements EntryData
{

    /**
     * @var array
     */
    private $entryFiles;
    /**
     * @var Integrity
     */
    private $integrity;

    /**
     * EntryPointData constructor.
     * @param array $entryFiles
     * @param Integrity $integrity
     */
    public function __construct(array $entryFiles, Integrity $integrity)
    {
        $this->entryFiles = $entryFiles;
        $this->integrity  = $integrity;
    }

    /**
     * @return array
     */
    public function getEntryFiles(): array
    {
        return $this->entryFiles;
    }

    /**
     * @return Integrity
     */
    public function getIntegrity(): Integrity
    {
        return $this->integrity;
    }


}