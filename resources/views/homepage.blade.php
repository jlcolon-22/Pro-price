@extends('layouts.app')

@section('title', 'Homepage')


@section('content')
    {{-- header --}}
    <x-buyer.header />

    {{-- carousel --}}
    <section>
        <div class="relative w-full h-fit ">
            <div class="overflow-x-scroll h-56 md:h-[30rem] overflow-y-hidden relative flex max-w-screen  snap-x snap-mandatory scroll-smooth"
                id="carousel">
                <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" class="object-cover min-w-full snap-start"
                    alt="...">
                <img src="{{ asset('assets/r-architecture-JvQ0Q5IkeMM-unsplash.jpg') }}" class="object-cover min-w-full snap-start"
                    alt="...">
            </div>
            <div class="absolute top-0 bottom-0 left-4 flex items-center">
                <button onclick="scrollCarousel(0)">
                    <img src="{{ asset('icons/arrow-left.svg') }}" loading="lazy"
                        class=" bg-white/30 hover:bg-white/60 transition-colors ease-in-out rounded-full p-2 "
                        alt="">
                </button>
            </div>
            <div class="absolute top-0 bottom-0 right-4 flex items-center">
                <button onclick="scrollCarousel(1)">
                    <img src="{{ asset('icons/arrow-left.svg') }}" loading="lazy"
                        class="rotate-180  bg-white/30 hover:bg-white/60 transition-colors ease-in-out rounded-full p-2"
                        alt="">
                </button>
            </div>

        </div>
    </section>

    {{-- features --}}
    <section class=" bg-secondary">
        <div class="container mx-auto py-10">
            <div class="grid md:grid-cols-4 gap-5">
                {{-- updated --}}
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/refresh-ccw.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">UPDATED</h2>
                    <p class="tracking-wider text-paragraph">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste voluptate culpa nam consectetur natus harum quidem, possimus accusamus nemo ex.
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/star.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">HIGH QUALITY HOUSES</h2>
                    <p class="tracking-wider text-paragraph">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste voluptate culpa nam consectetur natus harum quidem, possimus accusamus nemo ex.
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/dollar-sign.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">LONG TERM PAYMENTS</h2>
                    <p class="tracking-wider text-paragraph">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste voluptate culpa nam consectetur natus harum quidem, possimus accusamus nemo ex.
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/shield.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">SAFE AND RELIABLE CONTRACTS</h2>
                    <p class="tracking-wider text-paragraph">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste voluptate culpa nam consectetur natus harum quidem, possimus accusamus nemo ex.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- properties --}}
    <section class="container mx-auto py-10">
        {{-- label and view all button --}}
            <div class=" flex justify-between items-center">
                <h2 class="tracking-wider text-text font-semibold text-2xl">PROPERTIES</h2>
                <a href="/properties" class="text-blue-500 font-semibold underline">view all</a>
            </div>
        {{-- property item --}}
        <div class="grid grid-cols-3 gap-10 py-10">
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy" class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex gap-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end px-3 pb-3">

                    <a href="#" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy" class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex gap-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end px-3 pb-3">

                    <a href="#" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy" class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex gap-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end px-3 pb-3">

                    <a href="#" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy" class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex gap-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end px-3 pb-3">

                    <a href="#" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" loading="lazy" class="h-64 w-full object-cover" alt="">
                </div>
                <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">House 12313</h1>
                <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                    <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    ₱21313
                </p>
                <p class="px-3 flex gap-x-2 text-paragraph">
                    <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                    Antipolo City
                </p>
                <div class="flex items-center justify-end px-3 pb-3">

                    <a href="#" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
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
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        const carousel = document.querySelector('#carousel');

        function scrollCarousel(type) {

            if (type == 0) {
                carousel.scrollBy(-200, 0)
            } else {
                carousel.scrollBy(200, 0)
            }
        }


    </script>
@endsection
