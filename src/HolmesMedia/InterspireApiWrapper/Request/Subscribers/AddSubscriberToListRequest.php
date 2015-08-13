<?php

namespace HolmesMedia\InterspireApiWrapper\Request\Subscribers;


use HolmesMedia\InterspireApiWrapper\Request\AbstractRequest;

/**
 * Class AddSubscriberToListRequest
 * @package HolmesMedia\InterspireApiWrapper\Request\Subscribers
 */
class AddSubscriberToListRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $type = 'subscribers';
    /**
     * @var string
     */
    protected $method = 'AddSubscriberToList';
}