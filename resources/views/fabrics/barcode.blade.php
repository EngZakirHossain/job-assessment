@extends('layouts.masterLayout')
@section('pageTitle', 'Edit Sale')

@section('content')
<div class="container">
    <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Fabrics
                </a>
    <h3 class="mb-3">Barcode for Fabric #{{ $fabric->fabric_no }}</h3>
    <div id="barcode-section" class="text-center">
        <h3>Fabric #{{ $fabric->fabric_no }}</h3>
        <img src="data:image/png;base64,{{ $barcodeImage }}" alt="barcode">
        <p>{{ $fabric->barcode }}</p>
    </div>

    <button onclick="printBarcode()" class="btn btn-dark mt-3">
        <i class="bi bi-printer"></i> Print Barcode
    </button>

</div>
@endsection

@push('scripts')
<script>
function printBarcode() {
    var content = document.getElementById('barcode-section').innerHTML;
    var printWindow = window.open('', '', 'height=400,width=600');

    printWindow.document.write('<html><head><title>Print Barcode</title>');
    printWindow.document.write('<link rel="stylesheet" href="{{ asset("css/app.css") }}">'); // optional
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');

    // Wait for content to load before printing
    printWindow.document.close();
    printWindow.focus();

    printWindow.onload = function() {
        printWindow.print();
        // printWindow.close(); // optional: remove if you want user to see it
    };
}
</script>

@endpush
