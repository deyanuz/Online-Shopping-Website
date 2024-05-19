<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;
use Exception;
use UnexpectedValueException;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view("frontend.checkout", ["cartItems" => $cartItems]);
    }
    public function payment()
    {
        if(!Auth::check()){
            return redirect()->route('auth.login');
        }
        Stripe::setApiKey('sk_test_51PBkIVLaUcADbFrFT4lclsHZeyOFQDH5CDbFmI6aOFQwEPdU5Nt74cvT5oWaGSwwwL8N9ccwrN51tKkSdb8HwAwK003qGNHjgQ');

        $products = Cart::instance('cart')->content();
        $lineItems = [];
        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $product->qty,
            ];
        }
        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = Cart::instance('cart')->total();
        $order->session_id = $session->id;
        $order->user_id = Auth::user()->id;
        $order->save();

        return redirect($session->url);
    }
    public function success(Request $request)
    {
        Stripe::setApiKey('sk_test_51PBkIVLaUcADbFrFT4lclsHZeyOFQDH5CDbFmI6aOFQwEPdU5Nt74cvT5oWaGSwwwL8N9ccwrN51tKkSdb8HwAwK003qGNHjgQ');
        $sessionId = $request->get('session_id');

        try {
            $session = Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('session_id', $session->id)->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }

            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            Cart::instance('cart')->destroy();
            return redirect()->route("frontend.shop")->with('success', 'Order Successful');
        } catch (Exception $e) {
            throw new NotFoundHttpException();
        }
    }
    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_9830bb03a415280492719cb1494da488d16412d4f815e7d5242a904925180848';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    Cart::instance('cart')->destroy();
                    $order->status = 'paid';
                    $order->save();

                }
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
