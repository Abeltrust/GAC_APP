<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = Message::latest()->paginate(5);
        return view('admin.messages',compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('admin.create-messages');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         
        $request -> validate([
            
            'recipient'=>['required','string'],
            'subject'=>['required','string'],
            'message'=>['required'],
        ]);
            $message = new Message();
            $message -> sender       = Auth::user()->lastName.' '.Auth::user()->middlename.' '.Auth::user()->firstName;
            $message -> recipant     = $request ->recipient;
            $message -> subject      = $request ->subject;
            $message -> message      = $request ->message;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time().$this->random_strings(6) . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/messages'), $filename);
                $message -> fileName = $request->file('file')->getClientOriginalName() ;    
                $message -> filedirname = $filename;    
            }
            $message -> save();
            toast('Messege send successfully!!','success');
            return redirect('messages')->with('success', 'Messege send successfully.');

    }

    function random_strings($length_of_string)
    {
    
        // String of all alphanumeric character
        $str_result = '123456789ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz';
    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
                        0, $length_of_string);
    }

    public function pagination(Request $request){
        $message = Message::latest()->paginate(5);
        return view('admin.message_pagination',compact('message'))->render();
    }

    public function searchMessage(Request $request){
        $message = Message::where('subject','like','%'.$request->search_string.'%')
        ->orWhere('recipant','like','%'.$request->search_string.'%')->orderBy('created_at','desc');

        if($message->count()>=1){
            return view('admin.message_pagination',compact('message'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
