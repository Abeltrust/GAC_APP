
@extends('layouts.admin')
@section('script')
<!-- <style>
    .table th {
        border: none;
        font-weight: ;
    }
</style> -->
@endsection
<script>
     document.addEventListener("DOMContentLoaded", function() {
     $('.editUser').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        async: false,
        url: '/member/edit/'+id,
        success: function(response) {
            
            $('#user_update_id').val(id);
            $('#firstname').val(response.firstName);
            $('#lastname').val(response.lastName);
            $('#middlename').val(response.middlename);
            $('#yearOfCallToBar').val(response.yearOfCallToBar);
            $('#editSCN').val(response.scn);
            $('#phoneNumber').val(response.phoneNumber);
            $('#email').val(response.email);
           
        },
        error: function(response) {
            alert(response.responseText);
        }
    });
    $('.editUserModal').modal('show');
});

$('.deleteUser').on('click touchstart tap',function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#payment_id').val(id);
        $('#deleteUserModal').modal('show');
        
   });

});
</script>
@section('content')
<div class="container mt-5 px-4 px-md-0">
   <div class="row d-flex flex-sm-row justify-content-between mb-5">
                <div class="col-sm-5">
                   <h3 class="table-title-3"> {{$user->lastName.' '.$user->firstName.' '.$user->middlename}}</h3>
                </div>
               
                    <div class="d-flex col-sm-3 mt-2">
                    <button class="btn btn-norm editUser" data-bs-toggle="modal" data-id="{{$user->id}}" type="button">
                        Edit
                    </button>
               
                    <button class="btn btn-norm deleteUser" data-bs-toggle="modal" data-id="{{$user->id}}" type="button">
                        Delete
                    </button>
               
                    <a href="{{route('message.create')}}" role="button" class="btn  btn-normal">
                        Send message
                    </a>
            </div>
        </div>
        <div class="d-flex d-lg-flex flex-lg-row row">
            <div class="col-md-2 mb-2">
                <label class="form-view-label text-uppercase">SCN</label>
                <div class="form-value-label scn" id="">{{$user->scn}}</div>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-view-label">Phone number</label>
                <div class="form-value-label amount" id="">{{$user->phoneNumber}}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-view-label">Email</label>
                <div class="form-value-label amount" id="">{{$user->email}}</div>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-view-label text-uppercase">YEAR OF CALL</label>
                <div class="form-value-label yearOfCall" id="">{{$user->yearOfCallToBar}}</div>
            </div>
        </div>
    <div class="row mt-5">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="table-title-2">Payment History</h4>
        </div>
        <div class="col-md-12 table-responsive" >
        <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Date</th>
                    <th class=" h-table">Amount paid</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                   
                     @foreach($paymentDetails as $paymentDetail)
                         @if($paymentDetail ->scn === $user -> scn )
                            <td>
                                 {{ $paymentDetail -> transaction_date}}
                            </td>
                           <td>
                           &#8358;{{ number_format( $paymentDetail->amount )}}
                            </td>
                            <td>
                            @if($paymentDetail->status ==='successful')
                                <span class="badge bg-success-badge py-2 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                    Successful
                                </span>
                            @elseif($paymentDetail->status ==='pending')
                                <span class="badge bg-warning-badge py-2 px-3">
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
                           <button class="btn btn-view btnpaymentView" type="button" data-bs-toggle="modal" data-id="{{Auth::user() -> id}}" > View</button>
                        </td>
                        @endif
                     @endforeach
                     
                    </tr> 
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.modals')
@include('admin.paymentModal')
@endsection
