<?php

namespace Modules\NovaPoshta\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;
use Exception;

class NPService
{
    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public static function getWarehouses($page)
    {
        $client = new Client();
        $response = $client->post('https://api.novaposhta.ua/v2.0/json/', [
            'json' => [
                'apiKey' => config('np-api.api-key'),
                'modelName' => 'AddressGeneral',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => [
                    'Page' => $page,
                ]
            ]
        ]);

        $data = json_decode($response->getBody());

        if ($data->success) {
            return $data;
        } else {
            Log::info('error warehouse parse', [
                'message' => $data,
            ]);
            throw new Exception('Unable to fetch cities');
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public static function getCities()
    {
        $client = new Client();
        $response = $client->post('https://api.novaposhta.ua/v2.0/json/', [
            'json' => [
                'apiKey' => config('np-api.api-key'),
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
                'methodProperties' => new StdClass(),
            ]
        ]);

        $data = json_decode($response->getBody());

        if ($data->success) {
            return $data;
        } else {
            Log::info('error city parse', [
                'message' => $data,
            ]);
            throw new Exception('Unable to fetch cities');
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public static function getStreet($cityRef, $search)
    {
        $client = new Client();
        $response = $client->post('https://api.novaposhta.ua/v2.0/json/', [
            'json' => [
                'apiKey' => config('np-api.api-key'),
                'modelName' => 'Address',
                'calledMethod' => 'getStreet',
                'methodProperties' => [
                    'FindByString' => $search,
                    'CityRef' => $cityRef
                ],
            ]
        ]);

        $data = json_decode($response->getBody());

        if ($data->success) {
            return $data;
        } else {
            Log::info('error city parse', [
                'message' => $data,
            ]);
            throw new Exception('Unable to fetch cities');
        }
    }
}
