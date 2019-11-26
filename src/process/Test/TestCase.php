<?php declare(strict_types=1);

/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 */
namespace Process\Test;

use DG\BypassFinals;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Process\Encore\DataProvider;

abstract class TestCase extends PhpUnitTestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        BypassFinals::enable();
    }

    /**
     * @param bool $expectToFetchData
     * @return MockObject
     */
    protected function getMockDataGather( $expectToFetchData = true) : MockObject
    {
        $mockMethod       = 'fetchData';
        $mockDataProvider = $this->getMockBuilder(DataProvider::class);
        $mockDataProvider->onlyMethods([$mockMethod]);
        $service = $mockDataProvider->getMock();

        $expects = $expectToFetchData ? $this->exactly(1) : $this->never();

        $service
        ->expects($expects)
        ->method($mockMethod)
        ->will($this->returnValue($this->getFilesData()));
        return $service;
    }

    protected function getFilesData()
    {
      return
          require TESTS_PATH . DIRECTORY_SEPARATOR .'data'.
              DIRECTORY_SEPARATOR.'encore_generated_data.php';
    }

    protected function getEntryPointsData()
    {
        return json_decode($this->getFilesData()['entryPoints'],true)
                ['entrypoints'];

    }

    protected function getIntegrityData()
    {
        return json_decode($this->getFilesData()['entryPoints'],true)
        ['integrity'];

    }

    protected function getManifestData()
    {
        return json_decode($this->getFilesData()['manifest'],true);
    }

    protected function getEntryJsData($entry)
    {
        return $this->getEntryPointsData()[$entry]['js'] ?? [];
    }

    protected function getEntryCssData($entry)
    {
        return $this->getEntryPointsData()[$entry]['css'] ?? [];
    }

    protected function getScriptTags()
    {

    }




}