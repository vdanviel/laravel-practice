<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){

    }

    public function checkout(){

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        /* $session = \Stripe\Checkout\Session::create(array(
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => '{{PRICE_ID}}',
                'quantity' => 1,
              ]],
              'mode' => 'payment',
              'success_url' => $YOUR_DOMAIN . '/success.html',
              'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        )); */
    }

    public function success(){

    }
}
