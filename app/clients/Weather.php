<?php

namespace App\clients;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Weather
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {

        $this->client = new Client();
    }

    /**
     * @param string $search
     * @return WeatherResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $search)
    {
        $response = $this->client->request('GET', Config::get('weather.url') . $search, [
            'auth' => ['user', 'pass'],
            'http_errors' => false
        ]);

        // Return a standardised response. If we were interacting with multiple APIs, then I'd create an interface
        // so that they can all be interacted with in the same way.
        return new WeatherResponse($response);
    }
}
