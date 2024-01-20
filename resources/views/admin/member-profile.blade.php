
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
        <img src="{{ asset('storage/assets/images/' . $user->userImage) }}" class="rounded-circle mb-3 mx-5" style="width: 150px; height: 150px;" alt="User Image">
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
                        data-bs-content="<h6>{{ number_format($total_count) }}</h6>"
                    >{{ number_format($total_count) }}</span>
                    <p>Total Approved Request</p>
                </div>
                <div class="col-md-3 card-dashboard text-success">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format($paid) }}</h6>">
                        &#8358;{{ number_format($paid) }}</span>
                    <p>Total amount Paid</p>
                </div>
                <div class="col-md-3 card-dashboard text-danger">
                    <span 
                        class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format($total) }}</h6>">
                        &#8358;{{ number_format($total) }}
                    </span>
                    <p >Outstabding Ballance</p>
                </div>
            </div>
        <div class="mt-4">
           <div class="d-flex justify-content-between">
             <h4>Requisition Information</h4>  
           </div>
          @if(is_null($dataM)||is_null($dataF))
           <span>
              No application data
           </span>
           @else
           <table class="table nowrap table-borderless table-striped w-100">
                <thead>
                    <tr>
                        <th>Item </th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dataM as  $d)
                    <tr>
                        <td>{{$d -> item}}</td>
                        <td>&#8358;{{$d -> total}} </td>
                        <td>
                           <a class="btn btn-view " href="{{route('members.profile',$d -> id)}}"  type="button" > View details</a>
                       </td>
                    </tr>
                @endforeach
                @foreach($dataF as  $df)
                    <tr>
                        <td>{{$df -> description}}</td>
                        <td>&#8358;{{$df -> amount}} </td>
                        <td>
                           <a class="btn btn-view " href="{{route('members.profile',$df -> id)}}"  type="button" > View details</a>
                       </td>
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
