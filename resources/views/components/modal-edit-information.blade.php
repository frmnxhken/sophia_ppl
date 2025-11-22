@props(['post', 'id'])
<div class="modal fade" id="editInformation{{ $post->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="fw-bold fs-5">Edit Informasi {{ $id }}</h1>
                <form action="{{ route('updateInformation', ['id' => $id, 'id_post' => $post->id]) }}" method="post" class="mt-4">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label">Informasi</label>
                        <textarea class="form-control" name="content" rows="4" placeholder="Tuliskan informasi..">{{ $post->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>