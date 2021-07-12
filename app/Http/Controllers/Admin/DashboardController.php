<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;

class DashboardController extends Controller
{
    public function index(){
        $customers      = User::count();
        $transaction    = Transaction::sum('total_price') ;
        $revenue        = Transaction::count();
        return view('pages.admin.dashboard',[
            'customers'     => $customers,
            'revenue'       => $revenue,
            'transaction'   => $transaction
        ]);
    }
}
