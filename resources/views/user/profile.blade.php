@section('title', 'Register')

@extends('user.layout')

@section('content')
    <section class="bg-gray-100 py-3 md:py-3">
        <div class="container" x-data="pdfViewer()">
            <div class="flex justify-start">
                <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                    @if ($apply_data == null)
                        <img src="{{ asset('assets/failed.jpg') }}" alt="success" class="mx-auto w-full lg:w-5/12">
                        {{-- Information --}}
                        <div class="flex justify-center">
                            <p class="text-center text-gray-500">You have not applied for any scholarship yet. Please click
                                the button below to apply for a scholarship.</p>
                        </div>
                        {{-- Back button --}}
                        <div class="flex justify-center">
                            <a href="{{ route('user.apply') }}"
                                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md mt-3">Apply
                                Now</a>
                        </div>
                    @else
                        @if (Session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ Session('success') }}</span>
                            </div>
                        @endif
                        {{-- Show Data in form --}}
                        <!-- component -->
                        <div class="flex">
                            <div class="p-4 px-4 md:p-8 mb-6">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                    <div
                                        class="text-gray-600 flex flex-col items-center text-center md:items-start md:text-start">
                                        <p class="text-lg font-bold">Personal Details</p>
                                        <div class="me-3 mt-3 sm:mt-2">
                                            <img src="{{ asset('storage/' . $apply_data->document->profile_picture) }}"
                                                alt="" class="rounded h-52 md:h-auto sm:h-40 sm:w-40 object-cover">
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
                                                    value="{{ $apply_data->document->email }}"
                                                    placeholder="email@domain.com" disabled />
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
                                                    value="{{ $apply_data->document->gender }}"
                                                    placeholder="email@domain.com" disabled />
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
                                                    'first_letter_of_recommendation' =>
                                                        'First Letter of Recommendation',
                                                    'second_letter_of_recommendation' =>
                                                        'Second Letter of Recommendation',
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

                                            <div class="md:col-span-6 text-right mt-4">
                                                <div class="inline-flex items-end">
                                                    <a href="/profile/edit"
                                                        class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-xl transition duration-200 ease-in-out">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Modal -->
                        <div x-show="isOpen"
                            class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center">
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
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                        <!-- Include PDF.js library -->
                    @endif
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
