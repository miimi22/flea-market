<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function purchase(PurchaseRequest $request)
    {
        $payments = Payment::all();
        return view('purchase', ['payments' => $payments]);
    }

    public function address(AddressRequest $request)
    {
        return view('address');
    }
}
