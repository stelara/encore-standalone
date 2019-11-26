<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */
declare(strict_types=1);

namespace Process\Encore\Contracts;

/**
 * Interface DataGather
 * @package Process\Encore\Contracts
 */
interface DataGather
{

    public function load();

    public function getEntryPointsData(): array;

    public function getManifestData(): array;
}