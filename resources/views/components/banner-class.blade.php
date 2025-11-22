@props(['classroom'])

<div class="{{ $classroom->color }} p-4 rounded d-flex flex-column justify-content-between">
    <h1 class="fs-4 fw-bold text-dark">{{ $classroom->name }}</h1>
    <p class="fs-6 text-dark">{{ $classroom->description }}</p>
    <div class="mt-4">
        <p class="fs-vs text-dark">{{ $classroom->user->firstname." ".$classroom->user->lastname }}</p>
    </div>
</div>