

@extends('layouts.admin')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script defer>
    $.ajaxSetup({
        header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
   <script type="text/javascript" defer>
    document.addEventListener("DOMContentLoaded", function() {
    $('.btnpaymentView').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        async: false,
        url: '/payment/view/'+id,
        success: function(response) {
            
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

//edit
$('.editSetPayment').on('click touchstart tap',function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        async: false,
        url: '/setpayment/edit/'+id,
        success: function(response) {
            $('#yoc').val(response.year);
            $('#branch_dues').val(response.branch);
            $('#id_card').val(response.idcard);
            $('#insurance').val(response.insurance);
            $('#total').val(response.total);
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

   $('#createMakePaymentModal').on('click touchstart tap',function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
    
        $.ajax({
        type: 'GET',
        async: false,
        url: '/getpayment/amount/'+id,
        success: function(response) {
            // alert(response.branch)
            $('#branch01').val(response.branch);
            $('#card01').val(response.idcard);
            $('#insurance01').val(response.insurance);
            $('#total01').val(response.total);
        //  alert(response.branch)
        },
        error: function(response) {
            alert(response.responseText);
        }
    });
        $('#PaymentFeeModal').modal('show');
        
   });

   $('#branchcheck').change(function(e) {
        e.preventDefault();
        let branch=0,card=0,insure=0;

        alert("Checked Box deselect");
        if($(this).prop('checked')) {
            alert("Checked Box Selected");
        } else {
           
        }
        if($('#branchcheck').is(':checked')){
            branch=$('#branch01').val();
           alert(branch)
        }else{
            branch=0;
           
        }
        if($('#idcardcheck').is(':checked')){
            card=$('#card01').val()
        }else{
            card=0;
        }
        if($('#insurancecheck').is(':checked')){
            insure=$('#insurance01').val()
        }else{
            insure=0;
        }
        let total=parseFloat(insure)+parseFloat(card)+parseFloat(branch);
        $('#total01').val(total);
   });

   $('#idcardcheck').change(function(e) {
        e.preventDefault();
        let branch=0,card=0,insure=0;
        if($('#branchcheck').is(':checked')){
            branch=$('#branch01').val();
           
        }else{
            branch=0;
           
        }
        if($('#idcardcheck').is(':checked')){
            card=$('#card01').val()
        }else{
            card=0;
        }
        if($('#insurancecheck').is(':checked')){
            insure=$('#insurance01').val()
        }else{
            insure=0;
        }
        let total=parseFloat(insure)+parseFloat(card)+parseFloat(branch);
        $('#total01').val(total);
   });

   $('#insurancecheck').change(function(e) {
        e.preventDefault();
        let branch=0,card=0,insure=0;
        if($('#branchcheck').is(':checked')){
            branch=$('#branch01').val();
        }else{
            branch=0;
        }
        if($('#idcardcheck').is(':checked')){
            card=$('#card01').val()
        }else{
            card=0;
        }
        if($('#insurancecheck').is(':checked')){
            insure=$('#insurance01').val()
        }else{
            insure=0;
        }
        let total=parseFloat(insure)+parseFloat(card)+parseFloat(branch);
        $('#total01').val(total);
   });
});
</script>


<script>

    $(function(){
        $('#makePaymentForm').submit(
            function(e){
                e.preventDefault()
                var name =$('#fullname').val();
                var email =$('#email_payment').val();
                var phone_number =$('#phone_number').val();
                var amount =$('#total01').val();
                

                makePayment(amount,email,phone_number,name);
            }
        )
    })
    function makePayment(amount,email,phone_number,name) {
      FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-7161d1b25f588cff324b6498d515a56f-X",
        tx_ref: "Rx1_{{substr(rand(0,time()),0,7)}}",
        amount: parseFloat(amount),
        currency: "NGN",
        payment_options: "card, ussd",
        // redirect_url: "https://glaciers.titanic.com/handle-flutterwave-payment",
        
        callback:function(data){
            console.log(data)
                
                var transaction_id=data.transaction_id
                var _token= $("input[name='_token']").val()
                
                $.ajax({
                    type: 'POST',
                    async: false,
                    url: '/verify/'+amount,
                    data:{
                        transaction_id,
                        amount,
                        _token
                    }
                    // success: function(response) {
                    //     $('#branch01').val(response.branch);
                    //     $('#card01').val(response.idcard);
                    //     $('#insurance01').val(response.insurance);
                    //     $('#total01').val(response.total);
                    // },
                    // error: function(response) {
                    //     alert(response.responseText);
                    // }
                });
        },
        customer: {
          email: email,
          phone_number: phone_number,
          name: name,
        },
        customizations: {
          title: "The Titanic Store",
          description: "Payment for an awesome cruise",
          logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
        },
      });
    }
  </script>
@section('content')

<div class="container mt-5 px-4 px-md-0">



    <div class="row mt-5">
        <h3>PAYMENT SCHEDULE FOR 2023</h3>
        <div class="col-md-12 table-responsive" >
            <table class="table table-borderless table-striped-m w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Year</th>
                    <th class=" h-table">Branch dues</th>
                    <th class=" h-table">ID card</th>
                    <th class=" h-table">Insurance</th>
                    <th class=" h-table">Total</th>
                    {{-- <th class=" h-table">Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                @if($payment)
                {{-- @foreach($payment as $payments) --}}
                  <tr>
                    <td >{{$payment -> year}}</td>
                    <td>&#8358;{{ number_format($payment -> branch)}}</td>
                    <td>&#8358;{{ number_format($payment -> idcard)}}</td>
                    <td>&#8358;{{ number_format($payment -> insurance)}}</td>
                    <td>&#8358;{{ number_format($payment -> total)}}</td>
                    {{-- <td class="d-flex "> 
                        <button class="btn btn-norm editSetPayment" data-id="{{$payments -> id}}" type="button" data-bs-toggle="modal"> Edit</button>
                        <button class="btn btn-norm deleteSetPayment" data-id="{{$payments -> id}}" type="button" data-bs-toggle="modal"> Delete</button>
                    </td> --}}
                  </tr>
                {{-- @endforeach --}}
                  @else
                   <tr>
                    <td colspan="5" class="text-center">No payment set</td>
                   </tr>
                   @endif
                </tbody>
            </table>
        </div>

          <div class=" d-flex justify-content-center mb-4 mt-2">
            @if($payment)
                <button  data-id="{{$payment->id}}"="" id="createMakePaymentModal" type="button" class="btn btn-primary btn-proceed-payment" >
                Proceed to payment
                </button>
            @else
                <button   type="button" class="btn btn-primary btn-proceed-payment" disabled>
                     No payment set
                </button>
            @endif
             
          </div>
      </div>



    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-center">
            <h2 class="table-title">PAYMENT  HISTORY</h2>
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
                    @if(!$paymentDetails -> isEmpty())
                    @foreach($paymentDetails as $paymentDetail)
                    <tr>
                     {{-- {{$paymentDetail}} --}}
                         {{-- @if($paymentDetail ->scn === Auth::user() -> scn ) --}}
                            <td>
                                 {{ $paymentDetail ->transaction_date}}
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
                        {{-- @else
                        
                        <td colspan="4" class="text-center">No payment made</td>
                       
                        @endif --}}
                    </tr> 
                     @endforeach
                     @else
                        <td colspan="4" class="text-center">No payment made</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('members.modals')
 @include('admin.paymentModal')
@endsection
