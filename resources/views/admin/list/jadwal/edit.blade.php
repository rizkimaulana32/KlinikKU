@extends('layouts.admin')

@section('content')
    <section class="p-4 bg-white dark:bg-gray-900 sm:ml-64">
        <div class="max-w-3xl px-4 py-8 mx-auto md:py-16">
            <h2 class="mt-8 mb-4 text-xl font-bold text-gray-900 sm:mt-4 dark:text-white">Edit a Schedule</h2>
            <form action="{{ url('/admin/list/' . $dokter_id . '/jadwal/' . $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type date" value={{ $data->date }} required="">
                        @error('date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Available" {{ $data->status == 'Available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="Unavailable" {{ $data->status == 'Unavailable' ? 'selected' : '' }}>Unavailable
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slot
                            Waktu Mulai</label>
                        <input type="time" name="start_time" id="start_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type start time" value="{{ $data->start_time }}" required="">
                        @error('start_time')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slot
                            Waktu Akhir</label>
                        <input type="time" name="end_time" id="end_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type end_time" value="{{ $data->end_time }}" required="">
                        @error('end_time')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ url('/admin/list/' . $dokter_id . '/jadwal') }}"
                        class="px-4 py-2 text-sm font-medium text-center text-blue-700 bg-white border border-blue-700 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300">Back</a>
                    <button type="submit"
                        class="ml-2.5 items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg whitespace-nowrap focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Update Schedule
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
