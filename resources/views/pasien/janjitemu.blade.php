@extends('layouts.app')

@section('content')

    <!-- ======= Status Section ======= -->
    <section id="status">
        <div class="container mt-5">
            @include('components.error-flash-bs')

            @include('components.success-flash-bs')

            @if (auth()->user()->pasien->janjiTemu->isEmpty())
                <div class="flex items-center justify-center min-h-96">Anda belum melakukan janji temu</div>
            @else
                <div class="mt-10 section-title">
                    <h2>Janji Temu</h2>
                </div>
                @foreach ($data as $janjiTemu)
                    <div class="mb-4 appointment-card">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="font-bold text-center">Janji Temu - {{ $janjiTemu->dokter->name }}</h5>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="text-center col-md-6">
                                <p class="status-badge"><strong>Status:</strong>
                                    <span
                                        class="badge {{ $janjiTemu->status == 'Completed' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $janjiTemu->status }}
                                    </span>
                                </p>
                            </div>
                            <div class="text-center col-md-6">
                                <p class="appointment-date"><strong>Tanggal:</strong>
                                    {{ date('d F Y', strtotime($janjiTemu->date)) }} |
                                    {{ date('H:i', strtotime($janjiTemu->start_time)) }} -
                                    {{ date('H:i', strtotime($janjiTemu->end_time)) }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="text-center col-md-6">
                                <button class="btn btn-primary btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#scheduleModal{{ $janjiTemu->id }}"
                                    {{ $janjiTemu->status == 'Completed' ? 'disabled' : '' }}>
                                    Ubah Jadwal
                                </button>
                            </div>
                            <div class="text-center col-md-6">
                                <!-- Tombol untuk memunculkan modal konfirmasi -->
                                <button type="button" class="btn btn-danger btn-m"
                                    {{ $janjiTemu->status == 'Completed' ? 'disabled' : '' }} data-bs-toggle="modal"
                                    data-bs-target="#cancelAppointmentModal{{ $janjiTemu->id }}">
                                    Batalkan
                                </button>

                                <!-- Modal konfirmasi pembatalan -->
                                <div class="modal fade" id="cancelAppointmentModal{{ $janjiTemu->id }}" tabindex="-1"
                                    aria-labelledby="cancelAppointmentModalLabel{{ $janjiTemu->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="cancelAppointmentModalLabel{{ $janjiTemu->id }}">Konfirmasi
                                                    Pembatalan Janji Temu</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="confirmCancelForm{{ $janjiTemu->id }}" method="POST"
                                                    action="{{ url('/pasien/janjitemu/' . $janjiTemu->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="mb-3">
                                                        <label for="passwordConfirmation{{ $janjiTemu->id }}"
                                                            class="form-label">Konfirmasi dengan Password</label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Confirm password" required>
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Batalkan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="scheduleModal{{ $janjiTemu->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Schedule</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="updateScheduleForm{{ $janjiTemu->id }}" method="POST"
                                        action="{{ url('/pasien/janjitemu/' . $janjiTemu->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="date{{ $janjiTemu->dokter_id }}" class="form-label">Pilih
                                                Tanggal</label>
                                            <input type="date" name="date" id="date{{ $janjiTemu->dokter_id }}"
                                                class="form-control @error('date') is-invalid @enderror"
                                                value="{{ $janjiTemu->date }}" required>
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slot{{ $janjiTemu->dokter_id }}" class="form-label">Slot
                                                Waktu</label>
                                            <select id="slot{{ $janjiTemu->dokter_id }}" name="slot"
                                                class="form-select @error('slot') is-invalid @enderror" required>
                                                <!-- Slot options will be filled dynamically with JavaScript -->
                                            </select>
                                            @error('slot')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="note{{ $janjiTemu->dokter_id }}" class="form-label">Keluhan</label>
                                            <textarea id="note{{ $janjiTemu->dokter_id }}" rows="2" name="note"
                                                class="form-control @error('note') is-invalid @enderror" placeholder="Type note here" required>{{ $janjiTemu->note }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password{{ $janjiTemu->dokter_id }}" class="form-label">Password
                                                Confirmation</label>
                                            <input type="password" name="password"
                                                id="password{{ $janjiTemu->dokter_id }}"
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
            @endif
        </div>
    </section>
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
