<?php

namespace HolmesMedia\InterspireApiWrapper\Failure\Logger;


use HolmesMedia\InterspireApiWrapper\Failure\LogEntry;

/**
 * Class Logger
 * @package BoilerGrants\Interspire\Failure
 */
class WordpressDatabaseLogger extends AbstractLogger
{
    /**
     * @var \wpdb
     */
    private $wpdb;

    /**
     * @var
     */
    private $logTableName;

    /**
     * @param $logTableName
     */
    public function __construct($logTableName)
    {
        /** @var \wpdb $wpdb */
        global $wpdb;

        $this->wpdb = $wpdb;

        $this->logTableName = $logTableName;
    }


    /**
     * @param LogEntry $entry
     */
    protected function persist(LogEntry $entry)
    {
        $this->wpdb->insert(
            sprintf("%s%s", $this->wpdb->prefix, $this->logTableName),
            array(
                'email_address' => $entry->getEmailAddress(),
                'reason' => $entry->getFailureReason(),
                'submission_date' => (new \DateTime())->format('Y-m-d H:i:s')
            ),
            array(
                '%s',
                '%s',
                '%s'
            )
        );
    }
}
