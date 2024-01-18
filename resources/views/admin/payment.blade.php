

@extends('layouts.admin')
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
            $('#scnID').val(response.scn);
            $('#amount').val(response.amount);
            $('#yearOfCall').val(response.yoc);
            $('#transaction_date').val(response.transaction_date);
            $('#transaction_id').val(response.transaction_id);
            $('#status').val(response.status);
            $('.amount').text(response.amount);
            $('.transaction_date').text(response.amount);
            $('.scn').text(response.scn);
            $('.yearOfCall').text(response.yoc);
            $('.transaction_id').text(response.transaction_id);
            $('.transaction_date').text(response.transaction_date);
           if (response.status ==='successful') {
            document.querySelector('.statusSuccess').style.display = 'block';       
           }else if(response.status ==='pending'){
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

});
</script>
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
        $(document).on('click touchstart tap','.pagination a',function(e) {
            e.preventDefault();
            let page=$(this).attr('href').split('page=')[1]
            paymentPagination(page)
        });


        $(document).on('change',function(e) {
            e.preventDefault();
            let search_string = $('#paymentSearch').val();
            // alert(search_string)
            $.ajax({
                    url:"{{route('payment.search')}}",
                    method: 'GET',
                    data:{search_string:search_string},
                    success:function(res){
                        $('.payment-table').html(res);
                    }
                })
        });
    });

    function paymentPagination(page){
            $.ajax({
                url:"/payment/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.payment-table').html(res);
                }
            })
    }
</script>

@section('content')

<div class="container mt-5 px-4 px-md-0">
    

    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="table-title-2">Payments</h2>
            <div>
                <select name="paymentSearch" id="paymentSearch" class="form-control  form-select-2 form-select">
                    <option  disabled selected>Staff ID</option>
                    @foreach($scnValues as $scn)
                        <option value="{{ $scn->scn }}">{{ $scn->scn }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12 table-responsive payment-table" >
            <table class="table table-borderless table-striped w-100">
                <thead>
                  <tr>
                    <th class=" h-table">Email</th>
                    <th class=" h-table">Amount</th>
                    <th class=" h-table">Deduction</th>
                    <th class=" h-table">Status</th>
                    <th class=" h-table">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if (!$finance->isEmpty() || !$mortgage -> isEmpty())
                        @foreach($mortgage as $m)
                                
                                <tr>
                                    <td >{{$m -> applied_by}}</td>
                                    <td>&#8358;{{ number_format($m -> total) }}</td>
                                    <td>
                                        &#8358;{{ number_format($m->deduct_monthly) }}
                                    </td>
                                   
                                    <td>
                                        @if($m->status ==='approved')
                                            <span class="badge bg-success-badge py-2 px-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                                approved
                                            </span>
                                        @elseif($m->status ==='pending')
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
                                      <a class="btn btn-view bg-primary text-light" href="{{route('rdeduct',$m -> id)}}" type="button" > Deduct</a>
                                      <button class="btn btn-view btnpaymentView" onclick="printFunction();" type="button" data-bs-toggle="modal"  data-id="{{$m -> id}}"> View</button>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($finance as $f)
                                
                                <tr>
                                    <td >{{$f -> applied_by}}</td>
                                    <td>&#8358;{{ number_format($f -> amount) }}</td>
                                    <td>
                                        &#8358;{{ number_format($f->deduct_monthly) }}
                                    </td>
                                   
                                    <td>
                                        @if($f->status ==='approved')
                                            <span class="badge bg-success-badge py-2 px-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                                approved
                                            </span>
                                        @elseif($f->status ==='pending')
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
                                      <a class="btn btn-view bg-primary text-light" href="{{route('fdeduct',$f -> id)}}" type="button" > Deduct</a>
                                      <button class="btn btn-view btnpaymentView" onclick="printFunction();" type="button" data-bs-toggle="modal"  data-id="{{$f -> id}}"> View</button>
                                    </td>
                                </tr>
                            @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No Record Yet</td>
                       </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>             
</div>
@include('admin.paymentModal')
@endsection
