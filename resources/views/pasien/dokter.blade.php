@extends('layouts.app')

@section('content')
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors" style="padding-top: 80px;">
        <div class="container">
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
                                        <div class="w-full">
                                            <label for="date{{ $doctor->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                                Tanggal</label>
                                            <input type="date" name="date" id="date{{ $doctor->id }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                            @error('date')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full mt-3">
                                            <label for="slot{{ $doctor->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slot
                                                Waktu</label>
                                            <select id="slot{{ $doctor->id }}" name="slot"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                                <!-- Slot options will be filled dynamically -->
                                            </select>
                                        </div>
                                        <div class="mt-3 sm:col-span-2">
                                            <label for="note{{ $doctor->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keluhan</label>
                                            <textarea id="note{{ $doctor->id }}" rows="2" name="note"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Type note here" required></textarea>
                                            @error('note')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-full mt-3">
                                            <label for="password"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                                                Confirmation</label>
                                            <input type="password" name="password" id="password"
                                                placeholder="Type your password here"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                            @error('password')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-primary btn-custom"
                                            id="submitFormBtn">Submit</button>
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
