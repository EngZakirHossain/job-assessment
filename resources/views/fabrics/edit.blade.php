@extends('layouts.masterLayout')
@section('pageTitle') Edit Fabric @endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Fabric</h2>
    <form action="{{ route('fabrics.update', $fabric->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Fabric Details -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label">Fabric No</label>
                                <input type="text" name="fabric_no" value="{{ old('fabric_no', $fabric->fabric_no) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Supplier</label>
                                <select name="supplier_id" class="form-select form-control select2" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $fabric->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Composition</label>
                                <input type="text" name="composition" value="{{ old('composition', $fabric->composition) }}" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">GSM</label>
                                <input type="number" name="gsm" value="{{ old('gsm', $fabric->gsm) }}" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">QTY</label>
                                <input type="number" name="qty" value="{{ old('qty', $fabric->qty) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Cuttable Width</label>
                                <input type="number" name="cuttable_width" value="{{ old('cuttable_width', $fabric->cuttable_width) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Production Type</label>
                                <select name="production_type" class="form-select form-control" required>
                                    <option value="Dyeing" {{ old('production_type', $fabric->production_type) == 'Dyeing' ? 'selected' : '' }}>Dyeing</option>
                                    <option value="Knitting" {{ old('production_type', $fabric->production_type) == 'Knitting' ? 'selected' : '' }}>Knitting</option>
                                    <option value="Weaving" {{ old('production_type', $fabric->production_type) == 'Weaving' ? 'selected' : '' }}>Weaving</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Fabric Image</label><br>
                                @if($fabric->image_path && file_exists(storage_path('app/public/'.$fabric->image_path)))
                                    <img src="{{ asset('storage/'.$fabric->image_path) }}" class="img-thumbnail mb-2" width="100">
                                @else
                                    <img src="{{ asset('assets/images/default.jpg') }}" class="img-thumbnail mb-2" width="100">
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control">{{ old('remarks', $fabric->remarks) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Fabric Info -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Construction</label>
                                <input type="text" name="construction" value="{{ old('construction', $fabric->construction) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Color Pantone Code</label>
                                <input type="text" name="color_pantone" value="{{ old('color_pantone', $fabric->color_pantone) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Weave Type</label>
                                <input type="text" name="weave_type" value="{{ old('weave_type', $fabric->weave_type) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Finish Type</label>
                                <input type="text" name="finish_type" value="{{ old('finish_type', $fabric->finish_type) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Dyeing Method</label>
                                <input type="text" name="dyeing_method" value="{{ old('dyeing_method', $fabric->dyeing_method) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Printing Method</label>
                                <input type="text" name="printing_method" value="{{ old('printing_method', $fabric->printing_method) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Lead Time (Days)</label>
                                <input type="text" name="lead_time_days" value="{{ old('lead_time_days', $fabric->lead_time_days) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">MOQ</label>
                                <input type="number" name="moq" value="{{ old('moq', $fabric->moq) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Shrinkage (%)</label>
                                <input type="number" step="0.01" name="shrinkage" value="{{ old('shrinkage', $fabric->shrinkage) }}" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Fabric Selected By</label>
                                <input type="text" name="fabric_selected_by" value="{{ old('fabric_selected_by', $fabric->fabric_selected_by) }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-end mt-3">
                    <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Fabric</button>
                </div>
            </div>
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
