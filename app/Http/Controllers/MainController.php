<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mockery\Exception;


class MainController extends Controller
{
    public function index()
    {
        $client = new Client();

        $key = env('YANDEX_API_KEY');

        if (!$key) {
            throw new Exception('Отсутствует API ключ в .env');
        }

        try {

            $res = $client->get('https://api.weather.yandex.ru/v2/informers', [
                'headers' => [
                    'X-Yandex-API-Key' => $key
                ],
                'query' => [
                    'lat' => '53.243562',
                    'lon' => '34.363425',
                    'lang' => 'ru_RU'
                ]
            ]);
            $json = $res->getBody();

            $data = json_decode($json);

            return view('index', compact('data'));

        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

}
