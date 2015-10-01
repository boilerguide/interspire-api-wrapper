<?php

namespace HolmesMedia\InterspireApiWrapper\Request\Transformer;


use HolmesMedia\InterspireApiWrapper\Request\AbstractRequest;

class XMLTransformer extends AbstractTransformer
{
    public function transform(AbstractRequest $request)
    {
        $domXml = new \DOMDocument('1.0', 'utf-8');

        $xmlRequest = $domXml->createElement('xmlrequest');
        $xmlRequest->appendChild($domXml->createElement('username', $this->authData->getUsername()));
        $xmlRequest->appendChild($domXml->createElement('usertoken', $this->authData->getUserToken()));
        $xmlRequest->appendChild($domXml->createElement('requesttype', $request->getType()));
        $xmlRequest->appendChild($domXml->createElement('requestmethod', $request->getMethod()));

        $detailsNode = $domXml->createElement('details');
        foreach ($request->getDetails()->toArray() as $k => $v) {
            $detailsNode->appendChild($domXml->createElement($k, $v));
        }

        $detailsNode->appendChild($domXml->createElement('add_to_autoresponders', 'true'));

        $xmlRequest->appendChild($detailsNode);
        $domXml->appendChild($xmlRequest);

        return $domXml->saveXML();
    }

}