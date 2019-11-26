<?php declare(strict_types=1);

/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 *
 */

use Process\Encore\Exceptions\ProcessorException;
use Process\Encore\Processor;
use Process\Test\TestCase;

class ProcessorTest extends TestCase
{

    public $processor;

    public function setUp(): void
    {
        $this->processor = new Processor(
            $this->getMockDataGather()
        );
    }

    /**
     * Data provider
     * @return array
     */
    public function getSections(): array
    {
        return [
            'App Section'   => ['app'],
            'Page Section'  => ['page'],
            'Page1 Section' => ['page1']
        ];
    }

    /**
     * @dataProvider getSections
     * @param $section
     * @throws ProcessorException
     */
    public function testGetEntryPointJsData($section) : void
    {
        $this->assertSame($this->getEntryJsData($section),
            $this->processor->getEntryPointJsData($section)->getEntryFiles());
    }

    /**
     * @dataProvider getSections
     * @param $section
     * @throws ProcessorException
     */
    public function testGetEntryPointCssData($section) : void
    {
        $this->assertSame($this->getEntryCssData($section),
            $this->processor->getEntryPointCssData($section)->getEntryFiles());
    }

    public function testGetManifestData() : void
    {
        $this->assertSame($this->getManifestData(),
            $this->processor->getManifestData());
    }
}