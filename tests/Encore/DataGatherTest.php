<?php declare(strict_types=1);

/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 *
 */

use Process\Test\TestCase;

class DataGatherTest extends TestCase
{

    public $dataProviderService;

    public function setUp(): void
    {
        $this->dataProviderService = $this->getMockDataGather();
    }

    protected function assertPreConditions(): void
    {
        $this->dataProviderService->load();
    }

    public function testGetEntryPointsData()
    {
        $this->assertSame($this->getEntryPointsData(),
            $this->dataProviderService->getEntryPointsData());
    }

    public function testGetIntegrityData()
    {
        $this->assertSame($this->getIntegrityData(),
            $this->dataProviderService->getIntegrityData());
    }

    public function testGetManifestData()
    {
        $this->assertSame($this->getManifestData(),
            $this->dataProviderService->getManifestData());
    }

}