<?php

namespace App\Http\Repositories;

use GuzzleHttp\Client;

$client = new Client();

class NearByRepository
{

    public function getPlacesByCity($city)
    {
        $nearbyData = $this->fetchNearByDataFromApi($city);

        return $this->formatNearByData($nearbyData);
    }


    private function fetchNearByDataFromApi($ll)
    {
        $client = new Client();

        $apiKey = "fsq3JW+YfdKOSmJMEZkMdi5+Hm17+blg9vQhsTzJyInnKPY=";

        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/search', [
            'headers' => [
                'Authorization' => $apiKey,
                'accept' => 'application/json',
            ],
            'query' => [
                'll' => $ll,
                'categories' => '13000',
                'v' => '20230215',
                'radius' => 1000,
                'limit' => 6,
            ],
        ]);

        //dd(json_decode($response->getBody(), true)['results']);

        $places = collect(json_decode($response->getBody(), true)['results'])
            ->map(function ($place) {
                return [
                    'fsq_id' => $place['fsq_id'],
                    'name' => $place['name'],
                    'address' => $place['location']['formatted_address'],
                    'city' => $place['location']['locality'],
                    'lat' => $place['geocodes']['main']['latitude'],
                    'lng' => $place['geocodes']['main']['longitude'],
                    'photos' => $this->getPhotos($place['fsq_id']),
                    'tips' => $this->getTips($place['fsq_id']),
                ];
            });



        return  $places;
    }

    private function getPhotos($fsq_id) {

        $client = new Client();

        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/' . $fsq_id . '/photos', [
            'headers' => [
                'Authorization' => 'fsq3JW+YfdKOSmJMEZkMdi5+Hm17+blg9vQhsTzJyInnKPY=',
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true)[0];

        $photo = $data['prefix'] . "original" . $data['suffix'];

        return $photo;

    }

    private function getTips($fsq_id) {

        $client = new Client();

        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/' . $fsq_id . '/tips', [
            'headers' => [
                'Authorization' => 'fsq3JW+YfdKOSmJMEZkMdi5+Hm17+blg9vQhsTzJyInnKPY=',
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true)[0];

        return $data;

    }


    private function formatNearByData($nearbyData)
    {
        return $nearbyData;
    }
}
