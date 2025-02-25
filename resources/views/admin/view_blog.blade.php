@extends('admin.layout')
@section('title', $blog->title)
@section('content')
    <section class="container self-center">
        {{-- Breadcrumb --}}
        <nav class="text-black font-bold my-6 mx-3" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin.index') }}">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.blog') }}" class="text-gray-500 duration-300 hover:text-gray-600">Blog</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.showBlog', $blog->id) }}"
                        class="text-gray-500 duration-300 hover:text-gray-600">{{ $blog->title }}</a>
                </li>
            </ol>
        </nav>
        {{-- Blog Content --}}
        <div class="w-full mx-auto mt-3 bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-900">{{ $blog->title }}</h1>
            <p class="text-gray-600">{{ $blog->created_at }}</p>
            <img class="w-full h-72 object-cover mt-4 rounded-lg" src="{{ asset('storage/' . $blog->image) }}"
                alt="Scholarship announcement">
            <div class="mt-6 text-gray-800">
                {!! $blog->body !!}
                <p class="mt-4 text-blue-900 font-bold">Email: international@dinus.id </p>
                <p class="mt-1 text-blue-900 font-bold">Whatsapp: +62 813-9100-2282 </p>
            </div>
        </div>
    </section>
@endsection
