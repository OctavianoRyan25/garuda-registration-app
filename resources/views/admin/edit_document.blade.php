@section('title', 'Update Document')
@extends('admin.layout')
@section('content')
        {{-- Form --}}
        <section class="bg-gray-100 py-3 md:py-3">
            <div class="container">
                <div class="flex justify-center">
                    <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                        <h3 class="text-2xl font-bold text-center">Update Your Profile</h3>
                        {{-- Session has success --}}
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
                        {{-- Session has error --}}
                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif
                        <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data" class="mt-8">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/2">
                                    <label for="first_name" class="text-sm font-bold text-gray-600">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="border border-gray-300 p-2 rounded-md mt-1 w-full" value="{{ $document->first_name }}">
                                    @error('first_name')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/2">
                                    <label for="family_name" class="text-sm font-bold text-gray-600">Family Name</label>
                                    <input type="text" name="family_name" id="family_name" class="border border-gray-300 p-2 rounded-md mt-1 w-full" value="{{ $document->family_name }}">
                                    @error('family_name')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/2">
                                    <label for="email" class="text-sm font-bold text-gray-600">Email</label>
                                    <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="border border-gray-300 p-2 rounded-md mt-1 w-full" disabled>
                                    @error('email')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/2">
                                    <label for="phone_number" class="text-sm font-bold text-gray-600">Phone or Whatsapp Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="border border-gray-300 p-2 rounded-md mt-1 w-full" value="{{ $document->phone_number }}">
                                    @error('phone_number')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="nationality" class="text-sm font-bold text-gray-600">Nationality</label>
                                    <select name="nationality" id="nationality" class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                        <option value="" disabled>Choose Your Country</option>
                                        <option value="{{ $document->nationality }}" selected>{{ $document->nationality }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationality')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="passport_number" class="text-sm font-bold text-gray-600">Passport Number</label>
                                    <input type="text" name="passport_number" id="passport_number" class="border border-gray-300 p-2 rounded-md mt-1 w-full" value="{{ $document->passport_number }}">
                                    @error('passport_number')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="department" class="text-sm font-bold text-gray-600">Preferable Department</label>
                                    <select name="department" id="department" class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                        <option value="" disabled>Choose Your Department</option>
                                        <option value="{{ $document->department }}" selected>{{ $document->department }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department }}">{{ $department }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="passport" class="text-sm font-bold text-gray-600">Passport</label>
                                    <input id="passport" type="file" name="passport" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('passport')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="research_proposal" class="text-sm font-bold text-gray-600">Research Proposal</label>
                                    <input id="research_proposal" type="file" name="research_proposal" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('research_proposal')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="study_plan" class="text-sm font-bold text-gray-600">Study Plan</label>
                                    <input id="study_plan" type="file" name="study_plan" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('study_plan')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="english_proficiency" class="text-sm font-bold text-gray-600">English Proficiency</label>
                                    <input id="english_proficiency" type="file" name="english_proficiency" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('english_proficiency')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="transcript" class="text-sm font-bold text-gray-600">Transcript & Certificate</label>
                                    <input id="transcript" type="file" name="transcript" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('transcript')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="cv" class="text-sm font-bold text-gray-600">Curriculum Vitae</label>
                                    <input id="cv" type="file" name="cv" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('cv')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="medical_checkup" class="text-sm font-bold text-gray-600">Medical Checkup</label>
                                    <input id="medical_checkup" type="file" name="medical_checkup" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('medical_checkup')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="first_letter_of_recommendation" class="text-sm font-bold text-gray-600">First Letter Recommendation</label>
                                    <input id="first_letter_of_recommendation" type="file" name="first_letter_of_recommendation" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('first_letter_of_recommendation')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full px-3 xl:w-1/3">
                                    <label for="second_letter_of_recommendation" class="text-sm font-bold text-gray-600">Second Letter Recommendation</label>
                                    <input id="second_letter_of_recommendation" type="file" name="second_letter_of_recommendation" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    @error('second_letter_of_recommendation')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-4">
                                <div class="w-full px-3">
                                    <button type="submit" class="btn btn-md bg-yellow-500 rounded-md p-3 w-full mt-10 hover:bg-yellow-400 hover:ease-in-out transition">
                                        <p class="text-white text-center font-bold">Register</p>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        {{-- End Of Form --}}
@endsection
