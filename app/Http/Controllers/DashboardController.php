<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('product', function($product){
        $product->where('users_id', Auth::user()->id);
        });
        $revenue = $transactions->get()->reduce(function($carry, $item){
            return $carry+$item->price;
        });

        $customer = User::count();

        // dd($transactions->get());
        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data'  => $transactions->get(),
            'revenue'           => $revenue,
            'customer'          => $customer
        ]);
    }
}
