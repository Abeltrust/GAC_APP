<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentDetails;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    
    public function store(Request $request)
    {
       // dd($request->all());

        $amount =$request->amount;
        $tenpercent = $amount * 0.1;
        $totalaAmount = $amount + $tenpercent;
        $finance = new finance();
        $finance -> applied_by= auth()->user()->email;
        $finance -> approved_by= '';
        $finance -> status='pending';
        $finance -> description = $request->description;
        $finance -> amount = $totalaAmount;
        $finance -> deduct_monthly = $request->deduct_monthly;
        $finance -> start_month  = $request->start_monthly;
        $finance -> last_deduction = now();
        $finance -> save();
        toast('Application send successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function approve($id)
    {
        $finance = finance::find($id);
        $finance -> status ='approved';
        $finance -> approved_by = auth()->user()->email;
        $finance ->update();

        toast('Application Approved successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function decline($id)
    {
        $finance = finance::find($id);
        $finance -> status ='decline';
        $finance -> approved_by = auth()->user()->email;
        $finance ->update();

        toast('Application Declined successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function details($id)
    {
        $finance = finance::find($id)->first();
         //dd($finance);
        return $finance ;
    }
    public function deduct( $id)
    {
        $finance = finance::find($id);
        
        if($finance -> amount >= $finance -> deduct_monthly){
        $ballance = $finance -> amount - $finance -> deduct_monthly;
        $finance -> amount =  $ballance;
        $finance -> last_deduction = now();
        $finance -> update();
        $details = new PaymentDetails();
        $details -> name    =   $finance -> description;
        $details -> email   =   $finance -> applied_by;
        $details -> staffId =   $finance -> applied_by;
        $details -> count   =   $ballance;
        $details -> amount  =   $finance -> deduct_monthly;
        $details ->save();
        toast('Deducted successfully!', 'success')->timerProgressBar();
        return redirect()->back();
        }elseif($finance->amount > 0 && $finance -> amount <= $finance -> deduct_monthly){
            $finance -> amount =  0;
            $finance -> status =  paid;
            $finance -> last_deduction = now();
            $finance -> update();
            $details = new PaymentDetails();
            $details -> name    =   $finance -> description;
            $details -> email   =   $finance -> applied_by;
            $details -> staffId =   $finance -> applied_by;
            $details -> count   =   $finance -> amount;
            $details -> amount  =   $finance -> deduct_monthly;
            $details ->save();
            toast('Deducted successfully!', 'success')->timerProgressBar();
            return redirect()->back();
        }
    else{
        toast('Sorry cannot deduct!', 'error')->timerProgressBar();
            return redirect()->back();
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(finance $finance)
    {
        //
    }
}
