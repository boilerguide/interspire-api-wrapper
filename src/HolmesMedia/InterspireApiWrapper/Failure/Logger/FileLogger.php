<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger;


use HolmesMedia\InterspireApiWrapper\Failure\LogEntry;
use HolmesMedia\InterspireApiWrapper\Failure\Logger\Exception\FileNotWritableException;

/**
 * Class Logger
 * @package BoilerGrants\Interspire\Failure
 */
class FileLogger extends AbstractLogger
{

    /**
     * @var string
     */
    private $logFilePath;

    /**
     * FileLogger constructor.
     *
     * @param string $logFilePath
     */
    public function __construct($logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }


    /**
     * @param LogEntry $entry
     *
     * @throws \Exception
     */
    protected function persist(LogEntry $entry)
    {
        if (!($file = fopen($this->logFilePath, 'a'))) {
            throw new FileNotWritableException($this->logFilePath);
        }

        $lineToWrite = sprintf(
            "%s;%s;%s\n",
            (new \DateTime())->format("Y-m-d H:i:s"),
            $entry->getEmailAddress(),
            $entry->getFailureReason()

        );

        if (false === fwrite($file, $lineToWrite)) {
            throw new FileNotWritableException($this->logFilePath);
        };

        fclose($file);
    }
}
