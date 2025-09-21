@extends('layouts.masterLayout')
@section('pageTitle', 'Edit Sale')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Sale #{{ $sale->id }}</h3>

    <form id="sale-form">
        @csrf
        @method('PUT')

        <!-- Customer and Date -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer">Customer</label>
                <select id="customer" name="customer_id" class="form-control" required>
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $sale->user_id==$customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="sale_date">Sale Date</label>
                <input type="date" id="sale_date" name="date" value="{{ $sale->sale_date }}" class="form-control" required>
            </div>
        </div>

        <!-- Sale Items -->
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
                        @foreach($sale->items as $item)
                            <tr>
                                <td>
                                    <select name="items[][product_id]" class="form-control product-select" required>
                                        <option value="">-- Select --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $item->product_id==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="items[][quantity]" class="form-control qty" value="{{ $item->quantity }}" min="1"></td>
                                <td><input type="number" step="0.01" name="items[][unit_price]" class="form-control unit_price" value="{{ $item->unit_price }}"></td>
                                <td><input type="number" step="0.01" name="items[][discount]" class="form-control discount" value="{{ $item->discount }}"></td>
                                <td class="line-total">{{ number_format(($item->quantity * $item->unit_price) - $item->discount,2) }}</td>
                                <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-3">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" class="form-control">{{ $sale->notes->first()->content ?? '' }}</textarea>
        </div>

        <!-- Totals -->
        <div class="mt-4 p-3 bg-light rounded">
            <strong>Subtotal:</strong> <span id="subtotal">0.00</span> |
            <strong>Total Discount:</strong> <span id="discount_total">0.00</span> |
            <strong>Grand Total:</strong> <span id="grand_total">0.00</span>
        </div>

        <!-- Actions -->
        <div class="mt-3">
            <button type="button" id="save-sale" class="btn btn-success">💾 Update Sale</button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    let products = @json($products);

    function recalcRow($tr){
        const qty = parseFloat($tr.find('.qty').val()||0);
        const price = parseFloat($tr.find('.unit_price').val()||0);
        const discount = parseFloat($tr.find('.discount').val()||0);
        $tr.find('.line-total').text(((qty*price)-discount).toFixed(2));
        recalcAll();
    }

    function recalcAll() {
        let subtotal = 0, discount_total = 0;
        $('#items-table tbody tr').each(function() {
            const qty = parseFloat($(this).find('.qty').val()||0);
            const price = parseFloat($(this).find('.unit_price').val()||0);
            const discount = parseFloat($(this).find('.discount').val()||0);
            subtotal += qty*price;
            discount_total += discount;
        });
        $('#subtotal').text(subtotal.toFixed(2));
        $('#discount_total').text(discount_total.toFixed(2));
        $('#grand_total').text((subtotal-discount_total).toFixed(2));
    }

    // Initial recalc
    $('#items-table tbody tr').each(function(){ recalcRow($(this)); });

    // Add / Remove rows
    $('#add-row').click(function(){
        const row = $(`
            <tr>
                <td><select name="items[][product_id]" class="form-control product-select" required>
                    <option value="">-- Select --</option>
                    ${products.map(p=>`<option value="${p.id}">${p.name}</option>`).join('')}
                </select></td>
                <td><input type="number" name="items[][quantity]" class="form-control qty" value="1" min="1"></td>
                <td><input type="number" step="0.01" name="items[][unit_price]" class="form-control unit_price" value="0"></td>
                <td><input type="number" step="0.01" name="items[][discount]" class="form-control discount" value="0"></td>
                <td class="line-total">0.00</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
            </tr>
        `);
        $('#items-table tbody').append(row);
    });

    $('#items-table').on('click', '.remove-row', function(){ $(this).closest('tr').remove(); recalcAll(); });
    $('#items-table').on('input', '.qty,.unit_price,.discount', function(){ recalcRow($(this).closest('tr')); });

    // Submit update via AJAX
    $('#save-sale').click(function(){
        const items = [];
        $('#items-table tbody tr').each(function(){
            const product_id = $(this).find('.product-select').val();
            if(!product_id) return;
            items.push({
                product_id: parseInt(product_id),
                quantity: parseInt($(this).find('.qty').val()||0),
                unit_price: parseFloat($(this).find('.unit_price').val()||0),
                discount: parseFloat($(this).find('.discount').val()||0)
            });
        });

        const payload = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            customer_id: $('#customer').val(),
            date: $('#sale_date').val(),
            notes: $('#notes').val(),
            items: items
        };

        $.ajax({
            url: "{{ route('sales.update', $sale->id) }}",
            method: "POST",
            data: JSON.stringify(payload),
            contentType: "application/json",
            success: function(res){ alert(res.message || 'Sale updated'); window.location.href = "{{ route('sales.index') }}"; },
            error: function(xhr){
                const err = xhr.responseJSON;
                if(err && err.errors){ alert(Object.values(err.errors).flat().join("\n")); }
                else { alert('Error updating sale'); }
            }
        });
    });
});

// Update unit price when product changes
$('#items-table').on('change', '.product-select', function(){
    const $tr = $(this).closest('tr');
    const productId = $(this).val();
    if(!productId) return;

    const product = products.find(p => p.id == productId);
    if(product){
        $tr.find('.unit_price').val(parseFloat(product.price).toFixed(2));
        recalcRow($tr);
    } else {
        $.getJSON(`/sales/product/${productId}/price`, function(resp){
            $tr.find('.unit_price').val(parseFloat(resp.price).toFixed(2));
            recalcRow($tr);
        });
    }
});

</script>
@endpush
