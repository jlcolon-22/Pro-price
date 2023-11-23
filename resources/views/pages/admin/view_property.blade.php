@extends('layouts.app')

@section('title', 'Admin View Property')



@section('content')
    <section class="bg-body flex min-h-screen max-h-[100svh] overflow-hidden">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10 max-h-[100svh] overflow-auto">
            <a href="{{ route('admin_properties') }}" class="bg-button px-4 py-2 ">back</a>
            <div class="py-10">
                <h1 class="font-semibold opacity-70 underline">Property Details</h1>
                <div class="grid grid-cols-3 gap-x-10 p-4">
                    <div class="grid">
                        <label for="">Title</label>
                        <input type="text" class="px-3 py-2 bg-black/10 text-opacity-60 " disabled value="{{ $property->title }}">
                    </div>
                    <div class="grid">
                        <label for="">Price</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->price }}">
                    </div>
                    <div class="grid">
                        <label for="">Type</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->type }}">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-x-10 p-4">
                    <div class="grid">
                        <label for="">Land Size</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->land_size }}">
                    </div>
                    <div class="grid">
                        <label for="">Floor Area</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->floor_area }}">
                    </div>
                    <div class="grid">
                        <label for="">Bed Room</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->bed_room }}">
                    </div>
                </div>
                <div class="grid grid-cols-3 items-start gap-x-10 p-4">
                    <div class="grid">
                        <label for="">Bath Room</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->bath_room }}">
                    </div>
                    <div class="grid">
                        <label for="">Floor Number</label>
                        <input type="text" class="px-3 py-2 bg-black/10 opacity-75 " disabled value="{{ $property->floor_number }}">
                    </div>

                    <div class="grid">
                        <label for="">Address</label>

                        <textarea class="px-3 py-2 bg-black/10 opacity-75 " disabled rows="4">{{ $property->address }}</textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="py-10">
                <h1 class="font-semibold opacity-70 underline">Property Photos</h1>

                <div class="grid grid-cols-3">
                    @foreach ($property->photos as $photo)
                    <img src="{{ asset($photo->photo) }}" alt="..." loading="lazy">
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="py-10">
                <h1 class="font-semibold opacity-70 underline">Property Copy of title of land</h1>

                <div class="">

                    <img src="{{ asset($property->title_copy) }}" alt="..." loading="lazy">

                </div>
            </div>


        </main>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
