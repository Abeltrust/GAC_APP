<?php

namespace App\Http\Controllers;

use App\Models\UserApi;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;
class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function import()
    {

        $import=new UsersImport();
        Excel::import($import,request()->file('file'));
        toast('Uploaded Successfully!!','success');
        // Alert::success('Success Title', 'Uploaded Successfully!!');
        // alert()->success('SuccessAlert','Uploaded Successfully!!');

        return  redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserApi $userApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserApi $userApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserApi $userApi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserApi $userApi)
    {
        //
    }
}
