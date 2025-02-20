@extends('admin.layout')
@section('title', 'All Data')
@section('content')
    <nav class="text-black font-bold my-6 mx-3" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                <a href="{{ route('admin.index') }}">Home</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.allData') }}" class="text-gray-500">All Applicant</a>
            </li>
        </ol>
    </nav>
    <div class="container mx-auto px-3">
        <div class="bg-white shadow-md rounded-lg p-3 mt-4">
            <h2 class="flex flex-col mb-5 text-center text-2xl font-bold text-blue-800">ALL DATA APPLICANTS</h2>
            <div class="flex flex-wrap md:justify-between items-center mb-4 p-4 ">
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-4">
                    <button id="archive-button"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition ease-in-out duration-200 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-1" viewBox="0 0 100 100">
                            <path fill="currentColor"
                                d="M89.148 32.927c.001-.037.011-.07.011-.107a3.972 3.972 0 0 0-1.016-2.642l.02-.011l-7.87-13.627a2.53 2.53 0 0 0-2.468-1.914c-.083 0-.161.016-.242.024v-.024H22.219v.004c-.013 0-.026-.004-.039-.004a2.42 2.42 0 0 0-2.17 1.315l-.008-.005l-8.212 14.231l.015.008a4.068 4.068 0 0 0-.963 2.642c0 .047.012.091.014.138v48.211c-.002.048-.014.093-.014.142c0 2.284 1.817 4.069 4.095 4.066c.043 0 .083-.011.125-.012h69.87c.043.001.083.012.126.012c2.283 0 4.1-1.782 4.1-4.062c0-.036-.01-.068-.011-.104V32.927zM63.413 57.492l-12.391 17.43c-.226.318-.59.505-.98.507h-.004c-.386 0-.751-.187-.977-.503L36.59 57.494a1.201 1.201 0 0 1-.091-1.251c.208-.401.62-.654 1.071-.654h5.833l.001-15.654c0-.667.538-1.205 1.203-1.205h10.789c.665 0 1.204.539 1.204 1.204v15.655h5.83a1.206 1.206 0 0 1 .983 1.903zM18.376 28.733l5.263-9.119h52.67l5.266 9.119H18.376z" />
                        </svg>Archive
                    </button>
                    <button id="export-button"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition ease-in-out duration-200 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-1" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m16.2 20.5l2.8-2.8V20h1v-4h-4v1h2.3l-2.8 2.8l.7.7ZM18 23q-2.075 0-3.538-1.463T13 18q0-2.075 1.463-3.538T18 13q2.075 0 3.538 1.463T23 18q0 2.075-1.463 3.538T18 23ZM7 9h10V7H7v2Zm4.675 12H5q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h14q.825 0 1.413.588T21 5v6.7q-.725-.35-1.463-.525T18 11q-.275 0-.513.012t-.487.063V11H7v2h6.125q-.45.425-.813.925T11.675 15H7v2h4.075q-.05.25-.063.488T11 18q0 .825.15 1.538T11.675 21Z" />
                        </svg>Export
                    </button>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <form action="{{ route('admin.allData') }}" method="GET" class="flex flex-wrap items-center gap-3">
                        <div class="relative">
                            <input type="number" id="year" name="year" value="{{ request('year') }}"
                                placeholder="Filter by Year"
                                class="w-32 border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-300 outline-none" />
                        </div>
                        <div class="relative">
                            <input type="text" id="name" name="name" value="{{ request('name') }}"
                                placeholder="Search by Name"
                                class="w-48 border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-300 outline-none" />
                        </div>
                        <button type="submit"
                            class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </form>

                    <div class="relative">
                        <button type="button" onclick="toggleDropDown()" id="menu-button"
                            class="flex items-center gap-2 px-3 py-2 text-sm bg-blue-900 hover:bg-blue-700 text-white font-bold rounded-md shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-funnel h-5 w-5"
                                viewBox="0 0 16 16">
                                <path
                                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                            </svg>
                        </button>
                        <div id="dropDownFilter"
                            class="hidden absolute right-0 z-10 mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="first_name_asc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Name
                                        (A-Z)</button>
                                </form>
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="first_name_desc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Name
                                        (Z-A)</button>
                                </form>
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="nationality_asc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Nationality
                                        (A-Z)</button>
                                </form>
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="nationality_desc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Nationality
                                        (Z-A)</button>
                                </form>
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="department_asc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Department
                                        (A-Z)</button>
                                </form>
                                <form method="GET" action="{{ route('admin.allData') }}">
                                    <input type="hidden" name="sort" value="department_desc">
                                    <button type="submit"
                                        class="block w-full px-1 py-2 text-sm text-gray-700 hover:bg-gray-100">Department
                                        (Z-A)</button>
                                </form>
                            </div>
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
                    <thead class="bg-[#003d7a] text-white">
                        <tr>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(0)">No.</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(1)">No. Register</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(2)">Name</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(4)">Email</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(5)">Department</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(6)">Nationality</th>
                            <th class="py-3 px-4 cursor-pointer" onclick="sortTable(7)">Archieved</th>
                            <th class="py-3 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $index => $applicant)
                            <tr class="even:bg-slate-200">
                                <td class="py-2 px-4 border-b text-center">{{ $index + $applicants->firstItem() }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $applicant->no_register }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    {{ $applicant->document->first_name . ' ' . $applicant->document->family_name }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $applicant->document->email }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $applicant->document->department }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $applicant->document->nationality }}</td>
                                @if ($applicant->is_archived == 1)
                                    <td class="py-2 px-4 border-b text-center"><span
                                            class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">yes</span>
                                    </td>
                                @else
                                    <td class="py-2 px-4 border-b text-center"><span
                                            class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">no</span></td>
                                @endif
                                <td class="py-2 px-4 border-b">
                                    <div class="items-center flex gap-1">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.showEditForm', $applicant->apply_id) }}"
                                            class="inline-flex items-center p-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.destroy', $applicant->apply_id) }}" method="POST"
                                            class="inline-flex items-center p-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete(event)"
                                                class="flex items-center justify-center p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 delete-button"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                {{-- Spinner --}}
                                                <svg aria-hidden="true" id="spinner" role="status"
                                                    class="hidden w-4 h-4 text-white animate-spin" viewBox="0 0 100 101"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="#E5E7EB" />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- View Button -->
                                        <a href="{{ route('admin.showApplicant', $applicant->apply_id) }}"
                                            class="inline-flex items-center p-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-eye h-4 w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </a>
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
            <div class="mt-4">
                {{ $applicants->links() }}
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('admin.partials.archive-modal')
    @include('admin.partials.export-modal')

    {{-- Sorting Script --}}
    <script>
        function toggleDropDown() {
            document.getElementById("dropDownFilter").classList.toggle("hidden");
        }
        document.addEventListener("click", function(event) {
            let dropdown = document.getElementById("dropDownFilter");
            let button = document.getElementById("menu-button");
            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });

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
        document.getElementById('archive-button').addEventListener('click', function() {
            document.getElementById('archiveModal').classList.remove('hidden');
        });

        // Export Button Click
        document.getElementById('export-button').addEventListener('click', function() {
            document.getElementById('exportModal').classList.remove('hidden');
        });

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
