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
                    <a href="{{ route('admin.table') }}" class="text-gray-500">Current Applicant</a>
                </li>
            </ol>
        </nav>
        {{-- Table --}}
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white mx-3">
            <div class="flex flex-col mb-5 text-center text-2xl font-bold">Data Peserta {{ $year }}</div>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="my-4 p-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- Button Export Excel --}}
            <div class="flex justify-end mb-3">
                <a href="{{ route('admin.exportApplicant') }}"
                    class="inline-flex items-center p-3 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-up h-5 w-5"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                        <path fill-rule="evenodd"
                            d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z" />
                    </svg>
                    <span class="ml-2">Export Excel</span>
                </a>
            </div>
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.table') }}" class="flex items-center my-3">
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
                        <th data-priority="5" class="py-3 px-4">Email</th>
                        <th data-priority="6" class="py-3 px-4">Department</th>
                        <th data-priority="7" class="py-3 px-4">Nationality</th>
                        <th data-priority="8" class="py-3 px-4 rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($applicants->count() > 0)
                        @foreach ($applicants as $index => $applicant)
                            <tr class="even:bg-slate-200 text-center">
                                <td class="p-4">{{ $applicants->firstItem() + $index }}</td>
                                <td>{{ $applicant->no_register }}</td>
                                <td>{{ $applicant->document->first_name . ' ' . $applicant->document->family_name }}</td>
                                <td>{{ $applicant->document->email }}</td>
                                <td>{{ $applicant->document->department }}</td>
                                <td>{{ $applicant->document->nationality }}</td>
                                <td>
                                    <div class="justify-center items-center flex gap-1">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.showEditForm', $applicant->id) }}"
                                            class="inline-flex items-center p-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.destroy', $applicant->id) }}" method="POST"
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
                                        <a href="{{ route('admin.showApplicant', $applicant->id) }}"
                                            class="inline-flex items-center p-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-eye h-4 w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </a>

                                        {{-- Comment modal --}}
                                        <button
                                            onclick="openModal({{ $applicant->id }}, '{{ $applicant->comment ?? '' }}')"
                                            class="inline-flex items-center p-2 bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium rounded-md comment-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-chat-left-dots h-4 w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                                <path
                                                    d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No data available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $applicants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('admin.partials.add-comment')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('add-comment-form');

            // Disable Enter key to prevent form submission in modal
            modal.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission on Enter key
                }
            });
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

        function openModal(applyId, comment) {
            // Set nilai input hidden dengan user ID
            document.getElementById('apply_id').value = applyId;

            // Isi bagian 'Current Comment' dengan komentar yang ada
            document.getElementById('current-comment').textContent = comment || 'Empty';
            console.log(comment);
            console.log("Apply ID =", applyId);

            // Tampilkan modal
            document.getElementById('addCommentModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function addComment(event) {
            event.preventDefault();

            const applyId = document.getElementById('apply_id').value;

            // Menyembunyikan tombol dan menampilkan spinner saat proses submit
            const button = document.getElementById('button-add-comment');
            // const spinner = document.getElementById('spinner-in-modal');

            // if (!spinner) {
            //     console.error("Error: Spinner element not found!");
            //     return;
            // }

            button.disabled = true;
            button.innerHTML = 'Adding Comment...';
            // spinner.classList.remove('hidden');

            const comment = document.getElementById('comment').value;
            const formData = new FormData();
            const url = `{{ route('admin.updateComment') }}`;
            formData.append('id', applyId);
            formData.append('comment', comment);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'url': url,
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value,
                        "X-Http-Method-Override": "PATCH"
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Comment added successfully!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    button.disabled = false;
                    // spinner.classList.add('hidden');
                    button.innerHTML = 'Add Comment';
                    window.location.reload();
                    // document.getElementById('add-comment-form').reset();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add comment.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.error('Error:', error);
                    button.disabled = false;
                    // if (spinner) spinner.classList.add('hidden');
                    button.innerHTML = 'Add Comment';
                });
        }
    </script>
@endsection
