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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNumber' => ['required','string','max:255'],
            'gender' => ['required','string','max:255'],
            'maritalStatus' => ['required','string','max:255'],
            // 'userImage' => ['file','image:jpeg,png,jpg,','max:3072'],
            'staffId' => ['required','string','max:255'],
            'Department' => ['required','string','max:255'],
            'nextOfKinFullName' => ['required','string','max:255'],
            'nextOfKinPhoneNumber' => ['required','string','max:255'],
            'nextOfKinAddress' => ['required','string','max:255']
        ]);

        
        $phone= $request->phonenumber;
        $email= $request->email;
       // dd($file = $request->file('userImage'));
       if ($request->hasFile('userImage')) {
        $file = $request->file('userImage');
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    
        $filePath = $file->storeAs('assets/images', $filename, 'public');
    
        $userCheck = UserApi::where('email',$email)->orWhere('phone',$phone)->first();
        $roleCheck =User::all()->count();
       
        if(is_null($userCheck)){
            if($roleCheck <= 0){
            $user = new User();
            $user -> name           = $request -> name;
            $user -> email          = $request ->email;
            $user -> password       = Hash::make($request->password);
            $user -> userImage      = $filename;
            $user -> maritalStatus  = $request ->maritalStatus;
            $user -> staffId        = $request ->staffId;
            $user -> Department     = $request ->Department;
            $user -> gender         = $request ->gender;
            $user -> phoneNumber    = $request ->phoneNumber;
            $user -> nextOfKinFullName = $request ->nextOfKinFullName;
            $user -> nextOfKinPhoneNumber= $request ->nextOfKinPhoneNumber;
            $user -> nextOfKinAddress   = $request ->nextOfKinAddress;
            $user -> role   = 'admin';
            $user ->save();
            event(new Registered($user));
        
            Auth::login($user);
            toast('Registration Successful! You\'re Welcome..', 'success');
            return redirect('/dashboard') ->with('success','Registered Successfully');
            }else{
                $user = new User();
            $user -> name           = $request -> name;
            $user -> email          = $request ->email;
            $user -> password       = Hash::make($request->password);
            $user -> userImage      = $filename;
            $user -> maritalStatus  = $request ->maritalStatus;
            $user -> staffId        = $request ->staffId;
            $user -> Department     = $request ->Department;
            $user -> gender         = $request ->gender;
            $user -> phoneNumber    = $request ->phoneNumber;
            $user -> nextOfKinFullName = $request ->nextOfKinFullName;
            $user -> nextOfKinPhoneNumber= $request ->nextOfKinPhoneNumber;
            $user -> nextOfKinAddress   = $request ->nextOfKinAddress;
            $user -> role   = 'user';
            $user ->save();

            event(new Registered($user));
        
            Auth::login($user);
            toast('Registration Successful! You\'re Welcome..', 'success');
            return redirect('/profile') ->with('success','Registered Successfully');
            }
            
        }else{
            toast('User already exist', 'error')->timerProgressBar();
            return redirect()->route('register');
        }
    }else{
        toast('No image Uploaded', 'error')->timerProgressBar();
        return redirect()->route('register');
    }
  } 
}
