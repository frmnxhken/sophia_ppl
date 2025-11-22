<x-layout>
    <div class="mw-md py-4">
        <form method="post" action="{{ route('storeMaterial', ['id' => $id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="card p-4">
                <div class="mb-3">
                    <label class="form-label">Judul materi</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="content" rows="4"></textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="card p-4 mt-3">
                <div class="mb-3">
                    <label class="form-label">Lampiran</label>
                    <input type="file" name="files[]" multiple class="form-control" id="file-input">
                </div>

                <div id="file-preview" class="mt-3">
                    @if(session('uploadedFiles'))
                    @foreach(session('uploadedFiles') as $file)
                    <div class="d-flex align-items-center justify-content-between border rounded p-3 bg-white shadow-none mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-file fs-5 text-danger me-3"></i>
                            <div>
                                <p class="fs-vs fw-bold mb-0">{{ $file['name'] }}</p>
                                <small class="fs-vs text-muted">{{ $file['extension'] }} • {{ $file['size'] }}MB</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button class="btn btn-dark mt-3">Post</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('/scripts') }}/preview.js"></script>
</x-layout>