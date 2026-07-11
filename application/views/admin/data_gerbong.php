<!-- Tombol Tambah gerbong -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahgerbongModal">
  <i class="bi bi-plus-circle"></i> Tambah Gerbong
</button>

<!-- Modal Tambah Gerbong -->
<div class="modal fade" id="tambahgerbongModal" tabindex="-1" aria-labelledby="tambahgerbongLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-bold" id="tambahgerbongLabel"><i class="bi bi-box-seam"></i> Tambah Data Gerbong</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('admin/gerbong/simpan') ?>" method="post">
        <div class="modal-body">
          <div class="row g-3">

            <!-- Dropdown Pilih Kereta -->
            <div class="col-md-6">
              <label for="kereta_id" class="form-label">Kereta</label>
              <select name="kereta_id" id="kereta_id" class="form-control rounded-pill shadow-sm" required>
                <option value="">-- Pilih Kereta --</option>
                <?php foreach ($kereta as $k) : ?>
                  <option value="<?= $k->kereta_id ?>"><?= $k->nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Nama Kode Gerbong -->
            <div class="col-md-6">
              <label for="nama_kode" class="form-label">Kode Gerbong</label>
              <input type="text" class="form-control rounded-pill shadow-sm" id="nama_kode" name="nama_kode"
                placeholder="Misal: G1, G2, G3" required>
            </div>

            <!-- Jumlah Kursi -->
            <div class="col-md-6">
              <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
              <input type="number" class="form-control rounded-pill shadow-sm" id="jumlah_kursi" name="jumlah_kursi"
                placeholder="Masukkan jumlah kursi" required>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-light rounded-pill px-4">Reset</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Table Modern -->
<div class="card shadow-sm border-0 rounded-4">
  <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-table"></i> Data Gerbong</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Kereta</th>
            <th>Kode Gerbong</th>
            <th>Jumlah Kursi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($gerbong as $g) : ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $g['nama_kereta'] ?></td>
            <td><?= $g['nama_kode'] ?></td>
            <td><?= $g['jumlah_kursi'] ?></td>
            <td>
              <a href="javascript:void(0)" onclick="konfirmasiHapus('<?= site_url('admin/gerbong/delete_data/' . $g['gerbong_id']); ?>')" class="btn btn-sm btn-outline-danger rounded-pill">
                <i class="bi bi-trash"></i> Hapus
              </a>
              <a href="<?= site_url('admin/gerbong/edit/' . $g['gerbong_id']); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                <i class="bi bi-pencil"></i> Edit
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Custom Style -->
<style>
  .modal-content { border-radius: 15px; }
  .form-control { font-size: 14px; padding: 10px 15px; }
  .table thead th { font-size: 13px; text-transform: uppercase; letter-spacing: 0.05rem; }
  .table tbody td { font-size: 14px; }
  .btn { font-size: 13px; }
</style>

<!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script konfirmasi hapus -->
<script>
  function konfirmasiHapus(url) {
    Swal.fire({
      title: 'Yakin hapus data?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  }
</script>
