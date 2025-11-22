@extends('profile.layout')
@section('content')

<h4 class="fw-bold fs-5 mb-5">Edit your profile</h4>

<form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"
                value="{{ old('firstname', Auth::user()->firstname) }}">
            @error('firstname')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control  @error('lastname') is-invalid @enderror"
                value="{{ old('lastname', Auth::user()->lastname) }}">
            @error('lastname')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror"
                value="{{ old('email', Auth::user()->email) }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Photo Profile</label>
            <input type="file" name="photo" id="photoInput" class="form-control  @error('photo') is-invalid @enderror">
            @error('photo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <button class="btn btn-dark">Save Changes</button>
        <a class="fs-vs" href="{{ route('changePassword') }}">Update Password?</a>
    </div>
</form>

<script>
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const imgURL = URL.createObjectURL(file);
        document.getElementById('photoPreview').src = imgURL;
    });
</script>

@endsection