@section('title', 'Register')

@extends('user.layout')

@section('content')
        {{-- Form --}}
        <section class="bg-gray-100 py-3 md:py-3">
            <div class="container">
                <div class="flex justify-center">
                    @if($apply_data)
                        <div class="w-full h-full lg:w-full bg-white p-8 rounded-xl mx-3">
                            {{-- Image Sucess --}}
                            <img src="{{ asset('assets/success.jpg') }}" alt="success" class="mx-auto w-full lg:w-5/12">
                            {{-- Information --}}
                            <div class="flex justify-center">
                                <p class="text-center text-gray-500">Yeay, your Application Has Been Submitted Successfully</p>
                            </div>
                            {{-- Button --}}
                            <div class="flex justify-center">
                                <a href="{{ route('user.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md mt-3">Back</a>
                            </div>
                        </div>
                    @else
                        <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                            <h3 class="text-2xl font-bold text-center">Register</h3>
                            <form action="{{ route('user.submitApplication') }}" method="POST" enctype="multipart/form-data" class="mt-8">
                                @csrf
                                <div class="flex flex-wrap mb-4">
                                    <div class="w-full px-3 xl:w-1/2">
                                        <label for="first_name" class="text-sm font-bold text-gray-600">First Name<span class="text-red-500">*</span></label>
                                        <input type="text" name="first_name" id="first_name" class="border border-gray-300 p-2 rounded-md mt-1 w-full" placeholder="john">
                                        @error('first_name')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/2">
                                        <label for="family_name" class="text-sm font-bold text-gray-600">Family Name<span class="text-red-500">*</span></label>
                                        <input type="text" name="family_name" id="family_name" class="border border-gray-300 p-2 rounded-md mt-1 w-full" placeholder="doe">
                                        @error('family_name')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-4">
                                    <div class="w-full px-3 xl:w-1/2">
                                        <label for="email" class="text-sm font-bold text-gray-600">Email<span class="text-red-500">*</span></label>
                                        <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="border border-gray-300 p-2 rounded-md mt-1 w-full" disabled>
                                        @error('email')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/2">
                                        <label for="phone_number" class="text-sm font-bold text-gray-600">Phone or Whatsapp Number<span class="text-red-500">*</span></label>
                                        <input type="text" name="phone_number" id="phone_number" class="border border-gray-300 p-2 rounded-md mt-1 w-full" placeholder="+62 8123 4567 8910">
                                        @error('phone_number')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-4">
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="nationality" class="text-sm font-bold text-gray-600">Nationality<span class="text-red-500">*</span></label>
                                        <select name="nationality" id="nationality" class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                            <option value="" selected disabled>Choose Your Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="passport_number" class="text-sm font-bold text-gray-600">Passport Number<span class="text-red-500">*</span></label>
                                        <input type="text" name="passport_number" id="passport_number" class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                        @error('passport_number')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="department" class="text-sm font-bold text-gray-600">Preferable Department<span class="text-red-500">*</span></label>
                                        <select name="department" id="department" class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                            <option value="" selected disabled>Choose Your Department</option>
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
                                        <label for="passport" class="text-sm font-bold text-gray-600">Passport<span class="text-red-500">*</span></label>
                                        <input id="passport" type="file" name="passport" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        {{-- <p class="text-xs text-gray-400 mt-2">*Only PDF allowed.</p> --}}
                                        @error('passport')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="research_proposal" class="text-sm font-bold text-gray-600">Research Proposal<span class="text-red-500">*</span></label>
                                        <input id="research_proposal" type="file" name="research_proposal" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('research_proposal')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="study_plan" class="text-sm font-bold text-gray-600">Study Plan<span class="text-red-500">*</span></label>
                                        <input id="study_plan" type="file" name="study_plan" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('study_plan')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-4">
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="english_proficiency" class="text-sm font-bold text-gray-600">English Proficiency<span class="text-red-500">*</span></label>
                                        <input id="english_proficiency" type="file" name="english_proficiency" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('english_proficiency')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="transcript" class="text-sm font-bold text-gray-600">Transcript & Certificate<span class="text-red-500">*</span></label>
                                        <input id="transcript" type="file" name="transcript" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('transcript')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="cv" class="text-sm font-bold text-gray-600">Curriculum Vitae<span class="text-red-500">*</span></label>
                                        <input id="cv" type="file" name="cv" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('cv')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-4">
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="medical_checkup" class="text-sm font-bold text-gray-600">Medical Checkup<span class="text-red-500">*</span></label>
                                        <input id="medical_checkup" type="file" name="medical_checkup" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('medical_checkup')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="first_letter_of_recommendation" class="text-sm font-bold text-gray-600">First Letter Recommendation<span class="text-red-500">*</span></label>
                                        <input id="first_letter_of_recommendation" type="file" name="first_letter_of_recommendation" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                        @error('first_letter_of_recommendation')
                                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full px-3 xl:w-1/3">
                                        <label for="second_letter_of_recommendation" class="text-sm font-bold text-gray-600">Second Letter Recommendation<span class="text-red-500">*</span></label>
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
                    @endif
                </div>
            </div>
        </section>
        {{-- End Of Form --}}
@endsection
