@section('title', 'Register')

@extends('user.layout')

@section('content')
<section class="bg-gray-100 py-3 md:py-6">
    <div class="container">
        <div class="flex justify-start">
            <div class="w-full lg:w-11/12 bg-white p-8 rounded-xl mx-3">
                <h3 class="text-2xl font-bold text-center">Home</h3>
                @if (is_null($apply_data))
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 my-3" role="alert">
                        <p class="font-bold">Announecement!</p>
                        <p>Please apply scholarship first.</p>
                    </div>
                    <div class="my-3">
                        <table class="table-auto">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2">Email</td>
                                    <td class="px-4 py-2">{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Status</td>
                                    <td class="px-4 py-2 items-center text-center rounded-md bg-gray-50 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Unregistered</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else 
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                        <p class="font-bold">Announecement!</p>
                        <p>Your application has been submitted successfully.</p>
                    </div>
                    {{-- Show data --}}
                    <div class="my-3">
                        <table class="table-auto">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2">Email</td>
                                    <td class="px-4 py-2">{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Status</td>
                                    @if($apply_data->status->name == 'Approved')
                                        <td class="px-4 py-2 items-center text-center rounded-md bg-green-50 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-500/10">{{ $apply_data->status->name }}</td>
                                    @elseif($apply_data->status->name == 'Rejected')
                                        <td class="px-4 py-2 items-center text-center rounded-md bg-red-50 text-xs font-medium text-red-600 ring-1 ring-inset ring-red-500/10">{{ $apply_data->status->name }}</td>
                                    @else
                                    <td class="px-4 py-2 items-center text-center rounded-md bg-blue-50 text-xs font-medium text-blue-600 ring-1 ring-inset ring-gray-500/10">{{ $apply_data->status->name }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
    
@endsection
