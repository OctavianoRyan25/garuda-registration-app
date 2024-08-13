@extends('admin.layout')
@section('title', 'Detail User')
@section('content')
<div class="container mx-auto px-4 sm:px-8" x-data="pdfViewer()">
    <div class="flex flex-col my-5 text-center text-2xl font-bold">Detail User</div>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
            <!-- Card Data Diri -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-4">{{ $user->first_name }} {{ $user->family_name }}'s Details</h1>
                <div class="mb-4 space-y-4">
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="email"><path fill="#222" d="M53.42 53.32H10.58a8.51 8.51 0 0 1-8.5-8.5V19.18a8.51 8.51 0 0 1 8.5-8.5h42.84a8.51 8.51 0 0 1 8.5 8.5v25.64a8.51 8.51 0 0 1-8.5 8.5ZM10.58 13.68a5.5 5.5 0 0 0-5.5 5.5v25.64a5.5 5.5 0 0 0 5.5 5.5h42.84a5.5 5.5 0 0 0 5.5-5.5V19.18a5.5 5.5 0 0 0-5.5-5.5Z"></path><path fill="#222" d="M32 38.08a8.51 8.51 0 0 1-5.13-1.71L3.52 18.71a1.5 1.5 0 1 1 1.81-2.39L28.68 34a5.55 5.55 0 0 0 6.64 0l23.35-17.68a1.5 1.5 0 1 1 1.81 2.39L37.13 36.37A8.51 8.51 0 0 1 32 38.08Z"></path><path fill="#222" d="M4.17 49.14a1.5 1.5 0 0 1-1-2.62l18.4-16.41a1.5 1.5 0 0 1 2 2.24L5.17 48.76a1.46 1.46 0 0 1-1 .38zm55.66 0a1.46 1.46 0 0 1-1-.38l-18.4-16.41a1.5 1.5 0 1 1 2-2.24l18.39 16.41a1.5 1.5 0 0 1-1 2.62z"></path></svg>
                        <input type="text" class="bg-gray-100 border-0 text-gray-800 text-lg font-medium" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="phone"><path d="M27.308,20.649l-2.2-2.2a3.521,3.521,0,0,0-4.938-.021,2.152,2.152,0,0,1-2.729.267A15.026,15.026,0,0,1,13.3,14.562a2.181,2.181,0,0,1,.284-2.739A3.521,3.521,0,0,0,13.553,6.9l-2.2-2.2a3.514,3.514,0,0,0-4.961,0l-.633.634c-3.3,3.3-3.053,10.238,3.813,17.1,4.14,4.141,8.307,5.875,11.686,5.875a7.5,7.5,0,0,0,5.418-2.061l.634-.634A3.513,3.513,0,0,0,27.308,20.649ZM25.894,24.2l-.634.634c-2.6,2.6-8.339,2.125-14.276-3.813S4.571,9.34,7.171,6.74L7.8,6.107a1.511,1.511,0,0,1,2.133,0l2.2,2.2a1.511,1.511,0,0,1,.021,2.11,4.181,4.181,0,0,0-.531,5.239,17.01,17.01,0,0,0,4.713,4.706,4.179,4.179,0,0,0,5.231-.517,1.512,1.512,0,0,1,2.118.013l2.2,2.2A1.51,1.51,0,0,1,25.894,24.2Z"></path></svg>
                        <input type="text" class="bg-gray-100 border-0 text-gray-800 text-lg font-medium" value="{{ $user->phone_number }}" readonly>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="address"><path d="M61 28a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-3v-1a1 1 0 0 0-1-1H25c-.093 0-.177.03-.263.053L19.6 14.2a.999.999 0 0 0-1.2 0l-16 12a.999.999 0 0 0-.4.8v6a1 1 0 0 0 1.53.848L6 32.304V49a1 1 0 0 0 1 1h50a1 1 0 0 0 1-1v-1h3a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-3v-2h3a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-3v-2h3zm-1-6v4h-2v-4h2zM4 27.5l15-11.25L34 27.5v3.696l-14.47-9.044a1.003 1.003 0 0 0-1.06 0L4 31.196V27.5zm4 3.554 11-6.875 11 6.875V48h-2V37a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v11H8V31.054zM22 48V38h4v10h-4zm34 0H32V32.304l2.47 1.544A1 1 0 0 0 36 33v-6a.999.999 0 0 0-.4-.8L27.333 20H56v28zm4-6v4h-2v-4h2zm0-10v4h-2v-4h2z"></path><path d="M50 23H40a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-8v-4h8v4zm1 6H40a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2zm0 4H40a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2zm0 4H40a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2z"></path></svg>
                        <input type="text" class="bg-gray-100 border-0 text-gray-800 text-lg font-medium" value="{{ $user->nationality }}" readonly>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h3M3 14h3M3 18h3M6 10h12M6 14h12M6 18h12M15 6h3"/></svg>
                        <input type="text" class="bg-gray-100 border-0 text-gray-800 text-lg font-medium" value="{{ $user->passport_number }}" readonly>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" id="company"><path d="M8 30a2.006 2.006 0 0 0-2 2h4a2.006 2.006 0 0 0-2-2zM4 52h32V36H4a3.999 3.999 0 0 0-4 4v8a3.999 3.999 0 0 0 4 4zm115-22a2.006 2.006 0 0 0-2 2h4a2.006 2.006 0 0 0-2-2zm5 6H92v16h32a3.999 3.999 0 0 0 4-4v-8a3.999 3.999 0 0 0-4-4zm-5 46a1.996 1.996 0 0 0-1.73 1h3.46a1.996 1.996 0 0 0-1.73-1zm5 5H97v16h27a3.999 3.999 0 0 0 4-4v-8a3.999 3.999 0 0 0-4-4zM6 58h4a2 2 0 0 0-4 0zm30 4H4a3.999 3.999 0 0 0-4 4v8a3.999 3.999 0 0 0 4 4h29.88A8.587 8.587 0 0 1 36 76.71zm83-6a2.006 2.006 0 0 0-2 2h4a2.006 2.006 0 0 0-2-2zm5 6H92v14.71A8.587 8.587 0 0 1 94.12 78H124a3.999 3.999 0 0 0 4-4v-8a3.999 3.999 0 0 0-4-4zM50 74v-4a2 2 0 0 1 4 0v4a2.006 2.006 0 0 1-2 2h12a2.006 2.006 0 0 1-2-2v-4a2 2 0 0 1 4 0v4a2.006 2.006 0 0 1-2 2h12a2.006 2.006 0 0 1-2-2v-4a2 2 0 0 1 4 0v4a2.006 2.006 0 0 1-2 2h12V4a3.999 3.999 0 0 0-4-4H44a3.999 3.999 0 0 0-4 4v72h12a2.006 2.006 0 0 1-2-2zm24-64a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zM62 10a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zM50 10a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm0 12a2 2 0 0 1 4 0v4a2 2 0 0 1-4 0zm38.54 22H39.46A4.25 4.25 0 0 0 35 84v42a2.006 2.006 0 0 0 2 2h54a2.006 2.006 0 0 0 2-2V84a4.25 4.25 0 0 0-4.46-4zm.46 44H39V84.13L88.54 84a.782.782 0 0 1 .46.13z"></path><path d="M64 90a2 2 0 0 0-2 2v24a2 2 0 0 0 4 0V92a2 2 0 0 0-2-2zm-8 10a2 2 0 0 0-2 2v4a2 2 0 0 0 4 0v-4a2 2 0 0 0-2-2zm16 0a2 2 0 0 0-2 2v4a2 2 0 0 0 4 0v-4a2 2 0 0 0-2-2zM8 82a1.996 1.996 0 0 0-1.73 1h3.46A1.996 1.996 0 0 0 8 82zm-4 21h27V87H4a3.999 3.999 0 0 0-4 4v8a3.999 3.999 0 0 0 4 4zm2.27 5h3.46a1.996 1.996 0 0 0-3.46 0zm24.82 18.98A5.333 5.333 0 0 1 31 126v-14H4a3.999 3.999 0 0 0-4 4v8a3.999 3.999 0 0 0 4 4h27.35a5.91 5.91 0 0 1-.25-.94.221.221 0 0 1-.01-.08zM119 107a1.996 1.996 0 0 0-1.73 1h3.46a1.996 1.996 0 0 0-1.73-1zm5 5H97v14a5.333 5.333 0 0 1-.09.98.221.221 0 0 1-.01.08 5.91 5.91 0 0 1-.25.94H124a3.999 3.999 0 0 0 4-4v-8a3.999 3.999 0 0 0-4-4z"></path></svg>
                        <input type="text" class="bg-gray-100 border-0 text-gray-800 text-lg font-medium" value="{{ $user->department }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Card Dokumen -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">PDF Files</h2>
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
                    ];
                @endphp
                @if (!empty($user))
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($documents as $key => $label)
                            @if (!empty($user->$key))
                                <li class="flex items-center bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <a href="#" @click.prevent="openModal('{{ asset('storage/' . $user->$key) }}')" class="text-base text-blue-500 hover:underline">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No PDF files available.</p>
                @endif
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                            <path d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z"/>
                            <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </button>
                    <button @click="zoomOut" class="text-white hover:text-stone-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-out" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                            <path d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z"/>
                            <path fill-rule="evenodd" d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                    <button @click="closeModal" class="text-gray-600 hover:text-gray-800">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4 max-h-[calc(100vh-6rem)] overflow-auto">
                <canvas id="pdf-canvas"></canvas>
            </div>
            <div class="flex justify-end p-4 border-t border-gray-300">
                <a :href="pdfUrl" download class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Download PDF</a>
            </div>
        </div>
    </div>
</div>

<!-- Include PDF.js library -->
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
                    const viewport = page.getViewport({ scale: this.scale });
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
