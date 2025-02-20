@extends('admin.layout')
@section('title', 'Data Peserta')
@section('content')
    <div class="container self-center">
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
                    <a href="{{ route('admin.status') }}" class="text-gray-500">Update Status</a>
                </li>
            </ol>
        </nav>
        {{-- Table --}}
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white mx-3">
            <div class="flex flex-col mb-5 text-center text-2xl font-bold">Data Peserta</div>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.status') }}" class="flex items-center my-3">
                    <input type="search" name="search" id="search" placeholder="Cari data..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 p-2 px-4 rounded-md focus:outline-[#003d7a]">
                    <button type="submit"
                        class="ml-2 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search h-5 w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </form>
                <form id="paginationForm" method="GET" action="{{ url()->current() }}"
                    class="flex items-center space-x-2">
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="border rounded-md py-1 px-2 text-sm"
                        onchange="this.form.submit()">
                        <option value="" {{ request('perPage') == 0 ? 'selected' : '' }}>-- Jumlah data --</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>
            <table id="example" class="stripe" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                <thead class="bg-[#003d7a] text-white">
                    <tr>
                        <th data-priority="1" class="py-3 px-4 rounded-tl-lg">No.</th>
                        <th data-priority="2" class="py-3 px-4">No. Register</th>
                        <th data-priority="3" class="py-3 px-4">Name</th>
                        <th data-priority="5" class="py-3 px-4">Department</th>
                        <th data-priority="6" class="py-3 px-4">Status</th>
                        <th data-priority="7" class="py-3 px-4 rounded-tr-lg">Action Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $index => $applicant)
                        <tr class="text-center even:bg-slate-200">
                            <td class="text-sm">{{ $applicants->firstItem() + $index }}</td>
                            <td class="text-sm">{{ $applicant->no_register }}</td>
                            <td class="text-sm">
                                {{ $applicant->document->first_name . ' ' . $applicant->document->family_name }}</td>
                            <td class="text-sm">{{ $applicant->document->department }}</td>
                            <td>
                                @if ($applicant->status_id == 6)
                                    <span
                                        class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 5)
                                    <span
                                        class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 4)
                                    <span
                                        class="bg-cyan-200 text-cyan-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 3)
                                    <span
                                        class="bg-orange-200 text-orange-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 2)
                                    <span
                                        class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @else
                                    <span
                                        class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="justify-center items-center flex gap-2">
                                    <!-- Acc Button -->
                                    {{-- Button Update --}}
                                    <button id="updateStatus"
                                        class="flex items-center justify-center p-2 bg-blue-700 hover:bg-blue-800 rounded-md my-1">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form id="formUpdate" method="POST"
                                        class="hidden inline-flex items-center p-3 text-sm font-medium"
                                        action="{{ route('admin.updateStatus', $applicant->id) }}">
                                        @csrf
                                        <select name="status"
                                            class="px-3 py-2 text-gray-800 bg-white border border-gray-300 rounded-md me-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                            <option disabled {{ is_null($applicant->status_id) ? 'selected' : '' }}>Select
                                                Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $applicant->status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="flex gap-2 text-white">
                                            <button type="submit"
                                                class="flex items-center justify-center p-2 bg-green-300 hover:bg-green-500 rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="bi bi-check-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status"
                                                    class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="#E5E7EB" />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </button>
                                            <button type="button" id="cancelUpdate"
                                                class="flex items-center justify-center p-2 bg-red-300 hover:bg-red-500 rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="bi bi-x-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 9.414l4.293 4.293a1 1 0 0 0 1.414-1.414L9.414 8l4.293-4.293a1 1 0 0 0-1.414-1.414L8 6.586 3.707 2.293a1 1 0 0 0-1.414 1.414L6.586 8 2.293 12.293a1 1 0 0 0 1.414 1.414L8 9.414z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $applicants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <script>
        // Show spinner when button clicked
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    const spinner = submitButton.querySelector('#spinner');

                    submitButton.disabled =
                        true; // Disable the button to prevent multiple submissions
                    submitButton.querySelector('svg:not(#spinner)').classList.add(
                        'hidden'); // Hide the original icon
                    spinner.classList.remove('hidden'); // Show the spinner
                });
            });

            const updateStatus = document.querySelectorAll('#updateStatus');
            const formUpdate = document.querySelectorAll('#formUpdate');
            const cancelUpdate = document.querySelectorAll('#cancelUpdate');
            console.log(updateStatus);
            // Show form update status
            updateStatus.forEach((update, index) => {
                update.addEventListener('click', function() {
                    formUpdate[index].classList.remove('hidden');
                    update.classList.add('hidden');
                });
            });
            cancelUpdate.forEach((cancel, index) => {
                cancel.addEventListener('click', function() {
                    formUpdate[index].classList.add('hidden');
                    updateStatus[index].classList.remove('hidden');
                });
            });
        });
    </script>
@endsection
