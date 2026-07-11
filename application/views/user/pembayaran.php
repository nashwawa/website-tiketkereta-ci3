<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $judul_halaman ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4"><?= $judul_halaman ?></h3>

    <?php if ($this->session->flashdata('alert')): ?>
        <?= $this->session->flashdata('alert'); ?>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Kereta</th>
                        <th>Stasiun Awal</th>
                        <th>Stasiun Akhir</th>
                        <th>Jadwal</th>
                        <th>Jumlah Penumpang</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($pemesanan)): ?>
                    <?php $no=1; foreach ($pemesanan as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p->nama_kereta; ?></td>
                            <td><?= $p->stasiun_awal; ?></td>
                            <td><?= $p->stasiun_akhir; ?></td>
                            <td>
                                <?= date('d-m-Y H:i', strtotime($p->jam_berangkat)); ?>
                                <br> s/d <br>
                                <?= date('d-m-Y H:i', strtotime($p->jam_sampai)); ?>
                            </td>
                            <td><?= $p->jumlah_penumpang; ?></td>
                            <td>Rp <?= number_format($p->total_harga,0,',','.'); ?></td>
                            <td>
                                <?php if ($p->status_pembayaran == 'belum_bayar'): ?>
                                    <span class="badge bg-danger">Belum Bayar</span>
                                <?php elseif ($p->status_pembayaran == 'menunggu_konfirmasi'): ?>
                                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                <?php elseif ($p->status_pembayaran == 'lunas'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('user/pembayaran/detail/'.$p->pemesanan_id); ?>" 
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Belum ada pemesanan.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
