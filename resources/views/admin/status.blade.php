@extends('admin.layout')
@section('title', 'Data Peserta')
@section('ex-css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for DataTables */
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            padding: .5rem 1rem;
            line-height: 1.25;
            border: 2px solid #edf2f7;
            border-radius: .25rem;
            background-color: #edf2f7;
        }

        table.dataTable.hover tbody tr:hover {
            background-color: #ebf4ff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            border-radius: .25rem;
            border: 1px solid transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1), 0 1px 2px rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #667eea !important;
            border: 1px solid transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1), 0 1px 2px rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #667eea !important;
            border: 1px solid transparent;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            margin: .75em 0;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
            background-color: #667eea !important;
        }
    </style>
@endsection

@section('content')
    <div class="container w-full xl:w-full mx-auto px-2">
        <nav class="text-black font-bold my-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin.index') }}">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.status') }}" class="text-gray-500">Update Status</a>
                </li>
            </ol>
        </nav>
        {{-- Table --}}
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <div class="flex flex-col my-5 text-center text-2xl font-bold">Data Peserta</div>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="2">No Register</th>
                        <th data-priority="3">First Name</th>
                        <th data-priority="4">Family Name</th>
                        <th data-priority="5">Email</th>
                        <th data-priority="6">Status 1</th>
                        <th data-priority="7">Action Status 1</th>
                        <th data-priority="8">Status 2</th>
                        <th data-priority="9">Action Status 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $index => $applicant)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $applicant->no_register }}</td>
                            <td>{{ $applicant->document->first_name }}</td>
                            <td>{{ $applicant->document->family_name }}</td>
                            <td>{{ $applicant->document->email }}</td>
                            <td>
                                @if($applicant->status->name == 'Rejected')
                                    <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif($applicant->status->name == 'Accepted')
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @endif
                            </td>
                            <td>
                                @if($applicant->status->name == 'Processed')
                                    <div class="items-center flex gap-2">
                                        <!-- Edit Button -->
                                        <form method="POST" class="inline-flex items-center p-3 bg-green-300 hover:bg-green-500 text-white text-sm font-medium rounded-md" action="{{ route('admin.approve', $applicant->id) }}">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status" class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                </svg>
                                            </button>
                                        </form>
                                    
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.reject', $applicant->id) }}" method="POST" class="inline-flex items-center p-3 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"fill="currentColor" class="bi bi-x-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status" class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($applicant->secondStatus->name == 'Rejected')
                                    <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $applicant->secondStatus->name }}</span>
                                @elseif($applicant->secondStatus->name == 'Accepted')
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $applicant->secondStatus->name }}</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{ $applicant->secondStatus->name }}</span>
                                @endif
                            </td>
                            <td>
                                @if($applicant->secondStatus->name == 'Processed')
                                    <div class="items-center flex gap-2">
                                        <!-- Edit Button -->
                                        <form method="POST" class="inline-flex items-center p-3 bg-green-300 hover:bg-green-500 text-white text-sm font-medium rounded-md" action="{{ route('admin.approveSecond', $applicant->id) }}">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status" class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                </svg>
                                            </button>
                                        </form>
                                    
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.rejectSecond', $applicant->id) }}" method="POST" class="inline-flex items-center p-3 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"fill="currentColor" class="bi bi-x-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status" class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                language:{
                    lengthMenu: 
                                'Display <select>' +
                                '<option value="10">10</option>' +
                                '<option value="50">50</option>' +
                                '<option value="100">100</option>' +
                                '<option value="-1">All</option>' +
                                '</select> records'
                }
            }).columns.adjust().responsive.recalc();
        });

        // Show spinner when button clicked
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    const spinner = submitButton.querySelector('#spinner');
                    
                    submitButton.disabled = true; // Disable the button to prevent multiple submissions
                    submitButton.querySelector('svg:not(#spinner)').classList.add('hidden'); // Hide the original icon
                    spinner.classList.remove('hidden'); // Show the spinner
                });
            });
        });

    </script>
@endsection
