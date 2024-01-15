<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requisition;
use App\Models\PaymentDetails;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','!=','admin')->paginate(5);
       //// $scnValues = User::where('role','!=','admin')->select('staffID')->get();
        $data =Requisition::where('applied_by',auth()->user()->email);
        $pageTitle ='Members';

        // return $scnValues;
       return view('admin.members',compact('users','pageTitle'));
    }
  
    public function pagination(Request $request){
        $users = User::where('role','!=','admin')->paginate(5);
        return view('admin.member_pagination',compact('users'))->render();
    }

    public function searchMembers(Request $request){
        $users = User::where('staffId',$request->search_string)->orderBy('created_at','desc');
        if($users->count()>=1){
            return view('admin.member_pagination',compact('users'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        }

    }

    public function viewProfile($id)
    {
        $user = User::find($id);
        $data = Requisition::where('applied_by',auth()->user()->email);
        $paymentDetails = PaymentDetails::all();
        
        
        return view('admin.member-profile',compact('user','data'));
    }
    
    public function edit( $member)
    {
        $user = User::find($member);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request -> user_update_id;
        $user = User::find($id);
        
            $user -> scn            = $request -> scn;
            //$user -> title          = $request ->title;
            //$user -> role           = $request ->role;
            $user -> firstname      = $request ->firstname;
            $user -> lastName       = $request ->lastname;
            $user -> middlename     = $request ->middlename;
            $user -> phoneNumber    = $request ->phonenumber;
            $user -> yearOfCallToBar= $request ->yearOFCall;
            //$user -> gender         = $request ->gender;
            //$user -> organization   = $request ->organization;
            //$user -> address        = $request ->address;
            $user -> email          = $request ->email;
           // $user -> password       = Hash::make($request->password);
            $user ->update();
            toast( 'User updated successfully.','success');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request -> user_id;
        $user = User::find($id);
        $user -> delete();
        toast( 'User deleted successfully.','success');
        return redirect('admin.members');
    }
}
