@extends('layouts.app')

@section('title', 'Homepage')


@section('content')
    {{-- header --}}
    <x-buyer.header />

    {{-- hearo section --}}
    {{-- <section class="z-0 " >
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
    </section> --}}
    <div class="items-center w-10/12 grid-cols-2 mx-auto overflow-x-hidden lg:grid md:py-14 lg:py-24 xl:py-14 lg:mt-3 xl:mt-5"
        data-aos="fade-right" data-aos-duration="800">
        <div class="pr-2 md:mb-14 py-14 md:py-0">
            <h1 class="text-3xl font-semibold text-text xl:text-5xl lg:text-3xl animate-in slide-in-from-top duration-1000"><span class="block w-full">Let Proprice be
                    your compass</span> in the world of property values and trends. </h1>
            <p class="py-4 text-lg text-gray-500 2xl:py-8 md:py-6 2xl:pr-5 animate-in slide-in-from-left-72 duration-1000">
                Join Proprice today and revolutionize the way you engage with real estate – where accuracy meets user
                empowerment, shaping a seamless journey towards your dream property.
            </p>
            <div class="mt-4">
                <a type="button" onclick="modalLoginToggle()"
                    class="px-5 py-3 text-lg tracking-wider cursor-pointer text-white bg-button rounded-lg md:px-8 hover:bg-button group"><span>Get
                        Started</span> </a>
            </div>
        </div>

        <div class="pb-10 overflow-hidden md:p-10 lg:p-0 sm:pb-0">
            <img id="heroImg1"
                class="transition-all duration-300 ease-in-out hover:scale-105 lg:w-full sm:mx-auto sm:w-4/6 sm:pb-12 lg:pb-0"
                src="{{ asset('assets/pngwing.com(2).png') }}" alt="Awesome hero page image" width="500"
                height="488" />
        </div>
    </div>
    {{-- features --}}
    <section class="px-3 md:px-0 bg-secondary py-10">
        <div class="container mx-auto pb-10">
            <h1 class="py-10 text-center text-2xl  font-semibold">Welcome to Proprice,where innovation meets your real
                estate dreams! </h1>
            <div class="grid md:grid-cols-3 gap-5" id="featuresContainer">
                {{-- updated --}}
                <div class="border px-5 py-8 bg-body space-y-3 rounded opacity-0">
                    <img src="{{ asset('icons/refresh-ccw.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Predictive Precision</h2>
                    <p class="tracking-wider text-paragraph">
                        While our system might occasionally require adjustments for precision, fear not! Sellers can
                        fine-tune and modify their property details, ensuring accuracy. Dive in, upload your property, and
                        tweak as needed for spot-on predictions!
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded opacity-0">
                    <img src="{{ asset('icons/star.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Interactive Engagement</h2>
                    <p class="tracking-wider text-paragraph">
                        Buyers, this is your playground! Bookmark your favorites, and view properties. Connect effortlessly,
                        set appointments with agents, and engage in insightful inquiries, all at your convenience.
                    </p>
                </div>
                <div class="border px-5 py-8 bg-body space-y-3 rounded opacity-0">
                    <img src="{{ asset('icons/bar-chart.svg') }}" class="bg-button rounded-md p-3 " alt="">
                    <h2 class="tracking-wider text-text font-semibold">Continuous Improvement</h2>
                    <p class="tracking-wider text-paragraph">
                        We believe in evolving together. Proprice continually refines its prediction models based on the
                        data uploaded by buyers. This feedback loop enriches our algorithms, enhancing future predictions
                        and ensuring a dynamic, ever-improving system.
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
            @if (Auth::guard('seller')->check() || Auth::guard('buyer')->check() || Auth::guard('agent')->check())
            <a href="/properties" class="text-blue-500 font-semibold underline">view all</a>
            @else
            <a onclick="modalTypeToggle()" type="button" class="text-blue-500 font-semibold underline">view all</a>

            @endif

        </div>
        {{-- property item --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 py-10" id="projectContainer">
            {{-- display 6 propery only --}}
            @forelse ($properties as $property)
                <div class="bg-body border  h-fit rounded opacity-0">

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
                {{-- if walang laman yung request ito yung lalabas --}}
            @empty
                <h1>no propery found...</h1>
            @endforelse

        </div>
    </section>

    {{-- footer makikita moto sa /resources/views/buyer --}}
    <x-buyer.footer />
@endsection
@section('scripts')
    {{-- javascript modal --}}
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
        const featuresContainer = document.querySelector('#featuresContainer');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    console.log(entry.target)
                    // ,' fade-in',' zoom-in ','duration-1000'
                    entry.target.classList.remove('opacity-0')
                    entry.target.classList.add('animate-in')
                    entry.target.classList.add('fade-in')
                    entry.target.classList.add('zoom-in')
                    entry.target.classList.add('delay-500')
                    entry.target.classList.add('duration-1000')

                }
            });
        })

        for (const child of featuresContainer.children) {
            observer.observe(child);
        }

        const projectContainer = document.querySelector('#projectContainer');

        const observerProject = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    console.log(entry.target)
                    // ,' fade-in',' zoom-in ','duration-1000'
                    entry.target.classList.remove('opacity-0')
                    entry.target.classList.add('animate-in')
                    entry.target.classList.add('fade-in')
                    entry.target.classList.add('zoom-in')
                    entry.target.classList.add('delay-500')
                    entry.target.classList.add('duration-1000')

                }
            });
        })
        for (const child of projectContainer.children) {
            observerProject.observe(child);
        }
    </script>
@endsection
