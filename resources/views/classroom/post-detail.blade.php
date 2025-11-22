<x-layout>
    <div class="mw-md py-4">
        <div class="row">
            <div class="col-md-8 mb-4">
                @if($submission && $submission->status === "graded")
                <p class="fw-bold fs-6" style="text-align: right;">{{ $submission->score }}/100</p>
                @elseif($submission && $submission->status === "done")
                <p class="text-muted fs-6" style="text-align: right;">Belum dinilai</p>
                @endif
                <div class="d-flex gap-3">
                    <div class="d-none d-lg-block">
                        <img class="rounded-circle object-fit-cover" width="40" height="40" src="{{ asset($post->user->photo) }}">
                    </div>
                    <div class="w-100">
                        @if($post->type === "assignment")
                        <h2 class="fs-5 fw-bold mt-2">Tugas: {{ $post->title }}</h2>
                        @else
                        <h2 class="fs-5 fw-bold mt-2">{{ $post->title }}</h2>
                        @endif
                        <p class="fs-vs text-muted">{{ $post->user->firstname." ".$post->user->lastname }} . {{ $post->created_at->format("d M Y") }}</p>
                        <div class="fs-6">
                            {{ $post->content }}
                        </div>

                        <div class="row mt-3">
                            @foreach ($postFiles as $postFile)
                            <div class="col-md-6 mt-2" onclick="window.location.href=`{{ route('fileDownload', ['id' => $id, 'id_file' => $postFile->id]) }}`">
                                <x-card-file :file="$postFile" />
                            </div>
                            @endforeach
                        </div>

                        @if($post->type === "assignment")
                        <div class="w-100 mt-4 d-flex justify-content-between align-items-center">
                            <p class="fs-6 fw-bold">100 Poin</p>
                            <p class="fs-vs text-muted mt-1">Berakhir: {{ $post->due }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($post->type === "assignment" && $submission && $submission->status === "pending")
            <div class="col-md-4">
                <div class="card p-4">
                    <form method="POST" action="{{ route('storeSubmission', ['id' => $id, 'id_post' => $post->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div id="file-preview" class="mt-3"></div>
                        <div class="mb-3">
                            <label class="form-label">Tambahkan Tugas</label>
                            <input type="file" name="files[]" multiple class="form-control @error('files') is-invalid @enderror" id="file-input">
                            @error('files')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-dark w-100 mt-2">
                            Assign
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @if($post->type === "assignment" && $isAuthor)
            <div class="col-md-4">
                <a href="{{ route('assesments', ['id' => $id, 'id_post' => $post->id]) }}" class="btn btn-dark w-100">Lihat Pengumpulan</a>
            </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('/scripts') }}/preview.js"></script>
</x-layout>