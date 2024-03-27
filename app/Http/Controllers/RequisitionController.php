<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentDetails;

class RequisitionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amount =$request->amount;
        $tenpercent = $amount * 0.1;
        $totalaAmount = $amount + $tenpercent;
        $requisition = new Requisition();
        $requisition -> item =$request -> Item;
        $requisition -> quantity =$request -> quantity;
        $requisition -> unitPrice =$request -> unit_price;
        $requisition -> total =$totalaAmount;
        $requisition -> status ='pending';
        $requisition -> applied_by = auth()->user()->email;
        $requisition -> approved_by = '';
        $requisition -> last_deduction = now();
        $requisition -> deduct_monthly = $request->deduct_monthly;
        $requisition -> start_month  = $request -> start_monthly;
        $requisition ->save();

        toast('Application send successfully!', 'success')->timerProgressBar();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function approve($id)
    {
        $requisition = Requisition::find($id);
        $requisition -> status ='approved';
        $requisition -> approved_by = auth()->user()->email;
        $requisition ->update();

        toast('Application Approved successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }
    public function decline($id)
    {
        $requisition = Requisition::find($id);
        $requisition -> status ='declined';
        $requisition -> approved_by = auth()->user()->email;
        $requisition ->update();

        toast('Application Declined successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }
    public function details($id)
    {
        $requisition = Requisition::find($id);
    
        return  $requisition;
    }
  
    public function deduct($id)
    {
        $request = Requisition::find($id);
        if($request -> total >= $request -> deduct_monthly){
        $ballance = $request -> total - $request -> deduct_monthly;
        $request -> total =  $ballance;
        $request -> last_deduction = now();
        $request ->update();
        $details = new PaymentDetails();
        $details -> name    =   $request -> item;
        $details -> email   =   $request -> applied_by;
        $details -> staffId =   $request -> applied_by;
        $details -> count   =   $ballance;
        $details -> amount  =   $request -> deduct_monthly;
        $details ->save();
    toast('Deducted successfully!', 'success')->timerProgressBar();
    return redirect()->back();
        }elseif($request->amount > 0 && $request -> amount <= $request -> deduct_monthly){
            $ballance = $request -> total - $request -> deduct_monthly;
            $request -> total = 0;
            $request -> status = paid;
            $request -> last_deduction = now();
            $request ->update();
            $details = new PaymentDetails();
            $details -> name    =   $request -> item;
            $details -> email   =   $request -> applied_by;
            $details -> staffId =   $request -> applied_by;
            $details -> count   =   $request -> total;
            $details -> amount  =   $request -> deduct_monthly;
            $details -> save();
        }else{
            toast('Sorry cannot deduct!', 'error')->timerProgressBar();
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
