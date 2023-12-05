<div class="modal fade" tabindex="-1" id="PaymentFeeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Payment</h5>
          <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('pay') }}" id="makePaymentFor" >
            @csrf
                    <div class="modal-body" >
                    
                        <div id="ref-add-field">

                                <div class="row" >
                                    <div class="col-12">
                                    <label class="form-label">Branch dues</label>
                                        <div class="mb-3 form-group d-flex justify-content-between justify-content-center align-items-center gap-2 ">
                                            <input type="number" id="branch01" name="branch" class="form-control branchfield" placeholder="Enter amount">
                                            <input type="checkbox" class="form-check-input " checked name="" id="branchcheck">
                                        </div>
                                        @error('branch')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                       @enderror
                                   </div>
                                </div>
                                <div class="row" >
                                    <div class="col-12">
                                    <label class="form-label">ID Card</label>
                                        <div class="mb-3 form-group d-flex justify-content-between justify-content-center align-items-center gap-2">
                                            <input type="number" id="card01" name="card" class="form-control branchfield" placeholder="Enter amount">
                                            <input type="checkbox" class="form-check-input " checked name="" id="idcardcheck">
                                        </div>
                                        @error('card')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                   </div>
                                </div>
                                <div class="row" >
                                    <div class="col-12">
                                    <label class="form-label">Insurance</label>
                                        <div class="mb-3 form-group d-flex justify-content-between justify-content-center align-items-center gap-2">
                                            <input type="number" id="insurance01" name="insurance" class="form-control branchfield" placeholder="Enter amount">
                                            <input type="checkbox" class="form-check-input " checked name="" id="insurancecheck">
                                        </div>
                                        @error('insurance')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                   </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label class="form-label">Total</label>
                                    <div class="mb-3 mt-1">
                                        <input type="number" readonly id="total01" data-id="0" name="total"  class="form-control totalfield" placeholder="Enter amount">
                                    </div>
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <input type="email" hidden value="{{Auth::user()->email}}" id="email_payment" name="email_payment" >
                                <input type="tel" hidden value="{{Auth::user()->phoneNumber}}" id="phone_number" name="phone_number" >
                                <input type="text" hidden value="{{Auth::user()->firstName.' '.Auth::user()->lastName.' '.Auth::user()->middlename}}" id="fullname" name="fullname" >

                        </div>
                    
                   
                    </div>   
                <div class="modal-footer  ">
                    <button type="submit" class="btn btn-primary w-100 btn-custom-h">Set payment</button>
                </div>
        </form>
      </div>
    </div>
</div>