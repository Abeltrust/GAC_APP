
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
<div class="container mt-4 px-4 px-md-0">
        <div class="text-center">
        <img src="{{asset('assets/images/avatar-2.jpg')}}" class="rounded-circle mb-3 mx-5" style="width: 150px; height: 150px;" alt="User Image">
           <h3>{{$user-> name}}</h3>
            <!-- <div class="mt-2">
                <span class="badge bg-success py-2">Verified</span>
                <span class="badge bg-warning py-2 text-dark">Pending</span>
            </div> -->
             
        </div>
        <div class="row gap-4 mt-4 justify-content-center align-item-center">
                <div class="col-md-3 card-dashboard">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6></h6>"
                    >0</span>
                    <p>Total number of Request</p>
                </div>
                <div class="col-md-3 card-dashboard">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format(1000) }}</h6>">
                        &#8358;{{ number_format(1000000000) }}</span>
                    <p>Total amount Paid this month</p>
                </div>
                <div class="col-md-3 card-dashboard">
                    <span 
                        class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format(1000) }}</h6>">
                        &#8358;{{ number_format(1000) }}
                    </span>
                    <p>Total amount generated</p>
                </div>
            </div>
        <div class="mt-4">
           <div class="d-flex justify-content-between">
             <h4>Requisition Information</h4>  
             <!-- <div class="mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   Apply for Loan
                </button>
             </div> -->
           </div>
          @if(is_null($data))
           <span>
              No application data
           </span>
           @else
           <table class="table nowrap table-borderless table-striped w-100">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Item </th>
                        <th>Qnty</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $index => $d)
                    <tr>
                        <td>{{$index+1 }}</td>
                        <td>{{$d -> item}}</td>
                        <td>{{$d -> quantity}}</td>
                        <td>&#8358;{{$d -> total}} </td>
                      @if($d -> status == 'approve')
                        <td><span class="btn-primary text-light p-1 rounded"> Approved </span></td>
                        @elseif($d -> status =='pending')
                         <td><span class="btn-warning text-light p-1 rounded"> pending </span></td>
                         <td><button class="btn-primary text-light p-1 rounded">Aprove</button> </td>
                         <td><button class="btn-primary text-light p-1 rounded">Decline</button> </td>
                         @else
                           <td><span class="btn-danger text-light p-1 rounded"> Declined </span></td>
                           <td><button class="btn-primary text-light p-1 rounded">Aprove</button><button class="btn-danger mx-1 text-light p-1 rounded">Decline</button> </td>
                       @endif
                       
                    </tr>
                   
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@include('admin.modals')
@include('admin.paymentModal')
@endsection
