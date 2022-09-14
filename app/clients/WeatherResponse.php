<?php

namespace App\clients;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class WeatherResponse
{
    /**
     * @var bool
     */
    protected $ok;

    /**
     * @var array
     */
    protected $messages;

    /**
     * @var mixed
     */
    protected $responseContents;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        //A simple flag to let us know if anything went wrong
        $this->setOk($response);
        //Format any error message that were returned
        $this->setMessages($response);
        //If no errors occured, decode the json response and store it as an array
        $this->setResponseContents($response);
        //store the raw response in case we want to interrogate it later
        $this->setResponse($response);
    }

    /**
     * @param Response $response
     * @return void
     */
    public function setOk(Response $response): void
    {
        $this->ok = $response->getStatusCode() == 200;;
    }


    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * @param Response $response
     * @return void
     */
    public function setMessages(Response $response): void
    {
        $this->messages = [];

        //Format error messages here
        if($response->getStatusCode() != 200) {
            $responseContents = json_decode($response->getBody()->getContents(), true);
            if(isset($responseContents['error']['code']) && $responseContents['error']['code'] == 1003) {
                $this->messages['search'] = 'Please provide a search paramater';
            } elseif(isset($responseContents['error']['code']) && $responseContents['error']['code'] == 1006) {
                $this->messages['search'] = 'No matching location found.';
            } elseif (isset($responseContents['error']['message'])) {
                $this->messages['misc'] = $responseContents['error']['message'];
            }
        }
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param Response $response
     * @return void
     */
    public function setResponseContents(Response $response): void
    {
        $this->responseContents = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return mixed
     */
    public function getResponseContents()
    {
        return $this->responseContents;
    }

    /**
     * @param Response $response
     * @return void
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}
