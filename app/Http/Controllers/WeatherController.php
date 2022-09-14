<?php

namespace App\Http\Controllers;

use App\clients\Weather;
use App\Http\Requests\WeatherSearchRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\WeatherResource;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherController extends Controller
{
    protected $weatherClient;

    public function __construct() {
        // Provide a wrapper around the weather API so that it can be interrogated in a standard manner.
        // If we were interacting with multiple APIs each wrapper would implement the same interface
        $this->weatherClient = new Weather();
    }

    /**
     * @param WeatherSearchRequest $request handles the input validate
     * @return ErrorResource|WeatherResource
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(WeatherSearchRequest $request)
    {
        //Get a WeatherResponseObject so we know how to interrogate the response
        $searchResult = $this->weatherClient->search($request->get('search'));

        // Return standardised error json object if search was not successful
        if(!$searchResult->isOk()) {
            return new ErrorResource($searchResult->getMessages());
        } else {
            return new WeatherResource($searchResult->getResponseContents());
        }
    }
}
