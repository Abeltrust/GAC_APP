<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserApi;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
       
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {  

       
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'scn' => ['string', 'max:255',],
            'address' => ['string', 'max:255'],
            'gender' => ['required','string', 'max:255'],
            'organization' => ['string', 'max:255'],
            'year' => ['string', 'max:255'],
            'phonenumber' => ['required','string', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        
        $phone= $request->phonenumber;
        $email= $request->email;

        // $userCheck = UserApi::where(function($query) use ($phone, $email) {
		// 	$query->where('email',$email)
		// 				->orWhere('phone',$phone);
        //             })->get();

        // return $userCheck;
        $userCheck = UserApi::where('email',$email)->orWhere('phone',$phone)->first();
        // dd($userCheck);
        if(!is_null($userCheck)){
            $user = new User();
            $user -> scn            = $request -> scn;
            $user -> title          = $request ->title;
            $user -> role           = $request ->role;
            $user -> firstname      = $request ->firstname;
            $user -> lastName       = $request ->lastname;
            $user -> middlename     = $request ->middlename;
            $user -> phoneNumber    = $request ->phonenumber;
            $user -> yearOfCallToBar= $request ->year;
            $user -> gender         = $request ->gender;
            $user -> organization   = $request ->organization;
            $user -> address        = $request ->address;
            $user -> email          = $request ->email;
            $user -> password       = Hash::make($request->password);
            $user ->save();
    
            event(new Registered($user));
        
            Auth::login($user);
            toast('Registration Successful! You\'re Welcome..', 'success');
            return redirect(RouteServiceProvider::HOME) ->with('success','Registered Successfully');
        }else{
            toast('User does not exist', 'error')->timerProgressBar();
            return redirect()->route('register');
        }
    }
}
