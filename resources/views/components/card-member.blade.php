@props(['member', 'isAuthor', "id"])
<div class="d-flex gap-3 align-items-center justify-content-between">
    <div class="d-flex gap-3 align-items-center">
        <img class="rounded-circle object-fit-cover" width="40" height="40" src="{{ $member->user->photo }}">
        <p class="fs-6 mt-3">{{ $member->user->firstname." ".$member->user->lastname }}</p>
    </div>
    @if($isAuthor)
    <form action="{{ route('bannedMember', ['id' => $id, 'id_user' => $member->user->id]) }}" method="post">
        @csrf
        @method('delete')
        <button onclick="return confirm('Anda yakin ingin menendangnya?')" class="badge bg-danger border-0">Kick</button>
    </form>
    @endif
</div>