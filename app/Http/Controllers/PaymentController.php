<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\PaymentDetails;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $users = User::with([
            'paymentDetails'
            ])->where('role','!=','admin')->get();
        $scnValues = User::where('role','!=','admin')->select('scn')->get();
        // $paymentDetails = PaymentDetails::all();
       return view('admin.payment',compact('users','scnValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view($id)
    {
        $user = User::find($id);
            if ($user) {
                $scn = $user->scn;
                $paymentDetails = PaymentDetails::where('scn', $scn)->first();
                if ($paymentDetails) {
                    return response()->json(['user' => $user, 'paymentDetails' => $paymentDetails]);
                }else{
                    return redirect()->back();
                }
            }
       
    }

    public function pagination(Request $request){
        $users =  PaymentDetails::all()->paginate(5);
        return view('admin.payment_pagination',compact('users'))->render();
    }
    public function paymentSearch(Request $request){
        $users = User::where('scn',$request->search_string)->orderBy('created_at','desc');
        if($users->count()>=1){
            return view('admin.payment_pagination',compact('users'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        } 
}

public function verify(Request $request){
    $flw = new \Flutterwave\Rave('FLWSECK_TEST-2fb000d62842bc80c7da4e350c4abd02-X'); // Set `PUBLIC_KEY` as an environment variable
    $transactions = new \Flutterwave\Transactions();
    $response = $transactions->verifyTransaction(['id' => $request->transaction_id]);
    if (
        $response['data']['status'] === "successful"
        && $response['data']['amount'] === $request->amount
        && $response['data']['currency'] === 'NGN') {
        // Success! Confirm the customer's payment
    } else {
        // Inform the customer their payment was unsuccessful
    }
}
// public function print(Request $request){
//     $scn = $request -> scn;
//     $data= PaymentDetails::where('scn',$scn);
//     dd($data);
//     return $data;
// }
}