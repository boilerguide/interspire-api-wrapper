<?php


namespace HolmesMedia\InterspireApiWrapper;

use GuzzleHttp\Exception\RequestException;
use HolmesMedia\InterspireApiWrapper\Failure\Logger;
use HolmesMedia\InterspireApiWrapper\Failure\Logger\LoggerFactory;
use HolmesMedia\InterspireApiWrapper\Request\AbstractRequest;
use GuzzleHttp\Client;
use HolmesMedia\InterspireApiWrapper\Request\RequestAuthData;
use HolmesMedia\InterspireApiWrapper\Request\Transformer\AbstractTransformer;
use HolmesMedia\InterspireApiWrapper\Request\Transformer\XMLTransformer;

/**
 * Class Connector
 *
 * @package HolmesMedia\InterspireApiWrapper
 */
class Connector
{
    /**
     * @var Client
     */
    private $httpClient;
    /**
     * @var Logger\AbstractLogger
     */
    private $logger;

    /**
     * @var AbstractTransformer
     */
    private $requestTransformer;

    /**
     * Connector constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->httpClient = new Client(array(
            'base_url' => $config['url']
        ));

        $this->logger = (new LoggerFactory())
            ->setLoggerType($config['logger']['type'])
            ->setLoggerLocation($config['logger']['location'])
            ->create();

        $this->requestTransformer = new XMLTransformer(new RequestAuthData($config['username'], $config['usertoken']));
    }


    /**
     * @param AbstractRequest $request
     */
    public function send(AbstractRequest $request)
    {
        $transformedRequest = $this->requestTransformer->transform($request);

        try {
            $response = $this->httpClient->post('', array(
                'body' => array(
                    'xml' => $transformedRequest
                )
            ));
        } catch (RequestException $exception) {
            $this->logger->logException(
                $request->getDetails()->getEmailAddress(),
                $exception
            );
            return;
        }

        if ($response->getStatusCode() != 200) {
            $this->logger->logHTTPResponseError(
                $request->getDetails()->getEmailAddress(),
                $response
            );
        } else {
            $responseXML = simplexml_load_string($response->getBody()->getContents());
            if ($responseXML->status != 'SUCCESS') {
                $this->logger->logInterspireSubmissionError(
                    $request->getDetails()->getEmailAddress(),
                    $responseXML
                );
            }
        }

        return;
    }


}