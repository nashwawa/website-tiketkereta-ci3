<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAI - Pemesanan Tiket</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .header {
            background: white;
            padding: 15px 40px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kai-logo {
            background: linear-gradient(45deg, #2a5298, #ff6b35);
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
        }

        .main-content { display: flex; }

        .form-section { flex: 2; padding: 40px; background: #f8f9fa; }

        .summary-section {
            flex: 1;
            background: white;
            border-left: 1px solid #e0e0e0;
        }

        .page-title { font-size: 32px; margin-bottom: 30px; font-weight: 300; }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
        }

        .section-title {
            color: #2a5298;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-row { display: flex; gap: 20px; margin-bottom: 20px; }

        .form-group { flex: 1; }

        .form-group label { margin-bottom: 8px; display: block; }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
        }

        .btn-register {
            padding: 10px 25px;
            border-radius: 20px;
            border: none;
            background: #2a5298;
            color: white;
            cursor: pointer;
        }

        .summary-header {
            background: #ff6b35;
            color: white;
            padding: 25px;
            text-align: center;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <header class="header">
        <div class="kai-logo">KAI</div>
    </header>

    <div class="main-content">

        <!-- Form Section -->
        <div class="form-section">
            <h1 class="page-title">Pemesanan</h1>

            <form method="post" action="<?= base_url('user/DataDiri/simpan'); ?>">

                <input type="hidden" name="jadwal_id" value="<?= $jadwal['jadwal_id']; ?>">

                <!-- Data Pemesan -->
                <div class="form-container">
                    <h2 class="section-title">Data Pemesan</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" class="form-control" name="no_tlp" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                </div>

                <!-- Data Penumpang Lain (Tanpa JS) -->
                <?php if ($jumlah_tiket > 1): ?>
                    <?php for ($i = 2; $i <= $jumlah_tiket; $i++): ?>
                    <div class="form-container">
                        <h2 class="section-title">Data Penumpang <?= $i ?></h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Penumpang</label>
                                <input type="text" class="form-control" name="penumpang[<?= $i ?>][nama]" required>
                            </div>

                            <div class="form-group">
                                <label>No Identitas</label>
                                <input type="text" class="form-control" name="penumpang[<?= $i ?>][nik]" required>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>

                <button type="submit" class="btn-register">Lanjutkan</button>

            </form>
        </div>

        <!-- Summary Section -->
        <div class="summary-section">

            <div class="summary-header">
                <h2>Total Rp <?= number_format($jadwal['harga'], 0, ',', '.'); ?></h2>
            </div>

            <div style="padding: 20px;">
                <p><?= date('l, d F Y', strtotime($jadwal['jam_berangkat'])); ?></p>

                <h3><?= $jadwal['nama_kereta']; ?></h3>
                <p><?= $jumlah_tiket ?> Penumpang</p>

                <p><b><?= $jadwal['stasiun_awal']; ?></b> → <b><?= $jadwal['stasiun_akhir']; ?></b></p>

                <p>
                    Berangkat: <?= date('H:i', strtotime($jadwal['jam_berangkat'])); ?><br>
                    Tiba: <?= date('H:i', strtotime($jadwal['jam_sampai'])); ?>
                </p>
            </div>

        </div>

    </div>

</div>

</body>
</html>
