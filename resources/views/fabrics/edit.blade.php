@extends('layouts.masterLayout')
@section('pageTitle') Edit Fabric @endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Fabric</h2>

    <form action="{{ route('fabrics.update', $fabric->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select form-control select2" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $fabric->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Fabric No</label>
            <input type="text" name="fabric_no" class="form-control" value="{{ $fabric->fabric_no }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Composition</label>
            <input type="text" name="composition" class="form-control" value="{{ $fabric->composition }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">GSM</label>
            <input type="number" name="gsm" class="form-control" value="{{ $fabric->gsm }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">QTY</label>
            <input type="number" name="qty" class="form-control" value="{{ $fabric->qty }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Cuttable Width</label>
            <input type="number" name="cuttable_width" class="form-control" value="{{ $fabric->cuttable_width }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Production Type</label>
            <select name="production_type" class="form-select form-control" required>
                <option value="Dyeing" {{ $fabric->production_type == 'Dyeing' ? 'selected' : '' }}>Dyeing</option>
                <option value="Knitting" {{ $fabric->production_type == 'Knitting' ? 'selected' : '' }}>Knitting</option>
                <option value="Weaving" {{ $fabric->production_type == 'Weaving' ? 'selected' : '' }}>Weaving</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Fabric Image</label><br>
            @if($fabric->image_path && file_exists(storage_path('app/public/'.$fabric->image_path)))
                <img src="{{ asset('storage/'.$fabric->image_path) }}" class="img-thumbnail mb-2" width="100">
            @else
                <img src="{{ asset('assets/images/default.jpg') }}" class="img-thumbnail mb-2" width="100">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Optional Fields -->
        <div class="col-md-6">
            <label class="form-label">Construction</label>
            <input type="text" name="construction" class="form-control" value="{{ $fabric->construction }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Color Pantone Code</label>
            <input type="text" name="color_pantone" class="form-control" value="{{ $fabric->color_pantone }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Weave Type</label>
            <input type="text" name="weave_type" class="form-control" value="{{ $fabric->weave_type }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Finish Type</label>
            <input type="text" name="finish_type" class="form-control" value="{{ $fabric->finish_type }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Dyeing Method</label>
            <input type="text" name="dyeing_method" class="form-control" value="{{ $fabric->dyeing_method }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Printing Method</label>
            <input type="text" name="printing_method" class="form-control" value="{{ $fabric->printing_method }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Lead Time</label>
            <input type="text" name="lead_time" class="form-control" value="{{ $fabric->lead_time }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">MOQ</label>
            <input type="number" name="moq" class="form-control" value="{{ $fabric->moq }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Shrinkage (%)</label>
            <input type="number" step="0.01" name="shrinkage" class="form-control" value="{{ $fabric->shrinkage }}">
        </div>

        <div class="col-md-12">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control">{{ $fabric->remarks }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Fabric Selected By</label>
            <input type="text" name="fabric_selected_by" class="form-control" value="{{ $fabric->fabric_selected_by }}">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Update Fabric
            </button>
            <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });
</script>
@endpush
