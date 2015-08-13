<?php

namespace HolmesMedia\InterspireApiWrapper\Failure;


/**
 * Class LogEntry
 * @package BoilerGrants\Interspire\Failure
 */
class LogEntry
{
    /**
     * @var string
     */
    private $emailAddress;
    /**
     * @var string
     */
    private $failureReason;

    /**
     * LogEntry constructor.
     * @param string $emailAddress
     * @param string $failureReason
     */
    public function __construct($emailAddress, $failureReason)
    {
        $this->emailAddress = $emailAddress;
        $this->failureReason = $failureReason;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getFailureReason()
    {
        return $this->failureReason;
    }


}