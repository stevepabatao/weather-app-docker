<?php

namespace App\Http\Repositories;

use GuzzleHttp\Client;

class NearByRepository
{
    public function getPlacesByCity($city)
    {
        $nearbyData = $this->fetchNearByDataFromApi($city);

        return $this->formatNearByData($nearbyData);
    }


    private function fetchNearByDataFromApi($city)
    {
        $client = new Client();

        $url = 'https://api.foursquare.com/v3/places/match?name=Manila&ll=14.59%2C120.98';

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'fsq3JW+YfdKOSmJMEZkMdi5+Hm17+blg9vQhsTzJyInnKPY=',
                'accept' => 'application/json',
            ],
        ]);

        dd($response);

        $nearbyData = $response->getBody();



        return $nearbyData;
    }



    private function formatNearByData($nearbyData)
    {
        return [
            'places' => $nearbyData['response']['venues']
        ];
    }
}
