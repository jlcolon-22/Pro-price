@extends('layouts.app')

@section('title', 'Properties')

@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10 px-3 md:px-0">
        {{-- filter button --}}
        <div class="relative">
            <button id="filterButton" onclick="showFIlter()"
                class="border w-full md:w-[20rem] flex items-center justify-between gap-x-4 space-x-5 px-5 py-2 bg-body rounded text-gray-400">
                Search
                <img src="{{ asset('icons/search.svg') }}" class="w-[1rem]" alt="">
            </button>

            <form id="filterForm" class="absolute z-40 bg-body shadow border w-full md:w-[30rem] p-2 hidden">
                <div class="grid md:grid-cols-2">
                    <div class="mt-2">
                        <h3 class="text-text">Type</h3>

                        <div class="flex gap-x-2">
                            <input type="radio" name="type" value="Bungalow"
                                {{ app('request')->input('type') == 'Bungalow' ? 'checked' : '' }}>Bungalow
                        </div>
                        <div class="flex gap-x-2">
                            <input type="radio" name="type" value="Townhouse"
                                {{ app('request')->input('type') == 'Townhouse' ? 'checked' : '' }}>Townhouse
                        </div>
                        <div class="flex gap-x-2">
                            <input type="radio" name="type" value="Duplex"
                                {{ app('request')->input('type') == 'Duplex'  ? 'checked' : '' }}>Duplex
                        </div>
                        <div class="flex gap-x-2">
                            <input type="radio" name="type" value="Single Attached"
                                {{ app('request')->input('type') == 'Single Attached' ? 'checked' : '' }}>Single Attached
                        </div>
                    </div>
                    <div class="mt-2">
                        <h3 class="text-text">Location</h3>

                        <div class="flex gap-x-2">
                            <input type="radio" name="location" value="Antipolo"
                                {{ app('request')->input('location') == 'Antipolo' ? 'checked' : '' }}>Antipolo
                        </div>
                        <div class="flex gap-x-2">
                            <input type="radio" name="location" value="San mateo"
                                {{ app('request')->input('location') == 'San mateo' ? 'checked' : '' }}>San mateo
                        </div>
                        <div class="flex gap-x-2">
                            <input type="radio" name="location" value="Binangonan"
                                {{ app('request')->input('location') == 'Binangonan' ? 'checked' : '' }}>Binangonan
                        </div>
                    </div>
                </div>

                <div class="relative my-6">
                    <label for="labels-range-input" class="">Labels range(<span id="currentPrice">₱{{ app('request')->input('price') ? number_format(app('request')->input('price')) : '50000' }}</span>  )</label>
                    <input id="labels-range-input" name="price" onchange="searchPrice(this)" type="range" value="{{ app('request')->input('price') ? app('request')->input('price') : '50000' }}" min="50000" max="100000000"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Min (₱ 50k)</span>

                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Max (₱ 100M)</span>
                </div>



                <div class="mt-4 grid space-y-1">
                    <button type="submit" class="bg-button px-5 py-2 w-full text-text">Submit</button>
                    <a href="/properties" type="button" class="bg-gray-300 px-5 py-2 w-full text-center text-text">Clear</a>
                </div>
            </form>
        </div>
        {{-- property item --}}
        <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-10 py-10">


            @forelse ($properties as $property)
                <div class="bg-body border  h-fit rounded ">
                    <div class="p-3">
                        <img src="{{ asset($property->photo?->photo) }}" loading="lazy" class="h-64 w-full object-cover"
                            alt="">
                    </div>
                    <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">{{ $property->title }}</h1>
                    <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                        <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                        ₱{{ number_format($property->price) }}
                    </p>
                    <p class="px-3 flex gap-x-2 text-paragraph">
                        <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                        {{ $property->address }}
                    </p>
                    <div class="flex items-center justify-end px-3 pb-3">

                        <a href="{{ route('view_property', ['id' => $property->id]) }}"
                            class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                            view
                        </a>
                    </div>
                </div>
            @empty
            <h1>No Property found....</h1>
            @endforelse



        </div>
        <div>
            {{ $properties->links() }}
        </div>
    </section>

    {{-- footer --}}
    <x-buyer.footer />
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        const filterForm = document.querySelector('#filterForm');

        function showFIlter() {
            filterForm.classList.toggle('hidden');
        }
        function searchPrice(e)
        {

            const price = parseFloat(e.value)
            document.querySelector('#currentPrice').innerHTML = '₱'+price.toLocaleString('en-US')

        }
    </script>
@endsection
