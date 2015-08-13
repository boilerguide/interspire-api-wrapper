<?php

namespace HolmesMedia\InterspireApiWrapper\Request;


/**
 * Class Details
 *
 * Represents the 'details' field in the Interspire Request XML
 *
 * @package HolmesMedia\InterspireApiWrapper\Request
 */
class Details
{
    /**
     *  HTML mail format
     */
    const MAILING_FORMAT_HTML = 'html';
    /**
     *  Plain text mail format
     */
    const MAILING_FORMAT_PLAIN = 'text';

    /**
     * @var string
     */
    private $emailAddress;
    /**
     * @var int
     */
    private $mailingList;
    /**
     * @var string
     */
    private $format;
    /**
     * @var bool
     */
    private $confirmed;

    /**
     * RequestDetails constructor.
     *
     * @param string $emailAddress
     * @param int    $mailingList
     * @param string $format
     * @param bool   $confirmed
     */
    public function __construct($emailAddress, $mailingList, $format = self::MAILING_FORMAT_HTML, $confirmed = true)
    {
        $this->validateAndSetEmailAddress($emailAddress);
        $this->validateAndSetFormat($format);

        $this->mailingList = $mailingList;
        $this->confirmed = $confirmed;
    }

    /**
     * @param string $emailAddress
     */
    private function validateAndSetEmailAddress($emailAddress)
    {
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("This is not correct email address");
        }

        $this->emailAddress = $emailAddress;
    }

    /**
     * @param string $format
     */
    private function validateAndSetFormat($format)
    {
        if (!(in_array($format, array(
            self::MAILING_FORMAT_HTML,
            self::MAILING_FORMAT_PLAIN
        )))) {
            throw new \InvalidArgumentException("Wrong mailing format provided");
        }
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'emailaddress' => $this->emailAddress,
            'mailinglist' => $this->mailingList,
            'format' => $this->format,
            'confirmed' => $this->confirmed ? 'yes' : 'no'
        );
    }
}