<style>
    /* ====== Global ====== */
body {
  background: #f9fafc;
  font-family: "Poppins", sans-serif;
}

/* ====== Header ====== */
h3.fw-bold {
  font-size: 1.8rem;
  letter-spacing: 0.5px;
}

/* ====== Card Jadwal ====== */
.card {
  border: none;
  border-radius: 16px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
}

.card-body h5 {
  font-size: 1.2rem;
  color: #2c3e50;
}

.badge {
  font-size: 0.75rem;
  padding: 0.4em 0.7em;
  border-radius: 8px;
}

/* ====== Button ====== */
.btn {
  border-radius: 50px;
  font-weight: 500;
  padding: 0.4rem 1.2rem;
  transition: all 0.25s ease;
}

.btn-outline-secondary {
  border-width: 2px;
}

.btn-outline-secondary:hover {
  background: #6c757d;
  color: #fff;
}

.btn-success {
  background: linear-gradient(135deg, #28a745, #20c997);
  border: none;
}

.btn-success:hover {
  background: linear-gradient(135deg, #20c997, #28a745);
  transform: scale(1.05);
}

/* ====== Text ====== */
.text-primary {
  color: #0d6efd !important;
}

.text-success {
  color: #198754 !important;
}

.text-secondary {
  color: #6c757d !important;
}

/* ====== Icon ====== */
.bi-arrow-right {
  font-size: 1.6rem;
  color: #0d6efd;
}

</style>
<div class="container mt-5 mb-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Hasil Pencarian Jadwal Kereta</h3>
        <a href="<?= base_url('home') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Home
        </a>
    </div>

    <?php if (empty($jadwal)): ?>
        <div class="alert alert-warning text-center shadow-sm rounded-3">
            <strong>Oops!</strong> Jadwal kereta tidak ditemukan sesuai pencarian.
        </div>
    <?php else: ?>
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col text-center">
                <span class="fw-bold me-2">Urut Berdasarkan:</span>
                <a href="?sort=stasiun_awal" class="btn btn-outline-primary btn-sm">Stasiun Awal</a>
                <a href="?sort=stasiun_akhir" class="btn btn-outline-primary btn-sm">Stasiun Tujuan</a>
                <a href="?sort=nama_kereta" class="btn btn-outline-primary btn-sm">Nama Kereta</a>
                <a href="?sort=jam_berangkat" class="btn btn-outline-primary btn-sm">Jam Berangkat</a>
                <a href="?sort=harga" class="btn btn-outline-primary btn-sm">Harga</a>
            </div>
        </div>

        <!-- List Jadwal -->
        <?php foreach ($jadwal as $j): ?>
        <div class="card shadow-lg border-0 rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    
                    <!-- Info Kereta -->
                    <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                        <h5 class="fw-bold text-dark mb-1">
                            <?= strtoupper($j['nama_kereta']) ?>
                        </h5>
                        <span class="badge bg-primary">Kereta</span>
                    </div>

                    <!-- Stasiun Awal -->
                    <div class="col-md-3 text-center">
                        <h6 class="text-secondary mb-1"><?= ucfirst($j['stasiun_awal']) ?></h6>
                        <small class="text-muted">
                            <?= date('H:i', strtotime($j['jam_berangkat'])) ?>
                        </small>
                    </div>

                    <!-- Icon -->
                    <div class="col-md-1 text-center">
                        <i class="bi bi-arrow-right fs-4 text-primary"></i>
                    </div>

                    <!-- Stasiun Tujuan -->
                    <div class="col-md-3 text-center">
                        <h6 class="text-secondary mb-1"><?= ucfirst($j['stasiun_akhir']) ?></h6>
                        <small class="text-muted">
                            <?= date('H:i', strtotime($j['jam_sampai'])) ?>
                        </small>
                    </div>

                    <!-- Harga & Pesan -->
                    <div class="col-md-2 text-center">
                        <h5 class="text-success fw-bold mb-2">
                            Rp <?= number_format($j['harga'], 0, ',', '.') ?>
                        </h5>
                        <a href="<?= base_url('transaksi/pesan/'.$j['jadwal_id']) ?>" 
                           class="btn btn-sm btn-success rounded-pill px-3">
                            <i class="bi bi-ticket-perforated"></i> Pesan
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
