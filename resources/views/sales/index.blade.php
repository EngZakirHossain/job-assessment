@extends('layouts.masterLayout')
@section('pageTitle') Sales List @endsection

@section('content')
<div class="container">
  <h3 class="mb-3">Sales List</h3>

  <div class="mb-3">
    <a href="{{ route('sales.create') }}" class="btn btn-success">+ Add New Sale</a>
    <a href="{{ route('sales.trash') }}" class="btn btn-warning">🗑 Trash</a>
  </div>

  <!-- Filters -->
  <form method="GET" class="row mb-3 g-2">
    <div class="col-md-3">
      <select name="customer_id" class="form-control">
        <option value="">-- All Customers --</option>
        @foreach($customers as $customer)
          <option value="{{ $customer->id }}" {{ request('customer_id')==$customer->id ? 'selected' : '' }}>
            {{ $customer->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <input type="date" name="sale_date" class="form-control" value="{{ request('sale_date') }}">
    </div>    
    <div class="col-md-3">
      <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ request('product_name') }}">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Products</th>
        <th>Total</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sales as $sale)
      <tr>
        <td>{{ $sale->id }}</td>
        <td>{{ $sale->customer->name ?? '-' }}</td>
        <td>{{ $sale->sale_date }}</td>
        <td>
          <ul class="mb-0">
            @foreach($sale->items as $item)
              <li>{{ $item->product->name ?? 'N/A' }} ({{ $item->quantity }} × {{ number_format($item->unit_price,2) }})</li>
            @endforeach
          </ul>
        </td>
        <td>{{ number_format($sale->grand_total,2) }} BDT</td>
        <td>
          <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-info">View</a>
          <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary">Edit</a>
          <button class="btn btn-sm btn-danger delete-sale" data-id="{{ $sale->id }}">Delete</button>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">No sales found.</td>
      </tr>
      @endforelse
      @if($sales->count())
      <tr class="table-secondary">
        <td colspan="4" class="text-end"><strong>Total sales:</strong></td>
        <td colspan="2"><strong>{{ number_format($pageTotal,2) }} BDT</strong></td>
      </tr>
      @endif
    </tbody>
  </table>

  {{ $sales->withQueryString()->links() }}
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {

    $('.delete-sale').on('click', function() {
        if(!confirm('Are you sure you want to delete this sale?')) return;

        let saleId = $(this).data('id');
        let $row = $(this).closest('tr');

        $.ajax({
            url: `/sales/${saleId}`,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res){
                alert(res.message || 'Sale deleted successfully.');
                $row.remove();
            },
            error: function(xhr){
                let err = xhr.responseJSON;
                if(err && err.message) alert(err.message);
                else alert('An error occurred while deleting.');
            }
        });
    });

});
</script>
@endpush
