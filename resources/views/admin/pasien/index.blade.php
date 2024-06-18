@extends('layouts.admin')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="pt-8 mt-8 bg-white">
            <div class="container max-w-full mx-auto">
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-900">Patient Table</h2>

                <div class="flex flex-col mt-4 mb-4 sm:flex-row sm:justify-between">
                    <div class="flex items-center mb-2 sm:mb-0">
                        <form action="{{ url('/admin/pasien') }}" method="GET" class="flex items-center w-full sm:w-auto">
                            <input type="text" name="search" placeholder="Search..."
                                class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500" />
                            <button type="submit"
                                class="ml-2.5 whitespace-nowrap rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Search</button>
                        </form>
                        <a href="{{ url('/admin/pasien') }}"
                            class="ml-2 whitespace-nowrap rounded-lg bg-white px-4 py-2 text-sm font-medium text-blue-700 outline outline-1 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:ml-2.5">
                            Reset </a>
                    </div>
                </div>

                {{-- <div class="flex justify-between mt-4 mb-4">
                    <div class="flex items-center">
                        <form action="{{ url('/admin/pasien') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" placeholder="Search..."
                                class="px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit"
                                class="ml-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                Search
                            </button>
                        </form>
                        <a href="{{ url('/admin/pasien') }}"
                            class="ml-2.5 bg-white text-blue-700 outline outline-1 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            Reset
                        </a>
                    </div>

                    {{-- <a href="{{ url('/admin/pasien/create') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg focus:ring-4 focus:ring-green-300 hover:bg-green-700">
                        Add Patient
                    </a> --}}
                {{-- </div> --}}

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Username</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                                    Tanggal Lahir</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Umur</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Gender</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Alamat</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                                    No Telpon</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Actions</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $no = $data->firstItem(); ?>
                            @foreach ($data as $user)
                                <tr>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $no }}</td>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $user->username }}</td>
                                    <td class="max-w-xs px-6 py-4 truncate">{{ $user->email }}</td>
                                    @if ($user->pasien)
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->name }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->birth_date }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->age }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->gender }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->address }}</td>
                                        <td class="max-w-xs px-6 py-4 truncate">{{ $user->pasien->phone }}</td>
                                    @else
                                        <td class="max-w-xs px-6 py-4 truncate" colspan="6"></td>
                                    @endif

                                    <td class="px-6 py-4 text-sm font-medium text-left">
                                        <div class="flex items-center">
                                            <a href="{{ url('/admin/pasien/' . $user->id . '/edit') }}"
                                                class="mr-4 text-indigo-600 hover:text-indigo-900">Update</a>
                                            <form action=" {{ url('/admin/pasien/' . $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
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
