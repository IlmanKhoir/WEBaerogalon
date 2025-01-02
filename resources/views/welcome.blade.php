<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aero Galon</title>
    <link rel="icon" href="{{ asset('gambar/gambarair.jpg') }}" type="image/x-icon" style="border-radius: 50%;">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.6)), 
                  url("{{asset('gambar/gambarair.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #fff;
            overflow-x: hidden;
        }

        .hero {
            max-width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
            animation: fadeIn 1.5s ease-out;
        }

        .hero-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
            animation: fadeInUp 1.5s ease-out;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: bounceIn 2s ease-out;
        }

        .hero p {
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            animation: fadeInUp 2s ease-out;
        }

        .features-section,
        .delivery-area,
        .process-section,
        .gallery-section {
            background: rgba(0, 0, 0, 0.7);
            padding: 80px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeIn 1.5s ease-out;
        }

        .pricing-section {
            background: linear-gradient(135deg, 
                rgba(0, 32, 96, 0.7), 
                rgba(0, 64, 128, 0.7)
            );
            padding: 80px 0;
            animation: fadeIn 1.5s ease-out;
        }

        .feature-card,
        .price-card,
        .card-standard {
            background: rgba(255, 255, 255, 0);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1.5s ease-out;
        }

        .feature-card:hover,
        .price-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
        }

        .price-card {
            background: rgba(255, 255, 255, 0.15);
        }

        .price-amount {
            color: #fff;
        }

        .price-period {
            color: #ddd;
        }

        .price-features li {
            color: #fff;
        }

        .alert-info,
        .alert-warning {
            background: rgba(0, 123, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .price-button .btn {
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 30px;
            border: 7px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-button {
            padding: 15px 40px;
            font-size: 1.2rem;
            border-radius: 10px;
            background: #00cc66;
            border: none;
            color: white;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .cta-button:hover {
            background: #00aa55;
            transform: scale(1.05);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            animation: fadeIn 1.5s ease-out;
        }

        .floating-whatsapp a {
            background: linear-gradient(45deg, #25d366, #128C7E);
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .floating-whatsapp a:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.4);
        }

        .gallery-image {
            border-radius: 15px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            animation: fadeInUp 1.5s ease-out;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        .process-step {
            text-align: center;
            padding: 20px;
            position: relative;
            animation: fadeInUp 1.5s ease-out;
        }

        .process-step::after {
            content: '';
            position: absolute;
            top: 20px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #0066cc;
            z-index: -1;
        }

        .process-step:last-child::after {
            display: none;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #00ccff, #00ff99);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Standarisasi ukuran section */
        .section-padding {
            padding: 0;
        }
        
        /* Standarisasi ukuran heading */
        h1 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
        }
        
        h2 {
            font-size: 2.2rem;
            margin-bottom: 2rem;
        }
        
        h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        h4 {
            font-size: 1.4rem;
            margin-bottom: 0.8rem;
        }
        
        /* Standarisasi card */
        .card-standard {
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.1),
                rgba(255, 255, 255, 0.05)
            );
        }
        
        /* Standarisasi gambar */
        .img-standard {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1.5s ease-out;
        }

        .img-standard:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }
        
        /* Standarisasi spacing */
        .section-title {
            margin-bottom: 40px;
        }
        
        .feature-card, .price-card, .testimonial-card {
            height: 100%;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        /* Standarisasi icon */
        .icon-standard {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        /* Standarisasi button */
        .btn-standard {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 25px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #fff, #00cc66);
        }

        .delivery-area {
            background: rgba(0, 0, 0, 0.5);
        }

        .delivery-area .card-standard {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        .delivery-area .text-primary {
            color: #00ccff !important;
        }

        .delivery-area h2,
        .delivery-area h3,
        .delivery-area p,
        .delivery-area li {
            color: #fff;
        }

        .delivery-area .alert-info {
            background: rgba(0, 123, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .delivery-area .fas.fa-map-marked-alt {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #00ccff, #00ff99);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .delivery-area .text-success {
            color: #00ff99 !important;
        }

        .delivery-area ul li {
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .delivery-area .alert {
            border-radius: 10px;
            padding: 15px 20px;
        }

        .delivery-area .card-body {
            padding: 2rem;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .text-dark {
            color: #fff !important;
        }

        .icon-standard {
            color: #00ccff;
            font-size: 2.5rem;
        }

        .price-amount {
            font-size: 2.5rem;
            color: #00ff99;
            font-weight: 700;
        }

        .price-features li i {
            color: #00ff99;
        }

        .text-success {
            color: #00ff99 !important;
        }

        .feature-card h3,
        .price-card h3,
        .process-step h4 {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="hero-content">
            <h1>AERO HEXAGONAL </h1>
            <p class="lead mb-4">Nikmati Kesegaran Air Minum Terbaik Langsung ke Rumah Anda</p>
            <a href="https://wa.me/6285893930323?text=Halo,%20saya%20tertarik%20untuk%20memesan%20galon%20air.%20Mohon%20informasi%20lebih%20lanjut." 
               class="btn-standard cta-button">
                <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
            </a>
        </div>
    </section>

    <!-- Tambahkan section area pengiriman setelah hero section -->
    <section class="delivery-area section-padding ">
        <div class="container pb-5">
            <h2 class="text-center section-title pt-5">Area Pengiriman</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-standard">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt mb-3"></i>
                            <h3 class="mb-4">Wilayah Parungpanjang</h3>
                            <p class="lead mb-4">Kami melayani pengiriman untuk area:</p>
                            <div class="row mt-4" style="text-align:left  ; margin-left: 50px; ">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Parungpanjang</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Jagabaya</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Kabasiran</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Pingku</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Gintung</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Karihkil</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Bojong Indah</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i>Sekitar Parungpanjang</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-info mt-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Pengiriman Hanya Tersedia Sesuai Sekitar Area Parungpanjang
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Rekomendasi Air Galon -->
    <section class="features-section section-padding pb-5">
        <div class="container">
            <h2 class="text-center section-title mb-5 mt-5">Mengapa Memilih Kami?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card card-standard">
                        <i class="fas fa-tint icon-standard text-primary"></i>
                        <h3>Air Berkualitas Premium</h3>
                        <p>Air minum kami melalui 8 tahap penyaringan dan pengujian laboratorium rutin untuk menjamin kualitas terbaik</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success mr-2"></i>8 Tahap Filtrasi</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Teruji BPOM</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Sertifikasi Halal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card card-standard">
                        <i class="fas fa-truck icon-standard text-primary"></i>
                        <h3>Layanan Pengiriman</h3>
                        <p>Layanan pengiriman khusus area Parungpanjang dan sekitarnya</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Area Parungpanjang</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Pengiriman Terjadwal</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Pelayanan Ramah</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card card-standard">
                        <i class="fas fa-shield-alt icon-standard text-primary"></i>
                        <h3>Jaminan Kebersihan</h3>
                        <p>Standar kebersihan tinggi untuk keamanan dan kenyamanan Anda</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Galon Steril</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Segel Keamanan</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Garansi Produk</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Ganti bagian Fitur Spesial -->
            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="feature-card card-standard bg-primary text-white">
                        <i class="fas fa-award icon-standard"></i>
                        <h3>Kualitas Terjamin</h3>
                        <p>Standar kualitas air minum terbaik:</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle mr-2"></i>Air Pegunungan Alami</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Proses Penyaringan Modern</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Pengujian Laboratorium Rutin</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Izin BPOM & Sertifikasi Halal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="feature-card card-standard bg-success text-white">
                        <i class="fas fa-hand-holding-water icon-standard"></i>
                        <h3>Pelayanan Prima</h3>
                        <p>Komitmen pelayanan terbaik:</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle mr-2"></i>Staff Profesional</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Pengiriman Tepat Waktu</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Galon Selalu Bersih</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Pelayanan Ramah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Pilihan Paket Layanan -->
    <section class="pricing-section" id="order">
    <div class="container">
        <h2 class="text-center text-white mb-5">Pilihan Paket Layanan</h2>
        <div class="row justify-content-center align-items-center">
            @foreach($hargaGalon as $paket)
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="price-card">
                        <div class="price-header">
                            <h3>{{ $paket->nama_paket }}</h3>
                            <div class="price-amount">Rp {{ number_format($paket->price, 0, ',', '.') }}</div>
                            <div class="price-period">{{ $paket->description }}</div>
                        </div>
                        <ul class="price-features">
                            @foreach(json_decode($paket->benefit) as $benefit)
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    {{ $benefit }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="price-button">
                            <a href="https://wa.me/6285893930323?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($paket->nama_paket) }}.%20Harga%20{{ urlencode('Rp ' . number_format($paket->price, 0, ',', '.')) }}%20{{ urlencode($paket->description) }}.%20Mohon%20informasi%20lebih%20lanjut."
                               class="btn btn-primary btn-lg">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Cara Pemesanan Mudah -->
    <section class="process-section">
        <div class="container">
            <h2 class="text-center section-title mb-5">Cara Pemesanan Mudah</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <h4>Hubungi Kami</h4>
                        <p>Hubungi dengan pilih paket yang anda inginkan</p> 
                        <p>atau bisa hubungi kami Langsung dengan memencet tombol whatsapp</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <h4>Konfirmasi Pesanan</h4>
                        <p>Konfirmasi alamat dan jumlah pesanan</p>
                        <p>Gunakan fitur share lokasi untuk memudahkan pengiriman</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <h4>Terima Pesanan</h4>
                        <p>Pesanan akan siap diantar hari itu juga sesuai dengan jam kerja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Produk -->
    <!-- <section class="gallery-section section-padding">
        <div class="container">
            <h2 class="text-center section-title">Galeri Produk</h2>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset(path: 'gambar/download (1).jpeg') }}" class="img-standard mb-4" alt="Galon Air 2">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset(path: 'gambar/download (1).jpeg') }}" class="img-standard mb-4" alt="Galon Air 2">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset(path: 'gambar/download (1).jpeg') }}" class="img-standard mb-4" alt="Galon Air 3">
                </div>
            </div>
        </div>
    </section> -->

    <!-- Floating WhatsApp -->
    <div class="floating-whatsapp">
        <a href="https://wa.me/6285893930323?text=Halo,%20saya%20tertarik%20dengan%20layanan%20air%20galon%20Anda.%20Mohon%20informasi%20lebih%20lanjut%20mengenai%20produk%20dan%20layanan%20yang%20tersedia." 
           target="_blank">
            <i class="fab fa-whatsapp fa-2x"></i>
            <span>Contact Me</span>
        </a>
    </div>

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-4">
                    <h3 class="mb-4">Hubungi Kami</h3>
                    <p><i class="fab fa-whatsapp mr-2"></i>085893930323</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>Pancuran Tujuh, Jl. Cikuda-Pingku Kec. Parungpanjang
                    Kabupaten Bogor</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <h3 class="mb-4">Jam Operasional</h3>
                    <p>Senin - Minggu</p>
                    <p>08:00 - 17:00 WIB</p>
                </div>
            </div>
            <div class="alert alert-warning mt-4 text-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                Pengiriman khusus area Parungpanjang dan sekitarnya
            </div>
            <!-- Tambahkan tombol login admin yang tersembunyi -->
            <div class="text-center mt-4" >
                <a href="{{ route(name: 'admin.login') }}" class="text-muted" style="font-size: 12px; text-decoration: none; opacity: 0.5;">
                    <i class="fas fa-lock mr-1"></i>Admin
                </a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Mencegah pengguna menekan tombol back
        (function (global) {
            if (typeof (global) === "undefined") {
                throw new Error("window is undefined");
            }

            var _hash = "!";
            var noBackPlease = function () {
                global.location.href += "#";

                // Menambahkan hash ke URL
                global.setTimeout(function () {
                    global.location.href += "!";
                }, 50);
            };

            global.onhashchange = function () {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };

            global.onload = function () {
                noBackPlease();

                // Menonaktifkan tombol back
                document.body.onkeydown = function (e) {
                    var elm = e.target.nodeName.toLowerCase();
                    if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
                        e.preventDefault();
                    }
                    // Mencegah tombol backspace
                    e.stopPropagation();
                };
            };
        })(window);
    </script>
</body>
</html>
