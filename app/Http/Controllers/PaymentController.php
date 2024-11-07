<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function index(String $id){
        $package = Package::findOrFail($id);
        return view('stripe', ['package' => $package]);
    }

    public function checkout(Request $request){

        // dd($request);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        Charge::create ([
            "amount" => $request->price * 100,
            "currency" => "aed",
            "source" => $request->stripeToken,
            "description" => "Test payment from Arayan"
        ]);

        $user = Auth()->user();
        $user->paid = true;
        $user->save();
        dd($user);

        return back()->with("success","Payment has been successfully processed.");
    }
}
