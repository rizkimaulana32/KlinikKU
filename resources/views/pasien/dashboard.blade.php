@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            @if (!auth()->user()->pasien)
                <h1>Welcome to Klinikku</h1>
            @else
                <h1>Welcome <span
                        class="text-transparent bg-gradient-to-r from-blue-800 via-blue-400 to-blue-500 bg-clip-text">{{ auth()->user()->pasien->name }}</span>
                    to Klinikku</h1>
            @endif
            <h2>Solusi Kesehatan Terlengkap</h2>
            <a href="{{ url('/pasien/dokter') }}" class="btn-get-started">Choose Dokter</a>
        </div>
    </section><!-- End Hero -->

    <!-- ======= Why Us Section ======= -->
    {{-- <section id="why-us" class="why-us">
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
                                    <h4>Pendaftaran Pasien Online</h4>
                                    <p>daftar secara online melalui website Klinikku. Anda dapat
                                        memilih dokter atau layanan yang diinginkan, dan membuat
                                        janji temu tanpa harus datang langsung ke klinik.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="mt-4 icon-box mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Lihat Jadwal Dokter</h4>
                                    <p>
                                        deserunt</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="mt-4 icon-box mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Akses Rekam Medis</h4>
                                    <p>
                                        facere</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Why Us Section --> --}}
@endsection
