<?php

namespace HolmesMedia\InterspireApiWrapper\Request;


/**
 * Class RequestAuthData
 * @package HolmesMedia\InterspireApiWrapper\Request
 */
class RequestAuthData
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $userToken;

    /**
     * RequestAuthData constructor.
     * @param string $username
     * @param string $userToken
     */
    public function __construct($username, $userToken)
    {
        $this->username = $username;
        $this->userToken = $userToken;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }




}