<div class="dropdown">
    <a class="btn dropdown-toggle"
        href="#"
        role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa-solid fa-plus"></i>
        New
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item"
                data-bs-toggle="modal"
                data-bs-target="#createInformation">
                Pengumuman
            </a>
        </li>
        <li>
            <a class="dropdown-item"
                href="{{ route('createAssignment', $id) }}">
                Tugas
            </a>
        </li>
        <li>
            <a class="dropdown-item"
                href="{{ route('createMaterial', $id) }}">
                Materi
            </a>
        </li>
    </ul>
</div>