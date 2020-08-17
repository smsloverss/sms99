<?php


namespace App\Services;


use GuzzleHttp\Client;

/**
 * Class Messagehub
 * @package App\Services
 */
class Messagehub
{

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var null
     */
    protected $auth = NULL;

    /**
     * Messagehub constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://app.messagehub.nl/apis/'
        ]);
        $this->getAuthToken();
    }

    /**
     * @return |null
     */
    private function getAuthToken()
    {
        if (!is_null($this->auth))
            return $this->auth;

        $response = $this->client->post('auth', [
            'json' => [
                'type' => 'access_token',
                'username' => env('MESSAGEHUB_USERNAME'),
                'password' => env('MESSAGEHUB_PASSWORD'),
            ]
        ]);

        $data = json_decode($response->getBody()->getContents());

        if (property_exists($data, 'payload'))
            $this->auth = $data->payload->access_token;


        return $this->auth;
    }

    public function sendSingleMessage($from, $to, $message)
    {
        $response = $this->client->post('sms/mt/v2/send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken(),
            ],
            'json' => [[
                'to' => $to,
                'from' => $from,
                'message' => $message,
            ]]
        ]);

        return $response->getBody()->getContents();

    }

    public function getBalance()
    {
        $response = $this->client->get('sms/mt/v2/balance', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->auth,
            ]
        ]);
        var_dump($response->getBody()->getContents());
    }
}
