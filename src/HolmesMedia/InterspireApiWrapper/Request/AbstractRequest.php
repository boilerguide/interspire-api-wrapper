<?php

namespace HolmesMedia\InterspireApiWrapper\Request;


/**
 * Class AbstractRequest
 *
 * @package HolmesMedia\InterspireApiWrapper\Request
 */
abstract class AbstractRequest
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $method;
    /**
     * @var Details
     */
    protected $details;

    /**
     * @param Details $details
     *
     * @return AbstractRequest
     */
    public function setDetails(Details $details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return Details
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}