<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception;


/**
 * Class InvalidLoggerTypeException
 *
 * @package HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception
 */
class InvalidLoggerTypeException extends \Exception
{

    /**
     * InvalidLoggerTypeException constructor.
     *
     * @param string $loggerType
     */
    public function __construct($loggerType)
    {
        $message = sprintf(
            "%s is not a valid logger type,",
            $loggerType
        );
        parent::__construct($message);
    }
}