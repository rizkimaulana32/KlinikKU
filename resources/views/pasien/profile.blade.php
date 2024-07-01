@extends('layouts.app')

@section('content')
    <section id="profile">
        <div class="container mt-5">
            @include('components.error-flash-bs')
            @include('components.success-flash-bs')
            <div class="mt-10 section-title">
                <h2>Profile</h2>
            </div>
            <div class="px-5 py-2 bg-white rounded-lg shadow-md profile-card">
                @if (!Auth::user()->pasien)
                    <form method="POST" action="{{ route('pasien.profile.create') }}">
                    @else
                        <form method="POST" action="{{ url('/pasien/profile/' . $data->id . '/update') }}">
                            @method('PUT')
                @endif
                @csrf

                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $data->pasien->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="birth_date" class="form-label">Tanggal Lahir:</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                        name="birth_date" value="{{ old('birth_date', $data->pasien->birth_date ?? '') }}">
                    @error('birth_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="age" class="form-label">Usia:</label>
                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age"
                        name="age" value="{{ old('age', $data->pasien->age ?? '') }}">
                    @error('age')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="gender" class="form-label">Jenis Kelamin:</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                        @if (!Auth::user()->pasien)
                            <option value="Laki-Laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @else
                            <option value="Laki-Laki"
                                {{ old('gender', $data->pasien->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('gender', $data->pasien->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        @endif
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="address" class="form-label">Alamat:</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', $data->pasien->address ?? '') }}">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="phone" class="form-label">Nomor Telepon:</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" value="{{ old('phone', $data->pasien->phone ?? '') }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="username" class="form-label">Username:</label>
                    @if (!Auth::user()->pasien)
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ Auth::user()->username }}" disabled>
                    @else
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username', $data->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>

                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email:</label>
                    @if (!Auth::user()->pasien)
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}" disabled>
                    @else
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $data->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>

                <div class="mb-3 form-group">
                    <label for="password" class="form-label">Password:</label>
                    @if (!Auth::user()->pasien)
                        <input type="password" class="form-control" id="password" name="password" value="" disabled>
                    @else
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Masukkan password baru">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>

                <div class="mb-3 form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
