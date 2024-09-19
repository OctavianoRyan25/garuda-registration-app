@extends('admin.layout')
@section('title', 'Data Blog')
@section('content')
<section class="bg-gray-100 py-3 md:py-3">
    <div class="container">
        <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
            <div class="justify-start mb-3">
                <a href="{{ route('admin.blog') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold p-2 mt-3 rounded-md inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
            </div>
            <h1 class="text-2xl font-semibold text-gray-700 mb-6">Update Blog Post</h1>
            
            @if($errors->any())
                <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.updateBlog', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="block text-lg font-semibold text-gray-700">Title</label>
                    <input type="text" class="form-control mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" name="title" value="{{ $blog->title }}"></input>
                </div>

                <div class="form-group">
                    <label for="body" class="block text-lg font-semibold text-gray-700">Body</label>
                    <textarea class="form-control mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="body" name="body">{{ $blog->body }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="block text-lg font-semibold text-gray-700">Thumbnail</label>
                    <input type="file" class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-yellow-500 file:hover:bg-yellow-600 file:text-gray-100 rounded" id="image" name="image"/>
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
