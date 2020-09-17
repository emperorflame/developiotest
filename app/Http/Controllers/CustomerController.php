<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = $this->getCustomers($request);
        return view('customers',[
            'customers' => $customers
        ]);
    }

    public function getCustomers (Request $request)
    {
        return Customer::with('tickets')->orderBy('name')->get()->toArray();
    }
}
