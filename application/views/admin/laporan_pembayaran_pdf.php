<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Pembayaran</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    th { background: #f0f0f0; }
  </style>
</head>
<body>
  <h2>Laporan Pembayaran</h2>
  <?php if($tgl_awal && $tgl_akhir): ?>
    <p>Periode: <?= $tgl_awal ?> s/d <?= $tgl_akhir ?></p>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Kereta</th>
        <th>Jadwal</th>
        <th>User</th>
        <th>Penumpang</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($laporan as $l): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $l->nama_kereta ?></td>
        <td><?= $l->stasiun_awal ?> - <?= $l->stasiun_akhir ?><br>
            <?= date('d-m-Y H:i', strtotime($l->jam_berangkat)) ?></td>
        <td><?= $l->nama_user ?><br>NIK: <?= $l->nik_user ?><br>No HP: <?= $l->no_telp ?></td>
        <td>
          <?php foreach($l->penumpang as $p): ?>
            <?= $p->nama ?> (<?= $p->nik ?>)<br>
            Email: <?= $p->email ?>, Telp: <?= $p->no_tlp ?><br>
          <?php endforeach; ?>
        </td>
        <td><?= $l->jumlah_penumpang ?></td>
        <td>Rp <?= number_format($l->total_harga,0,',','.') ?></td>
        <td><?= ucfirst($l->status_pembayaran) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
