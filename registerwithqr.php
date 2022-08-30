<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';
require 'functions.php';

use function GuzzleHttp\json_encode;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //Notice the Namespace and Class name
$dotenv->load();


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        

        $api_instance = $_ENV['ID_INSTANCE'];
        $api_token = $_ENV['API_TOKEN'];

        $client = new GuzzleHttp\Client();
        
        try {
            $response = $client->request('GET', BASE_URL.'waInstance'. $api_instance .'/qr/'. $api_token , array(
                
            )
            );
            print_r($response->getBody()->getContents());

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // handle exception or api errors.
            print_r($e->getMessage());
        }
    }else{

        echo json_encode(array("message" => "Request is not accepted"));
    }





?>