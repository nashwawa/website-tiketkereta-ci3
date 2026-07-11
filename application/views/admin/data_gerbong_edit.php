<div class="container mt-5">
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 text-primary">Edit Gerbong</h4>
            <form method="post" action="<?= site_url('admin/gerbong/update'); ?>">
                <div class="row mb-3">
                    <!-- Dropdown Pilih Kereta -->
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 16px;">Kereta</label>
                        <select name="kereta_id" class="form-control" required>
                            <option value="">-- Pilih Kereta --</option>
                            <?php foreach ($kereta as $k): ?>
                                <option value="<?= $k->id ?>" <?= ($gerbong->kereta_id == $k->id) ? 'selected' : '' ?>>
                                    <?= $k->nama ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Input Kode Gerbong -->
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 16px;">Kode Gerbong</label>
                        <input type="text" name="nama_kode" class="form-control"
                               value="<?= $gerbong->nama_kode; ?>" required>
                    </div>
                </div>
                
                <!-- Jumlah Kursi -->
                <div class="mb-3">
                    <label class="form-label" style="font-size: 16px;">Jumlah Kursi</label>
                    <input type="number" name="jumlah_kursi" class="form-control"
                           value="<?= $gerbong->jumlah_kursi; ?>" required>
                </div>

                <!-- Hidden ID -->
                <input type="hidden" name="id" value="<?= $gerbong->id; ?>">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
