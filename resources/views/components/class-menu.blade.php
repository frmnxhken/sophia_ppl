<div class="col-md-4 mb-3">
    <ul class="list-group w-100 d-flex flex-row flex-md-column">
        <li class="list-group-item flex-fill w-100 text-center text-md-start fs-vs">
            <a class="nav-link" href="{{ route('memberClass', $id) }}">Anggota</a>
        </li>
        <li class="list-group-item flex-fill w-100 text-center text-md-start fs-vs">
            <a href="{{ route("assignmentClass", $id) }}" class="nav-link">Tugas</a>
        </li>
        @if($isAuthor)
        <li class="list-group-item flex-fill w-100 text-center text-md-start fs-vs" data-bs-toggle="modal" data-bs-target="#codeClass">Kode</li>
        <li class="list-group-item flex-fill w-100 text-center text-md-start fs-vs">
            <a href="{{ route('setting', $id) }}" class="nav-link">Pengaturan</a>
        </li>
        @else
        <li class="list-group-item flex-fill w-100 text-center text-md-start fs-vs">Keluar</li>
        @endif
    </ul>
</div>