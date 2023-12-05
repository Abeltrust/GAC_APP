

@extends('layouts.admin')

<script>
   
</script>
@section('content')

<div class="container mt-5 px-4 px-md-0">
    <div class="row">
        <div class="col-md-6">
            <div class="row gap-4">
                <div class="col-md-5 card-dashboard">
                    <span>156</span>
                    <p>Total number of members</p>
                </div>
                <div class="col-md-5 card-dashboard">
                    <span>N236,000</span>
                    <p>Total number of members</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 gap-4 d-flex justify-content-end align-items-center mt-4 mt-md-0">
            <button class="btn  btn-custom btn-custom-primary-outline" data-bs-toggle="modal" data-bs-target="#setExcelUploadModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.22 20.75H5.78A2.64 2.64 0 0 1 3.25 18v-3a.75.75 0 0 1 1.5 0v3a1.16 1.16 0 0 0 1 1.25h12.47a1.16 1.16 0 0 0 1-1.25v-3a.75.75 0 0 1 1.5 0v3a2.64 2.64 0 0 1-2.5 2.75ZM16 8.75a.74.74 0 0 1-.53-.22L12 5.06L8.53 8.53a.75.75 0 0 1-1.06-1.06l4-4a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06a.74.74 0 0 1-.53.22Z"/><path fill="currentColor" d="M12 15.75a.76.76 0 0 1-.75-.75V4a.75.75 0 0 1 1.5 0v11a.76.76 0 0 1-.75.75Z"/></svg>
                Upload excel sheet
            </button>
            <button class="btn btn-custom btn-custom-primary " data-bs-toggle="modal" data-bs-target="#setPaymentRangeModal">
                Set payment range
            </button>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped-m w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Year</th>
                    <th class=" h-table">Branch dues</th>
                    <th class=" h-table">ID card</th>
                    <th class=" h-table">Insurance</th>
                    <th class=" h-table">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td >2020 - 2023</td>
                    <td>N2,250</td>
                    <td>N1,000</td>
                    <td>N5,000</td>
                    <td>N8,250</td>
                  </tr>
    
                  <tr>
                    <td >2020 - 2023</td>
                    <td>N2,250</td>
                    <td>N1,000</td>
                    <td>N5,000</td>
                    <td>N8,250</td>
                  </tr>
    
                  <tr>
                    <td >2020 - 2023</td>
                    <td>N2,250</td>
                    <td>N1,000</td>
                    <td>N5,000</td>
                    <td>N8,250</td>
                  </tr>
    
    
                  <tr>
                    <td colspan="2" >SAN & Benchers</td>
                    <td>N22,500</td>
                    <td>N1,000</td>
                    <td>N5,000</td>
                    <td>N28,250</td>
                  </tr>
                  
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Payments</h2>
            <a href="" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
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
                            Successful
                        </span>
                    </td>
                    <td>
                        <button class=" btn-view"> View</button>
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
                        <button class=" btn-view"> View</button>
                    </td>
                  </tr>

                  <tr>
                    <td >Akinfemi Olawale</td>
                    <td>2734808291</td>
                    <td>N8,250</td>
                    <td>
                        <span class="badge bg-success-badge py-2 px-3">
                            Successful
                        </span>
                    </td>
                    <td>
                        <button class=" btn-view"> View</button>
                    </td>
                  </tr>
    
                  
                  
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Members</h2>
            <a href="" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">SCN</th>
                    <th class=" h-table">Phone Number</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Year of call</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td >{{$user -> lastName.' '.$user -> lastName}}</td>
                    <td>{{$user -> scn}}</td>
                    <td>{{$user -> phoneNumber}}</td>
                    <td>
                        {{$user -> email}}
                    </td>
                    <td>
                        {{$user -> yearOfCallToBar}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.modals')
@include('admin.paymentModal')
@endsection
