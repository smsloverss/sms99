<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\Services\MessagebirdService;
use App\Services\Messagehub;
use App\SMSMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SMSMessageController extends Controller
{
    public function form()
    {
        return view('message');
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'from' => 'required',
            'message' => 'required'
        ]);

        $sender = strtolower($request->input('from'));

        $blacklist = Blacklist::query()
            ->where('token', '=', $sender)
            ->first();

        if (!is_null($blacklist)) {
            Session::flash('message', 'This sender is blacklisted.');
            return redirect()->back();
        }

        $numbers = explode(PHP_EOL, $request->input('to'));
        $numbers = array_map(function ($n) {
            return preg_replace("/[\n\r]/", "", $n);
        }, $numbers);

        $user = auth()->user();

        // Sending details
        $from = (string) $request->input('from');
        $message = (string) $request->input('message');

        // Max length of one sms is 160
        $messageCost = ceil(strlen($message) / SMSMessage::$MAX_LENGTH);

        // Total amount of numbers * sms price * message length
        $cost = (count($numbers) * SMSMessage::$COSTS) * $messageCost;


        if ($user->balance >= $cost) {

            $mh = new MessagebirdService();
            if ($mh->sendMessage(
                $from,
                $numbers,
                $message
            )) {
                $user->balance -= $cost;
                $user->save();

                SMSMessage::create([
                    'to' => count($numbers),
                    'from' => $from,
                    'message' => $message,
                    'user_id' => $user->id,
                ]);
                Session::flash('message', "Message's send!");
            } else {
                Session::flash('message', "Whoops, somethings happened.");
            }
        } else {
            Session::flash('message', "Your balance is to low.");
        }

        return redirect()->back();

    }
}
