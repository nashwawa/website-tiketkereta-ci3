<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari & Pesan Tiket Kereta</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-tabs {
            display: flex;
            gap: 10px;
        }

        .tab {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab.active {
            background: #ff6b35;
            transform: translateY(-2px);
        }

        /* Search Inputs */
        .search-inputs {
            background: white;
            padding: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .input-group {
            flex: 1;
            min-width: 150px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 12px;
            text-transform: uppercase;
        }

        .input-group input, 
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus, 
        .input-group select:focus {
            outline: none;
            border-color: #2a5298;
        }

        /* Calendar Section */
        .calendar-section {
            background: #f8f9fa;
            padding: 20px;
        }

        .calendar-header {
            text-align: center;
            margin-bottom: 20px;
            color: #2a5298;
            font-size: 18px;
            font-weight: bold;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .nav-btn {
            background: #555;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .nav-btn:hover {
            background: #333;
        }

        .calendar-days {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 30px;
        }

        .day-card {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            min-width: 120px;
        }

        .day-card.selected {
            background: #17a2b8;
            color: white;
            transform: translateY(-5px);
        }

        .day-card .day-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .day-card .day-date {
            font-size: 12px;
            color: #666;
        }

        .day-card.selected .day-date {
            color: #e0f7fa;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .filter-tab {
            background: #ff6b35;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .filter-tab:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }

        /* Results Header */
        .results-header {
            background: #2a5298;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        /* Train Results */
        .train-result {
            background: #2a5298;
            color: white;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .train-info {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .train-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .train-class {
            font-size: 14px;
            opacity: 0.8;
        }

        .route-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .station-info {
            text-align: center;
        }

        .station-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .station-time {
            font-size: 18px;
        }

        .station-date {
            font-size: 12px;
            opacity: 0.8;
        }

        .route-arrow {
            background: #ff6b35;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .duration {
            text-align: center;
            font-size: 14px;
            opacity: 0.9;
        }

        .price-section {
            text-align: center;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #ff6b35;
            margin-bottom: 10px;
        }

        .availability {
            font-size: 12px;
            margin-bottom: 15px;
        }

        .book-btn {
            background: #ff6b35;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .book-btn:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .search-inputs {
                flex-direction: column;
            }

            .calendar-days {
                flex-wrap: wrap;
                justify-content: center;
            }

            .train-result {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .train-info {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
    <div class="search-tabs">
        <a href="<?= base_url('home'); ?>" class="tab active">Cari & Pesan Tiket</a>
    </div>
</div>


    <!-- Search Inputs -->
    <div class="search-inputs">
        <div class="row mb-4"></div>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-section">
        <!-- <div class="calendar-header">SEPTEMBER 2025</div> -->
        <!-- <div class="calendar-nav">
            <button class="nav-btn">❮</button>
            <button class="nav-btn">❯</button>
        </div> -->

        <div class="calendar-days">
    <?php
    // Ambil hari ini
    $today = strtotime(date('Y-m-d'));

    // Loop 5 hari ke depan (bisa diubah sesuai kebutuhan)
    for ($i = 0; $i < 5; $i++) {
        $date = strtotime("+$i day", $today);
        $dayName = date('l', $date); // Nama hari (Sunday, Monday, etc.)
        
        // Ubah ke Bahasa Indonesia
        $hariIndo = [
            'Sunday'    => 'MINGGU',
            'Monday'    => 'SENIN',
            'Tuesday'   => 'SELASA',
            'Wednesday' => 'RABU',
            'Thursday'  => 'KAMIS',
            'Friday'    => 'JUMAT',
            'Saturday'  => 'SABTU'
        ];
        
        $dayNameIndo = $hariIndo[$dayName];
        
        // Format tanggal
        $tanggal = date('d F Y', $date);
        
        // Tambahkan class "selected" jika hari ini
        $selected = ($i == 0) ? 'selected' : '';
        ?>
        
        <div class="day-card <?= $selected ?>">
            <div class="day-name"><?= $dayNameIndo; ?></div>
            <div class="day-date"><?= $tanggal; ?></div>
        </div>
        
    <?php } ?>
</div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <!-- <span class="fw-bold me-2">Urut Berdasarkan:</span> -->
            <a href="?sort=stasiun_awal" class="filter-tab">Stasiun Awal</a>
            <a href="?sort=stasiun_akhir" class="filter-tab">Stasiun Tujuan</a>
            <a href="?sort=nama_kereta" class="filter-tab">Nama Kereta</a>
            <a href="?sort=jam_berangkat" class="filter-tab">Jam Berangkat</a>
            <a href="?sort=harga" class="filter-tab">Harga</a>
        </div>
    </div>

    <!-- Results Header -->
    <div class="results-header">
        <span>Kereta</span>
        <span>Berangkat</span>
        <span>Durasi</span>
        <span>Tiba</span>
        <span>Harga</span>
    </div>

    <!-- Train Results -->
    <?php if (!empty($jadwal)): ?>
        <?php foreach ($jadwal as $row): ?>
            <div class="train-result">
    <!-- Kereta -->
                <div>
                    <div class="train-name"><?= strtoupper($row['nama_kereta']); ?> (<?= $row['kereta_id']; ?>)</div>
                    <div class="train-class"><?= $row['nama_gerbong']; ?></div>
                </div>

                <!-- Berangkat -->
                <div class="station-info">
                    <div class="station-name"><?= $row['stasiun_awal']; ?></div>
                    <div class="station-time"><?= date('H:i', strtotime($row['jam_berangkat'])); ?></div>
                    <div class="station-date"><?= date('d F Y', strtotime($row['jam_berangkat'])); ?></div>
                </div>

                <!-- Durasi -->
                <div class="duration">
                <div class="route-arrow">→</div>
                    <?php 
                    $durasi = (strtotime($row['jam_sampai']) - strtotime($row['jam_berangkat'])) / 60;
                    echo floor($durasi/60) . "j " . ($durasi%60) . "m";
                    ?>
                </div>

                <!-- Tiba -->
                <div class="station-info">
                    <div class="station-name"><?= $row['stasiun_akhir']; ?></div>
                    <div class="station-time"><?= date('H:i', strtotime($row['jam_sampai'])); ?></div>
                    <div class="station-date"><?= date('d F Y', strtotime($row['jam_sampai'])); ?></div>
                </div>

                <!-- Harga -->
                <div class="price-section">
                    <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?>,-</div>
                    <div class="availability">Tersisa <?= $row['jumlah_kursi'] ?? '??'; ?> kursi</div>

                    <form action="<?= base_url('user/DataDiri'); ?>" method="post">
                        <input type="hidden" name="jadwal_id" value="<?= $row['jadwal_id']; ?>">
                        <button type="submit" class="book-btn">PESAN</button>
                    </form>
                </div>


            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Tidak ada jadwal ditemukan.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Day selection
        const dayCards = document.querySelectorAll('.day-card');
        dayCards.forEach(card => {
            card.addEventListener('click', function() {
                dayCards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Filter tabs
        const filterTabs = document.querySelectorAll('.filter-tab');
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Book button
        const bookBtn = document.querySelector('.book-btn');
        bookBtn.addEventListener('click', function() {
            alert('Memproses pemesanan tiket...');
        });

        // Navigation buttons
        const navBtns = document.querySelectorAll('.nav-btn');
        navBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                console.log('Navigating calendar...');
            });
        });

        // Input hover effects
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.boxShadow = '0 0 0 3px rgba(42, 82, 152, 0.1)';
            });
            input.addEventListener('blur', function() {
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
</body>
</html>
