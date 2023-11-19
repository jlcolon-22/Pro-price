@extends('layouts.app')



@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10">
        {{-- filter button --}}
        <div>
            <button id="filterButton" onclick="showFIlter()" class="border flex items-center justify-between gap-x-4 space-x-5 px-5 py-2 bg-body rounded">
                Filter
                <img src="{{ asset('icons/chevron-down.svg') }}" class="w-[1rem]" alt="">
            </button>
           <form id="filterForm" class="absolute z-40 bg-body shadow border w-[20rem] p-2 hidden">
            <div class="">
                <h3 class="text-text">Price</h3>
                <div class="grid grid-cols-5 items-center space-x-1 ">
                    <input type="number" name="from" class="text-center bg-tertiary py-2 rounded col-span-2" min="50000" value=" {{ app('request')->input('from') ? (int)app('request')->input('from') : 0 }}"  >
                    <span class="text-center " value="">TO </span>
                    <input type="number" name="to" class="text-center  bg-tertiary py-2 rounded  col-span-2" min="5000" >
                </div>
            </div>
            <div class="mt-2" >
                <h3 class="text-text">Location</h3>

                <div class="flex gap-x-2">
                    <input type="checkbox" name="antipolo" value="true"   {{ app('request')->input('antipolo') ? 'checked' : '' }}>Antipolo
                </div>
                <div class="flex gap-x-2">
                    <input type="checkbox" name="sanmateo" value="true"  {{ app('request')->input('sanmateo') ? 'checked' : '' }} >San mateo
                </div>
                <div class="flex gap-x-2">
                    <input type="checkbox"  name="cainta" value="true"  {{ app('request')->input('cainta') ? 'checked' : '' }}>Cainta
                </div>
            </div>
            <div class="mt-4 space-y-1">
                <button type="submit" class="bg-button px-5 py-2 w-full text-text">Submit</button>
                <button class="bg-gray-400 px-5 py-2 w-full text-text">Clear</button>
            </div>
           </form>
        </div>
        {{-- property item --}}
        <div class="grid grid-cols-3 gap-10 py-10">
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/heart.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border h-fit rounded">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/favorite_black_24dp.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/heart.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border h-fit rounded">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/favorite_black_24dp.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/heart.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border h-fit rounded">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy"
                        class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex space-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex space-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end space-x-2 px-3 pb-3">
                    <button class=" border  rounded px-4 py-2 text ">
                        <img src="{{ asset('icons/favorite_black_24dp.svg') }}" alt="">
                    </button>
                    <a href="#"
                        class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- footer --}}
    <x-buyer.footer/>
@endsection

@section('scripts')
<script>
    const filterForm = document.querySelector('#filterForm');
    function showFIlter(){
        filterForm.classList.toggle('hidden');
    }
</script>
@endsection
