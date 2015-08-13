<?php

namespace HolmesMedia\InterspireApiWrapper\Request\Transformer;


use HolmesMedia\InterspireApiWrapper\Request\AbstractRequest;
use HolmesMedia\InterspireApiWrapper\Request\RequestAuthData;

/**
 * Class AbstractTransformer
 * @package HolmesMedia\InterspireApiWrapper\Request\Transformer
 */
abstract class AbstractTransformer
{
    /**
     * @var RequestAuthData
     */
    protected $authData;

    /**
     * AbstractTransformer constructor.
     *
     * @param RequestAuthData $authData
     */
    public function __construct(RequestAuthData $authData)
    {
        $this->authData = $authData;
    }


    /**
     * @param AbstractRequest $request
     *
     * @return mixed
     */
    abstract public function transform(AbstractRequest $request);
}