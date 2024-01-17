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
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
