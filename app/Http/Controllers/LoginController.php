<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function loginUser(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            $cart = DB::table('carts')
                ->where('user_id', Auth::id())
                ->where('type', 'cart')
                ->first();
            $wishlist = DB::table('carts')
                ->where('user_id', Auth::id())
                ->where('type', 'wishlist')
                ->first();

            // If a cart exists, load it into the 'cart' instance
            if ($cart) {
                $cartContent = json_decode($cart->items, true);
                foreach ($cartContent as $item) {
                    Cart::instance('cart')->add($item['id'], $item['name'], $item['qty'], $item['price'])->associate('App\Models\Product');
                }
                DB::table('carts')
                    ->where('user_id', Auth::id())
                    ->where('type', 'cart')
                    ->delete();
            }
            if ($wishlist) {
                $cartContent = json_decode($wishlist->items, true);
                foreach ($cartContent as $item) {
                    Cart::instance('wishlist')->add($item['id'], $item['name'], $item['qty'], $item['price'])->associate('App\Models\Product');
                }
                DB::table('carts')
                    ->where('user_id', Auth::id())
                    ->where('type', 'wishlist')
                    ->delete();
            }
            return redirect('/')->with('success', 'Login Success');
        }

        return back()->with('error', 'Error Email or Password');
    }
    public function logoutUser()
    {
        if (Cart::instance('cart')->count() > 0) {

            // Serialize the cart items into JSON format
            $cartItems = Cart::instance('cart')->content()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ];
            })->toJson();

            DB::table('carts')->insert([
                'user_id' => auth()->id(),
                'items' => $cartItems,
                'type' => 'cart',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        if (Cart::instance('wishlist')->count() > 0) {

            // Serialize the cart items into JSON format
            $cartItems = Cart::instance('wishlist')->content()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ];
            })->toJson();

            DB::table('carts')->insert([
                'user_id' => auth()->id(),
                'items' => $cartItems,
                'type' => 'wishlist',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Cart::instance('cart')->destroy();
        Cart::instance('wishlist')->destroy();
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
