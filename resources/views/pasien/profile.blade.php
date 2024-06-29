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
            @if (!Auth::user()->pasien)
            <form method="POST" action="{{ route('pasien.profile.create') }}">
            @else
            <form method="POST" action="{{ url('/pasien/profile/'. $dataPasien->id . '/update') }}">
                @method('PUT');
            @endif
                @csrf
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $dataPasien->name ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $dataPasien->birth_date ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="age">Usia:</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ $dataPasien->age ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="Laki-Laki"
                        {{ optional($dataPasien->gender) == 'Laki-Laki' ? 'selected' : '' }} >Laki-laki</option>
                        <option value="Perempuan"
                        {{ optional($dataPasien->gender) == 'Perempuan' ? 'selected' : '' }} >Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $dataPasien->address ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $dataPasien->phone ?? '' }}">
                </div>
            
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="form-group save-button">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
