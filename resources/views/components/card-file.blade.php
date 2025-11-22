@props(['file', 'deleted' => false])
@php
if (!function_exists('formatSize')) {
function formatSize($bytes) {
if ($bytes >= 1024*1024) return number_format($bytes/1024/1024,2).' MB';
if ($bytes >= 1024) return number_format($bytes/1024,2).' KB';
return $bytes.' B';
}
}
@endphp

<div class="d-flex align-items-center justify-content-between border rounded p-3 bg-white shadow-none mb-2" data-id="{{ $file->id }}">
    <div class="d-flex align-items-center w-100">
        <i class="fa-solid fa-file fs-5 text-danger me-3 flex-shrink-0"></i>
        <div class="text-truncate w-100">
            <p class="fs-vs fw-bold mb-0 text-truncate">
                {{ $file->original_name }}
            </p>
            <small class="fs-vs text-muted">{{ $file->extension }} • {{ formatSize($file->size) }}</small>
        </div>
    </div>
    @if($deleted)
    <button type="button" class="btn btn-sm btn-outline-danger ms-2 delete-file-btn">Hapus</button>
    @endif
</div>