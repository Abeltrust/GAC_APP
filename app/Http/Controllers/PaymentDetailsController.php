<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $paymentDetail = PaymentDetails::paginate(3);'paymentDetail',
        $pageTitle ='Payment';
       return view('admin.paymentDetails',compact('pageTitle'));
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $details = new  PaymentDetails();
       
    }


    public function show(PaymentDetails $paymentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentDetails $paymentDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentDetails $paymentDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentDetails $paymentDetails)
    {
        //
    }
}
