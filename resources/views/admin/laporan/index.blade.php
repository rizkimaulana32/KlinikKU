@extends('layouts.admin')

@section('content')
    <div class="pt-32 sm:ml-64">
        <div class="container p-8 mx-auto">
            <h1 class="mb-8 text-3xl font-bold text-center">Generate Report</h1>

            <form action="{{ url('/admin/laporan/generate') }}" method="POST"
                class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="end_date" id="end_date"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="inline-block px-6 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Generate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
