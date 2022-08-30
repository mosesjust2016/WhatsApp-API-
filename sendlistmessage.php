<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';
require 'functions.php';

use function GuzzleHttp\json_encode;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //Notice the Namespace and Class name
$dotenv->load();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"));
       
        $api_instance = $_ENV['ID_INSTANCE'];
        $api_token = $_ENV['API_TOKEN'];

        $mobile =  $data->mobile .'@c.us';
        $message = $data->message;
        $footer = $data->footer;
        $btnText = $data->buttontext;



        $client = new GuzzleHttp\Client();

        $sections_array = $data->sections;

        // Define array of request body.
        $request_body = array(
            'chatId'=> $mobile,
            'message'=> $message,
            'footer'=> $footer,
            'buttonText'=> $footer,
            'sections'=> $sections_array
        );

       // echo json_encode($request_body);
        

        try {
            $response = $client->request('POST', BASE_URL.'waInstance'. $api_instance .'/SendListMessage/'. $api_token , array(
                'json' => $request_body 
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