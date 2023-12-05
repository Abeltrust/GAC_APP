<?php

namespace App\Http\Controllers;

use App\Models\setPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetPaymentController extends Controller
{
   
    public function store(Request $request)
    {
        

        
        $paymentData = [];

        // return $request->yearOfCallToBar;
        if(!is_null($request->yearOfCallToBar)){

            foreach ($request->yearOfCallToBar as $key =>$yearOfCallToBar ) {
    
                // return $yearOfCallToBar;\
                if($yearOfCallToBar){

                    $paymentCheck = setPayment::where('year',$yearOfCallToBar)->first();
        
                    if($paymentCheck){
                        toast($yearOfCallToBar.' of call already exist','error');
                        // return redirect()->back();
                    }else{
                    $paymentData[] = [
                        'year' => $yearOfCallToBar,
                        'branch' => $request->branch[$key],
                        'idCard' => $request->card[$key],
                        'insurance' => $request->insurance[$key],
                        'total' => $request->total[$key],
                    ];
                }
                }else{
                    toast('One of the column dont have selected year of call ','error');
                }
            }
            
            $payment = new setPayment();
            if($paymentData){
                $res=$payment->insert($paymentData);
        
                if($res){
                    toast('Payment set successfully','success');
                    return redirect()->back();
                }else{
                    toast('Payment not set successfully','error');
                    return redirect()->back();
                }
            }else{
                toast('Payment not set successfully','error');
                // return redirect()->back();
            }
        }
        // toast('Year of call not selected','error');
    
    toast('Year of call not selected','error');
    return redirect()->back();

}

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $payment = setPayment::where('id',$id)->first();
        return $payment;
    }
    public function update(Request $request)
    {
        $year = $request -> yearOFCall;
        $payment = setPayment::where('year',$year)->first();

        $payment ->  year = $year;
        $payment -> branch = $request->branch;
        $payment ->  idCard = $request->card;
        $payment ->  insurance = $request->insurance;
        $payment ->   total = $request->total;
        $payment -> update();
        toast('Payment updated successfully','success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getpayment($id)
    {
        $payment = setPayment::where('id',$id)->first();
        return response()->json($payment);
    }

    public function destroy(Request $request)
    {  
        $id = $request -> payment_id;
        $payment = setPayment::find($id);
        if($payment){
            $payment -> delete();
            toast('Payment deleted successfully','success');
            return redirect()->back();
        }else{
            toast('Payment note deleted ','error');
            return redirect()->back();
        }
    }
}
