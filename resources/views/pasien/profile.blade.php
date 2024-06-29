@extends('layouts.app')
@section('content')
    <section id="profile">
        <div class="container mt-5">
            <div class="profile-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center profile-title">Profil Pasien</div>
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" value="John Doe">
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia:</label>
                        <input type="number" class="form-control" id="usia" value="30">
                    </div>
                    <div class="form-group">
                        <label for="jenis-kelamin">Jenis Kelamin:</label>
                        <select class="form-control" id="jenis-kelamin">
                            <option selected>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" value="Jl. Sejahtera No. 10">
                    </div>
                    <div class="form-group">
                        <label for="nomor-telepon">Nomor Telepon:</label>
                        <input type="text" class="form-control" id="nomor-telepon" value="081234567890">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" value="johndoe@example.com">
                    </div>
                    <div class="form-group save-button">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
