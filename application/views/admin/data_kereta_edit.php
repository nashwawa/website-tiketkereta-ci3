<div class="container mt-5">
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 text-primary">Edit kereta</h4>
            <form method="post" action="<?= site_url('admin/kereta/update'); ?>" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 19px;">Name</label>
                        <input type="text" name="nama" class="form-control" value="<?= $kereta->nama; ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" style="font-size: 19px;">Jumlah Gerbong</label>
                    <input type="text" name="jumlah_gerbong" class="form-control" value="<?= $kereta->jumlah_gerbong; ?>">
                </div>

                <input type="hidden" name="id" value="<?= $kereta->kereta_id; ?>">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
