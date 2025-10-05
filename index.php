<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanggar Tari Tatra KJD - Pelestarian Seni Tari Tradisional</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #FFD700;
            --dark-brown: #5D2F17;
            --light-gold: #FFF8DC;
            --text-dark: #2C1810;
            --text-light: #F5F5DC;
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
            overflow-x: hidden;
        }
        
        .hero-section {
            background: linear-gradient(rgba(139, 69, 19, 0.7), rgba(93, 47, 23, 0.8)),
                        url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            color: var(--text-light);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at center, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease-out;
        }
        
        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.7);
            background: linear-gradient(45deg, var(--text-light), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            opacity: 0.9;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            max-width: 600px;
        }
        
        .btn-booking {
            background: linear-gradient(135deg, var(--accent-color), #FFA500);
            color: var(--text-dark);
            border: none;
            padding: 18px 45px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-booking::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-booking:hover {
            background: linear-gradient(135deg, #FFA500, var(--accent-color));
            color: var(--text-dark);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        }
        
        .btn-booking:hover::before {
            left: 100%;
        }
        
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        
        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-element:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.8rem;
        }
        
        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 15px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .schedule-quick {
            background: linear-gradient(135deg, var(--light-gold), #FFF);
            padding: 5rem 0;
        }
        
        .schedule-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            border-left: 5px solid var(--secondary-color);
            position: relative;
            overflow: hidden;
        }
        
        .schedule-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
        }
        
        .schedule-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            border-left-color: var(--accent-color);
        }
        
        .schedule-time {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
        }
        
        .schedule-class {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: var(--dark-brown);
        }
        
        .schedule-description {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .testimonial-section {
            background: var(--primary-color);
            color: var(--text-light);
            padding: 5rem 0;
            position: relative;
        }
        
        .testimonial-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23FFD700" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 215, 0, 0.2);
            position: relative;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border-color: var(--accent-color);
        }
        
        .testimonial-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 4px solid var(--accent-color);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .testimonial-name {
            font-weight: 600;
            color: var(--accent-color);
            font-size: 1.1rem;
        }
        
        .stars {
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        footer {
            background: var(--dark-brown);
            color: var(--text-light);
            padding: 4rem 0 2rem;
        }
        
        .footer-social a {
            color: var(--text-light);
            font-size: 1.8rem;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        
        .footer-social a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .btn-booking {
                padding: 15px 35px;
                font-size: 1.1rem;
            }
        }
        
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--text-light);
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-music me-2"></i>Sanggar Tari Tatra KJD
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jadwal">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="floating-elements">
            <div class="floating-element">
                <i class="fas fa-music" style="font-size: 60px;"></i>
            </div>
            <div class="floating-element">
                <i class="fas fa-heart" style="font-size: 50px;"></i>
            </div>
            <div class="floating-element">
                <i class="fas fa-star" style="font-size: 40px;"></i>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1>Sanggar Tari Tatra KJD</h1>
                        <p class="hero-subtitle">Kelompok Jaringan Daerah</p>
                        <p class="lead">Melestarikan keindahan seni tari tradisional Indonesia dengan teknik modern dan pembelajaran yang inspiratif. Bergabunglah dengan kami untuk menguasai gerakan tari yang memukau dan bermakna mendalam!</p>
                        <a href="#booking" class="btn-booking">
                            <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down fa-2x"></i>
        </div>
    </section>

    <!-- Jadwal Singkat Section -->
    <section id="jadwal" class="schedule-quick">
        <div class="container">
            <h2 class="section-title">Jadwal Kelas Minggu Ini</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Senin & Rabu
                        </div>
                        <div class="schedule-class">Tari Saman (Pemula)</div>
                        <div class="schedule-description">
                            16.00 - 17.30 WIB<br>
                            Untuk anak usia 7-14 tahun<br>
                            <strong>Instruktur:</strong> Bu Ratna<br>
                            <span class="text-success">Kuota: 6/15 tersedia</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Selasa & Kamis
                        </div>
                        <div class="schedule-class">Tari Jaipong (Menengah)</div>
                        <div class="schedule-description">
                            18.00 - 19.30 WIB<br>
                            Untuk remaja dan dewasa<br>
                            <strong>Instruktur:</strong> Kak Sinta<br>
                            <span class="text-warning">Kuota: 12/15 tersisa</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Sabtu
                        </div>
                        <div class="schedule-class">Tari Kecak (Lanjutan)</div>
                        <div class="schedule-description">
                            09.00 - 11.00 WIB<br>
                            Untuk yang berpengalaman<br>
                            <strong>Instruktur:</strong> Pak Kadek<br>
                            <span class="text-success">Kuota: 4/12 tersedia</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Jumat
                        </div>
                        <div class="schedule-class">Kelas Privat</div>
                        <div class="schedule-description">
                            Jadwal fleksibel<br>
                            Pembelajaran one-on-one<br>
                            <strong>Instruktur:</strong> Sesuai kebutuhan<br>
                            <span class="text-success">Tersedia</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Minggu
                        </div>
                        <div class="schedule-class">Workshop Tematik</div>
                        <div class="schedule-description">
                            13.00 - 16.00 WIB<br>
                            Tema: Tari Kreasi Modern<br>
                            <strong>Instruktur:</strong> Tim KJD<br>
                            <span class="text-warning">Kuota: 8/20 tersisa</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <div class="schedule-time">
                            <i class="fas fa-clock me-2"></i>Sabtu
                        </div>
                        <div class="schedule-class">Persiapan Kompetisi</div>
                        <div class="schedule-description">
                            14.00 - 17.00 WIB<br>
                            Latihan intensif untuk lomba<br>
                            <strong>Instruktur:</strong> Bu Ratna & Kak Sinta<br>
                            <span class="text-danger">Kuota: 15/15 penuh</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="pages/jadwal.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-calendar-alt me-2"></i>Lihat Jadwal Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="testimonial-section">
        <div class="container">
            <h2 class="section-title" style="color: var(--text-light);">Testimoni Siswa & Orang Tua</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80" alt="Ibu Wulan" class="testimonial-avatar">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Sanggar Tari Tatra KJD benar-benar luar biasa! Anak saya menjadi lebih percaya diri dan bangga dengan budaya Indonesia. Instrukturnya sangat profesional dan sabar mengajar."</p>
                        <div class="testimonial-name">Ibu Wulan Sari</div>
                        <small class="text-light opacity-75">Orang tua siswa</small>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80" alt="Dimas Prasetyo" class="testimonial-avatar">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Sebagai pemula di usia dewasa, saya merasa sangat welcome di sini. Metode pengajarannya mudah dipahami dan suasana latihan sangat menyenangkan. Highly recommended!"</p>
                        <div class="testimonial-name">Dimas Prasetyo</div>
                        <small class="text-light opacity-75">Siswa dewasa</small>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Ayu Lestari" class="testimonial-avatar">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Setelah 3 tahun di KJD, saya sudah bisa tampil di berbagai event nasional. Teknik yang diajarkan sangat detail dan autentik. Terima kasih Tatra KJD!"</p>
                        <div class="testimonial-name">Ayu Lestari</div>
                        <small class="text-light opacity-75">Alumni senior</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-5" style="background: linear-gradient(135deg, #f8f9fa, var(--light-gold));">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Tentang Tatra KJD</h2>
                    <p class="lead">Sanggar Tari Tatra KJD (Kelompok Jaringan Daerah) adalah komunitas seni tari yang berdedikasi untuk melestarikan dan mengembangkan seni tari tradisional Indonesia.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="fw-bold text-primary">150+</h3>
                                <p>Siswa Aktif</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="fw-bold text-primary">8</h3>
                                <p>Instruktur Berpengalaman</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="fw-bold text-primary">25+</h3>
                                <p>Jenis Tari</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="fw-bold text-primary">5</h3>
                                <p>Tahun Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1504609813442-a8924e83f76e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Kegiatan Sanggar" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="booking" class="py-5" style="background: var(--primary-color); color: var(--text-light);">
        <div class="container text-center">
            <h2 class="mb-4" style="color: var(--text-light); font-family: 'Playfair Display', serif;">Siap Bergabung dengan Keluarga Tatra KJD?</h2>
            <p class="lead mb-5">Daftarkan diri Anda sekarang dan rasakan pengalaman belajar tari yang tak terlupakan bersama instruktur terbaik!</p>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center flex-wrap">
                        <a href="tel:+6281234567890" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-phone me-2"></i>Hubungi Kami
                        </a>
                        <a href="https://wa.me/6281234567890" class="btn btn-outline-light btn-lg">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                        <a href="mailto:info@tatratkjd.com" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-envelope me-2"></i>Email
                        </a>
                        <a href="pages/jadwal.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-calendar-alt me-2"></i>Lihat Jadwal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 style="font-family: 'Playfair Display', serif; font-size: 1.5rem;">Sanggar Tari Tatra KJD</h5>
                    <p>Kelompok Jaringan Daerah yang berkomitmen melestarikan dan mengembangkan seni tari tradisional Indonesia untuk generasi masa depan.</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Informasi Kontak</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Seni Budaya No. 45, Jakarta Selatan 12560</p>
                    <p><i class="fas fa-phone me-2"></i>+62 812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i>info@tatratkjd.com</p>
                    <p><i class="fas fa-globe me-2"></i>www.tatratkjd.com</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Jam Operasional</h5>
                    <p><strong>Senin - Jumat:</strong> 15.00 - 21.00 WIB</p>
                    <p><strong>Sabtu - Minggu:</strong> 08.00 - 18.00 WIB</p>
                    <p><strong>Hari Libur Nasional:</strong> Tutup</p>
                    <p class="mt-3"><small class="text-muted">*Jadwal dapat berubah sewaktu-waktu</small></p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; <?php echo date('Y'); ?> Sanggar Tari Tatra KJD. All rights reserved. | Made with <i class="fas fa-heart text-danger"></i> for Indonesian Culture</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
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

        // Navbar transparency and effects on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const scrollIndicator = document.querySelector('.scroll-indicator');
            
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 4px 25px rgba(0,0,0,0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            }
            
            // Hide scroll indicator after scrolling
            if (window.scrollY > 100 && scrollIndicator) {
                scrollIndicator.style.opacity = '0';
            } else if (scrollIndicator) {
                scrollIndicator.style.opacity = '1';
            }
        });

        // Animation on scroll for cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards for animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.schedule-card, .testimonial-card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.8s ease';
                observer.observe(card);
            });
        });

        // Enhanced hover effects for cards
        document.querySelectorAll('.schedule-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroSection = document.querySelector('.hero-section');
            const parallaxSpeed = 0.5;
            
            if (heroSection) {
                heroSection.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
            }
        });

        // Dynamic greeting based on time
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const hour = now.getHours();
            let greeting = 'Selamat datang';
            
            if (hour < 12) {
                greeting = 'Selamat pagi';
            } else if (hour < 17) {
                greeting = 'Selamat siang';
            } else {
                greeting = 'Selamat malam';
            }
            
            console.log(greeting + ' di Sanggar Tari Tatra KJD!');
        });

        // Loading animation for page
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>
