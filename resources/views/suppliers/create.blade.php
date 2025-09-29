@extends('layouts.masterLayout')
@section('pageTitle') Create Sale @endsection

@section('content')
<div class="container">
    <h3 class="mb-3">Add Supplier</h3>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Country *</label>
                <input type="text" name="country" value="{{ old('country') }}" class="form-control" required>
                @error('country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Company/Factory Name *</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" required>
                @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Code *</label>
                <input type="text" name="code" value="{{ old('code') }}" class="form-control" required>
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <hr>

        <div class="row g-3">
            <div class="col-md-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control">
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <label>Representative Name</label>
                <input type="text" name="rep_name" value="{{ old('rep_name') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Representative Email</label>
                <input type="email" name="rep_email" value="{{ old('rep_email') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Representative Phone</label>
                <input type="text" name="rep_phone" value="{{ old('rep_phone') }}" class="form-control">
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-success">Save</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')

@endpush
