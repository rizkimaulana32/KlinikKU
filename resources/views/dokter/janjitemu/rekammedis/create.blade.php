@extends('layouts.admin')

@section('content')
    <section class="p-4 bg-white dark:bg-gray-900 sm:ml-64">
        <div class="max-w-3xl px-4 py-8 mx-auto md:py-16">
            <h2 class="mt-8 mb-4 text-xl font-bold text-gray-900 sm:mt-4 dark:text-white">Add a Rekam Medis</h2>
            <form action="{{ url('/dokter/janjitemu/' . $janji_temu_id . '/rekammedis') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="diagnosis"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diagnosis</label>
                        <textarea id="diagnosis" rows="2" name="diagnosis"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type diagnosis here" required></textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="obat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resep
                            obat</label>
                        <textarea id="obat" rows="2" name="obat"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type resep obat here" required></textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tindakan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tindakan</label>
                        <textarea id="tindakan" rows="2" name="tindakan"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type tindakan here" required></textarea>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ url('/dokter/janjitemu/' . $janji_temu_id . '/rekammedis') }}"
                        class="px-4 py-2 text-sm font-medium text-center text-blue-700 bg-white border border-blue-700 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300">Back</a>
                    <button type="submit"
                        class="whitespace-nowrap ml-2.5 items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Create Rekam Medis
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
