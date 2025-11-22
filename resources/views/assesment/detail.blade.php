<x-layout>
    <div class="mw-md py-4">
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="d-flex gap-3">
                    <div class="d-none d-lg-block">
                        <img class="rounded-circle object-fit-cover" width="40" height="40" src="https://i.pinimg.com/736x/68/d8/20/68d820546cdbda38f0ac2e5c481f73b7.jpg">
                    </div>
                    <div class="w-100">
                        <h2 class="fs-5 fw-bold mt-2">
                            {{ $submission->user->firstname." ".$submission->user->lastname }}
                        </h2>
                        <p class="fs-vs text-muted">{{ $submission->updated_at->format("d M Y") }}</p>

                        <div class="row mt-3">
                            @foreach ($submission->files as $submissionFile)
                            <div class="col-md-6 mt-2" onclick="window.location.href=`{{ route('submissionDownload', ['id' => $id, 'id_file' => $submissionFile->id]) }}`">
                                <x-card-file :file="$submissionFile" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ route('signAssesment', ['id' => $id, 'id_submission' => $submission->id]) }}" method="post">
                    @csrf
                    @method("put")
                    <div class="mb-3">
                        <label for="" class="label-form">{{ $submission->score }} / 100</label>
                        <input type="number" name="score" class="form-control" value="{{ $submission->score }}">
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Sign</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>