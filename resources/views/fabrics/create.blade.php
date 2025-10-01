@extends('layouts.masterLayout')
@section('pageTitle') Create Fabrics  @endsection
@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
<div class="container">
    <h2 class="mb-4">Add Fabric</h2>

    <form action="{{ route('fabrics.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select form-control select2" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Fabric No</label>
            <input type="text" name="fabric_no" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Composition</label>
            <input type="text" name="composition" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">GSM</label>
            <input type="number" name="gsm" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">QTY</label>
            <input type="number" name="qty" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Cuttable Width</label>
            <input type="number" name="cuttable_width" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Production Type</label>
            <select name="production_type" class="form-select form-control" required>
                <option value="Dyeing">Dyeing</option>
                <option value="Knitting">Knitting</option>
                <option value="Weaving">Weaving</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Fabric Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Optional Fields -->
        <div class="col-md-6">
            <label class="form-label">Construction</label>
            <input type="text" name="construction" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Color Pantone Code</label>
            <input type="text" name="color_pantone" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Weave Type</label>
            <input type="text" name="weave_type" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Finish Type</label>
            <input type="text" name="finish_type" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Dyeing Method</label>
            <input type="text" name="dyeing_method" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Printing Method</label>
            <input type="text" name="printing_method" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Lead Time</label>
            <input type="text" name="lead_time_days" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">MOQ</label>
            <input type="number" name="moq" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Shrinkage (%)</label>
            <input type="number" step="0.01" name="shrinkage" class="form-control">
        </div>

        <div class="col-md-12">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Fabric Selected By</label>
            <input type="text" name="fabric_selected_by" class="form-control">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Save Fabric
            </button>
            <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Supplier",
            allowClear: true,
            width: '100%' // make it full width
        });
    });
</script>


@endpush
