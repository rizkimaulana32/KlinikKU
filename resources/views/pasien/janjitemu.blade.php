@extends('layouts.app')

@section('content')

    <!-- ======= Status Section ======= -->
    <section id="status">
        <div class="container mt-5">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->pasien->janjiTemu->isEmpty())
                <div class="text-center">Anda belum melakukan janji temu</div>
            @else
                @foreach ($data as $janjiTemu)
                    <div class="appointment-card">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Status Janji Temu</h4>
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
                                    {{ $janjiTemu->date }} | {{ $janjiTemu->start_time }} - {{ $janjiTemu->end_time }}
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
                                <form method="POST"
                                    action="{{ url('/pasien/janjitemu/' . $janjiTemu->id . '/dokter/' . $janjiTemu->dokter_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-m"
                                        {{ $janjiTemu->status == 'Completed' ? 'disabled' : '' }}>
                                        Batalkan
                                    </button>
                                </form>
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
                                    <form method="POST" action="{{ url('/pasien/janjitemu/' . $janjiTemu->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="w-full">
                                            <label for="date{{ $janjiTemu->dokter_id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                                Tanggal</label>
                                            <input type="date" name="date" id="date{{ $janjiTemu->dokter_id }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $janjiTemu->date }}" required>

                                        </div>
                                        <div class="w-full mt-3">
                                            <label for="slot{{ $janjiTemu->dokter_id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slot
                                                Waktu</label>
                                            <select id="slot{{ $janjiTemu->dokter_id }}" name="slot"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                                <!-- Slot options will be filled dynamically with JavaScript -->
                                            </select>
                                        </div>
                                        <div class="mt-3 sm:col-span-2">
                                            <label for="note{{ $janjiTemu->dokter_id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keluhan</label>
                                            <textarea id="note{{ $janjiTemu->dokter_id }}" rows="2" name="note"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Type note here" required>{{ $janjiTemu->note }}</textarea>

                                        </div>
                                        <div class="w-full mt-3">
                                            <label for="password{{ $janjiTemu->dokter_id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                                                Confirmation</label>
                                            <input type="password" name="password" id="password{{ $janjiTemu->dokter_id }}"
                                                placeholder="Type your password here"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-primary btn-custom"
                                            id="submitFormBtn{{ $janjiTemu->dokter_id }}">Submit</button>
                                    </form>
                                </div>
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
