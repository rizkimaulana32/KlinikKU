@extends('layouts.app')

@section('content')
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
        <div class="container mt-5">
            @include('components.error-flash-bs')

            <div class="mt-10 section-title">
                <h2>Dokter</h2>
            </div>
            <div class="container">
                <form action="{{ url('/pasien/dokter') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search"
                        id="search" value="{{ request()->search }}">
                    <button class="btn btn-outline-primary me-2" type="submit">Search</button>
                    <a href="{{ url('/pasien/dokter') }}" class="btn btn-outline-secondary" type="reset"
                        id="resetButton">Reset</a>
                </form>
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
                                        data-bs-target="#scheduleModal{{ $doctor->id }}">Buat Janji</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Schedule for {{ $doctor->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ url('/pasien/janjitemu/' . $doctor->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="date{{ $doctor->id }}" class="form-label">Pilih Tanggal</label>
                                            <input type="date" name="date" id="date{{ $doctor->id }}"
                                                class="form-control @error('date') is-invalid @enderror" required>
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slot{{ $doctor->id }}" class="form-label">Slot Waktu</label>
                                            <select id="slot{{ $doctor->id }}" name="slot"
                                                class="form-select @error('slot') is-invalid @enderror" required>
                                                <!-- Slot options will be filled dynamically -->
                                            </select>
                                            @error('slot')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="note{{ $doctor->id }}" class="form-label">Keluhan</label>
                                            <textarea id="note{{ $doctor->id }}" rows="2" name="note"
                                                class="form-control @error('note') is-invalid @enderror" placeholder="Type note here" required></textarea>
                                            @error('note')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Confirmation</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Type your password here" required>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" form-group d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Buat Janji</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Doctors Section -->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="date"]').forEach(function(dateInput) {
                dateInput.addEventListener('change', function() {
                    const doctorId = dateInput.id.replace('date', '');
                    const selectedDate = dateInput.value;
                    const slotSelect = document.getElementById('slot' + doctorId);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`/get-available-slots/${doctorId}?date=${selectedDate}`, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(slots => {
                            slotSelect.innerHTML = '';
                            slots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = `${slot.start_time}-${slot.end_time}`;
                                option.textContent =
                                    `${slot.start_time} - ${slot.end_time}`;
                                slotSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:',
                                error);
                        });
                });
            });
        });
    </script>
@endsection
