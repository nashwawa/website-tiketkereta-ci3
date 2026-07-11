<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $judul_halaman ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Detail Pemesanan</h3>

    <?php if ($this->session->flashdata('alert')): ?>
        <?= $this->session->flashdata('alert'); ?>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="mb-3"><?= $pemesanan->nama_kereta; ?></h5>
            <p>
                <strong>Stasiun:</strong> <?= $pemesanan->stasiun_awal; ?> → <?= $pemesanan->stasiun_akhir; ?><br>
                <strong>Jadwal:</strong> <?= date('d-m-Y H:i', strtotime($pemesanan->jam_berangkat)); ?> 
                s/d <?= date('d-m-Y H:i', strtotime($pemesanan->jam_sampai)); ?><br>
                <strong>Total Penumpang:</strong> <?= $pemesanan->jumlah_penumpang; ?><br>
                <strong>Total Harga:</strong> Rp <?= number_format($pemesanan->total_harga, 0, ',', '.'); ?><br>
                <strong>Status:</strong>
                <?php if ($pemesanan->status_pembayaran == 'belum_bayar'): ?>
                    <span class="badge bg-danger">Belum Bayar</span>
                <?php elseif ($pemesanan->status_pembayaran == 'menunggu_konfirmasi'): ?>
                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                <?php elseif ($pemesanan->status_pembayaran == 'lunas'): ?>
                    <span class="badge bg-success">Lunas</span>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="mb-3">Daftar Penumpang</h5>
            <ul class="list-group">
                <?php foreach ($penumpang as $pn): ?>
                    <li class="list-group-item">
                        <?= $pn->nama; ?> (NIK: <?= $pn->nik; ?>, Email: <?= $pn->email; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php if ($pemesanan->status_pembayaran == 'belum_bayar'): ?>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="mb-3">Upload Bukti Pembayaran</h5>
                <?= form_open_multipart('user/pembayaran/proses_bayar'); ?>
                    <input type="hidden" name="id_pemesanan" value="<?= $pemesanan->pemesanan_id; ?>">

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="QRIS">QRIS</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Kirim</button>
                <?= form_close(); ?>
            </div>
        </div>
    <?php elseif ($pemesanan->status_pembayaran == 'menunggu_konfirmasi'): ?>
        <div class="alert alert-warning">Bukti pembayaran sudah dikirim, menunggu konfirmasi admin.</div>
    <?php elseif ($pemesanan->status_pembayaran == 'lunas'): ?>
        <div class="alert alert-success">Pembayaran sudah dikonfirmasi. Tiket Anda siap digunakan.</div>
    <?php endif; ?>
</div>

</body>
</html>
