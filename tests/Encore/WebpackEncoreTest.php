<?php declare(strict_types=1);

/**
 * (c) Stelio Stefanov <stefanov.stelio@gmail.com>
 *
 */

use Process\Encore\Processor;
use Process\Test\TestCase;
use Process\WebpackEncore;

/**
 * Class WebpackEncoreTest
 */
class WebpackEncoreTest extends TestCase
{

    /**
     * @var WebpackEncore $encoreFacade
     */
    private $encoreFacade;

    public function setUp(): void
    {
        $this->encoreFacade = new WebpackEncore (
            new Processor(
                $this->getMockDataGather(false)
            )
        );
    }

    /**
     * Data provider sectionsProvider
     * @return array
     */
    public function sectionsProvider(): array
    {
        return [
            'Random Order JS'                               => [
                'js',
                ['app', 'page', 'page1'],
                true
            ],
            'Sequential Order JS'                           => [
                'js',
                ['app', 'page', 'page1'],
                false
            ],
            'Part of the sections test1 (Random order) JS'  => [
                'js',
                ['page', 'page1'],
                true
            ],
            'Part of the sections test2 (Random order) JS'  => [
                'js',
                ['app', 'page1'],
                true
            ],
            'Random Order CSS'                              => [
                'css',
                ['app', 'page', 'page1'],
                true
            ],
            'Sequential Order CSS'                          => [
                'css',
                ['app', 'page', 'page1'],
                false
            ],
            'Part of the sections test1 (Random order) CSS' => [
                'css',
                ['page', 'page1'],
                true
            ],
            'Part of the sections (Random order) CSS'       => [
                'css',
                ['app', 'page1'],
                true
            ]
        ];
    }

    /**
     * AssetsProvider
     * @return array
     */
    public function assetsProvider(): array
    {
        return [
            [
                'static/fonts/fontawesome-webfont.woff',
                '/static/fonts/fontawesome-webfont.fee66e71.woff',
                true
            ],
            [
                'static/images/python.png',
                '/static/images/python.ff06c339.png',
                true
            ],
            [
                'static/images/java.png',
                '/static/images/java.ff06c339.png',
                false
            ]
        ];
    }

    /**
     * GetJsFiles Random Call, ensure no duplicates .
     * Covers getJsFiles and getCssFiles
     * @dataProvider sectionsProvider
     * @param $type
     * @param $sections
     * @param $randomOrder
     */
    public function testGetFiles($type, $sections, $randomOrder): void
    {
        if ($randomOrder) {
            shuffle($sections);
        }

        $allFiles = [];
        foreach ($sections as $section) {
            $allFiles[$section] = $this->encoreFacade->{$type . 'Files'}($section);
        }

        $allFilesForRequest = array_reduce($allFiles,
            function ($prev, $current) {
                return array_merge($prev, $current);
            }, []);

        $this->assertEquals(count($allFilesForRequest),
            count(array_unique($allFilesForRequest)));
    }

    /**
     * @dataProvider assetsProvider
     * @param string $assetName
     * @param string $assetRealFile
     * @param bool $exists
     */
    public function testAsset(
        string $assetName,
        string $assetRealFile,
        bool $exists
    ): void {
        $result       = $this->encoreFacade->asset($assetName);
        $assertMethod = $exists ? 'Equals' : 'NotEquals';
        $this->{'assert' . $assertMethod}($result, $assetRealFile);
    }

    /**
     * Test JsFiles Empty On NextCall
     *
     */
    public function testJsFilesEmptyOnNextCall() : void
    {
        $section = 'app';
        $this->encoreFacade->jsFiles($section);
        $jsFilesSecondCall = $this->encoreFacade->jsFiles($section);
        $this->assertEmpty($jsFilesSecondCall);
    }

    /**
     * Test Css Files Empty On NextCall
     */
    public function testCssFilesEmptyOnNextCall() : void
    {
        $section = 'app';
        $this->encoreFacade->cssFiles($section);
        $cssFilesSecondCall = $this->encoreFacade->cssFiles($section);
        $this->assertEmpty($cssFilesSecondCall);
    }

    /**
     *  Test reset
     */
    public function testReset() : void
    {
        $section             = 'app';
        $cssFilesBeforeReset = $this->encoreFacade->cssFiles($section);
        $jsFilesBeforeReset  = $this->encoreFacade->jsFiles($section);

        $this->encoreFacade->reset();

        $cssFilesAfterReset = $this->encoreFacade->cssFiles($section);
        $jsFilesAfterReset  = $this->encoreFacade->jsFiles($section);

        $this->assertSame($cssFilesBeforeReset, $cssFilesAfterReset);
        $this->assertSame($jsFilesBeforeReset, $jsFilesAfterReset);

    }

    /**
     * Test link tags
     */
    public function testLinkTags() : void
    {
        $appLinkTags  = $this->encoreFacade->linkTags('app');
        $pageLinkTags = $this->encoreFacade->linkTags('page');
        $allLinkTags  = $appLinkTags . $pageLinkTags;

        $this->assertEquals(preg_replace("/\r|\n/", "",
            $this->getExpectedLinkTags()), $allLinkTags);
    }

    /**
     * Test script tags
     */
    public function testScriptTags() : void
    {
        $appScriptTags  = $this->encoreFacade->scriptTags('app');
        $pageScriptTags = $this->encoreFacade->scriptTags('page');
        $allScriptTags  = $appScriptTags . $pageScriptTags;
        $this->assertEquals(preg_replace("/\r|\n/", "",
            trim($this->getExpectedScriptTags())), trim($allScriptTags));
    }

    /**
     * Get expected script tags
     * @return string
     */
    private function getExpectedScriptTags()
    {
        return '<script integrity="sha384-rw9ymbirQ0CvZNgZEf9i2HDcZheP7dFfStAtt6W2+CoB6cDTQakUoa8MIvxTn+wo" 
crossorigin="anonymous" src="/static/runtime.js"></script> 
<script integrity="sha384-OTXHZOvqEbcOIDekxOR4/MGN4PKwgdEA15QOZiPR6UEqSRGQZYcZZmB69MwEaglk" 
crossorigin="anonymous" src="/static/vendors~app~page~page1.js"></script> 
<script integrity="sha384-uEP+Eqy0gZ1EdN2IVl3j/3eEpiGyXRKwyMItV2s2Yzle6ztlSIV+KOCQNQBdUo4W" 
crossorigin="anonymous" src="/static/vendors~app.js"></script> 
<script integrity="sha384-lW1lP+Q/KTSdljd8RSEiF+S7heffsKa4DWB00H8mYlhcKsuop98qvGoMMEZgzl+6" 
crossorigin="anonymous" src="/static/app.js"></script><script 
integrity="sha384-VVzwumLrLj5g2jsLuzf+08V8S6zIP2mtJJsJTmw0vsbxpC3fJuMW8xVPAhM6Vk+u" 
crossorigin="anonymous" src="/static/page.js"></script>';
    }

    /**
     * Get expected link tags
     * @return string
     */
    public function getExpectedLinkTags()
    {
        return '<link rel="stylesheet" integrity="sha384-QM3drU12cgafwJLyVxuRlrSl0V2r5bbUmV45KodqbC6be/R/5L4pz9h4Jc6Nm15K" 
crossorigin="anonymous" href="/static/app.css">';
    }

}