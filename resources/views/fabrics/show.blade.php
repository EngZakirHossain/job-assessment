@extends('layouts.masterLayout')
@section('pageTitle') Fabric Details @endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Fabric Details</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <!-- Supplier -->
                <div class="col-md-6">
                    <label class="form-label">Supplier</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->supplier->company_name ?? 'N/A' }}
                    </p>
                </div>

                <!-- Fabric No -->
                <div class="col-md-6">
                    <label class="form-label">Fabric No</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->fabric_no }}
                    </p>
                </div>

                <!-- Composition -->
                <div class="col-md-6">
                    <label class="form-label">Composition</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->composition }}
                    </p>
                </div>

                <!-- GSM -->
                <div class="col-md-3">
                    <label class="form-label">GSM</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->gsm }}
                    </p>
                </div>

                <!-- Qty -->
                <div class="col-md-3">
                    <label class="form-label">QTY</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->qty }}
                    </p>
                </div>

                <!-- Cuttable Width -->
                <div class="col-md-4">
                    <label class="form-label">Cuttable Width</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->cuttable_width }}
                    </p>
                </div>

                <!-- Production Type -->
                <div class="col-md-4">
                    <label class="form-label">Production Type</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->production_type }}
                    </p>
                </div>

                <!-- Fabric Image -->
                <div class="col-md-4">
                    <label class="form-label">Fabric Image</label><br>
                    @if($fabric->image_path && file_exists(storage_path('app/public/'.$fabric->image_path)))
                        <img src="{{ asset('storage/'.$fabric->image_path) }}" class="img-thumbnail mb-2" width="100">
                    @else
                        <img src="{{ asset('assets/images/default.jpg') }}" class="img-thumbnail mb-2" width="100">
                    @endif
                </div>

                <!-- Optional Fields -->
                <div class="col-md-6">
                    <label class="form-label">Construction</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->construction ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Color Pantone Code</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->color_pantone ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Weave Type</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->weave_type ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Finish Type</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->finish_type ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dyeing Method</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->dyeing_method ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Printing Method</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->printing_method ?? '-' }}
                    </p>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Lead Time</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->lead_time ?? '-' }}
                    </p>
                </div>

                <div class="col-md-4">
                    <label class="form-label">MOQ</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->moq ?? '-' }}
                    </p>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Shrinkage (%)</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->shrinkage ?? '-' }}
                    </p>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Remarks</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->remarks ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fabric Selected By</label>
                    <p class="form-control-plaintext border p-2 bg-light">
                        {{ $fabric->fabric_selected_by ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('fabrics.edit', $fabric->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
