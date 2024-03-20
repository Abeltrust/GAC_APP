<div class="modal fade" tabindex="-1" id="setPaymentRangeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Set payment range</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="setpayment-form" action="{{route('setpayment.store')}}" enctype="multipart/form-data" >
            @csrf
                    <div class="modal-body" >
                    
                        <div id="ref-add-field">
                            <div class=" d-flex d-lg-flex flex-lg-row flex-column justify-content-evenly gap-2" id="field0">
                               
                                <div class="mb-2 w-100">
                                    <label class="form-label">Amount</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" id="Amount" data-id="0" name="Amount"  class="form-control branchfield" placeholder="Enter minimum amount to be deducted">
                                    </div>
                                    @error('Amount')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                      </div> 
                  </div>    
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Set payment</button>
                </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade editSetPaymentRangeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit payment range</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="setpayment-form" action="{{route('setpayment.update')}}" >
            @csrf
                    <div class="modal-body" >
                    <div class=" d-flex d-lg-flex flex-lg-row flex-column justify-content-evenly gap-2" id="field0">
                               
                                <div class="mb-2">
                                    <label class="form-label">Amount</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" id="Amount"  name="Amount"  class="form-control branchfield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                       </div>
                    </div>
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Update payment</button>
                </div>
        </form>
      </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" id="setExcelUploadModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Excel File</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('users.import')}}" enctype="multipart/form-data" >
            @csrf
                    <div class="modal-body">
                        @csrf
                        @if (isset($errors) && $errors->any())
                                @foreach ($errors->all() as $error )
                                    <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">
                                        {{ $error}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Upload Excel File</label>
                                <div class="mb-3 mt-1">
                                    <input type="file" name="file"  class="form-control" placeholder="Upload your file" required  >
                                </div>
                                @error('name')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>   
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Upload</button>
                </div>
        </form>

        {{-- <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($errors) && $errors->any())
                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">

                        {{ $error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                    @endforeach
            @endif
                <div class="alert alert-warning p-3">

                    <p>Import an excel/ CSV file with new users list to register multiple users</p>
                </div>

                <div class="form-group">
                    <label for="" class="control-label font-weight-bold">Import Excel/CSV File</label>
                    <input type="file" name="file" id="" class="form-control" required>
                </div>

                <div class="row mx-4">
                    <div class="col-md-12 border-top">
                        <div class="card-footer text-end float-right">
                            <button class="btn btn-md btn-primary" type="submit"  >  <i class="fa-solid fa-download mr-1 text-white"></i>Upload</button>
                        </div>
                    </div>
                </div>
        </form> --}}
      </div>
    </div>
</div>



<div class="modal fade editUserModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit user</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('member.update')}}" >
            @csrf
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-2 col-md-12">
                                <input type="hidden" id="user_update_id" name="user_update_id">
                                <label class="form-label mb-2">Name</label>
                                <input type="text" id="name" name="name"  class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 col-md-6">
                                <label class="form-label mb-2">Staff ID</label>
                                <input type="text"id="editstaffId" name="staffId"  class="form-control @error('staffId') is-invalid @enderror" required readonly>
                                @error('staffId')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 col-md-12">
                                <label class="form-label mb-2">Phone Number</label>
                                <input type="text" id="phoneNumber" name="phonenumber"  class="form-control @error('phonenumber') is-invalid @enderror" required>
                                @error('phonenumber')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 col-md-12">
                                <label class="form-label mb-2">Email</label>
                                <input type="email" id="email" name="email"  class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                          
                        </div>
                      
                    </div>   
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Save</button>
                </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="addSubAdminModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add sub admins</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('permission.store')}}">
            @csrf
                    <div class="modal-body">
                    
                        @csrf
                       
                        <div class="row">
                           <div class="col-12 mt-1">
                                    <h6>Access types</h6>
                                    <input type="hidden"  name="scn"  class="form-check-input" id="scn">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox"  name="message" value="Send message" class="form-check-input" id="message">
                                    <label class="form-check-label my-1" for="exampleCheck1">Send message</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox"  name="payment"  value="Set payment range"  class="form-check-input" id="payment">
                                    <label class="form-check-label my-1" for="exampleCheck1">Set payment range</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox"   name="edit" value="Edit" class="form-check-input" id="edit">
                                    <label class="form-check-label my-1" for="exampleCheck1">Edit</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox"  name="delete" value="Delete" class="form-check-input" id="delete">
                                   <label class="form-check-label my-1" for="exampleCheck1">Delete</label>
                                </div>
                            </div>
                        </div>
                    </div>   
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Set Access </button>
                </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="deleteSubAdminModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <form method="POST" action="{{route('permission.destroy')}}" >
            @csrf
                    <div class="modal-body">
                        @csrf
                            <div class="row">
                             <div class="col-12 mt-1">
                                        <h6>Do you want to delete this Admin?</h6>
                                        <input type="hidden" name="scnd" id="scnd">
                             </div>
                            </div>
                    </div>   
                <div class="modal-footer  ">
                    <button type="button" class="btn btn-danger btn-custom-h" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary   btn-custom-h">Delete</button>
                </div>
        </form>
      </div>
    </div>
</div>
</div>



<div class="modal fade" tabindex="-1" id="deleteUserModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <form method="POST" action="{{route('member.destroy')}}" >
            @csrf
                    <div class="modal-body">
                        @csrf
                            <div class="row">
                             <div class="col-12 mt-1">
                                        <h6>Do you want to delete this User?</h6>
                                        <input type="hidden" name="user_id" id="user_id">
                             </div>
                            </div>
                    </div>   
                <div class="modal-footer  ">
                    <button type="button" class="btn btn-danger btn-custom-h" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary   btn-custom-h">Delete</button>
                </div>
        </form>
      </div>
    </div>
</div>
</div>

<div class="modal fade deletePaymentModal" tabindex="-1" id="" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete</h5>
            <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
           <form method="POST" action="{{route('setpayment.destroy')}}" >
            @csrf
                    <div class="modal-body">
                        @csrf
                            <div class="row">
                             <div class="col-12 mt-1">
                                        <h6>Do you want to delete this Payment?</h6>
                                        <input type="hidden" name="payment_id" id="payment_id">
                             </div>
                            </div>
                    </div>   
                <div class="modal-footer  ">
                    <button type="button" class="btn btn-danger btn-custom-h" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary   btn-custom-h">Delete</button>
                </div>
        </form>
      </div>
    </div>
   </div>
</div>



<div class="modal fade my-5" id="financialDetails" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-md rounded">
        <div class="modal-content">
                <div class="modal-body">
                   <div class="row mb-2"> 
                    <div class="col-6 d-flex text-center">
                        <h5 class="card-title">Requisition Information</h5>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn-close float-end bg-lightgreen border rounded" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                   </div>
                    <div class="text-sm text-gray-700 dark:text-gray-400">
                    <div class="row justify-content-between ms-8 me-8 mb-4 mx-5">
                   
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="" class="small">Name</label>
                            </div>
                            <div class="font-weight-bold small">
                            <label for="" class="small applied_by"></label>
                            </div>
                        </div>
                    </div>
               </div>
        </div>
    </div>
</div>