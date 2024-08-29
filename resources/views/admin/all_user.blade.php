@extends('admin.layout')

@section('title', 'All Data')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-center">All Data</h2>
        <div class="flex flex-wrap md:justify-end items-center mb-1">
            <form action="{{ route('admin.allData') }}" method="GET" class="flex items-center my-3">
                <label for="name" class="mr-2">Search:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="John Doe" class="border border-gray-300 p-2 rounded-md">
                <button type="submit" class="ml-2 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search h-5 w-5" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="flex justify-end items-center mb-6">
            {{-- Order By dropdown --}}
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" onclick="showDropDown()" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-mr-1 h-5 w-5 text-gray-400 bi bi-three-dots-vertical" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        </svg>
                    </button>
                </div>
                <div id="dropDownFilter" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="first_name_asc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">First Name (A-Z)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="first_name_desc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">First Name (Z-A)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="family_name_asc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Family Name (A-Z)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="family_name_desc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Family Name (Z-A)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="nationality_asc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Nationality Name (A-Z)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="nationality_desc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Nationality Name (Z-A)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="department_asc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Department Name (A-Z)</button>
                        </form>
                        <form method="GET" action="{{ route('admin.allData') }}" role="none">
                            <input type="hidden" name="sort" value="department_desc">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-3">Department Name (Z-A)</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Display success message if available --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Data Table --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table id="sortable-table" class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable(0)">No</th>
                        <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable(1)">No Register</th>
                        <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable(2)">Email</th>
                        <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable(3)">Name</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->apply->no_register }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $user->apply->document->first_name }} {{ $user->apply->document->family_name }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="items-center flex gap-2">
                                    <!-- Edit Button -->
                                    <button id="reset-password-button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded inline-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-book h-5 w-5 me-1 mt-1" viewBox="0 0 16 16">
                                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                                        </svg>Reset Password
                                    </button>
                                
                                    <!-- Delete Button -->
                                    {{-- <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline-flex items-center p-3 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete(event)" class="flex items-center justify-center p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 delete-button" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            {{-- Spinner --}}
                                            <svg aria-hidden="true" id="spinner" role="status" class="hidden w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-gray-500">No data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        {{-- <div class="mt-4">
            {{ $applicants->links() }}
        </div> --}}
    </div>

    {{-- Modals --}}
    @include('admin.partials.reset-password-modal')

    {{-- Sorting Script --}}
    <script>
        function showDropDown() {
            document.getElementById('dropDownFilter').classList.toggle('hidden');
        }
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form agar tidak submit secara langsung
            const form = event.target.closest('form'); // Temukan form terdekat
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = form.querySelector('button[type="button"]');
                    const deleteButton = form.querySelector('.delete-button');
                    const spinner = form.querySelector('#spinner');
                    button.disabled = true; // Nonaktifkan tombol
                    deleteButton.classList.add('hidden'); // Sembunyikan icon delete
                    spinner.classList.remove('hidden'); // Tampilkan spinner
                    form.submit(); // Kirim form setelah konfirmasi
                }
            });
        }
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("sortable-table");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        // Archive Button Click
        document.getElementById('reset-password-button').addEventListener('click', function() {
            document.getElementById('resetPassword').classList.remove('hidden');
        });

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
