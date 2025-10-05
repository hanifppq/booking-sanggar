<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kelas - Sanggar Tari Bali Puspa</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #FFD700;
            --text-dark: #2C1810;
            --text-light: #F5F5DC;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: #f8f9fa;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            padding: 6rem 0 4rem;
            margin-top: 76px;
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .schedule-container {
            padding: 4rem 0;
        }
        
        .schedule-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: var(--primary-color);
            color: var(--text-light);
            border: none;
            padding: 1.2rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            text-align: center;
            vertical-align: middle;
        }
        
        .table tbody td {
            padding: 1.2rem 1rem;
            vertical-align: middle;
            border-color: #e9ecef;
            text-align: center;
        }
        
        .table tbody tr:hover {
            background-color: rgba(139, 69, 19, 0.05);
            transition: background-color 0.3s ease;
        }
        
        .day-cell {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.95rem;
        }
        
        .time-cell {
            font-weight: 500;
            color: #495057;
        }
        
        .dance-type {
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 1rem;
        }
        
        .instructor-cell {
            color: #6c757d;
            font-weight: 500;
        }
        
        .quota-cell {
            font-weight: 600;
        }
        
        .quota-available {
            color: var(--success-color);
        }
        
        .quota-limited {
            color: var(--warning-color);
        }
        
        .quota-full {
            color: var(--danger-color);
        }
        
        .btn-booking {
            background: var(--accent-color);
            color: var(--text-dark);
            border: none;
            padding: 8px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-booking:hover {
            background: #FFA500;
            color: var(--text-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }
        
        .btn-booking:disabled {
            background: #6c757d;
            color: white;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-booking:disabled:hover {
            background: #6c757d;
            transform: none;
            box-shadow: none;
        }
        
        .legend {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .filter-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.5rem 1rem;
            transition: border-color 0.3s ease;
        }
        
        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
        
        .badge-level {
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-pemula {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        .badge-menengah {
            background: #fff3cd;
            color: #856404;
        }
        
        .badge-lanjutan {
            background: #f8d7da;
            color: #721c24;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .table-responsive {
                font-size: 0.85rem;
            }
            
            .btn-booking {
                padding: 6px 15px;
                font-size: 0.8rem;
            }
        }
        
        .booking-modal .modal-header {
            background: var(--primary-color);
            color: var(--text-light);
        }
        
        .booking-form .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
        }
        
        .booking-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-music me-2"></i>Sanggar Tari Bali Puspa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="jadwal.php">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container text-center">
            <h1 class="page-title">Jadwal Kelas</h1>
            <p class="page-subtitle">Pilih kelas yang sesuai dengan level dan jadwal Anda</p>
        </div>
    </section>

    <!-- Schedule Container -->
    <section class="schedule-container">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h6 class="mb-2">Filter Jadwal:</h6>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-select filter-select" id="filterDay">
                            <option value="">Semua Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-select filter-select" id="filterLevel">
                            <option value="">Semua Level</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Lanjutan">Lanjutan</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-select filter-select" id="filterInstructor">
                            <option value="">Semua Instruktur</option>
                            <option value="Bu Dewi">Bu Dewi</option>
                            <option value="Pak Wayan">Pak Wayan</option>
                            <option value="Bu Sari">Bu Sari</option>
                            <option value="Pak Made">Pak Made</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="legend">
                <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Keterangan Kuota:</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--success-color);"></div>
                            <span>Kuota Tersedia (5+ tempat)</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--warning-color);"></div>
                            <span>Kuota Terbatas (1-4 tempat)</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--danger-color);"></div>
                            <span>Kuota Penuh (0 tempat)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Table -->
            <div class="schedule-table">
                <div class="table-responsive">
                    <table class="table" id="scheduleTable">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Jenis Tari</th>
                                <th>Level</th>
                                <th>Instruktur</th>
                                <th>Kuota</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Senin -->
                            <tr data-day="Senin" data-level="Pemula" data-instructor="Bu Dewi">
                                <td class="day-cell">Senin</td>
                                <td class="time-cell">16:00 - 17:30</td>
                                <td class="dance-type">Tari Kecak</td>
                                <td><span class="badge badge-level badge-pemula">Pemula</span></td>
                                <td class="instructor-cell">Bu Dewi</td>
                                <td class="quota-cell quota-available">8/15</td>
                                <td class="price-cell">Rp 150.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Senin', '16:00-17:30', 'Tari Kecak', 'Bu Dewi', 'Rp 150.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Selasa -->
                            <tr data-day="Selasa" data-level="Menengah" data-instructor="Pak Wayan">
                                <td class="day-cell">Selasa</td>
                                <td class="time-cell">17:45 - 19:15</td>
                                <td class="dance-type">Tari Legong</td>
                                <td><span class="badge badge-level badge-menengah">Menengah</span></td>
                                <td class="instructor-cell">Pak Wayan</td>
                                <td class="quota-cell quota-limited">12/15</td>
                                <td class="price-cell">Rp 200.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Selasa', '17:45-19:15', 'Tari Legong', 'Pak Wayan', 'Rp 200.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Rabu -->
                            <tr data-day="Rabu" data-level="Pemula" data-instructor="Bu Dewi">
                                <td class="day-cell">Rabu</td>
                                <td class="time-cell">16:00 - 17:30</td>
                                <td class="dance-type">Tari Kecak</td>
                                <td><span class="badge badge-level badge-pemula">Pemula</span></td>
                                <td class="instructor-cell">Bu Dewi</td>
                                <td class="quota-cell quota-available">6/15</td>
                                <td class="price-cell">Rp 150.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Rabu', '16:00-17:30', 'Tari Kecak', 'Bu Dewi', 'Rp 150.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Kamis -->
                            <tr data-day="Kamis" data-level="Menengah" data-instructor="Pak Wayan">
                                <td class="day-cell">Kamis</td>
                                <td class="time-cell">17:45 - 19:15</td>
                                <td class="dance-type">Tari Legong</td>
                                <td><span class="badge badge-level badge-menengah">Menengah</span></td>
                                <td class="instructor-cell">Pak Wayan</td>
                                <td class="quota-cell quota-limited">13/15</td>
                                <td class="price-cell">Rp 200.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Kamis', '17:45-19:15', 'Tari Legong', 'Pak Wayan', 'Rp 200.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Jumat -->
                            <tr data-day="Jumat" data-level="Lanjutan" data-instructor="Bu Sari">
                                <td class="day-cell">Jumat</td>
                                <td class="time-cell">18:00 - 20:00</td>
                                <td class="dance-type">Kelas Privat</td>
                                <td><span class="badge badge-level badge-lanjutan">Lanjutan</span></td>
                                <td class="instructor-cell">Bu Sari</td>
                                <td class="quota-cell quota-available">2/5</td>
                                <td class="price-cell">Rp 350.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Jumat', '18:00-20:00', 'Kelas Privat', 'Bu Sari', 'Rp 350.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Sabtu -->
                            <tr data-day="Sabtu" data-level="Lanjutan" data-instructor="Pak Made">
                                <td class="day-cell">Sabtu</td>
                                <td class="time-cell">09:00 - 11:00</td>
                                <td class="dance-type">Tari Barong</td>
                                <td><span class="badge badge-level badge-lanjutan">Lanjutan</span></td>
                                <td class="instructor-cell">Pak Made</td>
                                <td class="quota-cell quota-full">15/15</td>
                                <td class="price-cell">Rp 250.000</td>
                                <td>
                                    <button class="btn btn-booking" disabled>
                                        <i class="fas fa-times me-1"></i>Penuh
                                    </button>
                                </td>
                            </tr>
                            
                            <tr data-day="Sabtu" data-level="Menengah" data-instructor="Bu Sari">
                                <td class="day-cell">Sabtu</td>
                                <td class="time-cell">14:00 - 16:00</td>
                                <td class="dance-type">Persiapan Pertunjukan</td>
                                <td><span class="badge badge-level badge-menengah">Menengah</span></td>
                                <td class="instructor-cell">Bu Sari</td>
                                <td class="quota-cell quota-available">5/12</td>
                                <td class="price-cell">Rp 180.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Sabtu', '14:00-16:00', 'Persiapan Pertunjukan', 'Bu Sari', 'Rp 180.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Minggu -->
                            <tr data-day="Minggu" data-level="Pemula" data-instructor="Bu Dewi">
                                <td class="day-cell">Minggu</td>
                                <td class="time-cell">10:00 - 11:30</td>
                                <td class="dance-type">Tari Pendet</td>
                                <td><span class="badge badge-level badge-pemula">Pemula</span></td>
                                <td class="instructor-cell">Bu Dewi</td>
                                <td class="quota-cell quota-available">4/15</td>
                                <td class="price-cell">Rp 160.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Minggu', '10:00-11:30', 'Tari Pendet', 'Bu Dewi', 'Rp 160.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                            
                            <tr data-day="Minggu" data-level="Menengah" data-instructor="Pak Made">
                                <td class="day-cell">Minggu</td>
                                <td class="time-cell">13:00 - 15:00</td>
                                <td class="dance-type">Workshop Khusus</td>
                                <td><span class="badge badge-level badge-menengah">Menengah</span></td>
                                <td class="instructor-cell">Pak Made</td>
                                <td class="quota-cell quota-limited">8/10</td>
                                <td class="price-cell">Rp 220.000</td>
                                <td>
                                    <button class="btn btn-booking" onclick="openBookingModal('Minggu', '13:00-15:00', 'Workshop Khusus', 'Pak Made', 'Rp 220.000')">
                                        <i class="fas fa-calendar-check me-1"></i>Booking
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div class="modal fade booking-modal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Booking Kelas Tari
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-form">
                        <!-- Class Info -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Detail Kelas</h6>
                                    <div id="classDetails"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Info -->
                        <form id="bookingForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="fullName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">No. Telepon *</label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="age" class="form-label">Usia *</label>
                                    <input type="number" class="form-control" id="age" min="5" max="80" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="experience" class="form-label">Pengalaman Menari</label>
                                <select class="form-select" id="experience">
                                    <option value="">Pilih pengalaman...</option>
                                    <option value="Tidak ada">Tidak ada pengalaman</option>
                                    <option value="Pemula">Pemula (< 1 tahun)</option>
                                    <option value="Menengah">Menengah (1-3 tahun)</option>
                                    <option value="Lanjutan">Lanjutan (> 3 tahun)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" id="notes" rows="3" placeholder="Sampaikan hal khusus yang perlu kami ketahui..."></textarea>
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya setuju dengan <a href="#" class="text-decoration-none">syarat dan ketentuan</a> yang berlaku *
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-booking" onclick="submitBooking()">
                        <i class="fas fa-check me-2"></i>Konfirmasi Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Global variables for booking
        let currentBookingData = {};

        // Filter functionality
        document.getElementById('filterDay').addEventListener('change', filterTable);
        document.getElementById('filterLevel').addEventListener('change', filterTable);
        document.getElementById('filterInstructor').addEventListener('change', filterTable);

        function filterTable() {
            const dayFilter = document.getElementById('filterDay').value;
            const levelFilter = document.getElementById('filterLevel').value;
            const instructorFilter = document.getElementById('filterInstructor').value;
            
            const rows = document.querySelectorAll('#scheduleTable tbody tr');
            
            rows.forEach(row => {
                const day = row.getAttribute('data-day');
                const level = row.getAttribute('data-level');
                const instructor = row.getAttribute('data-instructor');
                
                const dayMatch = !dayFilter || day === dayFilter;
                const levelMatch = !levelFilter || level === levelFilter;
                const instructorMatch = !instructorFilter || instructor === instructorFilter;
                
                if (dayMatch && levelMatch && instructorMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Open booking modal
        function openBookingModal(day, time, danceType, instructor, price) {
            currentBookingData = {
                day: day,
                time: time,
                danceType: danceType,
                instructor: instructor,
                price: price
            };
            
            // Update class details in modal
            const classDetails = document.getElementById('classDetails');
            classDetails.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <strong>Hari:</strong> ${day}<br>
                        <strong>Waktu:</strong> ${time}<br>
                        <strong>Jenis Tari:</strong> ${danceType}
                    </div>
                    <div class="col-md-6">
                        <strong>Instruktur:</strong> ${instructor}<br>
                        <strong>Harga:</strong> ${price}<br>
                        <strong>Status:</strong> <span class="text-success">Tersedia</span>
                    </div>
                </div>
            `;
            
            // Reset form
            document.getElementById('bookingForm').reset();
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
            modal.show();
        }

        // Submit booking
        function submitBooking() {
            const form = document.getElementById('bookingForm');
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const formData = {
                // Class data
                day: currentBookingData.day,
                time: currentBookingData.time,
                danceType: currentBookingData.danceType,
                instructor: currentBookingData.instructor,
                price: currentBookingData.price,
                
                // Student data
                fullName: document.getElementById('fullName').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                age: document.getElementById('age').value,
                experience: document.getElementById('experience').value,
                notes: document.getElementById('notes').value,
                terms: document.getElementById('terms').checked
            };
            
            // Simulate booking submission (replace with actual API call)
            console.log('Booking data:', formData);
            
            // Show success message
            alert(`Booking berhasil untuk ${formData.fullName}!\n\nDetail:\n- Kelas: ${formData.danceType}\n- Hari: ${formData.day}\n- Waktu: ${formData.time}\n- Instruktur: ${formData.instructor}\n\nTerima kasih! Kami akan menghubungi Anda segera.`);
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
            modal.hide();
            
            // TODO: Send data to server
            // fetch('booking_handler.php', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify(formData)
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         alert('Booking berhasil!');
            //     } else {
            //         alert('Terjadi kesalahan: ' + data.message);
            //     }
            // });
        }

        // Update quota colors based on availability
        document.addEventListener('DOMContentLoaded', function() {
            const quotaCells = document.querySelectorAll('.quota-cell');
            
            quotaCells.forEach(cell => {
                const quotaText = cell.textContent;
                if (quotaText.includes('/')) {
                    const [current, total] = quotaText.split('/').map(Number);
                    const available = total - current;
                    
                    cell.classList.remove('quota-available', 'quota-limited', 'quota-full');
                    
                    if (available === 0) {
                        cell.classList.add('quota-full');
                    } else if (available <= 4) {
                        cell.classList.add('quota-limited');
                    } else {
                        cell.classList.add('quota-available');
                    }
                }
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
