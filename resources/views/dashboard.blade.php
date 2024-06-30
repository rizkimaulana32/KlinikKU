@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to Klinikku</h1>
            <h2>Solusi Kesehatan Terlengkap</h2>
            <a href="{{ route('register') }}" class="btn-get-started">Register</a>
        </div>
    </section>

    <main id="main">
        <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Kenapa harus klinikku?</h3>
                        <p>
                            Kami menyediakan akses cepat dan mudah dalam layanan kesehatan seperti pendaftaran
                            pasien online,
                            pengelolaan jadwal dokter yang fleksibel, akses cepat ke rekam medis, dan kemampuan
                            untuk
                            membuat laporan serta analisis data anda.
                        </p>
                        <div class="text-center">
                            <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="mt-4 icon-box mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Pendaftaran Secara Online</h4>
                                    <p>daftar secara online melalui website Klinikku. Anda dapat
                                        memilih dokter atau layanan yang diinginkan, dan membuat
                                        janji temu tanpa harus datang langsung ke klinik.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="mt-4 icon-box mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Lihat Jadwal Dokter</h4>
                                    <p>Lihat jadwal dokter secara real-time dan pilih waktu yang sesuai dengan jadwal Anda. 
                                        Kami menawarkan fleksibilitas untuk menyesuaikan janji temu Anda dengan jadwal dokter yang tersedia.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="mt-4 icon-box mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Akses Rekam Medis</h4>
                                    <p>Akses rekam medis Anda dengan mudah dan cepat melalui platform kami. 
                                        Semua data kesehatan Anda disimpan dengan aman dan dapat diakses kapan saja sesuai kebutuhan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Why Us Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">
                <div class="section-title">
                    <h2>About</h2>
                </div>
                <div class="row">
                    <div
                        class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                        {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="mb-4 glightbox play-btn"></a> --}}
                    </div>

                    <div
                        class="py-5 col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center px-lg-5">
                        <h3>Tentang Klinikku</h3>
                        <p>Klinikku adalah pusat layanan kesehatan yang berdedikasi untuk memberikan perawatan yang terbaik dan terpercaya bagi masyarakat. Kami mengutamakan kenyamanan dan kemudahan akses untuk semua pasien kami.</p>

                        <div class="icon-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chat-heart" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.965 12.695a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2m-.8 3.108.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125M8 5.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                                </svg>
                            </div>
                            <h4 class="title"><a href="">Komitmen Kami</a></h4>
                            <p class="description">Komitmen kami adalah memberikan pelayanan kesehatan yang terbaik dengan mengutamakan kebutuhan dan kenyamanan pasien. Kami selalu berusaha untuk meningkatkan kualitas layanan kami.</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-display" viewBox="0 0 16 16">
                                    <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4q0 1 .25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75Q6 13 6 12H2s-2 0-2-2zm1.398-.855a.76.76 0 0 0-.254.302A1.5 1.5 0 0 0 1 4.01V10c0 .325.078.502.145.602q.105.156.302.254a1.5 1.5 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.76.76 0 0 0 .254-.302 1.5 1.5 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.76.76 0 0 0-.302-.254A1.5 1.5 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145"/>
                                </svg>
                            </div>
                            <h4 class="title"><a href="">Teknologi Terkini</a></h4>
                            <p class="description">Kami menggunakan teknologi terkini untuk memastikan bahwa Anda mendapatkan perawatan yang efisien dan tepat waktu. Dengan sistem online kami, Anda dapat dengan mudah mengakses layanan kami kapan saja dan di mana saja</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                                    <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                                </svg>
                            </div>
                            <h4 class="title"><a href="">Pengalaman Pasien</a></h4>
                            <p class="description">Kami percaya bahwa setiap pasien adalah prioritas utama. Oleh karena itu, kami berfokus pada memberikan pengalaman pelayanan yang ramah, profesional, dan penuh perhatian.</p>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">

            <div class="container">
                <div class="section-title">
                    <h2>Jadwal Dokter</h2>
                    <p>Silahkan melihat jadwal dokter, di bawah ini</p>
                </div>

                <div class="row">
                    @foreach ($data as $doctor)
                        <div class="mt-4 col-lg-6">
                            <div class="member d-flex align-items-start">
                                <div class="pic">
                                    <img src="{{ asset($doctor->image) }}" class="img-fluid" alt="{{ $doctor->name }}">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $doctor->name }}</h4>
                                    <span>{{ $doctor->spesialis }}</span>
                                    <p>Gender: {{ $doctor->gender }} | Usia: {{ $doctor->age }}</p>
                                    <div>
                                        <button class="btn btn-primary btn-custom me-3" data-bs-toggle="modal"
                                            data-bs-target="#scheduleModal{{ $doctor->id }}">Jadwal</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="scheduleModal{{ $doctor->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Schedule for {{ $doctor->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="w-full">
                                            <label for="date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                                Tanggal</label>
                                            <input type="date" name="date" id="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                            @error('date')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div id="availableSchedule" class="mt-4 row">
                                            <!-- Tempat untuk menampilkan jadwal yang tersedia -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modals = document.querySelectorAll('.modal');

                modals.forEach(function(modal) {
                    var dateInput = modal.querySelector('.modal-body input[type="date"]');
                    var availableScheduleDiv = modal.querySelector('.modal-body #availableSchedule');

                    dateInput.addEventListener('change', function() {
                        var selectedDate = this.value;
                        var doctorId = modal.getAttribute('id').replace('scheduleModal', '');

                        // Ajax request to fetch available schedules for this doctor and date
                        fetch('/fetch-available-schedules/' + doctorId + '/' + selectedDate)
                            .then(response => response.json())
                            .then(data => {
                                // Clear previous content
                                availableScheduleDiv.innerHTML = '';

                                // Loop through data and append available schedules
                                data.forEach(schedule => {
                                    if (schedule.status === 'Available') {
                                        var scheduleBlock = document.createElement('div');
                                        scheduleBlock.classList.add('bg-green-200', 'p-2',
                                            'mb-2', 'rounded', 'col-lg-5',
                                            'text-center',
                                            'm-auto');
                                        scheduleBlock.textContent = schedule.start_time +
                                            ' - ' + schedule.end_time;
                                        availableScheduleDiv.appendChild(scheduleBlock);
                                    }
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching available schedules:', error);
                            });
                    });
                });
            });
        </script>
    @endsection

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-title">
                <h2>Gallery</h2>
                <p>Di sini Anda dapat melihat berbagai foto dan momen berharga dari aktivitas dan layanan yang kami tawarkan di Klinikku. Kami bangga dapat memberikan pelayanan terbaik kepada semua pasien kami.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row g-0">

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-1.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-1.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-2.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-2.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-3.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-3.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-4.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-4.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-5.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-5.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-6.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-6.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-7.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-7.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="img/gallery/gallery-8.jpg" class="galelry-lightbox">
                            <img src="img/gallery/gallery-8.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Gallery Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Kontak</h2>
            <p>Hubungi kami untuk informasi lebih lanjut tentang layanan kami. Kami siap membantu Anda dengan segala kebutuhan kesehatan Anda.</p>
        </div>
    </div>

    <div>
        <iframe style="border:0; width: 100%; height: 350px;"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15830.11028309791!2d110.8573699!3d-7.5582735!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a143e0e39b97b%3A0x15cc150c144c67b4!2sUniversitas%20Sebelas%20Maret!5e0!3m2!1sid!2sid!4v1626899087478!5m2!1sid!2sid"
            frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="container">
        <div class="mt-5 row justify-content-center">
            <div class="col-lg-10">
                <div class="info d-flex justify-content-around align-items-center">
                    <div class="contact-item d-flex align-items-center">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            </svg>
                        </i>
                        <div>
                            <h4>Location:</h4>
                            <p>Jl. Ir. Sutami No.36 A, Surakarta, Jawa Tengah 57126</p>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-center">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                            </svg>
                        </i>
                        <div>
                            <h4>Email:</h4>
                            <p>info@uns.ac.id</p>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-center">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                                <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0" />
                            </svg>
                        </i>
                        <div>
                            <h4>Call:</h4>
                            <p>+62 271 637 697</p>
                        </div>

                    </div>
                </div>

                {{-- <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div> --}}

                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container py-4 d-md-flex">
        <div class="text-center me-md-auto text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="White" class="bi bi-arrow-up"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd" stroke="white" stroke-width="1"
            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
    </svg>
</a>
@endsection
