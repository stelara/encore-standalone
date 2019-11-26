<?php
/**
 * Created by Stelio Stefanov.
 * stefanov.stelio@gmail.com
 */

namespace Process\Encore\Exceptions;


use Exception;

/**
 * Class ProcessorException
 * @package Process\Encore\Exceptions
 */
class ProcessorException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}