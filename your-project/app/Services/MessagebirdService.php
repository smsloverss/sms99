<?php


namespace App\Services;


use Illuminate\Support\Facades\Log;
use MessageBird\Client;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Objects\Message;

class MessagebirdService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Client(env('MESSAGEBIRD_API'));
    }

    public function sendMessage(string $originator, array $recipients, string $body): bool
    {
        $message = new Message();
        $message->originator = $originator;
        $message->recipients = $recipients;
        $message->body = $body;
        try {
            $result = $this->api->messages->create($message);
            return true;
        } catch (AuthenticateException $e) {
            Log::debug('Your messagebird credentials are incorrect');
        } catch (BalanceException $e) {
            Log::debug('Your balance is insufficient');
        }
        return false;
    }
}
