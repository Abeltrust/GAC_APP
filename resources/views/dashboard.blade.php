@extends('layouts.admin')
@section('content')
<div class="container mt-5 px-4 px-md-0">
<div class="row">
  @if(auth()->user()->role==='user')
  
    <div class="col-md-12">
        <div class="row">
            <div class="mt-2">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Apply for Loan
                    </button>
                </div>
        </div>
    </div>
  @endif
   @if(auth()->user()->role =='admin')
        <div class="col-md-6">
          <div class="row gap-4">
                <div class="col-md-5 card-dashboard">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6></h6>"
                    >1</span>
                    <p>Total number of members</p>
                </div>
                <div class="col-md-5 card-dashboard">
                    <span 
                        class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format($total) }}</h6>">
                        &#8358;{{ number_format($total) }}
                    </span>
                    <p>Total amount generated</p>
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
       @endif
       @if(auth()->user()->role =='user')
       @if (!$request->isEmpty())
        <div class="row mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Approved Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($request as $r )
                    <tr>
                            <td >{{$r -> item}}</td>
                            <td>
                                    {{ $r->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($r->total) }}
                            </td> 
                            <td>
                                @if($r->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($r->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$r -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                </tbody>
            </table>
        </div>
     </div>
     @endif
     @if (!$requestP ->isEmpty())
     <div class="row mt-4">
     <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Pending Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requestP as $rp )
                    <tr>
                            <td >{{$rp -> item}}</td>
                            <td>
                                    {{ $rp->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($rp->total) }}
                            </td> 
                            <td>
                                @if($rp->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($rp->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$r -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                </tbody>
            </table>
        </div>
     </div>
     @endif
     @if (!$requestD->isEmpty())
     <div class="row mt-4">
     <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Declined Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requestD as $rD )
                    <tr>
                            <td >{{$rD -> item}}</td>
                            <td>
                                    {{ $rD->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($rD->total) }}
                            </td> 
                            <td>
                                @if($rD->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($rD->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$r -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                        
                </tbody>
            </table>
        </div>
     </div>
     @endif
    @endif
    @if(auth()->user()->role==='admin')
    @if (!$requestA->isEmpty())
    <div class="row mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Approved Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requestA as $rA )
                    <tr>
                            <td >{{$rA -> item}}</td>
                            <td>
                                    {{ $rA->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($rA->total) }}
                            </td> 
                            <td>
                                @if($rA->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($rA->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$rA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                </tbody>
            </table>
        </div>
     </div>
     @endif
     @if (!$requestPA->isEmpty())
     <div class="row mt-4">
     <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Pending Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requestPA as $rpA )
                    <tr>
                            <td >{{$rpA -> item}}</td>
                            <td>
                                    {{ $rpA->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($rpA->total) }}
                            </td> 
                            <td>
                                @if($rpA->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($rpA->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$rpA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                </tbody>
            </table>
        </div>
     </div>
     @endif
     @if (!$requestDA->isEmpty())
     <div class="row mt-4">
     <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Declined Request</h2>
            <a href="{{route('payments')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requestD as $rDA )
                    <tr>
                            <td >{{$rDA -> item}}</td>
                            <td>
                                    {{ $rDA->applied_by }}
                            </td>
                            <td>
                                &#8358;{{ number_format($rDA->total) }}
                            </td> 
                            <td>
                                @if($rDA->status ==='Approve')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($rDA->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView" data-id="{{$rDA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                </tbody>
            </table>
        </div>
     </div>        
    @endif
    <div class="row mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Members</h2>
            <a href="{{route('members')}}" class="a-view-all">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/></svg>
            </a>
        </div>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Name</th>
                    <th class=" h-table">Phone Number</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Department</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                @if (!is_null($users))
               
                @foreach($users as $user)
                  <tr>
                    <td >{{$user -> name}}</td>
                    <td>{{$user -> phoneNumber}}</td>
                    <td>
                        {{$user -> email}}
                    </td>
                    <td>
                        {{$user -> Department}}
                    </td>
                    <td>
                       <a class="btn btn-view " href="{{route('members.profile',$user -> id)}}"  type="button" > View profile</a>
                    </td>
                 </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="6" class="text-center">No Members</td>
                   </tr>
                @endif
                </tbody>
            </table>
         
        </div>
    </div>
    @endif
</div>
@include('members.modal')
@include('admin.modals')
@endsection