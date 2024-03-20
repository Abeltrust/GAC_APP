<div class="modal fade viewPaymentDetailsModal" tabindex="-1" id="" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment details</h5>
                <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                            <div class="modal-body" id="pdfContent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" id="amount" name="amount">
                                        <label class="form-view-label">AMOUNT WITHDRAWN</label>
                                    <div class="form-value-label amount" id=""></div>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="hidden" id="scnID" name="scn">
                                        <label class="form-view-label text-uppercase">Staff ID</label>
                                        <div class="form-value-label scn" id="viewDesription"></div>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="hidden" id="yearOfCall" name="yearOfCall">
                                        <label class="form-view-label text-uppercase">Department</label>
                                        <div class="form-value-label yearOfCall" id=""></div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                <div class="col-md-4">
                                        <label class="form-view-label text-uppercase">Transaction ID</label>
                                        <div class="form-value-label transaction_id" id=""></div>
                                        <input type="hidden" id="transaction_id" name="transaction_id">
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label class="form-view-label text-uppercase">Date of transaction</label>
                                        <div class="form-value-label transaction_date" id=""></div>
                                        <input type="hidden" id="transaction_date" name="transaction_date">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-view-label text-uppercase">STATUS</label>
                                        <div class="form-value-label statusSuccess" style="display:none;" id=""> 
                                        <input type="hidden" id="status" name="status">
                                        <span class="badge bg-success-badge py-2 px-3"  >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                                        Successful
                                            </span>
                                        </div>
                                        <div class="form-value-label statusPending" style="display:none;" id=""> 
                                         <span class="badge bg-warning-badge py-2 px-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                                Pending
                                        </span>
                                        </div>
                                        <div class="form-value-label statusDecline" style="display:none;" id=""> 
                                        <span class="badge bg-danger-badge py-2 px-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 15 15"><path fill="currentColor" d="M9.875 7.5a2.375 2.375 0 1 1-4.75 0a2.375 2.375 0 0 1 4.75 0Z"/></svg>
                                                Decline
                                        </span>
                                        </div>
                                    </div>
                            </div>

                            <div class="modal-footer  ">
                                <button type="button"  class="hide-on-print printModalConten btn btn-primary w-100 btn-custom-h">Download receipt</button>
                            </div>
      </div>
    </div>
</div>
