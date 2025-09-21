@extends('layouts.masterLayout')
@section('pageTitle', 'Sale Details')

@section('content')
<div class="container">
    <h3 class="mb-3">Sale #{{ $sale->id }} Details</h3>

    <div class="mb-3">
        <strong>Customer:</strong> {{ $sale->customer->name ?? '-' }}<br>
        <strong>Date:</strong> {{ $sale->sale_date }}<br>
        <strong>Sales Notes:</strong> 
        @if($sale->notes && $sale->notes->count())
            @foreach($sale->notes as $note)
                <div> {{ $note->content }}</div>
            @endforeach
        @else
            <div>No notes</div>
        @endif

    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price,2) }}</td>
                <td>{{ number_format($item->discount,2) }}</td>
                <td>{{ number_format(($item->quantity * $item->unit_price) - $item->discount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Grand Total</th>
                <th>{{ number_format($sale->grand_total,2) }} BDT</th>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back to Sales</a>
    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-primary">Edit Sale</a>
</div>
@endsection
