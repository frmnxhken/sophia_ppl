@props(['classroom'])
<div class="col-lg-3">
    <div class="card p-4 {{ $classroom->color }} shadow-none border-0 h-100 card-class">
        <div class="d-flex flex-column justify-content-between h-100">
            <div>
                <a href="{{ route('detailClass', $classroom->id) }}" class="fs-5 fw-bold text-dark pe-auto">{{ $classroom->name }}</a>
                <p class="fs-vs text-dark">{{ $classroom->description }}</p>
                <span class="fs-vs mt-3">{{ $classroom->user->firstname.' '.$classroom->user->lastname }}</span>
            </div>
            <div>
                <hr>
                <div class="d-flex">
                    <i class="fa-solid fa-users"></i>
                    <p class="fs-vs" style="margin-left: 8px;">{{ $classroom->members_count }} Anggota</p>
                </div>
            </div>
        </div>
    </div>
</div>