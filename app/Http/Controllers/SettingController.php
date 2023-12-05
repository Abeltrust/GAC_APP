<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with([
            'permission'
            ])->where('role','!=','admin')->paginate(10);
        // $permission = Permission::all();

        // return $users;
        return view('admin.settings',compact('users'));
    }

    
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $val=User::where('scn',Auth::user()->scn)->update(['password'=> Hash::make($request->new_password)]);
        toast('Password change successfully','success');
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function pagination(Request $request){
        $users = User::latest()->paginate(5);
        $permission = Permission::all();
        return view('admin.settings_pagination',compact('users','permission'))->render();
    }

    public function searchSettings(Request $request){
        // $permission = Permission::all();
        $users=[];
        if($request->search_string !=''){
            $users = User::with([
                'permission'
                ])
                ->where('firstName','like','%'.$request->search_string.'%')
                // ->orWhere('role','!=','admin')
                ->orWhere('lastName','like','%'.$request->search_string.'%')->orderBy('created_at','desc')->get();
        }else{
            $users = User::with([
                'permission'
                ])
                ->where('role','!=','admin')
                ->orderBy('created_at','desc')->get();
        }
        // $users = User::where('firstName','like','%'.$request->search_string.'%')
        // ->orWhere('lastName','like','%'.$request->search_string.'%')->orderBy('created_at','desc')->paginate(5);

        if($users->count()>=1){
            return view('admin.settings_pagination',compact('users'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
