<div class="modal fade" id="createInformation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="fw-bold fs-5">Buat Informasi</h1>
                <form action="{{ route('createInformation', $id) }}" method="post" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Informasi</label>
                        <textarea class="form-control" name="content" rows="4" placeholder="Tuliskan informasi.."></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Post</button>
                </form>
            </div>
        </div>
    </div>
</div>