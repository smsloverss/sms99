<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    public function webhook(Request $request)
    {
        if ($request->has('event')) {
            $e = $request->input('event');
            if ($e['type'] == 'charge:confirmed') {
                Log::debug('Charge is confirmed! Aye!');
                $order = Order::query()->where('cb_id', '=', $e['data']['id'])->first();
                if (!is_null($order) && $order->status !== Order::$PAYED) {
                    $order->status = Order::$PAYED;
                    $order->save();
                    $user = User::find($order->user_id);
                    $user->balance += $order->amount;
                    $user->save();
                }
            }
        }
    }

    public function show()
    {
        return view('pay');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $amount = $request->input('amount');

        if ($amount < 5) {
            return redirect()->back();
        }


        ApiClient::init(env('COINBASE_API'));


        $user = auth()->user();

        $charge = [
            'name' => 'Balance',
            'description' => 'Top up your balance',
            'local_price' => [
                'amount' => $request->input('amount'),
                'currency' => 'EUR',
            ],
            'pricing_type' => 'fixed_price',
        ];

        $chargeObject = Charge::create($charge);

        if ($chargeObject->id) {
            Order::create([
                'user_id' => $user->id,
                'amount' => $request->input('amount'),
                'cb_id' => $chargeObject->id,
            ]);
            return redirect()->away($chargeObject->hosted_url);
        }

        return redirect()->back();
    }
}
