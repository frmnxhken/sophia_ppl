<x-layout>
    <div class="mw-md">
        <div class="card p-4">
            <form method="POST" action="{{ route('updateSetting', ['id' => $id]) }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label">Nama Kelas</label>
                    <input type="text" value="{{ $classroom->name }}" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kelas</label>
                    <textarea class="form-control" name="description" rows="4">{{ $classroom->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark mt-2">
                    Update
                </button>
            </form>
        </div>
        <form action="" class="d-flex justify-content-end">
            <button class="btn btn-outline-dark mt-2">
                Delete Class
            </button>
        </form>
    </div>
</x-layout>