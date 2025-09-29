@extends('layouts.masterLayout')
@section('pageTitle', 'Edit Sale')

@section('content')
<div class="container">
    <h2>Edit Fabric</h2>
    <form action="{{ route('fabrics.update',$fabric->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Supplier</label>
        <select name="supplier_id" class="form-control" required>
            @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ $fabric->supplier_id==$supplier->id?'selected':'' }}>
                {{ $supplier->company_name }}
            </option>
            @endforeach
        </select>

        <label>Fabric No</label>
        <input type="text" name="fabric_no" class="form-control" value="{{ $fabric->fabric_no }}" required>

        <label>Composition</label>
        <input type="text" name="composition" class="form-control" value="{{ $fabric->composition }}" required>

        <label>GSM</label>
        <input type="number" name="gsm" class="form-control" value="{{ $fabric->gsm }}" required>

        <label>QTY</label>
        <input type="number" name="qty" class="form-control" value="{{ $fabric->qty }}" required>

        <label>Cuttable Width</label>
        <input type="number" name="cuttable_width" class="form-control" value="{{ $fabric->cuttable_width }}" required>

        <label>Production Type</label>
        <select name="production_type" class="form-control" required>
            <option value="Sample Yardage" {{ $fabric->production_type=="Sample Yardage"?'selected':'' }}>Sample Yardage</option>
            <option value="SMS" {{ $fabric->production_type=="SMS"?'selected':'' }}>SMS</option>
            <option value="Bulk" {{ $fabric->production_type=="Bulk"?'selected':'' }}>Bulk</option>
        </select>

        <!-- optional fields prefilled -->
        <label>Construction</label>
        <input type="text" name="construction" class="form-control" value="{{ $fabric->construction }}">

        <label>Color Pantone Code</label>
        <input type="text" name="color_pantone_code" class="form-control" value="{{ $fabric->color_pantone_code }}">

        <label>Weave Type</label>
        <input type="text" name="weave_type" class="form-control" value="{{ $fabric->weave_type }}">

        <label>Finish Type</label>
        <input type="text" name="finish_type" class="form-control" value="{{ $fabric->finish_type }}">

        <label>Dyeing Method</label>
        <input type="text" name="dyeing_method" class="form-control" value="{{ $fabric->dyeing_method }}">

        <label>Printing Method</label>
        <input type="text" name="printing_method" class="form-control" value="{{ $fabric->printing_method }}">

        <label>Lead Time</label>
        <input type="text" name="lead_time" class="form-control" value="{{ $fabric->lead_time }}">

        <label>MOQ</label>
        <input type="number" name="moq" class="form-control" value="{{ $fabric->moq }}">

        <label>Shrinkage (%)</label>
        <input type="number" step="0.01" name="shrinkage" class="form-control" value="{{ $fabric->shrinkage }}">

        <label>Remarks</label>
        <textarea name="remarks" class="form-control">{{ $fabric->remarks }}</textarea>

        <label>Fabric Selected By</label>
        <input type="text" name="fabric_selected_by" class="form-control" value="{{ $fabric->fabric_selected_by }}">

        <label>Fabric Image</label>
        <input type="file" name="image" class="form-control">
        @if($fabric->image)
            <img src="{{ asset('storage/'.$fabric->image) }}" width="80">
        @endif

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection

@push('scripts')

@endpush
