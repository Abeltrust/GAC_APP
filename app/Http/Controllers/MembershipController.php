<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\setPayment;
use App\Models\PaymentDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userd= Auth::user();
        $data = Requisition::where('applied_by',auth()->user()->email);
        $payment =null;
        $user =User::where('email','Auth::user()->email');
        // $paymentDetails = PaymentDetails::where('scn',Auth::user()->scn)->get();
        // // return($paymentDetails);
        return view('members.membership',compact('data','user'));
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

}
