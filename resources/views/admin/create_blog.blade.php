@extends('admin.layout')
@section('title', 'Data Blog')
@section('content')
<section class="container self-center">
    <nav class="text-black font-bold my-6" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('admin.index') }}">Home</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.blog') }}" class="text-gray-500 duration-300 hover:text-gray-600">Blog</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.createBlog') }}" class="text-gray-500 duration-300 hover:text-gray-600">Create Blog</a>
            </li>
        </ol>
    </nav>

    <div class="container">
        <div class="w-full lg:w-full bg-white p-8 rounded-xl">
            <h1 class="flex flex-col mb-5 text-center text-2xl font-bold">Create New Blog Post</h1>
            
            @if($errors->any())
                <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.storeBlog') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="form-group">
                    <label for="title" class="block text-md text-gray-700 mb-3">Title</label>
                    <input type="text" class="form-control block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" name="title" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="body" class="block text-md text-gray-700 mb-3">Body</label>
                    <textarea class="form-control block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="body" name="body" value="{{ old('body') }}"></textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="block text-md text-gray-700 mb-1">Thumbnail</label>
                    <input type="file" class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-yellow-500 file:hover:bg-yellow-600 file:text-gray-100 rounded duration-300" id="image" name="image"/>
                    <p class="text-xs text-gray-400 mt-2">PNG, JPG SVG, WEBP, and GIF are Allowed.</p>
                </div>


                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- CKEditor Initialization using CDN -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
</section>
@endsection
