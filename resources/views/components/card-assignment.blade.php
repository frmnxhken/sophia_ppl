@props(['post', 'id', 'isAuthor'])
<div class="card px-4 py-2">
    <div class="d-flex gap-3 align-items-start">
        <div class="mt-3">
            <img class="rounded-circle object-fit-cover" width="40" height="40" src="https://i.pinimg.com/736x/68/d8/20/68d820546cdbda38f0ac2e5c481f73b7.jpg">
        </div>
        <div class="mt-3 w-100">
            <p class="fs-vs fw-bold">{{ $post->title }}</p>
            <p style="margin-top: -20px;" class="fs-vs text-muted">
                Berakhir: {{ $post->due }}
            </p>
            @if($isAuthor)
            <div class="row mt-3">
                <hr>
                <div class="col-6 col-md-4">
                    <p class="fs-6">Mengumpulkan: <b>{{ $post->submitted }}</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <p class="fs-6">Ditugaskan: <b>{{ $post->pending }}</b></p>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('assesments', ['id' => $id, 'id_post' => $post->id]) }}" class="btn btn-dark">Lihat Pengumpulan</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>