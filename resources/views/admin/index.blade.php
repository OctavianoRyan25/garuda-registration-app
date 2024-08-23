@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="container mx-auto px-4 sm:px-8">
        <!-- component -->
        <div class="flex flex-col my-5 text-center text-2xl font-bold">Dashboard</div>
        <div class="flex flex-wrap -m-4 text-center">
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div class="border-2 bg-white shadow-lg px-4 py-6 rounded-lg transform transition duration-300 hover:scale-110">
                    <img src="{{ asset('assets/user.png') }}" alt="user" class="w-12 h-12 mb-3 inline-block">
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $count_user_today }}</h2>
                    <p class="leading-relaxed">User Registered Today</p>
                </div>
            </div>
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div class="border-2 bg-white shadow-lg px-4 py-6 rounded-lg transform transition duration-300 hover:scale-110">
                    <img src="{{ asset('assets/user.png') }}" alt="user" class="w-12 h-12 mb-3 inline-block">
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $count_user }}</h2>
                    <p class="leading-relaxed">All User Registered</p>
                </div>
            </div>
            
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div class="border-2 bg-white shadow-lg px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 24 24" id="globe" class="w-12 h-12 mb-3 inline-block">
                        <circle cx="12" cy="12" r="10.5" fill="#5d9cec"></circle>
                        <path fill="#3679ce" d="M13.5 22.393c-5.086-.729-9-5.107-9-10.393 0-5.286 3.914-9.664 9-10.393-.49-.071-.991-.107-1.5-.107C6.205 1.5 1.5 6.205 1.5 12S6.205 22.5 12 22.5c.509 0 1.01-.036 1.5-.107Z"></path>
                        <path fill="#e7e7e7" d="M12 1.5c-1.465 0-2.831.772-3.93 2.114C6.522 5.507 5.5 8.557 5.5 12c0 3.443 1.022 6.493 2.57 8.386C9.169 21.728 10.535 22.5 12 22.5c1.465 0 2.831-.772 3.93-2.114 1.548-1.893 2.57-4.943 2.57-8.386 0-3.443-1.022-6.493-2.57-8.386C14.831 2.272 13.465 1.5 12 1.5Zm0 1c1.184 0 2.268.662 3.156 1.747C16.586 5.995 17.5 8.82 17.5 12c0 3.18-.914 6.005-2.344 7.753C14.268 20.838 13.184 21.5 12 21.5c-1.184 0-2.268-.662-3.156-1.747C7.414 18.005 6.5 15.18 6.5 12c0-3.18.914-6.005 2.344-7.753C9.732 3.162 10.816 2.5 12 2.5Z"></path><path fill="#e7e7e7" d="M11.5 1.512v20.976a10.396 10.396 0 0 0 1 0V1.512a10.396 10.396 0 0 0-1 0Z"></path><path fill="#e7e7e7" d="M21.902 8.5H2.098c-.115.326-.215.66-.298 1h20.4c-.083-.34-.183-.674-.298-1zm.298 6H1.8c.083.34.183.674.298 1h19.804c.115-.326.215-.66.298-1z"></path>
                        <path d="M12 1.5C6.205 1.5 1.5 6.205 1.5 12S6.205 22.5 12 22.5 22.5 17.795 22.5 12 17.795 1.5 12 1.5Zm0 1c5.243 0 9.5 4.257 9.5 9.5s-4.257 9.5-9.5 9.5-9.5-4.257-9.5-9.5S6.757 2.5 12 2.5Z"></path>
                        <path d="M12 1.5c-1.465 0-2.831.772-3.93 2.114C6.522 5.507 5.5 8.557 5.5 12c0 3.443 1.022 6.493 2.57 8.386C9.169 21.728 10.535 22.5 12 22.5c1.465 0 2.831-.772 3.93-2.114 1.548-1.893 2.57-4.943 2.57-8.386 0-3.443-1.022-6.493-2.57-8.386C14.831 2.272 13.465 1.5 12 1.5Zm0 1c1.184 0 2.268.662 3.156 1.747C16.586 5.995 17.5 8.82 17.5 12c0 3.18-.914 6.005-2.344 7.753C14.268 20.838 13.184 21.5 12 21.5c-1.184 0-2.268-.662-3.156-1.747C7.414 18.005 6.5 15.18 6.5 12c0-3.18.914-6.005 2.344-7.753C9.732 3.162 10.816 2.5 12 2.5Z"></path><path d="M11.5 2v20a.5.5 0 0 0 1 0V2a.5.5 0 0 0-1 0Z"></path><path d="M21.541 8.5H2.459a.5.5 0 0 0 0 1h19.082a.5.5 0 0 0 0-1zm0 6H2.459a.5.5 0 0 0 0 1h19.082a.5.5 0 0 0 0-1z"></path>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $region_count }}</h2>
                    <p class="leading-relaxed">Region</p>
                </div>
            </div>
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div class="border-2 bg-white shadow-lg px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110"">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 47.5 47.5" viewBox="0 0 47.5 47.5" id="department" class="w-12 h-12 mb-3 inline-block">
                        <defs><clipPath id="a"><path d="M0 38h38V0H0v38Z"></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.25 0 0 -1.25 0 47.5)"><path fill="#ffcc4d" d="M0 0a2 2 0 0 1 2-2h18a2 2 0 0 1 2 2v20a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V0Z" transform="translate(15 3)"></path><path fill="#bcbec0" d="M0 0h-14v-2H2a2 2 0 0 1-2 2" transform="translate(35 25)"></path><path fill="#55acee" d="M21 1h14v20H21V1Z"></path><path fill="#ffe8b6" d="M0 0h-16a2 2 0 0 1-2-2v-32a2 2 0 0 1 2-2H2v34a2 2 0 0 1-2 2" transform="translate(19 37)"></path><path fill="#bcbec0" d="M0 0h-16a2 2 0 0 1-2-2H2a2 2 0 0 1-2 2" transform="translate(19 37)"></path><path fill="#55acee" d="M3 11h16v4H3v-4zM3 17h16v4H3v-4zM3 23h16v4H3v-4zM3 29h16v4H3v-4zM3 1h16v8H3V1Z"></path><path fill="#3b88c3" d="M7 1h8v4H7V1ZM24 1h8v4h-8V1z"></path><path fill="#ffcc4d" d="M36 9H21v2h15V9zM36 15H21v2h15v-2z"></path><path fill="#dd2e44" d="M0 0a2 2 0 0 0-2-2h-10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V0Z" transform="translate(37 30)"></path><path fill="#58595b" d="M29 25h-2v3h2v-3zM33 25h-2v3h2v-3z"></path><path fill="#f4abba" d="M27 30h-2v2h2v-2z"></path><path fill="#fff" d="M29 30h-2v2h2v-2z"></path><path fill="#f4abba" d="M31 30h-2v2h2v-2z"></path><path fill="#fff" d="M33 30h-2v2h2v-2z"></path><path fill="#f4abba" d="M35 30h-2v2h2v-2z"></path></g>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $department_count }}</h2>
                    <p class="leading-relaxed">Department</p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap w-full mt-10">
            <div class="w-full xl:w-1/2 p-2">
                <h2 class="text-lg font-semibold text-gray-900">Users by Nationality</h2>
                <div class="relative h-96">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="w-full xl:w-1/2 p-2">
                <h2 class="text-lg font-semibold text-gray-900">Users by Department</h2>
                <div class="relative">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_department as $department)
                                        <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $department->DEPARTMENT }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $department->COUNTER }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Pass data from Laravel to JavaScript
            window.chartData = @json($data_nationlity);
    
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById('myChart').getContext('2d');
                var data = window.chartData;
    
                var labels = data.map(function(item) {
                    return item.NATIONALITY;
                });
    
                var counts = data.map(function(item) {
                    return item.COUNTER;
                });
    
                var myChart = new Chart(ctx, {
                    type: 'bar', // You can change this to 'line', 'pie', etc.
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Users by Nationality',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById('myChart2').getContext('2d');
                var data = window.chartData;
    
                var labels = data.map(function(item) {
                    return item.NATIONALITY;
                });
    
                var counts = data.map(function(item) {
                    return item.COUNTER;
                });
    
                var myChart = new Chart(ctx, {
                    type: 'bar', // You can change this to 'line', 'pie', etc.
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Users by Nationality',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
