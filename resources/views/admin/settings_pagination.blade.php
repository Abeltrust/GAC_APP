
                    <table class="table table-borderless table-striped w-100"  >
                      <thead>
                        <tr>
                          <th class=" h-table">Name</th>
                          <th class=" h-table">SCN</th>
                          <th class=" h-table">Access type</th>
                          <th class=" h-table">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                          <tr>
                            <td >{{$user -> lastName.' '.$user -> firstName.' '.$user -> middlename}}</td>
                            <td>{{$user -> scn}}</td>
                            <td>
                              @if($user->permission)

                                @if ($user->permission->message)
                                    Send messages,
                                @endif

                                @if ($user->permission->payment)
                                    Set payment,
                                @endif

                                @if ($user->permission->edit)
                                    Edit,
                                @endif

                                @if ($user->permission->delete)
                                    Delete
                                @endif
                              @else
                                No Permission
                              @endif
                            </td>
                            <td class="">
                                <button class="btnESubadmin btn-view py-2 px-4"    data-id="{{$user -> scn}}" > Edit</button>
                                <button class="btn-view btnDSubadmin py-2 px-4"    data-id="{{$user -> scn}}"  > Delete</button>
                            </td>
                              </tr>
                         
                        @endforeach
                      </tbody>
                  </table>

{{-- {!! $users->links() !!} --}}