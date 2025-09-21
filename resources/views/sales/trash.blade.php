@extends('layouts.masterLayout')
@section('pageTitle') Trash - Sales @endsection

@section('content')
<div class="container">
  <h3 class="mb-3">Deleted Sales</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Total</th>
        <th>Deleted At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sales as $sale)
      <tr>
        <td>{{ $sale->id }}</td>
        <td>{{ $sale->customer->name ?? '-' }}</td>
        <td>{{ $sale->date }}</td>
        <td>{{ number_format($sale->grand_total,2) }} BDT</td>
        <td>{{ $sale->deleted_at->format('Y-m-d H:i') }}</td>
        <td>
            <button class="btn btn-sm btn-success restore-sale" data-id="{{ $sale->id }}">Restore</button>
            <button class="btn btn-sm btn-danger force-delete-sale" data-id="{{ $sale->id }}">Delete</button>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">No deleted sales found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $sales->links() }}
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('.restore-sale').on('click', function() {
        if(!confirm('Are you sure you want to restore this sale?')) return;

        let saleId = $(this).data('id');
        let $row = $(this).closest('tr');

        $.ajax({
            url: `/sales/${saleId}/restore`,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res){
                alert(res.message || 'Sale restored successfully.');
                $row.remove(); // remove row from table
            },
            error: function(xhr){
                alert('An error occurred while restoring.');
            }
        });
    });

    $('.force-delete-sale').on('click', function() {
        if(!confirm('Are you sure? This will permanently delete the sale!')) return;

        let saleId = $(this).data('id');
        let $row = $(this).closest('tr');

        $.ajax({
            url: `/sales/${saleId}/force-delete`,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res){
                alert(res.message || 'Sale permanently deleted.');
                $row.remove(); 
            },
            error: function(xhr){
                alert('An error occurred while deleting.');
            }
        });
    });

});
</script>
@endpush

