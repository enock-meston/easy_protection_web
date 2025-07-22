<?php

namespace App\Http\Controllers;

use App\Models\FlutterPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlutterPaymentController extends Controller
{
    //
    public function pay(Request $request){
        session()->forget('cart');

        $request->validate([
            'amount' => 'required|numeric|min:100',
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'quantity' => 'required|numeric|min:1',
        ]);

        $amount = $request->amount;
        $email = $request->email;
        $name = $request->name;
        $phone = $request->phone;
        $quantity = $request->quantity;
        $product_name = $request->product_name;
        $product_name = implode(',', $product_name);

        $tx_ref = date('dHis') . uniqid(); // unique transaction reference

        $response = Http::withToken(env('FLW_SECRET_KEY'))
            ->post('https://api.flutterwave.com/v3/payments', [
                'tx_ref' => $tx_ref,
                'amount' => $amount,
                'currency' => 'RWF',
                'redirect_url' => route('payment.callback'),
                'payment_options' => 'card,banktransfer,mobilemoneyrwanda',
                'customer' => [
                    'email' => $email,
                    'first_name' => $name,
                    'phone_number' => $phone,
                ],
                'customizations' => [
                    'title' => 'Easy Protection Payment',
                    'description' => 'Pay for security services',
                    'logo' => asset('images/logo.png'),
                ],
            ]);

        $data = $response->json();
        //save to database
        FlutterPayment::create([
            'tx_ref' => $tx_ref,
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'amount' => $amount,
            'currency' => 'RWF',
            'quantity' => $quantity,
            'product_name' => $product_name,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        if (isset($data['data']['link'])) {

            return redirect($data['data']['link']); // redirect to payment page
        } else {
            return back()->with('error', 'Payment initiation failed.');
        }
    }


    public function callback(Request $request)
    {
        // Flutterwave will redirect to this URL after payment
        // You can verify payment here if needed
        // save to database
        FlutterPayment::where('tx_ref', $request->tx_ref)->update([
            'status' => $request->status,
            'payment_status' => $request->status,
        ]);

        return view('success', [
            'status' => $request->status,
            'tx_ref' => $request->tx_ref,
            'transaction_id' => $request->transaction_id,
        ]);
    }


    // payment via api
    public function paymentApi(Request $request){
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'unit' => 'required|integer|min:1',
            'tx_ref' => 'required|string',
            'product_name' => 'required|string',
            'status' => 'required|string',
        ]);

        $amount = $request->amount;
        $email = $request->email;
        $name = $request->name;
        $phone = $request->phone;
        $quantity = $request->unit;
        $tx_ref = $request->tx_ref;
        $status = $request->status;
        $product_name = $request->product_name;


        // save to database
        FlutterPayment::create([
            'tx_ref' => $tx_ref,
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'amount' => $amount,
            'currency' => 'RWF',
            'quantity' => $quantity,
            'product_name' => $product_name,
            'status' => $status,
            'payment_status' => $status,
        ]);

        return response()->json([
            'message' => 'Payment successful',
            'status' => $status,
            'payment_status' => $status,
        ]);


    }

}
