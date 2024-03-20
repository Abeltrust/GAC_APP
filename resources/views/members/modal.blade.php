
<div class="modal fade" id="financialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Requisition Form</h5>
        <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{route('finance.store')}}" >
          @csrf
        <div class="row mb-3">
            <div class="col-md-12">
              <label for="Item" class="col-md-12 col-form-label text-md-start">{{ __('Description') }}</label>
              <input id="Item" type="text" class="form-control @error('Item') is-invalid @enderror" name="description" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('Item')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="Amount" class="col-md-12 col-form-label text-md-start">{{ __('Amount') }}</label>
              <input id="Amount" type="number" class="form-control @error('Amount') is-invalid @enderror" name="amount" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('Amount')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="deduct" class="col-md-12 col-form-label text-md-start">{{ __('Amount to deduct') }}</label>
              <input id="deduct" type="number" class="form-control @error('deduct') is-invalid @enderror" name="deduct_monthly" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('deduct_monthly')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
       
            <div class="col-md-6">
              <label for="deduct" class="col-md-12 col-form-label text-md-start">{{ __('Start Month') }}</label>
              <input id="start_month" type="number" class="form-control @error('start_month') is-invalid @enderror" name="deduct_month" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('start_month')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
      </div>
          <div class="modal-footer">
            <button type="button w-100" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="mortageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Requisition Form</h5>
        <button type="button" class="btn-close btn-bg-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('application.store')}}" >
          @csrf
        <div class="row mb-3">
            <div class="col-md-12">
              <label for="Item" class="col-md-6 col-form-label text-md-start">{{ __('Item Description') }}</label>
              <input id="Item" type="text" class="form-control @error('Item') is-invalid @enderror" name="Item" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('Item')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="quantity" class="col-form-label">{{ __('Quantity') }}</label>
              <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required onkeyup="calculateAmount()">
              @error('quantity')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="unit_price" class="col-form-label">{{ __('Unit Price') }}</label>
              <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ old('unit_price') }}" required onkeyup="calculateAmount()">
              @error('unit_price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="deduct" class="col-md-12 col-form-label text-md-start">{{ __('Amount to deduct monthly') }}</label>
              <input id="deduct" type="number" class="form-control @error('deduct') is-invalid @enderror" name="deduct_monthly" value="{{ old('name') }}" required  autofocus>
              @error('deduct')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="deduct" class="col-md-12 col-form-label text-md-start">{{ __('Start Month') }}</label>
              <input id="start_monthly" type="number" class="form-control @error('start_monthly') is-invalid @enderror" name="start_month" value="{{ old('start_monthly') }}" required autocomplete="name" autofocus>
              @error('start_monthly')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
            <div class="row mb-3">
            <div class="col-md-12">
              <label for="amount" class="col-form-label">{{ __('Amount') }}</label>
              <input id="amount" type="number" class="form-control" name="amount" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  function calculateAmount() {
    var quantity = document.getElementById('quantity').value;
    var unitPrice = document.getElementById('unit_price').value;
    var amountField = document.getElementById('amount');

    // Perform the calculation
    var amount = quantity * unitPrice;

    // Display the calculated amount in the amount field
    amountField.value = amount;
  }
</script>
