<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'temp_c' => $this['current']['temp_c'],
                'feelslike_c' => $this['current']['feelslike_c'],
                'condition' => [
                    "text" => $this['current']['condition']['text'],
                    "icon" =>  $this['current']['condition']['icon'],
                    "code" =>  $this['current']['condition']['code'],
                ],
                'wind_dir' => $this['current']['wind_dir'],
                'wind_mph' => $this['current']['wind_mph'],
                'uv' => $this['current']['uv']
            ],
            '_links' => [
                'self' => [
                    'href' => route('weather-search')
                ]
            ]
        ];
    }
}
