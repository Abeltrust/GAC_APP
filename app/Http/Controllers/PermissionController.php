<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
   
   
        public function store(Request $request)
   {
       $scn = $request->scn;
       
       $exixstingdata =  Permission::where('scn',$scn)->first();
       if($exixstingdata){
       $permission = Permission::where('scn',$scn)->first();
       $permission->message = $request->has('message');
       $permission->payment = $request->has('payment');
       $permission->edit = $request->has('edit');
       $permission->delete = $request->has('delete');
       $permission->update();
       toast('Permission updated successfully.', 'success')->timerProgressBar();
       return redirect()->back();
       }else{
        $permission = new Permission();
        $permission->scn = $request->scn;
        $permission->message = $request->has('message');
        $permission->payment = $request->has('payment');
        $permission->edit = $request->has('edit');
        $permission->delete = $request->has('delete');
        $permission->save();
        toast('Permission saved successfully.', 'success')->timerProgressBar();
        return redirect()->back();
    }

    }

    /**
     * Display the specified resource.
     */
    public function edit($scn)
    {
        $permission = Permission::where('scn',$scn)->first();
        return $permission;
        if ($permission) {
            return $permission; //response()->json($paymentDetails);
        }else{
            $response = 'empty';
            return $response;
        }
    }


   
    public function destroy(Request $request)
    {
        $scn = $request -> scnd;
        $permission = Permission::where('scn',$scn)->first();
        $permission->delete();
        toast( 'Permission deleted successfully.','success');
        return redirect()->back();
  }
    
}
