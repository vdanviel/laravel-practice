<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
class CepController extends Controller
{
    public static function cepdata($input){

        $cep = str_replace("-","", $input);

        $response = curl_init("https://viacep.com.br/ws/$cep/json/");

        curl_setopt_array($response, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $address = curl_exec($response);

        $address = json_decode($address, true);

        curl_close($response);
        
        if (isset($address['erro'])) {
            return false;
        }else {
            return $address;
        }
        
    }
}
