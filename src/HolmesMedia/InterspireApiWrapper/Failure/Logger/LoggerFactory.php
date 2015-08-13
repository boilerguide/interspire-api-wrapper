<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger;


use HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception\InvalidLoggerTypeException;


/**
 * Class LoggerFactory
 * @package HolmesMedia\InterspireApiWrapper\Failure\Logger
 */
class LoggerFactory
{

    /**
     * @var string
     */
    private $loggerType;
    /**
     * @var string
     */
    private $loggerLocation;

    /**
     * @param string $loggerType
     *
     * @return $this
     */
    public function setLoggerType($loggerType)
    {
        $this->loggerType = $loggerType;

        return $this;
    }

    /**
     * @param string $loggerLocation
     *
     * @return $this
     */
    public function setLoggerLocation($loggerLocation)
    {
        $this->loggerLocation = $loggerLocation;

        return $this;
    }

    /**
     * @return AbstractLogger
     *
     * @throws \Exception
     */
    public function create()
    {
        $className = __NAMESPACE__ . "\\" . ucwords($this->loggerType) . "Logger";

        if (!class_exists($className)) {
            $className = __NAMESPACE__ . "\\FileLogger";
        }

        $logger = new $className($this->loggerLocation);

        if ($logger instanceof AbstractLogger) {
            return $logger;
        } else {
            throw new InvalidLoggerTypeException($this->loggerType);
        }

    }
}