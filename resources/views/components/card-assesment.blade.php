@props(['submission', 'id'])
<div class="card p-4">
    <div class="d-flex gap-3 align-items-start">
        <div>
            <img class="rounded-circle object-fit-cover" width="45" height="45" src="{{ asset($submission->user->photo) }}" alt="profile">
        </div>
        <div>
            <p class="fs-vs fw-bold mt-1">
                {{ $submission->user->firstname." ".$submission->user->lastname }}
            </p>
            <p class="fs-vs text-muted" style="margin-top: -18px;">
                {{ $submission->updated_at->format("d M Y") }}
            </p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <p class="fs-6 fw-bold">{{ $submission->score }}/100</p>
        <a href="{{ route('submissionDetail', ['id' => $id, 'id_submission' => $submission->id]) }}">Lihat</a>
    </div>
</div>