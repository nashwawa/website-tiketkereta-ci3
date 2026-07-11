<!-- Tombol Tambah Jadwal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahjadwalModal">
  <i class="bi bi-plus-circle"></i> Tambah Jadwal
</button>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="tambahjadwalModal" tabindex="-1" aria-labelledby="tambahjadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-bold" id="tambahjadwalLabel"><i class="bi bi-calendar"></i> Tambah Data Jadwal</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('admin/jadwal/simpan') ?>" method="post">
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

            <!-- Jam Berangkat -->
            <div class="col-md-6">
              <label for="jam_berangkat" class="form-label">Jam Berangkat</label>
              <input type="datetime-local" class="form-control rounded-pill shadow-sm" 
                     id="jam_berangkat" name="jam_berangkat" required>
            </div>

            <!-- Jam Sampai -->
            <div class="col-md-6">
              <label for="jam_sampai" class="form-label">Jam Sampai</label>
              <input type="datetime-local" class="form-control rounded-pill shadow-sm" 
                     id="jam_sampai" name="jam_sampai" required>
            </div>

            <!-- Stasiun Awal -->
            <div class="col-md-6">
              <label for="stasiun_awal" class="form-label">Stasiun Awal</label>
              <input type="text" class="form-control rounded-pill shadow-sm" 
                     id="stasiun_awal" name="stasiun_awal" placeholder="Masukkan stasiun awal" required>
            </div>

            <!-- Stasiun Akhir -->
            <div class="col-md-6">
              <label for="stasiun_akhir" class="form-label">Stasiun Akhir</label>
              <input type="text" class="form-control rounded-pill shadow-sm" 
                     id="stasiun_akhir" name="stasiun_akhir" placeholder="Masukkan stasiun akhir" required>
            </div>

            <!-- Harga -->
            <div class="col-md-6">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" step="0.01" class="form-control rounded-pill shadow-sm" 
                     id="harga" name="harga" placeholder="Masukkan harga tiket" required>
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
    <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-table"></i> Data Jadwal</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th style="font-size: 14px;">No</th>
            <th style="font-size: 14px;">Nama Kereta</th>
            <th style="font-size: 14px;">Jam Berangkat</th>
            <th style="font-size: 14px;">Jam Sampai</th>
            <th style="font-size: 14px;">Stasiun Awal</th>
            <th style="font-size: 14px;">Stasiun Akhir</th>
            <th style="font-size: 14px;">Harga</th>
            <th style="font-size: 14px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($jadwal as $j) : ?>
          <tr>
            <td style="font-size: 14px;"><?= $no++ ?></td>
            <td style="font-size: 14px;"><?= $j['nama_kereta'] ?></td>
            <td style="font-size: 14px;"><?= date('d-m-Y H:i', strtotime($j['jam_berangkat'])) ?></td>
            <td style="font-size: 14px;"><?= date('d-m-Y H:i', strtotime($j['jam_sampai'])) ?></td>
            <td style="font-size: 14px;"><?= $j['stasiun_awal'] ?></td>
            <td style="font-size: 14px;"><?= $j['stasiun_akhir'] ?></td>
            <td style="font-size: 14px;">Rp <?= number_format($j['harga'], 0, ',', '.') ?></td>
            <td style="font-size: 14px;">
              <a href="javascript:void(0)" 
                 onclick="konfirmasiHapus('<?= site_url('admin/jadwal/delete_data/' . $j['kereta_id']); ?>')" 
                 class="btn btn-sm btn-outline-danger rounded-pill">
                <i class="bi bi-trash"></i> Hapus
              </a>
              <a href="<?= site_url('admin/jadwal/edit/' . $j['kereta_id']); ?>" 
                 class="btn btn-sm btn-outline-primary rounded-pill">
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

<!-- SweetAlert Konfirmasi -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
