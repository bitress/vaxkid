<?php

use GuzzleHttp\Client;

class SmsSender
{

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleHttp\Client();
    }

    public function init($phone, $message){

        // try {

        //         $endpoint = 'https://sendsms.fessitup.xyz/sendSMS?username=test&password=test&phone='.$phone.'&message='. $message. '&ur=0';
        //         $ch = curl_init();
        //         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_URL,$endpoint);
        //         $result = curl_exec($ch);
        //         curl_close($ch);

        //     if($result === false){
        //         $info = curl_getinfo($ch);
        //         curl_close($ch);
        //         die('Error occurred'.var_export($info));
        //     }

        //         $res = json_decode($result, false, 512, JSON_THROW_ON_ERROR);
        //             if ($res->status === 200){
        //               return true;
        //             }
        //               return true;

        // } catch (Exception $e){
        //     echo "Error: " . $e->getMessage();
        // }
        
      
//Set to your time zone in phone
date_default_timezone_set('Asia/Manila');

$time = time();
$deviceID = "cvw4cqCJw3Y:APA91bH8EYbB2neSEi88OzLyEiVM2GRclEUGjIlh3pVozta_bQu5AJ2ONnqi2kPQ0glumaj91rOQhpDRnTSTCbY1sbWYoCRBZtp8A5HEt3hSUbwu82BcrHbMkctOz4QOnxDwFWSFwiww";
$secret = "03efda7e-8ef4-4905-93b0-31829a084b97";
// you can hash to md5 to protect your secret, or you just send the secret
$secret = md5($secret.$time);

// USING GET
 file_get_contents("https://sms.ibnux.net/?to=".urlencode($phone)."&text=".urlencode($message)."&secret=$secret&time=$time&deviceID=".urlencode($deviceID));
return true;
// with POST, you don't need urlencode



    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fortresInit($phone, $message){
        $response = $this->client->request("POST", "https://api.sms.fortres.net/v1/messages", [
            "headers" => [
                "Content-type" => "application/json"
            ],
            "auth" => [CLIENT_ID, CLIENT_SECRET],
            "json" => [
                "recipient" => $phone,
                "message" => $message
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            return true;
        }
    }


}