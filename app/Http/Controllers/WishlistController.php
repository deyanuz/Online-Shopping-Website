<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class WishlistController extends Controller
{
    function index(Request $request){
        return view("frontend.wishlist");
    }
    public function remove($id)
    {
        $cartItem = Cart::instance('wishlist')->content()->where('id', $id)->first();
        $rowId = $cartItem->rowId;
        if ($rowId) {
            Cart::instance('wishlist')->remove($rowId);
        }

        return redirect()->route('frontend.wishlist');
    }
}
