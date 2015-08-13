<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger;


use GuzzleHttp\Message\ResponseInterface;
use HolmesMedia\InterspireApiWrapper\Failure\LogEntry;

/**
 * Class Logger
 * @package BoilerGrants\Interspire\Failure
 */
abstract class AbstractLogger
{

    /**
     * @param $emailAddress
     * @param \Exception $exception
     */
    public function logException($emailAddress, \Exception $exception)
    {
        $this->persist(new LogEntry(
            $emailAddress,
            $exception->getMessage()
        ));
    }

    /**
     * @param $emailAddress
     * @param ResponseInterface $response
     */
    public function logHTTPResponseError($emailAddress, ResponseInterface $response)
    {
        $this->persist(new LogEntry(
            $emailAddress,
            sprintf("HTTP ERROR: %s - %s", $response->getStatusCode(), $response->getReasonPhrase())
        ));
    }

    /**
     * @param $emailAddress
     * @param \SimpleXMLElement $response
     */
    public function logInterspireSubmissionError($emailAddress, \SimpleXMLElement $response)
    {
        $this->persist(new LogEntry(
            $emailAddress,
            $response->errormessage
        ));
    }

    /**
     * @param LogEntry $entry
     */
    abstract protected function persist(LogEntry $entry);
}
