<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $finance = new finance();
        $finance -> applied_by= auth()->user()->email;
        $finance -> approved_by= '';
        $finance -> status='pending';
        $finance -> description = $request->description;
        $finance -> amount = $request->amount;
        $finance -> deduct_monthly = $request->deduct_monthly;
        $finance -> save();
        toast('Application send successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(finance $finance)
    {
        //
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
