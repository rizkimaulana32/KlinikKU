@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to Klinikku</h1>
            <h2>We are team of talented designers making websites with Bootstrap</h2>
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
                            <h3>Why Choose Medilab?</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et
                                dolore magna aliqua. Duis aute irure dolor in reprehenderit
                                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus
                                optio ad
                                corporis.
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
                                        <h4>Corporis voluptates sit</h4>
                                        <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut
                                            aliquip</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="mt-4 icon-box mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Ullamco laboris ladore pan</h4>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="mt-4 icon-box mt-xl-0">
                                        <i class="bx bx-images"></i>
                                        <h4>Labore consequatur</h4>
                                        <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis
                                            facere</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
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
                        <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
                        <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed
                            minima temporibus
                            laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam
                            sint
                            et id nulla
                            tenetur. Suscipit aut voluptate.</p>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-fingerprint"></i></div>
                            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                                excepturi sint
                                occaecati cupiditate non provident</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-gift"></i></div>
                            <h4 class="title"><a href="">Nemo Enim</a></h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                blanditiis
                                praesentium voluptatum deleniti atque</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-atom"></i></div>
                            <h4 class="title"><a href="">Dine Pad</a></h4>
                            <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et
                                veritatis
                                odit. Sunt aut
                                deserunt minus aut eligendi omnis</p>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">

            <div class="container">
                <div class="section-title">
                    <h2>Doctors' Schedule</h2>
                    <p>Check the schedule of our doctors below.</p>
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
                                        <div id="availableSchedule" class="mt-4">
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
                                            'mb-2');
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
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.
                    Quia fugiat sit
                    in iste officiis commodi quidem hic quas.</p>
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
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.
                    Quia fugiat sit
                    in iste officiis commodi quidem hic quas.</p>
            </div>
        </div>

        <div>
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                frameborder="0" allowfullscreen></iframe>
        </div>


        <div class="container">
            <div class="mt-5 row">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                </svg>
                            </i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                </svg>
                            </i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0" />
                                </svg>
                            </i>
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
                        </div>

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
