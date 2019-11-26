<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */
declare(strict_types=1);

namespace Process\Encore;

/**
 * Class Integrity
 * @package Process\Encore
 */
class Integrity
{

    /**
     * @var array $integrityList
     */
    private $integrityList;

    /**
     * Integrity constructor.
     * @param array $integrityList
     */
    public function __construct(array $integrityList)
    {
        $this->integrityList = $integrityList;
    }

    public function hasIntegrity(): bool
    {
        return boolval(count($this->getIntegrityList()));
    }

    /**
     * Get IntegrityList
     * @return array
     */
    public function getIntegrityList(): array
    {
        return $this->integrityList;
    }

    /**
     * Integrity look up by fileName
     * @param string $file
     * @return string|null
     */
    public function lookUp(string $file): ?string
    {
        return $this->integrityList[$file] ?? null;
    }

}