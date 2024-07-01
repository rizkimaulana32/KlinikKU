@extends('layouts.app')

@section('content')
    <!-- Record Status Section -->
    <section id="record">
        <div class="container px-4 mx-auto mt-5">
            @if ($data->isEmpty())
                <div class="flex items-center justify-center min-h-96">Anda belum memiliki rekam medis</div>
            @else
                <div class="mt-10 section-title">
                    <h2>Rekam Medis</h2>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($data as $record)
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <div class="p-4">
                                <h2 class="mb-2 text-xl font-bold text-gray-800">Hasil Rekam Medis</h2>
                                <div class="mb-4 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1.5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 19a9 9 0 100-18 9 9 0 000 18zm-1.5-5a.5.5 0 01.492.41l.008.09v.75a.5.5 0 01-1 0v-.75a.5.5 0 01.5-.5zm1-4.5a.5.5 0 00-1 0v2.5a.5.5 0 001 0v-2.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Tanggal Konsultasi: {{ date('d F Y', strtotime($record->janjiTemu->date)) }} /
                                    Jam Konsultasi: {{ date('H:i', strtotime($record->janjiTemu->start_time)) }} -
                                    {{ date('H:i', strtotime($record->janjiTemu->end_time)) }}
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button
                                        class="px-4 py-2 mr-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 show-more-btn"
                                        data-bs-toggle="modal" data-bs-target="#recordModal{{ $record->id }}">
                                        Show More
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="recordModal{{ $record->id }}" tabindex="-1"
                                        aria-labelledby="recordModalLabel{{ $record->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="bg-gray-200 modal-header">
                                                    <h5 class="text-gray-800 modal-title"
                                                        id="recordModalLabel{{ $record->id }}">Detail Rekam Medis</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 19a9 9 0 100-18 9 9 0 000 18zm-1.5-5a.5.5 0 01.492.41l.008.09v.75a.5.5 0 01-1 0v-.75a.5.5 0 01.5-.5zm1-4.5a.5.5 0 00-1 0v2.5a.5.5 0 001 0v-2.5z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>
                                                                Tanggal Konsultasi:
                                                                {{ date('d F Y', strtotime($record->janjiTemu->date)) }} /
                                                                Jam Konsultasi:
                                                                {{ date('H:i', strtotime($record->janjiTemu->start_time)) }}
                                                                -
                                                                {{ date('H:i', strtotime($record->janjiTemu->end_time)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-700">Informasi Dokter
                                                        </h3>
                                                        <p><strong>Nama Dokter:</strong>
                                                            {{ $record->janjiTemu->dokter->name }}</p>
                                                        <p><strong>Spesialisasi:</strong>
                                                            {{ $record->janjiTemu->dokter->spesialis }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="text-sm text-gray-700">Keluhan:</div>
                                                        <p class="text-gray-800">{{ $record->janjiTemu->note }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="text-sm text-gray-700">Diagnosis:</div>
                                                        <p class="text-gray-800">{{ $record->diagnosis }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="text-sm text-gray-700">Resep Obat:</div>
                                                        <p class="text-gray-800">{{ $record->obat }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="text-sm text-gray-700">Tindakan:</div>
                                                        <p class="text-gray-800">{{ $record->tindakan }}</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
