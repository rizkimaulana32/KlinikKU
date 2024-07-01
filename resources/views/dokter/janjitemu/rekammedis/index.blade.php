@extends('layouts.admin')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="pt-8 mt-8 bg-white">
            @include('components.success-flash-tw')
            @include('components.error-flash-tw')
            <div class="container max-w-full mx-auto">
                <div class="flex flex-row mb-4">
                    <div class="basis-1/3">
                        <a href="{{ url('/dokter/janjitemu') }}"
                            class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-700 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300">Back</a>
                    </div>
                    <h2 class="text-2xl font-bold text-center text-gray-900 basis-1/3">Rekam Medis</h2>
                    <div class="basis-1/3"></div>
                </div>

                @if ($rekammedis)
                    @if (session('error'))
                        <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="mt-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <h3 class="text-lg font-bold">Diagnosis</h3>
                                <p class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">{{ $rekammedis->diagnosis }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <h3 class="text-lg font-bold">Resep Obat</h3>
                                <p class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">{{ $rekammedis->obat }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <h3 class="text-lg font-bold">Tindakan</h3>
                                <p class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">{{ $rekammedis->tindakan }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ url('/dokter/janjitemu/' . $janji_temu_id . '/rekammedis/' . $rekammedis->id . '/edit') }}"
                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Update</a>

                            <button id="deleteBtn{{ $rekammedis->id }}"
                                class="px-4 py-2 ml-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700"
                                type="button" onclick="toggleModal('deleteModal{{ $rekammedis->id }}')">
                                Delete
                            </button>
                            @include('components.confirm-delete', [
                                'itemId' => $rekammedis->id,
                                'action' =>
                                    '/dokter/janjitemu/' . $janji_temu_id . '/rekammedis/' . $rekammedis->id,
                            ])
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-32 mt-4">
                        <p class="text-sm text-gray-700">No rekam medis found for this appointment.</p>
                        <a href="{{ url('/dokter/janjitemu/' . $janji_temu_id . '/rekammedis/create') }}"
                            class="px-4 py-2 mt-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Add
                            Rekam Medis</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
