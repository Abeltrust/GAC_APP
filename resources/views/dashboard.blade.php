

@extends('layouts.admin')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script defer>
    $.ajaxSetup({
        header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script defer>
    $(document).ready(function() {

        let branchAmount=0;
        let cardAmount=0;
        let insuranceAmount=0;
        $(document).on('keyup','.branchfield',function(e) {
            e.preventDefault();
            getTotalAmount($(this).attr('data-id'))
        });

        $(document).on('keyup','.cardfield',function(e) {
            e.preventDefault();
            getTotalAmount($(this).attr('data-id'))
        });

        $(document).on('keyup','.insurancefield',function(e) {
            e.preventDefault();
            getTotalAmount($(this).attr('data-id'))
        });


        // $('#setpayment-form').validate({
        //     rules:{
        //         "yearOfCallToBar[]":{required:true}
        //     }
        // })

        // $('.yearOfCallToBar').each((i,e)=>{
        //     $(e).rules('',{required:true})
        // })
    });
    function getTotalAmount(id){
        let branch=parseFloat($('#branch'+id).val())
        let card=parseFloat($('#card'+id).val())
        let insurance=parseFloat($('#insurance'+id).val())
        if(!insurance){
            insurance=0;
        }

        if(!branch){
            branch=0;
        }

        if(!card){
            card=0;
        }


        let total=branch+insurance+card
        $('#total'+id).val(total)
    }

</script>

<script defer>
 document.addEventListener("DOMContentLoaded", function() {
    var counter = 1;
    var count = 1;
    
        function addRefField() {
            var field=`
                    <div class=" d-flex d-lg-flex flex-lg-row flex-column justify-content-evenly gap-2" id="field${counter}">
                                <div class="mb-2">
                                    <label class="form-label mb-2">Year of Call To Bar</label>
                                    <select id="yearOfCallToBar${counter}" required class="form-control mt-1" name="yearOfCallToBar[]">
                                        <option disabled selected> Select year</option>
                                        <option value="1 - 4 years"> 1 - 4 years</option>
                                        <option value="5 - 9 years"> 5 - 9 years</option>
                                        <option value="10 - 14 years"> 10 - 14 years</option>
                                        <option value="15 - 19 years"> 15 - 19 years</option>
                                        <option value="20 years & above"> 20 years & above</option>
                                        <option value="SAN & Benchers"> SAN & Benchers</option>
                                    </select>
                                    @error('yearOfCallToBar[]')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Branch dues</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" id="branch${counter}" name="branch[]" data-id="${counter}" class="form-control branchfield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">ID card</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" id="card${counter}" data-id="${counter}"   name="card[]"  class="form-control cardfield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Insurance</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" id="insurance${counter}" data-id="${counter}"  name="insurance[]"  class="form-control insurancefield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Total</label>
                                    <div class="mb-3 mt-1">
                                        <input type="text" id="total${counter}" name="total[]" data-id="${counter}"  class="form-control totalfield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    `;
        $('#ref-add-field').append(field);
        counter++;
    }

    document.getElementById('add_more_payment').addEventListener('click',function() {
      addRefField();
    });

    function removeRefField() {
        if (counter > 1) {
            $('#field' + (counter - 1)).remove();
            counter--;
        }
    }

    $('#remove_more_payment').on('click touchstart tap',function() {
        removeRefField();
    });

    $('.btnpaymentView').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        async: false,
        url: '/payment/view/'+id,
        success: function(response) {
            $('#scnID').val(response.paymentDetails.scn);
            $('#amount').val(response.paymentDetails.amount);
            $('#yearOfCall').val(response.user.yearOfCallToBar);
            $('#transaction_date').val(response.paymentDetails.transaction_date);
            $('#transaction_id').val(response.paymentDetails.transaction_id);
            $('#status').val(response.paymentDetails.status);
            $('.amount').text(response.paymentDetails.amount);
            $('.scn').text(response.paymentDetails.scn);
            $('.yearOfCall').text(response.user.yearOfCallToBar);
            $('.transaction_id').text(response.paymentDetails.transaction_id);
           $('.transaction_date').text(response.paymentDetails.transaction_date);
           if (response.paymentDetails.status ==='successful') {
            document.querySelector('.statusSuccess').style.display = 'block';       
           }else if(response.paymentDetails.status ==='pending'){
            document.querySelector('.statusPending').style.display ='block'; 
           } else{
            document.querySelector('.statusDecline').style.display ='block'; 
           }
        },
        error: function(response) {
            alert(response.responseText);
        }
    });
    $('.viewPaymentDetailsModal').modal('show');
});

    $(document).ready(function() {
        $('[data-bs-toggle="popover"]').popover({
            trigger: 'hover', 
            placement: 'right', 
            html: true 
        });
    });

//edit
$('.editSetPayment').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
   
    $.ajax({
        type: 'GET',
        async: false,
        url: '/setpayment/edit/'+id,
        success: function(response) {
            $('#yearOFCall').val(response.year);
            $('#yoc').val(response.year);
            $('#branch_dues').val(response.branch);
            $('#id_card').val(response.idcard);
            $('#insurance_edit').val(response.insurance);
            $('#total_edit').val(response.total);
        },
        error: function(response) {
            alert(response.responseText);
        }
    });
    $('.editSetPaymentRangeModal').modal('show');
});
    $('.deleteSetPayment').on('click touchstart tap',function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#payment_id').val(id);
        $('.deletePaymentModal').modal('show');
        
   });

   
    var branchDuesInput = document.getElementById("branch_dues");
    var idCardInput = document.getElementById("id_card");
    var insuranceInput = document.getElementById("insurance_edit");
    var totalInput = document.getElementById("total_edit");

    branchDuesInput.addEventListener("input", calculateTotal);
    idCardInput.addEventListener("input", calculateTotal);
    insuranceInput.addEventListener("input", calculateTotal);

    function calculateTotal() {
        var branchDues = parseFloat(branchDuesInput.value) || 0;
        var idCard = parseFloat(idCardInput.value) || 0;
        var insurance = parseFloat(insuranceInput.value) || 0;

        var total = branchDues + idCard + insurance;

        totalInput.value = total;
    }
});
</script>

@section('content')

<div class="container mt-5 px-4 px-md-0">
    <div class="row">
        <div class="col-md-6">
            <div class="row gap-4">
                <div class="col-md-5 card-dashboard">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>{{ number_format(count($users)) }}</h6>"
                    >{{count($users)}}</span>
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

            @if (auth()->user()->permission)
                @if (auth()->user()->permission->edit)
                    
                <button class="btn  btn-custom btn-custom-primary-outline" data-bs-toggle="modal" data-bs-target="#setExcelUploadModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.22 20.75H5.78A2.64 2.64 0 0 1 3.25 18v-3a.75.75 0 0 1 1.5 0v3a1.16 1.16 0 0 0 1 1.25h12.47a1.16 1.16 0 0 0 1-1.25v-3a.75.75 0 0 1 1.5 0v3a2.64 2.64 0 0 1-2.5 2.75ZM16 8.75a.74.74 0 0 1-.53-.22L12 5.06L8.53 8.53a.75.75 0 0 1-1.06-1.06l4-4a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06a.74.74 0 0 1-.53.22Z"/><path fill="currentColor" d="M12 15.75a.76.76 0 0 1-.75-.75V4a.75.75 0 0 1 1.5 0v11a.76.76 0 0 1-.75.75Z"/></svg>
                    Upload excel sheet
                            </button>
                    @else

                    <button disabled class="btn  btn-custom btn-custom-primary-outline" data-bs-toggle="modal" data-bs-target="#setExcelUploadModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.22 20.75H5.78A2.64 2.64 0 0 1 3.25 18v-3a.75.75 0 0 1 1.5 0v3a1.16 1.16 0 0 0 1 1.25h12.47a1.16 1.16 0 0 0 1-1.25v-3a.75.75 0 0 1 1.5 0v3a2.64 2.64 0 0 1-2.5 2.75ZM16 8.75a.74.74 0 0 1-.53-.22L12 5.06L8.53 8.53a.75.75 0 0 1-1.06-1.06l4-4a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06a.74.74 0 0 1-.53.22Z"/><path fill="currentColor" d="M12 15.75a.76.76 0 0 1-.75-.75V4a.75.75 0 0 1 1.5 0v11a.76.76 0 0 1-.75.75Z"/></svg>
                        Upload excel sheet
                    </button>

                    @endif
                    @if (auth()->user()->permission->payment)
                            <button class="btn btn-custom btn-custom-primary " data-bs-toggle="modal" data-bs-target="#setPaymentRangeModal">
                                Set payment range
                            </button> 
                    @else

                    
                    <button disabled class="btn btn-custom btn-custom-primary " data-bs-toggle="modal" data-bs-target="#setPaymentRangeModal">
                        Set payment range
                    </button> 
                @endif
            @elseif (auth()->user()->role=='admin')
                <button class="btn  btn-custom btn-custom-primary-outline" data-bs-toggle="modal" data-bs-target="#setExcelUploadModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.22 20.75H5.78A2.64 2.64 0 0 1 3.25 18v-3a.75.75 0 0 1 1.5 0v3a1.16 1.16 0 0 0 1 1.25h12.47a1.16 1.16 0 0 0 1-1.25v-3a.75.75 0 0 1 1.5 0v3a2.64 2.64 0 0 1-2.5 2.75ZM16 8.75a.74.74 0 0 1-.53-.22L12 5.06L8.53 8.53a.75.75 0 0 1-1.06-1.06l4-4a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06a.74.74 0 0 1-.53.22Z"/><path fill="currentColor" d="M12 15.75a.76.76 0 0 1-.75-.75V4a.75.75 0 0 1 1.5 0v11a.76.76 0 0 1-.75.75Z"/></svg>
                    Upload excel sheet
                </button>

                <button class="btn btn-custom btn-custom-primary " data-bs-toggle="modal" data-bs-target="#setPaymentRangeModal">
                    Set payment range
                </button> 
            @endif
            
            
            
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped-m w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Year of call to bar</th>
                    <th class=" h-table">Branch dues</th>
                    <th class=" h-table">ID card</th>
                    <th class=" h-table">Insurance</th>
                    <th class=" h-table">Total</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                @if(!$payment -> isEmpty())
                 @foreach($payment as $payments)
                  <tr>
                    <td >{{$payments -> year}}</td>
                    <td>&#8358;{{ number_format($payments -> branch)}}</td>
                    <td>&#8358;{{ number_format($payments -> idcard)}}</td>
                    <td>&#8358;{{ number_format($payments -> insurance)}}</td>
                    <td>&#8358;{{ number_format($payments -> total)}}</td>
                     <td> 
                   

                      {{-- @if (auth()->user()->permission)
                      @elseif (auth()->user()->role=='admin')
                      @endif --}}

                      @if (auth()->user()->permission)
                        @if (auth()->user()->permission->delete)
                            <button class="btn btn-norm deleteSetPayment" data-id="{{$payments -> id}}" type="button" > Delete</button>
                        @elseif (auth()->user()->permission->delete)
                              <button class="btn btn-norm editSetPayment" data-id="{{$payments -> id}}" type="button" > Edit</button>
                        @else
                        <button disabled  class="btn btn-norm deleteSetPayment" data-id="{{$payments -> id}}" type="button"> Delete</button>
                        @endif
                      @elseif (auth()->user()->role=='admin')
                      <button class="btn btn-norm editSetPayment" data-id="{{$payments -> id}}" type="button" > Edit</button>
                      <button class="btn btn-norm deleteSetPayment" data-id="{{$payments -> id}}" type="button"> Delete</button>
                      @endif
                     
                    </td>
                  </tr>
                @endforeach
                @else
                   <tr>
                    <td colspan="6" class="text-center">No payment set</td>
                   </tr>
                   @endif
                </tbody>
            </table>
           
        </div>
    </div>

    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between">
            <h2 class="table-title">Payments</h2>
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
                    <th class=" h-table">SCN/Email/Phone number</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @if (!is_null($users))
                        
                    @foreach ($users as $user )
                        @if (!$user->paymentDetails->isEmpty())
                            
                        @foreach ($user->paymentDetails as $payment)
                            <td >{{$user -> lastName.' '.$user -> lastName}}</td>
                            <td>
                                @if (isset($user->scn) && $user->scn)
                                    {{ $user->scn }}
                                @elseif (isset($user->email) && $user->email)
                                    {{ $user->email }}
                                @elseif (isset($user->phoneNumber) && $user->phoneNumber)
                                    {{ $user->phoneNumber }}
                                @endif
                            </td>
                            <td>
                                &#8358;{{ number_format($payment->amount) }}
                            </td>
                            <td>
                                @if($payment->status ==='successful')
                                    <span class="badge bg-success-badge py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                        Successful
                                    </span>
                                @elseif($payment->status ==='pending')
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
                                <button class="btn btn-view btnpaymentView" data-id="{{$user -> id}}" type="button" data-bs-toggle="modal" data-bs-target="#" > View</button>
                             </td>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No Record Yet</td>
                           </tr>
                        @endif
                    @endforeach
                   
                    @endif

                {{-- @foreach($users as $user)
                    <tr>
                     <td >{{$user -> lastName.' '.$user -> lastName}}</td>
                     <td>
                        @if (isset($user->scn) && $user->scn)
                            {{ $user->scn }}
                        @elseif (isset($user->email) && $user->email)
                            {{ $user->email }}
                        @elseif (isset($user->phoneNumber) && $user->phoneNumber)
                            {{ $user->phoneNumber }}
                        @else
                            No data available
                        @endif
                    </td>
                    @if(!$paymentDetails -> isEmpty())
                     @foreach($paymentDetails as $paymentDetail)
                     
                         @if($paymentDetail ->scn === $user -> scn )
                            <td>
                            &#8358;{{ number_format($paymentDetail->amount) }}
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
                           <button class="btn btn-view btnpaymentView" data-id="{{$user -> id}}" type="button"  > View</button>
                        </td>
                        @else
                        <td>N0.00</td>
                        <td colspan="2">No Payment Recieved</td>
                    
                        @endif
                     @endforeach
                     @else
                        <td>N0.00</td>
                        <td colspan="2">No Payment Recieved</td>
                        
                        @endif
                    </tr> 
                 @endforeach --}}
                 
                </tbody>
            </table>
           
        </div>
    </div>

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
                    <th class=" h-table">SCN</th>
                    <th class=" h-table">Phone Number</th>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Year of call</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                @if (!$users->isEmpty())
               
                @foreach($users as $user)
                  <tr>
                    <td >{{$user -> lastName.' '.$user -> firstName}}</td>
                    <td>{{$user -> scn}}</td>
                    <td>{{$user -> phoneNumber}}</td>
                    <td>
                        {{$user -> email}}
                    </td>
                    <td>
                        {{$user -> yearOfCallToBar}}
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
            {!! $users->links() !!}
        </div>
    </div>
</div>
@include('admin.modals')
@include('admin.paymentModal')
@endsection