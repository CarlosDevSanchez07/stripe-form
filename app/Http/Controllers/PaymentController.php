<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;

class PaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        return view('payment');
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'email' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            "price" => "required",
            "fee" => "required"
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->json([ "message" => "Error de validación", "data" => "" ]);
        }

        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->json([ "message" => $token['error'], "data" => "", "status" => "danger" ]);
        }
        if (empty($token['id'])) {
            $request->session()->flash('danger', 'Pago incorrecto.');
            return response()->json([ "message" => "No se genero el token id", "data" => "", "status" => "danger" ]);
        }

        $total = $request["price"];
        if($request["fee"]){
            $fee = $request["price"] * 0.025;
            $total = $fee + $request["price"];
        }

        $data = [
            'name' => $request["fullName"],
            "total" => $total,
            "subscription" => $request["frequency"] == "month" ? "Se realizara el cargo por valor ". $total . " cada vez empezando desde hoy" : "",
            "dedication" => $request["dedication"] ? "Con dedicatoria para ". $request["nameDedication"]. ", gracias por tu donación!" : ""
        ];

        if($request["frequency"] == "month"){
            $charge = $this->createSubscription($token["id"], $request,  $total);
            if (!empty($charge) && empty($charge['error']) && $charge['status'] == 'active') {

                $mail = new MailSend($data);
                Mail::to($request["email"])->send($mail);
                return response()->json([ "message" => "Subscrición exitosa", "data" => $charge, "status" => "success" ]);
            } else {
                return response()->json([ "message" => "No se pudo completar la subscripción " . $charge['error'], "data" => "", "status" => "danger" ]);
            }
        }else{
            $charge = $this->createCharge($token['id'], $total, $request["support"]);
            if (!empty($charge) && empty($charge['error']) && $charge['status'] == 'succeeded') {

                $mail = new MailSend($data);
                Mail::to($request["email"])->send($mail);
                return response()->json([ "message" => "Pago exitoso", "data" => $charge, "status" => "success" ]);
            } else {
                return response()->json([ "message" => "No se pudo completar el pago " . $charge['error'], "data" => "", "status" => "danger" ]);
            }
        }
        
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount, $description)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => $description
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    private function createSubscription ($token, $request, $total)
    {
        $charge = null;
        try {
            $customer = $this->stripe->customers->create([
                "name" => $request["fullName"],
                "email" => $request["email"],
                "source" => $token
            ]);
            $customer_id = $customer->id;

            $product = $this->stripe->products->create([
                "name" => "Donación ". $request["fullName"] . " - " . $total,
                "id"   => date("YmdHms"),
                "active" => true
            ]);
            $product_id = $product->id;
        
            $price = $this->stripe->prices->create([
                "unit_amount" => $total * 100,
                "currency" => "usd",
                "recurring" => ["interval" => "month"],
                "product" => $product_id,
            ]);
            $price_id = $price->id;
        
            $charge = $this->stripe->subscriptions->create([
                "customer" => $customer_id,
                "items" => [
                    ["price" => $price_id],
                ],
                "metadata" => [
                "start_date" => date("d-m-Y"),
                "total_months" => "12",
                "end_date" => date('Y-m-d', strtotime('+1 year'))
                ]
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }

        return $charge;
    }
}