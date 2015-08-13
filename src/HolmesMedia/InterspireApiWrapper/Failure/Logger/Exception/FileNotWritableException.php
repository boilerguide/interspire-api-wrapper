<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception;


/**
 * Class FileNotWritableException
 *
 * @package HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception
 */
class FileNotWritableException extends \Exception
{

    /**
     * FileNotWritableException constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $message = sprintf(
            "Log file path %s is not writable",
            $path
        );

        parent::__construct($message);
    }
}