<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $judul_halaman ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  @media print {
    .no-print { display: none !important; }
    body { margin: 0; }
    table th, table td { font-size: 11px; padding: 3px; }
  }
</style>
</head>
<body>

<div class="container">
  <div class="d-flex justify-content-between align-items-center my-3">
    <h5 class="fw-bold"><?= $judul_halaman ?></h5>
    <button onclick="window.print()" class="btn btn-success btn-sm no-print">Cetak</button>
  </div>

  <!-- Filter -->
  <form class="row g-2 mb-3 no-print" method="get">
    <div class="col-md-4">
      <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>" class="form-control" required>
    </div>
    <div class="col-md-4">
      <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>" class="form-control" required>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
  </form>

  <!-- Tabel -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>User</th>
          <th>Kereta</th>
          <th>Rute</th>
          <th>Jadwal</th>
          <th>Jml</th>
          <th>Total</th>
          <th>Status</th>
          <th>Bukti</th>
          <th>Penumpang</th>
        </tr>
      </thead>

      <tbody>
      <?php if (!empty($laporan)): ?>
        <?php $no=1; foreach($laporan as $l): ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>

          <td>
            <?= $l->nama_user ?><br>
            <small>NIK: <?= $l->nik_user ?></small><br>
            <small>Telp: <?= $l->no_telp ?></small>
          </td>

          <td><?= $l->nama_kereta ?></td>

          <td><?= $l->stasiun_awal ?> → <?= $l->stasiun_akhir ?></td>

          <td>
            <?= date('d-m-Y H:i', strtotime($l->jam_berangkat)) ?><br>
            <small>s/d <?= date('d-m-Y H:i', strtotime($l->jam_sampai)) ?></small>
          </td>

          <td class="text-center"><?= $l->jumlah_penumpang ?></td>

          <td class="text-end">Rp <?= number_format($l->total_harga,0,',','.') ?></td>

          <td class="text-center">
            <?php if ($l->status_pembayaran == 'belum_bayar'): ?>
              <span class="badge bg-danger">Belum</span>
            <?php elseif ($l->status_pembayaran == 'menunggu_konfirmasi'): ?>
              <span class="badge bg-warning text-dark">Menunggu</span>
            <?php else: ?>
              <span class="badge bg-success">Lunas</span>
            <?php endif; ?>
          </td>

          <td class="text-center">
            <?php if ($l->bukti_pembayaran): ?>
              <a href="<?= base_url('assets/uploads/'.$l->bukti_pembayaran) ?>" target="_blank" class="btn btn-info btn-sm no-print">Lihat</a>
            <?php else: ?> - <?php endif; ?>
          </td>

          <td>
            <?php if (!empty($l->penumpang)): ?>
              <?php foreach ($l->penumpang as $p): ?>
                <div>- <?= $p->nama ?> (<?= $p->nik ?>)</div>
              <?php endforeach; ?>
            <?php else: ?>
              -
            <?php endif; ?>
          </td>

        </tr>
        <?php endforeach; ?>

      <?php else: ?>
        <tr><td colspan="10" class="text-center text-muted">Tidak ada data</td></tr>
      <?php endif; ?>
      </tbody>

    </table>
  </div>
</div>

</body>
</html>
