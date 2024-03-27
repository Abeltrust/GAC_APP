@extends('layouts.admin')
<script type="text/javascript" defer>
    document.addEventListener("DOMContentLoaded", function() {
        $('.btn-info-view').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        async: false,
        url: '/fdetail/'+id,
        success: function(response) {
            $('.amount').text(response.amount);
            $('.transaction_date').text(response.amount);
            $('.scn').text(response.applied_by);
            $('.yearOfCall').text(response.yoc);
            $('.transaction_id').text(response.last_deduction);
            $('.transaction_date').text(response.transaction_date);
        //    if (response.status ==='successful') {
        //     document.querySelector('.statusSuccess').style.display = 'block';       
        //    }else if(response.status ==='pending'){
        //     document.querySelector('.statusPending').style.display ='block'; 
        //    } else{
        //     document.querySelector('.statusDecline').style.display ='block'; 
        //    }
        },
        error: function(response) {
            alert(response.responseText);
        }
    });
    $('.viewPaymentDetailsModal').modal('show');
});

});
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


@section('content')
<div class="container mt-5 px-4 px-md-0">
<div class="row">
  @if(auth()->user()->role==='user')
  
    <div class="col-md-12">
        <div class="row">
            <div class="mt-2">
                    <button type="button" class="btn btn-primary btn-py w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Apply for Loan
                    </button>
                </div>
        </div>
    </div>
  @endif
   @if(auth()->user()->role =='admin')
        <div class="col-md-6">
          <div class="row gap-2">
                <div class="col-md-5 card-dashboard">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>{{number_format($users)}}</h6>"
                    >{{number_format($users)}}</span>
                    <p>Total number of members</p>
                </div>
                <div class="col-md-5 card-dashboard">
                    <span 
                        class="larg-number text-success" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format(0) }}</h6>">
                        &#8358;{{ number_format(0) }}
                    </span>
                    <p> Total amount Deducted</p>
                </div>
            </div>
        </div>
       
        
        <div class="col-md-6  ">
        <div class="row gap-2">

        <div class="col-md-12 card-dashboard">
                    <span 
                        class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format($total) }}</h6>">
                        &#8358;{{ number_format($total) }}
                    </span>
                    <p>Total amount genarated</p>
                </div>
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
                                @if($r->status ==='approved')
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
                               <button class="btn btn-view btnpaymentView"  type="button" data-bs-toggle="modal"  data-id="{{$r -> id}}"> View details</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                             
                             @foreach($finance as $f)
                               <tr>
                                   <td>{{$f->description}}</td>
                                   <td>{{$f->applied_by}}</td>
                                   <td>&#8358;{{ number_format($f->amount)}}</td>
                                   <td>
                                   @if($f->status ==='approved')
                                   <span class="badge bg-success-badge py-2 px-3">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                       Approved
                                   </span>
                               @elseif($f->status ==='pending')
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
                                   <button class="btn btn-view btnpaymentView"  type="button" data-bs-toggle="modal"  data-id="{{$r -> id}}"> View details</button>
                                    <a class="btn btn-peimary bg-success text-light" href="{{route('approve',$f -> id)}}" type="button" > Approve</a>
                                      <a class="btn btn-view bg-danger text-light" href="{{route('decline',$f -> id)}}"  type="button" > Decline</a>
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
                                @if($rp->status ==='approved')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved {{$r->status}}
                                    </span>
                                    <a class="btn btn-view " href="{{route('members.profile'.user->id)}}"  type="button" > View profile</a>
                                @elseif($rp->status ==='pending')
                                    <span class="badge bg-warning-badge bg-warning py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Pending
                                    </span>
                                    <a class="btn btn-view " href="{{route('members.profile')}}"  type="button" > View profile</a>
                                @else
                                <span class="badge bg-danger-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Decline
                                    </span>
                                @endif
                            </td>
                             <td>
                               @if(auth()->user()-> role==='admin')
                               <button class="btn btn-view btnpaymentView"  type="button" data-bs-toggle="modal"  data-id="{{$r -> id}}"> View details</button>
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
                                @if($rD->status ==='approved')
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
                               <button class="btn btn-view btnpaymentView"  type="button" data-bs-toggle="modal"  data-id="{{$r -> id}}"> View details</button>
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
    @if (!$requestPA->isEmpty() || !$finance->isEmpty())
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
                                @if($rpA->status ==='approved')
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
                               <button class="btn btn-view btnrdetails" data-id="{{$rpA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#requisitionDetails" > View</button>
                               <a class="btn btn-view bg-success text-light" href="{{route('approve',$rpA -> id)}}" type="button" > Approve</a>
                               <a class="btn btn-view bg-danger text-light" href="{{route('decline',$rpA -> id)}}" type="button" > Decline</a>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                             
                              @foreach($finance as $f)
                                <tr>
                                    <td>{{$f->description}}</td>
                                    <td>{{$f->applied_by}}</td>
                                    <td>&#8358;{{ number_format($f->amount)}} </td>
                                    <td>
                                    @if($f->status ==='approved')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Approved
                                    </span>
                                @elseif($f->status ==='pending')
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
                                       <button class="btn btn-view btnfdetails" data-id="{{$f -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#requisitionDetails" > View</button>
                                       <a class="btn btn-view bg-success text-light" href="{{route('fapprove', $f -> id)}}" type="button" > Approve</a>
                                       <a class="btn btn-view bg-danger text-light" href="{{route('decline',$f -> id)}}" type="button" > Decline</a>
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
                                @if($rA->status ==='approved')
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
                               <button class="btn btn-view btn-info-view" data-id="{{$rA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#requisitionDetails" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach
                             
                             @foreach($financeApproved as $fa)
                               <tr>
                                   <td>{{$fa->description}}</td>
                                   <td>{{$fa->applied_by}}</td>
                                   <td>&#8358;{{ number_format($fa->amount)}}</td>
                                   <td>
                                   @if($fa->status ==='approved')
                                   <span class="badge bg-success-badge py-2 px-3">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                       Approved
                                   </span>
                               @elseif($fa->status ==='pending')
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
                                   <button class="btn btn-view btn-info-view"  type="button" data-bs-toggle="modal"  data-id="{{$rA -> id}}"> View details</button>
                              
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
                                @if($rDA->status ==='approved')
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
                               <button class="btn btn-view btnrdetails" data-id="{{$rDA -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#requisitionDetails" > View</button>
                               @else
                                -
                               @endif
                             </td>
                            </tr>
                             @endforeach

                             @foreach($finance as $f)
                               <tr>
                                   <td>{{$f->description}}</td>
                                   <td>{{$f->applied_by}}</td>
                                   <td>&#8358;{{ number_format($f->amount)}}</td>
                                   <td>
                                   @if($f->status ==='approved')
                                   <span class="badge bg-success-badge py-2 px-3">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                       Approved
                                   </span>
                               @elseif($f->status ==='pending')
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
                                   <button class="btn btn-view btnpaymentView"  type="button" data-bs-toggle="modal"  data-id="{{$f -> id}}"> View details</button>
                                      <a class="btn btn-view bg-success text-light" href="{{route('fapprove',$f -> id)}}" type="button" > Approve</a>
                                      <a class="btn btn-view bg-danger text-light" href="{{route('approve',$rpA -> id)}}" type="button" > Decline</a>
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
</div>
@include('members.modals')
@include('admin.modals')
@endsection