<!-- Table Modern -->
<div class="card shadow-sm border-0 rounded-4">
  <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 text-primary fw-bold">
      <i class="bi bi-table"></i> Data Pemesanan
    </h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Penumpang</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Kereta</th>
            <th>Stasiun Awal</th>
            <th>Stasiun Akhir</th>
            <th>Jam Berangkat</th>
            <th>Jam Sampai</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($pemesanan as $p): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($p->nama) ?></td>
            <td><?= htmlspecialchars($p->email) ?></td>
            <td><?= htmlspecialchars($p->no_tlp) ?></td>
            <td><?= htmlspecialchars($p->nama_kereta) ?></td>
            <td><?= htmlspecialchars($p->stasiun_awal) ?></td>
            <td><?= htmlspecialchars($p->stasiun_akhir) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($p->jam_berangkat)) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($p->jam_sampai)) ?></td>
            <td><?= (int) $p->jumlah_penumpang ?></td>
            <td>Rp <?= number_format($p->total_harga, 0, ',', '.') ?></td>
            <td>
              <?php if ($p->status_pembayaran == 'belum_bayar'): ?>
                <span class="badge bg-danger">Belum Bayar</span>
              <?php elseif ($p->status_pembayaran == 'menunggu_konfirmasi'): ?>
                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
              <?php else: ?>
                <span class="badge bg-success">Sudah Bayar</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($p->bukti_pembayaran): ?>
                <a href="<?= base_url('assets/uploads/'.$p->bukti_pembayaran) ?>" 
                   target="_blank" 
                   class="btn btn-sm btn-info">
                  <i class="bi bi-eye"></i> Lihat Bukti
                </a>
              <?php else: ?>
                <span class="text-muted">-</span>
              <?php endif; ?>

              <?php if ($p->status_pembayaran == 'menunggu_konfirmasi'): ?>
                <a href="<?= base_url('admin/pemesanan/konfirmasi/'.$p->pemesanan_id) ?>" 
                   class="btn btn-sm btn-success"
                   onclick="return confirm('Konfirmasi pembayaran ini?')">
                  <i class="bi bi-check-circle"></i> Konfirmasi
                </a>
              <?php endif; ?>
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
  .modal-content {
    border-radius: 15px;
  }
  .form-control {
    font-size: 14px;
    padding: 10px 15px;
  }
  .table thead th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.05rem;
  }
  .table tbody td {
    font-size: 14px;
  }
  .btn {
    font-size: 13px;
  }
</style>

<!-- SweetAlert2 -->
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
