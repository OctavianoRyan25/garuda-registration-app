@section('title', 'Register')

@extends('user.layout')

@section('content')
<section class="bg-gray-100 py-3 md:py-3">
    <div class="container">
        <div class="flex justify-start">
            <div class="w-full lg:w-full bg-white p-8 rounded-xl mx-3">
                @if($apply_data == null)
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-3" role="alert">
                        <p class="font-bold">Note!</p>
                        <p>You have not applied for any scholarship yet. You can apply <a class="font-semibold underline" href="/apply">Here</a></p>
                    </div>
                    <img src="{{ asset('assets/failed.jpg') }}" alt="success" class="mx-auto w-full lg:w-5/12">
                @else
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3" role="alert">
                        <p class="font-bold">Announcement!</p>
                        <p>Your application has been submitted successfully.</p>
                    </div>
                @endif
                    {{-- Show data --}}
                    <section class="w-full py-12 md:py-24 lg:py-32">
                        <div class="container px-4 md:px-6 space-y-10 xl:space-y-16">
                            <div class="grid max-w-[1300px] mx-auto gap-4 px-4 sm:px-6 md:px-10 md:grid-cols-2 md:gap-16">
                                <div>
                                    <h1 class="lg:leading-tighter text-2xl font-bold tracking-tighter sm:text-3xl md:text-3xl xl:text-4xl 2xl:text-4xl">
                                        Welcome {{ $apply_data->document->first_name }} {{ $apply_data->document->family_name }}
                                    </h1>
                                    <p class="mx-auto max-w-[700px] text-muted-foreground md:text-xl">
                                        Manage your scholarship applications, deadlines, and more in one place.
                                    </p>
                                </div>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full" data-v0-t="card">
                                        <div class="flex flex-col space-y-1.5 p-6">
                                            <h3 class="whitespace-nowrap text-xl text-center font-semibold leading-none tracking-tight">Your Profile</h3>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid gap-2">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">First Name:</span>
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">{{ $apply_data->document->first_name }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">Last Name:</span>
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">{{ $apply_data->document->family_name }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">Phone:</span>
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">{{ $apply_data->document->phone_number }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">Nationality:</span>
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">{{ $apply_data->document->nationality }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">Department:</span>
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">{{ $apply_data->document->department }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs md:text-xs lg:text-base md:font-medium">Status</span>
                                                    @if($apply_data->status->name == 'Rejected')
                                                        <span class="font-medium text-red-500">{{ $apply_data->status->name }}</span>
                                                    @elseif($apply_data->status->name == 'Accepted')
                                                        <span class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $apply_data->status->name }}</span>
                                                    @else
                                                    <span class="rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{ $apply_data->status->name }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- Aditional Card --}}
                    <section class="w-full py-12 md:py-24 lg:py-32 bg-muted">
                        <div class="container px-4 md:px-6">
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">
                                    More Info
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <p class="text-muted-foreground">
                                    To get more information about scholarship, please visit the link below.
                                    </p>
                                </div>
                                <div class="flex items-center p-6">
                                    <a
                                    href="https://garuda.dinus.ac.id/"
                                    class="inline-flex h-9 items-center justify-center rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-blue-800 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                                    >
                                    Apply Now
                                    </a>
                                </div>
                                </div>
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">
                                    Scholarship Resources
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <p class="text-muted-foreground">Explore our library of scholarship guides and tips.</p>
                                </div>
                                <div class="flex items-center p-6">
                                    <a
                                    href="#"
                                    class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                                    >
                                    Learn More
                                    </a>
                                </div>
                                </div>
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">
                                    Scholarship Updates
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <p class="text-muted-foreground">
                                    Stay informed about the latest scholarship opportunities and deadlines.
                                    </p>
                                </div>
                                <div class="flex items-center p-6">
                                    <a
                                    href="#"
                                    class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                                    >
                                    View Updates
                                    </a>
                                </div>
                                </div>
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Contact Us</h3>
                                </div>
                                <div class="p-6">
                                    <p class="text-muted-foreground">Get in touch with our team for any questions or assistance.</p>
                                </div>
                                <div class="flex items-center p-6">
                                    <a
                                    href="#"
                                    class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                                    >
                                    Contact Us
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
</section>
    
@endsection
