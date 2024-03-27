
@extends('layouts.admin')
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
                <label class="profile-view-label">Detai,</label>
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
