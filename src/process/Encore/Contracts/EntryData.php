<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */

namespace Process\Encore\Contracts;


use Process\Encore\Integrity;

/**
 * Interface EntryData
 * @package Process\Encore\Contracts
 */
interface EntryData
{

    public function getEntryFiles(): array;

    public function getIntegrity(): Integrity;
}