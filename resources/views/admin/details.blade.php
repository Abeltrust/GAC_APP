{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.admin')

<script>
    // $(document).ready(function() {
    //     var max_fields      = 10; //maximum input boxes allowed
    //     var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    //     var add_button      = $(".add_field_button"); //Add button ID
    
    //     var x = 1; //initlal text box count
        
        
    // $(add_button).click(function(e){ //on add input button click
    //         e.preventDefault();
    //         if(x < max_fields){ //max input box allowed
    //             //text box increment
    //         $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
    //         x++; 
    //     }
    // });
    
    //     // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        
    //     //     e.preventDefault(); 
    //     //     $(this).parent('div').remove(); 
    //     //     x--;
    //     // })
    // });
</script>
@section('content')

<div class="container mt-5 px-4 px-md-0">
    

    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="table-title-2">Adetomiwa Adeleke</h2>
            <div class="gap-3 w-50 d-flex justify-content-end">
                
               <button class="btn btn-primary-outline-color" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
               <button class="btn btn-primary-outline-color">Delete</button>
               <button class="btn btn-primary">Send message</button>
            </div>
        </div>

        <div class="row mb-5">
            

            <div class="col-md-2">
                <label class="profile-view-label">SCN</label>
                <div class="profile-value-label">367829101</div>
            </div>

            <div class="col-md-2">
                <label class="profile-view-label ">PHONE NUMBER</label>
                <div class="profile-value-label">N10,000</div>
            </div>

            <div class="col-md-2">
                <label class="profile-view-label text-uppercase">Email</label>
                <div class="profile-value-label">24 Apr 2022</div>
            </div>

            <div class="col-md-2">
                <label class="profile-view-label text-uppercase">Year of call</label>
                <div class="profile-value-label">1 - 4 years</div>
            </div>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">SCN/Email/Phone number</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td >Akinfemi Olawale</td>
                    <td>2734808291</td>
                    <td>N8,250</td>
                    <td>
                        <span class="badge bg-success-badge py-2 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                            Successful
                        </span>
                    </td>
                    <td>
                        <button class=" btn-view px-4" data-bs-toggle="modal" data-bs-target="#viewPaymentDetailsModal" > View</button>
                    </td>
                  </tr>

                  <tr>
                    <td >Akinfemi Olawale</td>
                    <td>2734808291</td>
                    <td>N8,250</td>
                    <td>
                        <span class="badge bg-success-badge py-2 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                            Successful
                        </span>
                    </td>
                    <td>
                        <button class=" btn-view px-4"> View</button>
                    </td>
                  </tr>

                  <tr>
                    <td >Akinfemi Olawale</td>
                    <td>2734808291</td>
                    <td>N8,250</td>
                    <td>
                        <span class="badge bg-success-badge py-2 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                            Successful
                        </span>
                    </td>
                    <td>
                        <button class=" btn-view px-4"> View</button>
                    </td>
                  </tr>
    
                  
                  
                </tbody>
            </table>
        </div>
    </div>

</div>
@include('admin.modals')
@endsection
