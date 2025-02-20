@section('title', 'Register')

@extends('user.layout')

@section('content')
    <section class="bg-gray min-h-screen flex items-center justify-center p-8">
        <div class="max-w-6xl mx-auto bg-white p-12 rounded-3xl shadow-xl border border-gray-200">
            @if ($apply_data == null)
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-3" role="alert">
                    <p class="font-bold">Note!</p>
                    <p>You have not applied for any scholarship yet. You can apply <a class="font-semibold underline"
                            href="/apply">Here</a></p>
                </div>
                <img src="{{ asset('assets/failed.jpg') }}" alt="success" class="mx-auto w-full lg:w-5/12">
            @else
                <!-- Header -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">
                        Welcome, <span
                            class="text-blue-800 hover:text-yellow-600 transition duration-150 ease-in-out">{{ $apply_data->document->first_name }}
                            {{ $apply_data->document->family_name }}</span>
                    </h1>
                    <p class="text-gray-500 mt-4 text-lg">Manage your scholarship applications, deadlines, and more in one
                        place.</p>
                </div>

                <!-- Profile -->
                <div class="mt-4 flex justify-center">
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg border border-gray-300 hover:shadow-2xl transition-all max-w-3xl w-full">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="currentColor"
                                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                            </svg>
                            Your Profile
                        </h2>
                        <hr class="border border-gray-300 w-full mb-3">
                        <div class="space-y-4 text-gray-600 text-sm">
                            <p><span class="font-medium text-gray-700">First
                                    Name: </span>{{ $apply_data->document->first_name }}</p>
                            <p><span class="font-medium text-gray-700">Last Name:
                                </span>{{ $apply_data->document->family_name }}</p>
                            <p><span class="font-medium text-gray-700">Phone: </span>
                                {{ $apply_data->document->phone_number }}</p>
                            <p><span class="font-medium text-gray-700">Nationality: </span>
                                {{ $apply_data->document->nationality }}</p>
                            <p><span class="font-medium text-gray-700">Department:
                                </span>{{ $apply_data->document->department }}
                            </p>
                            <p><span class="font-medium text-gray-700">Status: </span>
                                @if ($apply_data->status->name == 'Rejected')
                                    <button
                                        class="bg-green-100 border-2 border-red-400 text-red-400 px-3 py-1 text-xs rounded-full font-medium hover:bg-red-200 transition duration-300 ease-in-out">{{ $apply_data->status->name }}</button>
                                @elseif($apply_data->status->name == 'Accepted')
                                    <button
                                        class="bg-green-100 border-2 border-green-400 text-green-400 px-3 py-1 text-xs rounded-full font-medium hover:bg-green-200 transition duration-300 ease-in-out">{{ $apply_data->status->name }}</button>
                                @else
                                    <button
                                        class="bg-yellow-100 border-2 border-yellow-400 text-yellow-400 px-3 py-1 text-xs rounded-full font-medium hover:bg-yellow-200 transition duration-300 ease-in-out">
                                        {{ $apply_data->status->name }}
                                    </button>
                                @endif
                            </p>
                            <p><span class="font-medium text-gray-700">Comment: </span>{{ $apply_data->comment ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Info, Update, n Contact -->
                <div class="mt-12 grid md:grid-cols-3 gap-8 justify-items-center">
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg border border-gray-300 text-center hover:shadow-2xl transition-all">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">More Info</h3>
                        <p class="text-gray-500 text-sm mb-6">To get more information about scholarships, please visit the
                            link
                            below.</p>
                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">See
                            Now</button>
                    </div>
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg border border-gray-300 text-center hover:shadow-2xl transition-all">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Scholarship Updates</h3>
                        <p class="text-gray-500 text-sm mb-6">Stay informed about the latest scholarship opportunities and
                            deadlines.</p>
                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">View
                            Updates</button>
                    </div>
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg border border-gray-300 text-center hover:shadow-2xl transition-all">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Contact Us</h3>
                        <p class="text-gray-500 text-sm mb-6">Get in touch with our team for any questions or assistance.
                        </p>
                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">Contact
                            Us</button>
                    </div>
                </div>
        </div>
        @endif
    </section>


@endsection
