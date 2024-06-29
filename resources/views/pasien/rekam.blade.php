@extends('layouts.app')
@section('content')
    <section id="record"><!-- Record Status Section -->
        <div class="container mt-5">
            <div class="record-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center record-title">Hasil Rekam Medis</div>
                    </div>
                </div>
                <div class="row record-section">
                    <div class="col-md-6">
                        <h5>Informasi Pasien</h5>
                        <p><strong>Nama:</strong> John Doe</p>
                        <p><strong>Usia:</strong> 30 tahun</p>
                        <p><strong>Jenis Kelamin:</strong> Laki-laki</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Dokter</h5>
                        <p><strong>Nama Dokter:</strong> Dr. Jane Smith</p>
                        <p><strong>Spesialisasi:</strong> Kardiologi</p>
                        <p><strong>Tanggal Konsultasi:</strong> 20 Mei 2024</p>
                    </div>
                </div>
                <div class="row record-section">
                    <div class="col-md-12">
                        <h5>Diagnosis</h5>
                        <p>Penyakit jantung koroner yang membutuhkan penanganan lanjutan dan pemantauan rutin.</p>
                    </div>
                </div>
                <div class="row record-section">
                    <div class="col-md-12">
                        <h5>Resep dan Pengobatan</h5>
                        <p><strong>Obat:</strong> Aspirin, 81 mg, 1 kali sehari</p>
                        <p><strong>Catatan:</strong> Harus dikonsumsi setelah makan untuk menghindari iritasi
                            lambung.</p>
                    </div>
                </div>
                <div class="row record-section">
                    <div class="col-md-12">
                        <h5>Saran dan Tindak Lanjut</h5>
                        <p>Pasien disarankan untuk melakukan pemeriksaan lanjutan dalam waktu satu bulan serta
                            menjaga pola
                            makan dan rutin berolahraga ringan.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 record-buttons">
                        <button class="btn btn-primary">Cetak</button>
                        <button class="btn btn-secondary">Unduh PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
