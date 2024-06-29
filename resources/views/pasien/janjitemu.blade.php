@extends('layouts.app')

@section('content')
    <!-- ======= Status Section ======= -->
    <section id="status">
        <div class="container mt-5">
            <div class="appointment-card">
                <div class="row">
                    <div class="text-center col-md-12">
                        <h4>Status Janji Temu</h4>
                    </div>
                </div>
                <div class="mt-4 row">
                    <div class="text-center col-md-6">
                        <p class="status-badge"><strong>Status:</strong> <span class="badge bg-success">Dikonfirmasi</span>
                        </p>
                    </div>
                    <div class="text-center col-md-6">
                        <p class="appointment-date"><strong>Tanggal:</strong> 25 Mei 2024</p>
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="text-center col-md-6">
                        <button class="btn btn-primary btn-custom">Ubah Janji Temu</button>
                    </div>
                    <div class="text-center col-md-6">
                        <button class="btn btn-danger btn-custom">Batalkan Janji Temu</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Status Section -->
@endSection
