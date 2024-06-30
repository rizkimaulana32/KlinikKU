@extends('layouts.app')

@section('content')
    <section id="profile">
        <div class="container mt-5">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="p-5 bg-white rounded-lg shadow-md profile-card">
                <div class="mb-5 text-2xl font-bold text-center">Profil Pasien</div>
                @if (!Auth::user()->pasien)
                    <form method="POST" action="{{ route('pasien.profile.create') }}">
                    @else
                        <form method="POST" action="{{ url('/pasien/profile/' . $data->id . '/update') }}">
                            @method('PUT')
                @endif
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $data->pasien->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="birth_date" class="form-label">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ $data->pasien->birth_date ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Usia:</label>
                    <input type="number" class="form-control" id="age" name="age"
                        value="{{ $data->pasien->age ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin:</label>
                    <select class="form-select" id="gender" name="gender">
                        @if (!Auth::user()->pasien)
                            <option value="Laki-Laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @else
                            <option value="Laki-Laki" {{ $data->pasien->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ $data->pasien->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat:</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $data->pasien->address ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $data->pasien->phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    @if (!Auth::user()->pasien)
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ Auth::user()->username }}" disabled>
                    @else
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $data->username }}" required>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    @if (!Auth::user()->pasien)
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}" disabled>
                    @else
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $data->email }}" required>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    @if (!Auth::user()->pasien)
                        <input type="password" class="form-control" id="password" name="password" value=""
                            disabled>
                    @else
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password baru">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    @endif
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
