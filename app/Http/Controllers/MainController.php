<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use http\Client\Request;
use Mockery\Exception;
use Psr\Http\Message\ResponseInterface;

class MainController extends Controller
{
    public function index()
    {
        $client = new Client();

        try {
//            $res = $client->get('https://api.weather.yandex.ru/v2/informers',[
//                'headers'=>[
//                    'X-Yandex-API-Key' => '8427958f-8a00-46d5-9301-7d6102e973cd'
//                ],
//                'query'=>[
//                    'lat'=>'53.243562',
//                    'lon'=>'34.363425',
//                    'lang'=>'ru_RU'
//                ]
//            ]);
//           $json =  $res->getBody();

            $json = '{"now":1631017997,"now_dt":"2021-09-07T12:33:17.085094Z","info":{"url":"https://yandex.ru/pogoda/191?lat=53.243562\u0026lon=34.363425","lat":53.243562,"lon":34.363425},"fact":{"obs_time":1631016000,"temp":15,"feels_like":11,"icon":"ovc","condition":"overcast","wind_speed":3,"wind_dir":"w","pressure_mm":756,"pressure_pa":1007,"humidity":45,"daytime":"d","polar":false,"season":"autumn","wind_gust":9.9},"forecast":{"date":"2021-09-07","date_ts":1630962000,"week":36,"sunrise":"06:02","sunset":"19:19","moon_code":8,"moon_text":"moon-code-8","parts":[{"part_name":"evening","temp_min":8,"temp_avg":11,"temp_max":15,"wind_speed":2.2,"wind_gust":4.7,"wind_dir":"sw","pressure_mm":756,"pressure_pa":1007,"humidity":68,"prec_mm":0,"prec_prob":0,"prec_period":360,"icon":"skc_n","condition":"partly-cloudy","feels_like":8,"daytime":"n","polar":false},{"part_name":"night","temp_min":6,"temp_avg":7,"temp_max":8,"wind_speed":2.5,"wind_gust":5.7,"wind_dir":"sw","pressure_mm":755,"pressure_pa":1006,"humidity":83,"prec_mm":0,"prec_prob":0,"prec_period":360,"icon":"skc_n","condition":"partly-cloudy","feels_like":4,"daytime":"n","polar":false}]}}';

            $data = json_decode($json);


            return view('index', compact('data'));

        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

}
