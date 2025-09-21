@extends('layouts.masterLayout')
@section('pageTitle') Create Sale @endsection

@section('content')
<div class="container">
  <h3 class="mb-3">Create New Sale</h3>
  <form id="sale-form">
    @csrf
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="customer">Customer</label>
        <select id="customer" name="user_id" class="form-control" required>
          <option value="">-- Select Customer --</option>
          @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label for="sale_date">Sale Date</label>
        <input type="date" id="sale_date" name="date" value="{{ date('Y-m-d') }}" class="form-control" required>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header d-flex justify-content-between">
        <strong>Sale Items</strong>
        <button type="button" id="add-row" class="btn btn-sm btn-primary">+ Add Product</button>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm table-bordered mb-0" id="items-table">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th width="90">Qty</th>
              <th width="120">Unit Price</th>
              <th width="100">Discount</th>
              <th width="120">Line Total</th>
              <th width="50"></th>
            </tr>
          </thead>
          <tbody>
            <!-- rows inserted dynamically -->
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-3">
      <label for="notes">Notes</label>
      <textarea id="notes" name="notes" class="form-control"></textarea>
    </div>

    <div class="mt-4 p-3 bg-light rounded">
      <strong>Subtotal:</strong> <span id="subtotal">0.00</span> |
      <strong>Total Discount:</strong> <span id="discount_total">0.00</span> |
      <strong>Grand Total:</strong> <span id="grand_total">0.00</span>
    </div>

    <div class="mt-3">
      <button id="save-sale" type="button" class="btn btn-success">💾 Save Sale</button>
      <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
  let products = @json(\App\Models\Product::select('id','name','price')->get());

  function productOptions(){
    return products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('');
  }

  function addRow(prefill = {}) {
    const row = $(`
      <tr>
        <td>
          <select name="items[][product_id]" class="form-control product-select" required>
            <option value="">-- Select --</option>
            ${productOptions()}
          </select>
        </td>
        <td><input type="number" name="items[][quantity]" class="form-control qty" value="${prefill.quantity||1}" min="1"></td>
        <td><input type="number" step="0.01" name="items[][unit_price]" class="form-control unit_price" value="${prefill.price||0}"></td>
        <td><input type="number" step="0.01" name="items[][discount]" class="form-control discount" value="${prefill.discount||0}"></td>
        <td class="line-total">0.00</td>
        <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
      </tr>
    `);
    $('#items-table tbody').append(row);
    recalcAll();
  }

  // Add new row
  $('#add-row').on('click', function(){ addRow(); });

  // Remove row
  $('#items-table').on('click', '.remove-row', function(){
    $(this).closest('tr').remove();
    recalcAll();
  });

  // Set unit price when product selected
  $('#items-table').on('change', '.product-select', function(){
    const $tr = $(this).closest('tr');
    const productId = $(this).val();
    if(!productId) return;
    const p = products.find(x => x.id == productId);
    if(p){
      $tr.find('.unit_price').val(parseFloat(p.price).toFixed(2));
      recalcRow($tr);
    } else {
      $.getJSON(`{{ url('sales/product') }}/${productId}/price`, function(resp){
        $tr.find('.unit_price').val(parseFloat(resp.price).toFixed(2));
        recalcRow($tr);
      });
    }
  });

  // Recalculate row
  $('#items-table').on('input', '.qty, .unit_price, .discount', function(){
    recalcRow($(this).closest('tr'));
  });

  function recalcRow($tr){
    const qty = parseFloat($tr.find('.qty').val() || 0);
    const price = parseFloat($tr.find('.unit_price').val() || 0);
    const discount = parseFloat($tr.find('.discount').val() || 0);
    const lineTotal = (qty * price) - discount;
    $tr.find('.line-total').text(lineTotal.toFixed(2));
    recalcAll();
  }

  function recalcAll(){
    let subtotal = 0, discount_total = 0, grand = 0;
    $('#items-table tbody tr').each(function(){
      const qty = parseFloat($(this).find('.qty').val() || 0);
      const price = parseFloat($(this).find('.unit_price').val() || 0);
      const discount = parseFloat($(this).find('.discount').val() || 0);
      subtotal += qty * price;
      discount_total += discount;
    });
    grand = subtotal - discount_total;
    $('#subtotal').text(subtotal.toFixed(2));
    $('#discount_total').text(discount_total.toFixed(2));
    $('#grand_total').text(grand.toFixed(2));
  }

  // Initial row
  addRow();

  // Submit via AJAX
  $('#save-sale').on('click', function(){
    const items = [];
    $('#items-table tbody tr').each(function(){
      const product_id = $(this).find('.product-select').val();
      if(!product_id) return;
      items.push({
        product_id: parseInt(product_id),
        quantity: parseInt($(this).find('.qty').val() || 0),
        unit_price: parseFloat($(this).find('.unit_price').val() || 0),
        discount: parseFloat($(this).find('.discount').val() || 0),
      });
    });

    const payload = {
      _token: $('input[name=_token]').val(),
      user_id: $('#customer').val(),
      sale_date: $('#sale_date').val(),
      notes: $('#notes').val(),
      items: items
    };

    $.ajax({
      url: "{{ route('sales.store') }}",
      method: "POST",
      data: JSON.stringify(payload),
      contentType: "application/json",
      success: function(res){
        alert(res.message || 'Sale saved successfully');
        window.location.href = "{{ route('sales.index') }}";
      },
      error: function(xhr){
        const err = xhr.responseJSON;
        if(err && err.errors){
          let msg = Object.values(err.errors).flat().join("\n");
          alert(msg);
        } else {
          alert('An error occurred');
        }
      }
    });
  });
});
</script>
@endpush
