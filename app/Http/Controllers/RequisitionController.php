<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $requisition = new Requisition();
        $requisition -> item =$request -> Item;
        $requisition -> quantity =$request -> quantity;
        $requisition -> unitPrice =$request -> unit_price;
        $requisition -> total =$request -> amount;
        $requisition -> status ='pending';
        $requisition -> applied_by = auth()->user()->email;
        $requisition -> approved_by = '';
        $requisition -> deduct_monthly = $request->deduct_monthly;
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

  
    public function deduct($id)
    {
        $request = Requisition::find($id);
    $ballance = $request -> total - $request -> deduct_monthly;
    $request -> total =  $ballance;
    $request ->update();
    toast('Deducted successfully!', 'success')->timerProgressBar();
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
