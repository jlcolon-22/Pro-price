@extends('layouts.app')

@section('title', 'Homepage')


@section('content')
    {{-- header --}}
    <x-buyer.header />

    {{-- carousel --}}
    <section class="z-0 " >
        <div class="relative w-full h-fit ">
            <div class="overflow-x-scroll h-56 md:h-[30rem] overflow-y-hidden relative flex max-w-screen  snap-x snap-mandatory scroll-smooth"
                id="carousel">
                <img src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" class="object-cover min-w-full snap-start"
                    alt="...">
                <img src="{{ asset('assets/r-architecture-JvQ0Q5IkeMM-unsplash.jpg') }}" class="object-cover min-w-full snap-start"
                    alt="...">
            </div>
           <div class="absolute w-full top-0 left-0 h-full bg-black/60 flex justify-center items-center flex-col">
            <h1 class="text-body font-semibold  text-3xl  text-center">Let Proprice be your compass in the world of property values and trends. </h1>
            <p class="text-body w-[60%] text-center">
                Join Proprice today and revolutionize the way you engage with real estate – where accuracy meets user empowerment, shaping a seamless journey towards your dream property.
            </p>
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
    <section class="px-3 md:px-0 bg-secondary">
        <div class="container mx-auto pb-10">
            <h1 class="py-10 text-center text-2xl font-serif font-semibold">Welcome to Proprice,where innovation meets your real estate dreams! </h1>
            <div class="grid md:grid-cols-3 gap-5">
                {{-- updated --}}
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/refresh-ccw.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Predictive Precision</h2>
                    <p class="tracking-wider text-paragraph">
                        While our system might occasionally require adjustments for precision, fear not! Sellers can fine-tune and modify their property details, ensuring accuracy. Dive in, upload your property, and tweak as needed for spot-on predictions!
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/star.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Interactive Engagement</h2>
                    <p class="tracking-wider text-paragraph">
                        Buyers, this is your playground! Bookmark your favorites, and view properties. Connect effortlessly, set appointments with agents, and engage in insightful inquiries, all at your convenience.
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded">
                    <img src="{{ asset('icons/dollar-sign.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Continuous Improvement</h2>
                    <p class="tracking-wider text-paragraph">
                        We believe in evolving together. Proprice continually refines its prediction models based on the data uploaded by buyers. This feedback loop enriches our algorithms, enhancing future predictions and ensuring a dynamic, ever-improving system.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- properties --}}
    <section class="container mx-auto py-10 px-3 md:px-0">
        {{-- label and view all button --}}
            <div class=" flex justify-between items-center">
                <h2 class="tracking-wider text-text font-semibold text-2xl">PROPERTIES</h2>
                <a href="/properties" class="text-blue-500 font-semibold underline">view all</a>
            </div>
        {{-- property item --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 py-10">
            @forelse ($properties as $property)
            <div class="bg-body border  h-fit rounded ">
                <div class="p-3">
                    <img src="{{ asset($property->photo?->photo) }}" loading="lazy" class="h-64 w-full object-cover" alt="">
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

                    <a href="{{ route('view_property',['id' =>$property->id]) }}" class="bg-transparent border rounded px-4 py-2 text-text hover:bg-button transition-all ease-in-out">
                        view
                    </a>
                </div>
            </div>
            @empty

            @endforelse

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
