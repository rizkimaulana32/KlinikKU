@extends('layouts.admin')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="pt-8 mt-8 bg-white">
            <div class="container max-w-full mx-auto">
                <div class="container max-w-full mx-auto">
                    @include('components.success-flash-tw')
                    @include('components.error-flash-tw')
                    <h2 class="mb-4 text-2xl font-bold text-center text-gray-900">Schedule Table</h2>

                    <div class="flex flex-col mt-4 mb-4 sm:flex-row sm:justify-between">
                        <div class="flex items-center mb-2 sm:mb-0">
                            <form action="{{ url('/dokter/jadwal') }}" method="GET"
                                class="flex items-center w-full sm:w-auto">
                                <input type="text" name="search" placeholder="Search..." value="{{ request()->search }}"
                                    class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500" />
                                <button type="submit"
                                    class="ml-2.5 whitespace-nowrap rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Search</button>
                            </form>
                            <a href="{{ url('/dokter/jadwal') }}"
                                class="ml-2 whitespace-nowrap rounded-lg bg-white px-4 py-2 text-sm font-medium text-blue-700 outline outline-1 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:ml-2.5">
                                Reset </a>
                        </div>

                        <div class="flex justify-center mt-2 sm:mt-0 sm:justify-end ml-2.5">
                            <a href="{{ url('/dokter/jadwal/create') }}"
                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg whitespace-nowrap hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                Add Schedule </a>
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
                                        Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Start Time</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        End Time</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $no = $data->firstItem(); ?>
                                @foreach ($data as $jadwal)
                                    <tr>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $no }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $jadwal->date }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $jadwal->start_time }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $jadwal->end_time }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $jadwal->status }}</td>

                                        <td class="px-6 py-4 text-sm font-medium text-left">
                                            <div class="flex items-center">
                                                <a href="{{ url('/dokter/jadwal/' . $jadwal->id . '/edit') }}"
                                                    class="mr-4 text-indigo-600 hover:text-indigo-900">Update</a>

                                                <button id="deleteBtn{{ $jadwal->id }}"
                                                    class="text-red-600 hover:text-red-900" type="button"
                                                    onclick="toggleModal('deleteModal{{ $jadwal->id }}')">
                                                    Delete
                                                </button>
                                                @include('components.confirm-delete', [
                                                    'itemId' => $jadwal->id,
                                                    'action' => '/dokter/jadwal/' . $jadwal->id,
                                                ])
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
