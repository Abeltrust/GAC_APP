
@extends('layouts.app')

@section('content')

<div class="container mt-4">
        <div class="text-center">
            <img src="assets/images/avatar-2.jpg" class="rounded-circle mb-3" style="width: 150px; height: 150px;" alt="User Image">
            <h3>{{Auth::user()-> name}}</h3>
            <!-- <div class="mt-2">
                <span class="badge bg-success py-2">Verified</span>
                <span class="badge bg-warning py-2 text-dark">Pending</span>
            </div> -->
        </div>
        
        <div class="mt-4">
           <div class="d-flex justify-content-between">
             <h4>Requisition Information</h4>  
             <div class="mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   Apply for Loan
                </button>
             </div>
           </div>
          @if(!is_null($data))
           <span>
              No application data
           </span>
           @else
           <table class="table nowrap">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Item </th>
                        <th>Qnty</th>
                        <th>Amount</th>
                        <th>Status</th>
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


