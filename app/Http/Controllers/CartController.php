<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
class CartController extends Controller
{
     public function index()
    {
        $cart = Cart::with(['product.galleries','user'])->where('users_id',Auth::user()->id)->get();
        return view('pages.cart',[
            'carts' => $cart
        ]);
    }

    public function delete(Request $request, $id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart');   
    }


    public function success(){
        return view('pages.success');
    }
}
