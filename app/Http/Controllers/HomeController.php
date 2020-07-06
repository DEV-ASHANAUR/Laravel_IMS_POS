<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\Customer;
use App\Model\Payment;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $data['count_pur'] = Purchase::all()->count();
        $data['count_cus'] = Customer::all()->count();
        $data['count_sale'] = Invoice::where('status','1')->count();
        $data['count_due'] = Payment::sum('due_amount');
        
        return view('backend.layouts.home',$data);
    }
}
