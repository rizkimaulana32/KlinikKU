@extends('layouts.admin')

@section('content')
    <section class="p-4 bg-white dark:bg-gray-900 sm:ml-64">
        <div class="max-w-3xl px-4 py-8 mx-auto md:py-16">
            <h2 class="mt-8 mb-4 text-xl font-bold text-gray-900 sm:mt-4 dark:text-white">Edit an Appointment</h2>
            <form action="{{ url('/admin/list/' . $dokter_id . '/janjitemu/' . $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $data->date }}" required>
                        @error('date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Scheduled" {{ $data->status == 'Scheduled' ? 'selected' : '' }}>Scheduled
                            </option>
                            <option value="Completed" {{ $data->status == 'Completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="slot" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slot
                            Waktu</label>
                        <select id="slot" name="slot"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            @foreach ($available_slots as $slot)
                                <option value="{{ $slot->start_time }}-{{ $slot->end_time }}"
                                    {{ $data->start_time == $slot->start_time && $data->end_time == $slot->end_time ? 'selected' : '' }}>
                                    {{ $slot->start_time }} - {{ $slot->end_time }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tambah Input Hidden untuk Start Time dan End Time -->
                    <input type="hidden" name="start_time" id="start_time" value="{{ $data->start_time }}">
                    <input type="hidden" name="end_time" id="end_time" value="{{ $data->end_time }}">
                    <div class="sm:col-span-2">
                        <label for="note"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Note</label>
                        <textarea id="note" rows="4" name="note"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your note here">{{ $data->note }}</textarea>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ url('/admin/list/' . $dokter_id . '/janjitemu') }}"
                        class="px-4 py-2 text-sm font-medium text-center text-blue-700 bg-white border border-blue-700 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300">Back</a>
                    <button type="submit"
                        class="items-center px-4 py-2 whitespace-nowrap ml-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Update Appointment
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date');
            const slotSelect = document.getElementById('slot');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            dateInput.addEventListener('change', function() {
                const selectedDate = dateInput.value;

                fetch(`/admin/list/{{ $dokter_id }}/available-slots?date=${selectedDate}`, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(slots => {
                        slotSelect.innerHTML = '';
                        slots.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = `${slot.start_time}-${slot.end_time}`;
                            option.textContent = `${slot.start_time} - ${slot.end_time}`;
                            slotSelect.appendChild(option);
                        });

                        // Setel kembali nilai start_time dan end_time sesuai dengan slot terpilih
                        if (slotSelect.options.length > 0) {
                            selectedSlot = slotSelect.value.split('-');
                            startTimeInput.value = selectedSlot[0];
                            endTimeInput.value = selectedSlot[1];
                        } else {
                            startTimeInput.value = '';
                            endTimeInput.value = '';
                        }
                    });
            });

            slotSelect.addEventListener('change', function() {
                const selectedSlot = slotSelect.value.split('-');
                startTimeInput.value = selectedSlot[0];
                endTimeInput.value = selectedSlot[1];
            });

            // Saat halaman dimuat, atur nilai start_time dan end_time berdasarkan nilai awal yang terpilih
            const initialSelectedSlot = slotSelect.value.split('-');
            startTimeInput.value = initialSelectedSlot[0];
            endTimeInput.value = initialSelectedSlot[1];
        });
    </script>
@endsection
