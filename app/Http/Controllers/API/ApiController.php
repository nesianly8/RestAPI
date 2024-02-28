<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    private $uri = 'https://data.covid19.go.id/public/api/';

    public function getCovid19Case()
    {
        $client = new Client();

        $options = [
            'verify' => false,
            'Accept' => 'application/json',
        ];

        $response = $client->get($this->uri . 'prov.json', $options)->getBody()->getContents();

        $response_json = json_decode($response);

        return response()->json($response_json, 200);
    }
}
