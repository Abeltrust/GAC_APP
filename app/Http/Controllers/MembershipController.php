<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\setPayment;
use App\Models\PaymentDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userd= Auth::user();
        $payment =null;
        $year = (date('Y') - $userd->yearOfCallToBar);
      


        
        // return  $year;
        
        if($userd->role == 'Bencher' || $userd->role == 'SAN'){
            $payment = setPayment::where('year','SAN & Benchers')->first();
        }else if($year >=20 && ($userd->role != 'Bencher' || $userd->role != 'SAN') ){
            $payment = setPayment::where('year','20 years & above')->first();
        }else if($year >=15 && $year <= 19){
            $payment = setPayment::where('year','15 - 19 years')->first();
        }else if($year <=14 && $year >=10){
            $payment = setPayment::where('year','10 - 14 years')->first();
        }else if($year >=5 && $year <=9){
            $payment = setPayment::where('year','5 - 9 years')->first();
        }else if($year >=1 && $year <=4){
            $payment = setPayment::where('year','1 - 4 years')->first();
        }

        

        // return  $payment;
        
        $paymentDetails = PaymentDetails::where('scn',Auth::user()->scn)->get();
        // return($paymentDetails);
        return view('members.membership',compact('payment','paymentDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function receipt($id)
    {
        $paymentDetails = PaymentDetails::where('scn',Auth::user()->scn)->where('id',$id)->first();
        $pdf=Pdf::loadView('members.receipt',[
            'data'=>$paymentDetails,
        ])
        ->setPaper('a4', 'portrait')->setWarnings(false);
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
        // return $pdf->download('report.pdf');
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
