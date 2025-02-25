@section('title', 'Update Profile')
@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/css/datepicker.min.css">
    {{-- Form --}}
    <section class="container self-center">
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
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.showEditForm', $applicant->id) }}" class="text-gray-500">Update Profile
                        ({{ $applicant->document->first_name . ' ' . $applicant->document->family_name }})</a>
                </li>
            </ol>
        </nav>
        <div class="container">
            <div class="flex justify-center">
                <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                    <h3 class="flex flex-col mb-5 text-center text-2xl font-bold">Update
                        {{ $applicant->document->first_name . ' ' . $applicant->document->family_name }} Profile</h3>
                    {{-- Session has success --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    {{-- Session has error --}}
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    <form action="{{ route('admin.updateDocument', $applicant->id) }}" method="POST"
                        enctype="multipart/form-data" class="mt-8">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/2">
                                <label for="first_name" class="text-sm font-bold text-gray-600">First Name</label>
                                <input type="text" name="first_name" id="first_name"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full"
                                    value="{{ $applicant->document->first_name }}">
                                @error('first_name')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/2">
                                <label for="family_name" class="text-sm font-bold text-gray-600">Family Name</label>
                                <input type="text" name="family_name" id="family_name"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full"
                                    value="{{ $applicant->document->family_name }}">
                                @error('family_name')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/2">
                                <label for="email" class="text-sm font-bold text-gray-600">Email</label>
                                <input type="text" name="email" id="email"
                                    value="{{ $applicant->document->email }}"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full" disabled>
                                @error('email')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/4 flex flex-col mt-1">
                                <label for="phone_number" class="text-sm font-bold text-gray-600">Phone or Whatsapp
                                    Number</label>
                                <input type="tel" name="phone_number" id="phone"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full"
                                    value="{{ $applicant->document->phone_number }}">
                                @error('phone_number')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/4 flex flex-col mt-1">
                                <label for="date_of_birth" class="text-sm font-bold text-gray-600">Date of Birth<span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="birth_date" id="birth_date"
                                    value="{{ $applicant->document->birth_date }}"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full" data-toggle="datepicker">
                                @error('birth_date')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/4">
                                <label for="nationality" class="text-sm font-bold text-gray-600">Nationality</label>
                                <select name="nationality" id="nationality"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                    <option value="" disabled>Choose Your Country</option>
                                    <option value="{{ $applicant->document->nationality }}" selected>
                                        {{ $applicant->document->nationality }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                @error('nationality')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/4">
                                <label for="passport_number" class="text-sm font-bold text-gray-600">Passport
                                    Number</label>
                                <input type="text" name="passport_number" id="passport_number"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full"
                                    value="{{ $applicant->document->passport_number }}">
                                @error('passport_number')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/4">
                                <label for="department" class="text-sm font-bold text-gray-600">Preferable
                                    Department</label>
                                <select name="department" id="department"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                    <option value="" disabled>Choose Your Department</option>
                                    <option value="{{ $applicant->document->department }}" selected>
                                        {{ $applicant->document->department }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department }}">{{ $department }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/4">
                                <label for="gender" class="text-sm font-bold text-gray-600">Gender<span
                                        class="text-red-500">*</span></label>
                                <select name="gender" id="gender"
                                    class="border border-gray-300 p-2 rounded-md mt-1 w-full">
                                    <option value="" disabled>Choose Your Gender</option>
                                    @if ($applicant->document->gender == 'male')
                                        <option value="male" selected>Male</option>
                                        <option value="female">Female</option>
                                    @else
                                        <option value="male">Male</option>
                                        <option value="female" selected>Female</option>
                                    @endif
                                </select>
                                @error('gender')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="profile_picture" class="text-sm font-bold text-gray-600">Profile
                                    Picture</span></label>
                                <input id="profile_picture" type="file" name="profile_picture"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                {{-- <p class="text-xs text-gray-400 mt-2">*Only PDF allowed.</p> --}}
                                @error('profile_picture')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="passport" class="text-sm font-bold text-gray-600">Passport</label>
                                <input id="passport" type="file" name="passport"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('passport')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="cv" class="text-sm font-bold text-gray-600">Curriculum Vitae</label>
                                <input id="cv" type="file" name="cv"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('cv')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="study_plan" class="text-sm font-bold text-gray-600">Study Plan</label>
                                <input id="study_plan" type="file" name="study_plan"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('study_plan')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="english_proficiency" class="text-sm font-bold text-gray-600">English
                                    Proficiency</label>
                                <input id="english_proficiency" type="file" name="english_proficiency"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('english_proficiency')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="transcript" class="text-sm font-bold text-gray-600">Transcript &
                                    Certificate</label>
                                <input id="transcript" type="file" name="transcript"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('transcript')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="medical_checkup" class="text-sm font-bold text-gray-600">Medical
                                    Checkup</label>
                                <input id="medical_checkup" type="file" name="medical_checkup"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('medical_checkup')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="first_letter_of_recommendation" class="text-sm font-bold text-gray-600">First
                                    Letter Recommendation</label>
                                <input id="first_letter_of_recommendation" type="file"
                                    name="first_letter_of_recommendation"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('first_letter_of_recommendation')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="second_letter_of_recommendation"
                                    class="text-sm font-bold text-gray-600">Second Letter Recommendation</label>
                                <input id="second_letter_of_recommendation" type="file"
                                    name="second_letter_of_recommendation"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('second_letter_of_recommendation')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3" id="block_research_proposal">
                                <label for="research_proposal" class="text-sm font-bold text-gray-600">Research
                                    Proposal</label>
                                <input id="research_proposal" type="file" name="research_proposal"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('research_proposal')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-full px-3 xl:w-1/3">
                                <label for="commitment_letter" class="text-sm font-bold text-gray-600">Commitment
                                    Letter</label>
                                <input id="commitment_letter" type="file" name="commitment_letter"
                                    class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                @error('commitment_letter')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full px-3">
                                <button type="submit"
                                    class="btn btn-md bg-yellow-500 rounded-md p-3 w-full mt-10 hover:bg-yellow-400 hover:ease-in-out transition">
                                    <p class="text-white text-center font-bold">Update</p>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector("#phone");
            const iti = window.intlTelInput(input, {
                strictMode: true,
                // separateDialCode: true,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/utils.js",
            });

            const departmentSelect = document.querySelector('#department');
            const researchProposalField = document.querySelector('#research_proposal');
            const blockResearchProposal = document.querySelector('#block_research_proposal');

            window.addEventListener('load', function() {
                const selectedDepartment = departmentSelect.value.toLowerCase();

                if (selectedDepartment.includes('master') || selectedDepartment.includes('doctorate')) {
                    blockResearchProposal.classList.remove('hidden');
                } else {
                    blockResearchProposal.classList.add('hidden');
                }
            });

            departmentSelect.addEventListener('change', function() {
                const selectedDepartment = departmentSelect.value.toLowerCase();
                // Debugging
                console.log(selectedDepartment);

                console.log(selectedDepartment.includes('master'));

                // Cek jika pilihan mengandung kata 'master' atau 'doctorate'
                if (selectedDepartment.includes('master') || selectedDepartment.includes('doctorate')) {
                    blockResearchProposal.classList.remove('hidden');
                } else {
                    blockResearchProposal.classList.add('hidden');
                }
            });

            // Trigger check on page load in case there is a pre-selected value
            const selectedDepartmentOnLoad = departmentSelect.value.toLowerCase();
            if (selectedDepartmentOnLoad.includes('master') || selectedDepartmentOnLoad.includes('doctorate')) {
                researchProposalField.classList.add('hidden');
            }
        });
    </script>
    <script>
        function submitForm(e) {
            event.preventDefault();
            const form = event.target.closest('form');
            const spinner = form.querySelector('#spinner');
            const registerText = form.querySelector('.register-text');
            const registerButton = form.querySelector('#registerButton');
            spinner.classList.remove('hidden');
            spinner.classList.add('inline-block');
            registerText.classList.add('hidden');
            registerButton.classList.add('cursor-not-allowed', 'pointer-events-none', 'opacity-60');
            registerButton.disabled = true;
            form.submit();
        }
    </script>
    <script></script>
@endsection
