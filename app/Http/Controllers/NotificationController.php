<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userd= Auth::user();
        $message =null;
        $year = (date('Y') - $userd->yearOfCallToBar);
        if($userd->role == 'Bencher' || $userd->role == 'SAN'){
            $message = Message::where('recipant','SAN & Benchers')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }else if($year >=20 && ($userd->role != 'Bencher' || $userd->role != 'SAN') ){
            $message = Message::where('recipant','20 years & above')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }else if($year >=15 && $year <= 19){
            $message = Message::where('recipant','15 - 19 years')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }else if($year <=14 && $year >=10){
            $message = Message::where('recipant','10 - 14 years')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }else if($year >=5 && $year <=9){
            $message = Message::where('recipant','5 - 9 years')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }else if($year >=1 && $year <=4){
            $message = Message::where('recipant','1 - 4 years')->orWhere('recipant','all')->orWhere('recipant',auth()->user()->scn)->orderBy('created_at','desc')->get();
        }

        return view('members.notification',compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function viewMessage($id)
    {

        $message = Message::where('id',$id)->first();
        // return $message;
        return view('members.view-message',compact('message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function pagination(Request $request){
        $message = Message::latest()->paginate(5);
        $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
        ->get();

        $data=json_decode($result);
        $firstThreeLines = $data[0]->first_three_lines;
        return view('members.notification_pagination',compact('message','firstThreeLines'))->render();
    }

    public function searchNotification(Request $request){


        $userd= Auth::user();
        $message =null;
        $year = (date('Y') - $userd->yearOfCallToBar);
        if($userd->role == 'Bencher' || $userd->role == 'SAN'){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','SAN & Benchers')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }else if($year >=20 && ($userd->role != 'Bencher' || $userd->role != 'SAN') ){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','20 years & above')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }else if($year >=15 && $year <= 19){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','15 - 19 years')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }else if($year <=14 && $year >=10){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','10 - 14 years')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }else if($year >=5 && $year <=9){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','5 - 9 years')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }else if($year >=1 && $year <=4){
            $message = Message::where('subject','like','%'.$request->search_string.'%')
            ->where('recipant','1 - 4 years')->orderBy('created_at','desc')->get();
            $result = Message::select(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(message, '\n', 3), '\n', -1) AS first_three_lines"))
            ->get();
        }
      


        $data=json_decode($result);
        $firstThreeLines = $data[0]->first_three_lines;
        if($message->count()>=1){
            return view('members.notification_pagination',compact('message','firstThreeLines'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        }
     }
}
