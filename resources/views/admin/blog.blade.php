@extends('admin.layout')
@section('title', 'Data Blog')
@section('content')
    <div class="container self-center">
        {{-- Breadcrumb --}}
        <nav class="text-black font-bold my-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin.index') }}">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.blog') }}" class="text-gray-500 duration-300 hover:text-gray-600">Blog</a>
                </li>
            </ol>
        </nav>
        {{-- Table --}}
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded-md shadow bg-white">
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
            {{-- Button create blog --}}
            <div>
                <a href="{{ route('admin.createBlog') }}" class="inline-flex justify-end items-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-plus-fill h-5 w-5 mr-2" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0"/>
                    </svg>
                    Create Blog
                </a>
            </div>
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.blog') }}" class="flex items-center my-3">
                    <input type="search" name="search" id="search" placeholder="Cari judul atau slug..." value="{{ request('search') }}" class="border border-gray-300 p-2 px-4 rounded-md focus:outline-[#003d7a]">
                    <button type="submit" class="ml-2 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search h-5 w-5" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>
                <form id="paginationForm" method="GET" action="{{ url()->current() }}" class="flex items-center space-x-2">
                    @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="border rounded-md py-1 px-2 text-sm" onchange="this.form.submit()">
                        <option value="" {{ request('perPage') == 0 ? 'selected' : '' }}>-- Jumlah data --</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>
            {{-- Table --}}
            <table id="example" class="stripe" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                <thead class="bg-[#003d7a] text-white">
                    <tr>
                        <th data-priority="1" class="py-3 px-4 rounded-tl-lg">No.</th>
                        <th data-priority="2" class="py-3 px-4">Title</th>
                        <th data-priority="3" class="py-3 px-4">Slug</th>
                        <th data-priority="4" class="py-3 px-4 rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $index => $blog)
                        <tr class="even:bg-slate-200">
                            <td class="text-center p-4">{{ $blogs->firstItem() + $index }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td>
                                <div class="justify-center items-center flex gap-1">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.editBlog', $blog->id) }}" class="text-white inline-flex items-center p-2 bg-yellow-500 hover:bg-yellow-600 text-gray-800 text-sm font-medium rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                        </svg>
                                    </a>
                                
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.deleteBlog', $blog->id) }}" method="POST" class="inline-flex items-center p-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete(event)" class="flex items-center justify-center p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                
                                    <!-- View Button -->
                                    <a href="{{ route('admin.showBlog', $blog->id) }}" class="inline-flex items-center p-2 bg-[#003d7a] hover:bg-blue-600 text-white text-sm font-medium rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye h-4 w-4" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $blogs->appends(['perPage' => request('perPage')])->links() }}
            </div>
        </div>
    </div>

    <script>
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
                    form.submit(); // Kirim form setelah konfirmasi
                }
            });
        }
    </script>
@endsection
