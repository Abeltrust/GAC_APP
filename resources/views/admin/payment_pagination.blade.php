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
                    @if (!$users->isEmpty())
                        @foreach($users as $user)
                                
                            @foreach ($user->paymentDetails as $payment )
                                
                                <tr>
                                    <td >{{$user -> lastName.' '.$user -> firstName.' '.$user -> middlename}}</td>
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
                                        <button class="btn btn-view btnpaymentView" onclick="printFunction();" type="button" data-bs-toggle="modal"  data-id="{{$user -> id}}"> View</button>
                                    </td>
                                </tr>
                            @endforeach
                            
                            @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No Record Yet</td>
                       </tr>
                    @endif
                </tbody>
            </table>