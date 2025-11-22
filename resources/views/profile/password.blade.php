@extends('profile.layout')
@section('content')

<h4 class="fw-bold fs-5 mb-5">Change Password</h4>

<form action="{{ route('updatePassword') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label">Current Password</label>
            <input type="password"
                name="current_password"
                class="form-control @error('current_password') is-invalid @enderror">

            @error('current_password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">New Password</label>
            <input type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror">

            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <button class="btn btn-dark">Update Password</button>
    </div>
</form>

@endsection