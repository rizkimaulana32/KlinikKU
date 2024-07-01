@extends('layouts.admin')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="pt-8 mt-8 bg-white">
            <div class="container max-w-full mx-auto">
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-900">Doctor Management Table</h2>

                <div class="flex flex-col mt-4 mb-4 sm:flex-row sm:justify-between">
                    <div class="flex items-center mb-2 sm:mb-0">
                        <form action="{{ url('/admin/list') }}" method="GET" class="flex items-center w-full sm:w-auto">
                            <input type="text" name="search" placeholder="Search..." value="{{ request()->search }}"
                                class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500" />
                            <button type="submit"
                                class="ml-2.5 whitespace-nowrap rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Search</button>
                        </form>
                        <a href="{{ url('/admin/list') }}"
                            class="ml-2 whitespace-nowrap rounded-lg bg-white px-4 py-2 text-sm font-medium text-blue-700 outline outline-1 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:ml-2.5">
                            Reset </a>
                    </div>

                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Spesialis</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Actions</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = $data->firstItem(); ?>
                            @foreach ($data as $dokter)
                                <tr>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $no }}</td>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $dokter->name }}</td>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $dokter->spesialis }}</td>

                                    <td class="px-6 py-4 text-sm font-medium text-left">
                                        <div class="flex items-center">
                                            <a href="{{ url('/admin/list/' . $dokter->id . '/janjitemu') }}"
                                                class="text-indigo-600 hover:text-indigo-900 whitespace-nowrap">Janji
                                                Temu</a>
                                            <a href="{{ url('/admin/list/' . $dokter->id . '/jadwal') }}"
                                                class="ml-4 text-green-600 hover:text-green-900">Jadwal</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $data->links() }}
            </div>
    </section>
@endsection
