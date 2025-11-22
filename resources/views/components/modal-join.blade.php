<div class="modal fade" id="joinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="{{ route('joinClass') }}">
                    @csrf

                    <h1 class="fw-bold fs-5" id="exampleModalLabel">Gabung Kelas</h1>
                    <div class="bg-light p-4 mt-4">
                        <label class="form-label">Kode kelas</label>
                        <input type="text" name="code" class="form-control" placeholder="Kode kelas">
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Gabung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>