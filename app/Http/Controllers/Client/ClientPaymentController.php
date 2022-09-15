<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\setting_name_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPaymentController extends Controller
{
    public function client_payment()
    {
        $name_location = setting_name_location::where('admin_id', Auth::user()->admin_id)->first();
        return view('client.payment.invoicePayment', compact('name_location'));
    }


    public function client_stripe_payement_make(Request $request)
    {
        $amount = $request->amount * 100;

//        return $request->amount;
//        return $request->all();

        $stripe = new \Stripe\StripeClient(
            'sk_test_Rc3ItpcRMziLqT8XyLO0qesh00RYg0WFJi'
        );
//        $stripe->tokens->create([
//            'card' => [
//                'number' => $request->cardNumber,
//                'exp_month' => 4,
//                'exp_year' => 2023,
//                'cvc' => $request->cardCVC,
//            ],
//        ]);


//        if (!isset($token['id'])) {
//            return response()->json('Token_not_found');
//        }

        if ($request->stripeToken != null || $request->stripeToken != '') {
            $stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Paid to Peter',
            ]);
        }

        return back();
        exit();
        return response()->json('payment_done');


    }

}
