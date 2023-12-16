

@extends('layouts.admin')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


<script>
  
  $(document).ready(function() {
    $('.btnESubadmin').click(function(e) {
          e.preventDefault()
        let id = $(this).attr('data-id');
          $('#scn').val(id);
          $.ajax({
                type: 'GET',
                async: false,
                url: '/permission/edit/'+id,
                success: function(response) {
                  
                  if(response.message === 1) {
                    document.querySelector('#message').checked = true;
                  }else{
                    document.querySelector('#message').checked = false;
                  }

                  if(response.payment === 1){
                    document.querySelector('#payment').checked = true; 
                  }else{
                    document.querySelector('#payment').checked = false;
                  }
                  if(response.edit === 1){
                    document.querySelector('#edit').checked = true; 
                  }else{
                    document.querySelector('#edit').checked = false;
                  }
                  if(response.delete === 1){
                    document.querySelector('#delete').checked = true; 
                  }else{
                    document.querySelector('#delete').checked = false;
                  }
                },
                error: function(response) {
                    alert(response.responseText);
                }
            });
          $('#addSubAdminModal').modal('show');
      });
  
          

      
      $('.btnDSubadmin').on('click touchstart tap',function(e) {
          e.preventDefault()
          let scn = $(this).attr('data-id');
          $('#scnd').val(scn);
          $('#deleteSubAdminModal').modal('show');
      });
  });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click touchstart tap','.pagination a',function(e) {
            e.preventDefault();
            let page=$(this).attr('href').split('page=')[1]
            settingsPagination(page);
        });
    

        $(document).on('keyup',function(e) {
            e.preventDefault();
            let search_string = $('#settingSearch').val();

            // alert(search_string)
          
            $.ajax({
                url:"{{route('search.settings')}}",
                method: 'GET',
                data:{search_string:search_string?search_string:''},
                success:function(res){
                  // alert(res)
                    $('.subAdminTable').html(res);
                    
                }
            })
          });
        });

    function settingsPagination(page){
      // alert(res);
            $.ajax({
                url:"/settings/pagination/paginate-data?page="+page,
                success:function(res){
                    $('.subAdminTable').html(res);
                    
                }
            })
        }
      
    
 
</script>
@section('content')


<div class="container mt-5 px-4 px-md-0">
    

    <div class="row mt-4">

        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="table-title-2">Settings</h2>
           
        </div>
        <div class="col-md-12" >

            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item nav-item-1" role="presentation">
                  <button class="nav-link active nav-link-1" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item nav-item-1" role="presentation">
                  <button class="nav-link  nav-link-1" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="true">Change password</button>
                </li>
                <li class="nav-item nav-item-1" role="presentation">
                  <button class="nav-link  nav-link-1" id="subadmins-tab" data-bs-toggle="tab" data-bs-target="#subadmins" type="button" role="tab" aria-controls="subadmins" aria-selected="false">Sub admins</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="" class="w-md-75" >
                       <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Full name</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" value="{{Auth::user()->name}}" readonly>
                            </div>
                          </div>

                          <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Staff ID</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" value="{{Auth::user()->staffId }}" readonly>
                            </div>
                          </div>

                          <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Phone number</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" value="{{Auth::user()->phoneNumber }}" readonly>
                            </div>
                          </div>

                          <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Email</label>
                            <div class="col-md-8">
                              <input type="email" class="form-control" value="{{Auth::user()->email }}"  readonly>
                            </div>
                          </div>

                          <div class="mb-3 row">
                            <label for="" class="col-md-4 form-label">Department</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" value="{{Auth::user()-> Department }}" readonly>
                            </div>
                          </div>
                    </form>
                  </div>

                <div class="tab-pane fade " id="password" role="tabpanel" aria-labelledby="password-tab">
                    <form method="POST" action="{{route('password.change')}}" class="w-md-75" >
                      @csrf
                        <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Old password</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="current_password" required>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">New password</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control"  name="new_password" required>
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-4 row">
                            <label for="" class="col-md-4 form-label">Retype password</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="new_password_confirmation" required>
                            </div>
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                           @enderror
                          </div>
                        <div class="row mb-4">
                              <div class="col-md-8 offset-md-4">
                                 <button class="btn btn-primary" style="width: 150px;" type="submit">
                                    Save
                                 </button>
                              </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="subadmins" role="tabpanel" aria-labelledby="subadmins-tab">
                <div class="form-group has-search mb-5">
                  <span class="form-control-feedback ">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242a1.116 1.116 0 0 0-.045-.042Zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485Z" clip-rule="evenodd"/></svg>
                  </span>
                  <input type="text"  id="settingSearch" class="form-control search" placeholder="Search">
               </div>
                    <div class="col-md-12 table-responsive subAdminTable" >
                        <table class="table table-borderless table-striped w-100"  >
                            <thead>
                              <tr>
                                <th class=" h-table">Name</th>
                                <th class=" h-table">Staff ID</th>
                                <th class=" h-table">Access type</th>
                                <th class=" h-table">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($users as $user)
                                <tr>
                                  <td >{{$user -> name}}</td>
                                  <td>{{$user -> staffId}}</td>
                                  <td> {{$user->role}}</td>
                                  <td class="">

                                      @if(auth()->user()->role=='admin')
                                      <button class="btnESubadmin btn-view py-2 px-4"    data-id="{{$user -> staffId}}" > Edit</button>
                                      <button class="btn-view btnDSubadmin py-2 px-4"    data-id="{{$user -> staffId}}"  > Delete</button>
                                      @endif

                                    
                                  </td>
                                    </tr>
                               
                              @endforeach
                            </tbody>
                        </table>
                        {!! $users->links() !!}
                    </div>
                </div>
              </div>
           
        </div>
    </div>

</div>
@include('admin.modals')
@endsection
