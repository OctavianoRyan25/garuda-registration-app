@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <div class="container mx-auto px-4 sm:px-8">
        <!-- component -->
        <div class="flex justify-between items-center mx-6 mt-12">
            <div data-aos="flip-right"
                class="bg-white rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                <form method="GET" action="{{ route('admin.index') }}">
                    <!-- Dropdown Tahun -->
                    <div class="relative w-full md:w-56 px-6 flex flex-col items-start">
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                            Pilih Tahun
                        </label>
                        <div class="relative w-full">
                            <select name="year" id="year"
                                class="block w-full appearance-none bg-white border border-gray-300 hover:border-blue-500 px-4 py-2 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out"
                                onchange="this.form.submit()">
                                @for ($i = date('Y'); $i >= 2021; $i--)
                                    <option value="{{ $i }}" {{ $selected_year == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <!-- Icon Dropdown -->
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="fill-current text-gray-700 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- Welcome Card -->
            <div class="bg-blue-500 text-white px-6 py-4 rounded-lg shadow-md flex items-center" data-aos="flip-left">
                <svg class="w-10 h-10 text-white mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 007 18h10a4 4 0 001.879-.196M15 11h.01M9 11h.01M12 14h.01M4 6h16M4 6a2 2 0 012-2h12a2 2 0 012 2M4 6v12a2 2 0 002 2h12a2 2 0 002-2V6" />
                </svg>
                <div>
                    <h2 class="text-lg font-semibold">Welcome, Admin!</h2>
                    <p class="text-sm">Kelola data dengan mudah dan efisien.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-12">
            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <div data-aos="fade-right"
                    class="bg-white rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-person-fill text-blue-500 text-4xl mb-2 h-14 w-14" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    <p class="text-3xl font-semibold text-gray-800">{{ $count_user_today }}</p>
                    <p class="text-gray-500">User Registered Today</p>
                </div>

                <div data-aos="fade-right"
                    class="bg-white rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-people-fill text-blue-500 text-4xl mb-2 h-14 w-14" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                    <p class="text-3xl font-semibold text-gray-800">{{ $count_user }}</p>
                    <p class="text-gray-500">All Users in 2025</p>
                </div>

                <div data-aos="fade-left"
                    class="bg-white rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-globe2 text-blue-500 text-4xl mb-2 h-14 w-14" viewBox="0 0 16 16">
                        <path
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855q-.215.403-.395.872c.705.157 1.472.257 2.282.287zM4.249 3.539q.214-.577.481-1.078a7 7 0 0 1 .597-.933A7 7 0 0 0 3.051 3.05q.544.277 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9 9 0 0 1-1.565-.667A6.96 6.96 0 0 0 1.018 7.5zm1.4-2.741a12.3 12.3 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332M8.5 5.09V7.5h2.99a12.3 12.3 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.6 13.6 0 0 1 7.5 10.91V8.5zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741zm-3.282 3.696q.18.469.395.872c.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a7 7 0 0 1-.598-.933 9 9 0 0 1-.481-1.079 8.4 8.4 0 0 0-1.198.49 7 7 0 0 0 2.276 1.522zm-1.383-2.964A13.4 13.4 0 0 1 3.508 8.5h-2.49a6.96 6.96 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667m6.728 2.964a7 7 0 0 0 2.275-1.521 8.4 8.4 0 0 0-1.197-.49 9 9 0 0 1-.481 1.078 7 7 0 0 1-.597.933M8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855q.216-.403.395-.872A12.6 12.6 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.96 6.96 0 0 0 14.982 8.5h-2.49a13.4 13.4 0 0 1-.437 3.008M14.982 7.5a6.96 6.96 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008zM11.27 2.461q.266.502.482 1.078a8.4 8.4 0 0 0 1.196-.49 7 7 0 0 0-2.275-1.52c.218.283.418.597.597.932m-.488 1.343a8 8 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z" />
                    </svg>
                    <p class="text-3xl font-semibold text-gray-800">{{ $region_count }}</p>
                    <p class="text-gray-500">Regions</p>
                </div>

                <div data-aos="fade-left"
                    class="bg-white rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-building-fill-up text-blue-500 text-4xl mb-2 h-14 w-14"" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0" />
                        <path
                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-3.59 1.787A.5.5 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.5 4.5 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    <p class="text-3xl font-semibold text-gray-800">{{ $department_count }}</p>
                    <p class="text-gray-500">Department</p>
                </div>
            </div>

            <!-- Users by Nationality & Users by Department -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Grafik Users by Nationality -->
                <div data-aos="zoom-in-up"
                    class="bg-white col-span-4 rounded-xl shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-bar-chart-line-fill h-7 me-1 text-blue-700" viewBox="0 0 16 16">
                            <path
                                d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1z" />
                        </svg>
                        <h2 class="font-bold text-2xl text-gray-800 mb-5 text-center mt-5">USERS DISTRIBUTION BY
                            DEPARTMENTS</h2>
                    </div>
                    <hr class="my-5 w-full border-1 border-gray-200">
                    <canvas id="myChart"></canvas>
                </div>

                <!-- Tabel Users by Department -->
                <div
                    class="bg-white col-span-2 rounded-lg shadow-md p-6 hover:transform hover:translate-y-1 hover:shadow-lg transition-all">
                    <h2 class="font-semibold text-sm text-gray-800 mb-5">Users by Region</h2>
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 font-semibold">
                                <th class="px-4 py-2">NAME</th>
                                <th class="px-4 py-2 text-center">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_nationlity as $region)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-4 py-2">{{ $region->NATIONALITY }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $region->COUNTER }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        <script>
            window.chartData = @json($data_department);

            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('myChart').getContext('2d');
                var data = window.chartData;

                var labels = data.map(function(item) {
                    return item.DEPARTMENT;
                });

                var counts = data.map(function(item) {
                    return item.COUNTER;
                });

                // Generate random colors for each bar
                var backgroundColors = labels.map(() =>
                    `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`
                );
                var borderColors = backgroundColors.map(color => color.replace('0.5',
                    '1')); // Make border color fully opaque

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Users by Department',
                            data: counts,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
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
