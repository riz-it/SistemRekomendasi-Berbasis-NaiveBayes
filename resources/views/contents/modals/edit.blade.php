<form action="{{ route('data.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">Ubah Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="data">Data Ke</label>
                    <input type="number" min="0" value="{{ $data->data_to }}" name="data_ke" class="form-control"
                        id="data">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="name">Nama Barang</label>
                    <input type="text" value="{{ $data->stock_name }}" class="form-control" name="nama_barang"
                        id="nama_barang" placeholder="Nama Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="awal">Stok Awal</label>
                    <input type="number" min="0" value="{{ $data->first_stock }}" class="form-control"
                        name="stok_awal" id="awal">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="masuk">Masuk</label>
                    <input type="number" min="0" value="{{ $data->stock_in }}" class="form-control" name="stok_masuk"
                        id="masuk">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="keluar">Keluar</label>
                    <input type="number" min="0" value="{{ $data->stock_out }}" class="form-control"
                        name="stok_keluar" id="keluar">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="akhir">Stok Akhir</label>
                    <input type="number" min="0" value="{{ $data->last_stock }}" class="form-control"
                        name="stok_akhir" id="akhir">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
</form>
