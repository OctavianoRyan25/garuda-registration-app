@section('title', 'Detail Peserta')
@extends('admin.layout')
@section('content')
    <section class="container self-center mx-3">
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
                    <a href="{{ route('admin.showApplicant', $apply_data->id) }}" class="text-gray-500">Profile Detail
                        ({{ $apply_data->document->first_name . ' ' . $apply_data->document->family_name }})</a>
                </li>
            </ol>
        </nav>
        <div class="container" x-data="pdfViewer()">
            <div class="flex justify-start">
                <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                    @if (Session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ Session('success') }}</span>
                        </div>
                    @elseif(Session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ Session('error') }}</span>
                        </div>
                    @endif
                    <!-- component -->
                    <div class="flex">
                        <div class="p-4 px-4 md:p-8 mb-6">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-600">
                                    <p class="text-lg font-bold">
                                        {{ $apply_data->document->first_name . ' ' . $apply_data->document->family_name }}
                                        Profile Details</p>
                                    <div class="inline-flex mt-3">
                                        <span
                                            class="bg-yellow-500 text-blue-900 font-semibold py-1 px-3 rounded-full text-xs me-3">{{ $apply_data->no_register }}</span>
                                        <div class="mx-3">
                                            @if ($apply_data->status->name == 5)
                                                <span
                                                    class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $apply_data->status->name }}</span>
                                            @elseif($apply_data->status->name == 4)
                                                <span
                                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $apply_data->status->name }}</span>
                                            @else
                                                <span
                                                    class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{ $apply_data->status->name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="me-3 mt-3">
                                        <img src="{{ asset('storage/' . $apply_data->document->profile_picture) }}"
                                            alt="" srcset=""
                                            class="rounded h-52 md:h-auto sm:h-40 sm:w-40 object-cover">
                                    </div>
                                </div>
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                                        <div class="md:col-span-3">
                                            <label for="full_name">First Name</label>
                                            <input type="text" name="full_name" id="full_name"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->first_name }}" disabled />
                                        </div>

                                        <div class="md:col-span-3">
                                            <label for="full_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->family_name }}" disabled />
                                        </div>

                                        <div class="md:col-span-2">
                                            <label for="email">Email Address</label>
                                            <input type="text" name="email" id="email"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->email }}" placeholder="email@domain.com"
                                                disabled />
                                        </div>


                                        <div class="md:col-span-2">
                                            <label for="birth_date">Birth Date</label>
                                            <input type="text" name="birth_date" id="birth_date"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ \Carbon\Carbon::parse($apply_data->document->birth_date)->format('d M Y') }}"
                                                placeholder="12-12-2021" disabled />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="age">Age</label>
                                            <input type="text" name="age" id="age"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->age }}" placeholder="email@domain.com"
                                                disabled />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="gender">Gender</label>
                                            <input type="text" name="gender" id="gender"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->gender }}" placeholder="email@domain.com"
                                                disabled />
                                        </div>

                                        <div class="md:col-span-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->phone_number }}" placeholder=""
                                                disabled />
                                        </div>

                                        <div class="md:col-span-3">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" name="nationality" id="nationality"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="{{ $apply_data->document->nationality }}" placeholder=""
                                                disabled />
                                        </div>

                                        <div class="md:col-span-3">
                                            <label for="passport_nummber">Passport Number</label>
                                            <input type="text" name="passport_nummber" id="passport_nummber"
                                                class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                placeholder="" value="{{ $apply_data->document->passport_number }}"
                                                disabled />
                                        </div>

                                        <div class="md:col-span-3">
                                            <label for="department">Department</label>
                                            <input type="text" name="department" id="department"
                                                class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                placeholder="" value="{{ $apply_data->document->department }}"
                                                disabled />
                                        </div>
                                        {{-- File --}}
                                        @php
                                            $documents = [
                                                'passport' => 'Passport',
                                                'research_proposal' => 'Research Proposal',
                                                'study_plan' => 'Study Plan',
                                                'english_proficiency' => 'English Proficiency',
                                                'transcript' => 'Transcript',
                                                'cv' => 'CV',
                                                'medical_checkup' => 'Medical Checkup',
                                                'first_letter_of_recommendation' => 'First Letter of Recommendation',
                                                'second_letter_of_recommendation' => 'Second Letter of Recommendation',
                                                'commitment_letter' => 'Commitment Letter',
                                            ];
                                        @endphp
                                        @if (!empty($apply_data->document))
                                            @foreach ($documents as $key => $label)
                                                @if (!empty($apply_data->document->$key))
                                                    <div
                                                        class="md:col-span-2 flex items-center bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                                        <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                        </svg>
                                                        <a href="#"
                                                            @click.prevent="openModal('{{ asset('storage/' . $apply_data->document->$key) }}')"
                                                            class="text-base text-blue-500 hover:underline">
                                                            {{ $label }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-gray-500">No PDF files available.</p>
                                        @endif
                                        <div
                                            class="md:col-span-2 flex items-center bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-file-earmark-zip-fill h-5 w-5 text-blue-800 me-1"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 9.438V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243" />
                                                <path
                                                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-4-.5V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3zm0 4.5h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V8.5a1 1 0 0 1 1-1" />
                                            </svg>
                                            <a href="{{ route('admin.downloadZip', $apply_data->id) }}"
                                                class="text-base text-blue-500 hover:underline">
                                                Download All Files
                                            </a>
                                        </div>
                                    </div>
                                    {{-- Back button --}}
                                    <div class="flex justify-end mt-4">
                                        <a href="{{ route('admin.table') }}"
                                            class="bg-blue-800 hover:bg-blue-900 text-yellow-400 font-bold py-2 px-4 rounded-xl mr-2">
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Modal -->
                    <div x-show="isOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-2 h-auto max-h-screen">
                            <div class="flex justify-between items-center px-4 py-2 bg-gray-800 text-white">
                                <h3 class="text-lg font-semibold">PDF Viewer</h3>
                                <div class="flex space-x-2 gap-2">
                                    <button @click="zoomIn" class="text-white hover:text-stone-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0" />
                                            <path
                                                d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z" />
                                            <path fill-rule="evenodd"
                                                d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </button>
                                    <button @click="zoomOut" class="text-white hover:text-stone-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-zoom-out" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0" />
                                            <path
                                                d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z" />
                                            <path fill-rule="evenodd"
                                                d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                    </button>
                                    <button @click="closeModal" class="text-gray-600 hover:text-gray-800">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4 max-h-[calc(100vh-6rem)] overflow-auto">
                                <canvas id="pdf-canvas"></canvas>
                            </div>
                            <div class="flex justify-end p-4 border-t border-gray-300">
                                <a :href="pdfUrl" download
                                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        function pdfViewer() {
            return {
                isOpen: false,
                pdfUrl: '',
                pdfDoc: null,
                currentPage: 1,
                totalPages: 0,
                scale: 1.5, // Initial scale factor

                async openModal(url) {
                    this.isOpen = true;
                    this.pdfUrl = url; // Set the PDF URL for download
                    this.loadPdf(url);
                },

                closeModal() {
                    this.isOpen = false;
                    this.pdfDoc = null;
                    this.currentPage = 1;
                    this.totalPages = 0;
                },

                loadPdf(url) {
                    const loadingTask = pdfjsLib.getDocument(url);
                    loadingTask.promise.then(pdf => {
                        this.pdfDoc = pdf;
                        this.totalPages = pdf.numPages;
                        this.renderPage(this.currentPage);
                    }).catch(error => {
                        console.error('Error loading PDF:', error);
                    });
                },

                renderPage(num) {
                    this.pdfDoc.getPage(num).then(page => {
                        const viewport = page.getViewport({
                            scale: this.scale
                        });
                        const canvas = document.getElementById('pdf-canvas');
                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        context.save();
                        context.translate(viewport.width / 2, viewport.height / 2);
                        context.rotate((page.rotate * Math.PI) / 180);
                        context.translate(-viewport.width / 2, -viewport.height / 2);

                        page.render(renderContext).promise.then(() => {
                            context.restore();
                        });
                    });
                },

                zoomIn() {
                    this.scale += 0.2; // Increase scale by 0.2
                    this.renderPage(this.currentPage);
                },

                zoomOut() {
                    this.scale = Math.max(0.5, this.scale - 0.2); // Decrease scale by 0.2, but not below 0.5
                    this.renderPage(this.currentPage);
                }
            };
        }
    </script>
@endsection
