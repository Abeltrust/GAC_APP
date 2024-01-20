
@extends('layouts.admin')

@section('content')

<div class="container mt-4">
        
       <div class="row align-content-center">
        <div class="col-md-3 ">
        <img src="{{ asset('storage/assets/images/' . auth()->user()->userImage) }}" class="rounded-circle mb-3 mx-5" style="width: 150px; height: 150px;" alt="User Image">
                  <div class="mt-1">
                      <h6> <span class=""><strong>Staff ID:</strong>{{auth()->user()->staffId}}</span></h6>
                    </div> 
              </div>
        <div class="col-md-4 mt-3 card-profile mx-1">
                    <span
                    class="larg-number" 
                        data-bs-toggle="popover" 
                        title="Total amount generated" 
                        data-bs-content="<h6>&#8358;{{ number_format($total) }}</h6>">
                        &#8358;{{ number_format($total) }}</span>
                    <p class="text-danger">Outstanding Ballance</p>
          </div>
          <div class="col-md-4 mt-3 justify-content-evenly">
        <div class="mt-2 ">
            <button type="button" class="btn btn-primary mx-1 btn-py w-100" data-bs-toggle="modal" data-bs-target="#financialModal">
               Apply Financial Loan
            </button>
        </div>
        <div class="mt-2 ">
            <button type="button" class="btn btn-primary mx-1 btn-py w-100" data-bs-toggle="modal" data-bs-target="#mortageModal">
               Apply Mortgage Loan
            </button>
        </div>
    </div>
        </div>
        <div class="mt-2">
        <div class="d-flex flex-lg-row flex-column justify-content-between">
           <div>
                <h4>Requisition Information</h4>
            </div>  
          </div>
           </div>
          @if(is_null($data)||is_null($dataf))
           <span>
              No application data
           </span>
           @else
           <table class="table nowrap table-borderless table-striped w-100">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Deduction</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as  $d)
                    <tr>
                        <td>{{$d -> item}}</td>
                        <td>&#8358;{{ number_format($d -> total) }} </td>
                        <td class="text-danger">&#8358;{{ number_format($d -> deduct_monthly) }} </td>
                      @if($d -> status == 'approved')
                        <td><span class="btn-primary text-light p-1 rounded"> Approved </span></td>
                        @elseif($d -> status =='pending')
                         <td><span class="btn-warning text-light p-1 rounded"> pending </span></td>
                         @else
                           <td><span class="btn-danger text-light p-1 rounded"> Declined </span></td>
                       @endif
                    </tr>
                @endforeach
                @foreach($dataf as  $f)
                  <tr>
                    <td>{{$f->description}}</td>
                   <td>&#8358;{{ number_format($f->amount)}}</td>
                   <td class="text-danger">&#8358;{{ number_format($f -> deduct_monthly) }} </td>
                   @if($f -> status == 'approved')
                        <td><span class="btn-primary text-light p-1 rounded"> Approved </span></td>
                        @elseif($f -> status =='pending')
                         <td><span class="btn-warning text-light p-1 rounded"> pending </span></td>
                         @else
                           <td><span class="btn-danger text-light p-1 rounded"> Declined </span></td>
                       @endif
                  </tr>
                @endforeach
                </tbody>
            </table>
            @endif
            
        </div>
    </div>
    @include('members.modal')
    @endsection
@section('footer')
 @include('layouts.app-footer')
@endsection


