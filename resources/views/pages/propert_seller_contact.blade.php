@extends('layouts.app')

@section('title', 'Contact Seller')
@section('content')
    {{-- header --}}
    <x-buyer.header />

    {{-- main content --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-80px)] grid md:grid-cols-2">
        {{-- left section --}}
        <div>
            <img id="mainImage" src="{{ asset($property?->photo->photo) }}"
                class=" object-cover   h-[33rem] w-full overflow-hidden" loading="lazy" alt="">

            <div class="w-full">
                <div class="flex justify-between py-2">
                    <div>
                        <h1 class=" text-text tracking-wider font-semibold uppercase font-serif text-3xl">
                            {{ $property->title }}</h1>
                        <p class="text-2xl text-paragraph font-serif">
                            ₱ {{ number_format($property->price) }}
                        </p>
                    </div>
                    <div class="flex items-center gap-x-2">

                        @if (Auth::guard('buyer')->check() || Auth::guard('seller')->check())

                            @if (Auth::guard('buyer')->check())
                                @if ($bookmark)
                                    <a href="{{ route('buyer_add_bookmark', ['id' => $property->id]) }}"
                                        class=" border  rounded px-4 py-2 text ">
                                        <img src="{{ asset('icons/bookmark_black_24dp.svg') }}" alt="">
                                    </a>
                                @else
                                    <a href="{{ route('buyer_add_bookmark', ['id' => $property->id]) }}"
                                        class=" border  rounded px-4 py-2 text ">
                                        <img src="{{ asset('icons/bookmark.svg') }}" alt="">
                                    </a>
                                @endif

                            @endif
                        @else
                            <a type="button" onclick="modalLoginToggle()" class=" border  rounded px-4 py-2 text ">
                                <img src="{{ asset('icons/bookmark.svg') }}" alt="">
                            </a>
                        @endif
                        <button
                            class=" border flex gap-2 h-fit whitespace-nowrap items-center rounded px-4 py-2 text-text bg-button  hover:bg-yellow-500  ">
                            See Price Prediction <img src="{{ asset('icons/search.svg') }}" class="min-w-[1.3rem]"
                                alt="">
                        </button>
                    </div>
                </div>
                <hr>
                {{-- description and graph --}}
                <div class="flex py-4">
                    {{-- DESCRIPTION --}}
                    <div class="w-full">
                        <h1 class="text-text font-serif">Description</h1>

                        <div class="text-paragraph px-3 py-6 description font-serif ">

                            {!! $property->description !!}
                        </div>
                    </div>
                    {{-- grap --}}
                    {{-- <div class="w-[20rem]">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>

        {{-- right section --}}
        <div class="px-10">
            <div class=" w-full p-2 ">
                <h1 class="text-text font-semibold text-3xl text-center font-serif">Contact seller for more information</h1>
                <p class="text-center mt-3 w-[75%] mx-auto text-paragraph font-serif">
                    In order to show the seller number , please enter your own phone number, This will help seller follow up
                    your request.
                </p>
                <div class=" flex justify-center mt-10">
                    <div class="relative  ">
                        <input type="text" class="pr-2 pl-9 text py-2 outline-none border-b-2 focus:border-button"
                            placeholder="09101213434">
                        <label for="" class="absolute top-2 left-0">
                            <img src="{{ asset('icons/phone.svg') }}" alt="">
                        </label>
                    </div>
                </div>
                <div class="flex justify-center mt-10">
                    <button class="bg-blue-500  text-body px-4 py-2 flex items-center gap-x-3 hover:bg-blue-600 ">
                        {{-- <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt=""> --}}
                        Send Your Inquiries
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        const mainImage = document.querySelector('#mainImage');
        const itemImage = document.querySelectorAll('.itemImage');

        function changeImage(e) {
            itemImage.forEach(element => {
                element.classList.remove('border-4')
                element.classList.remove('border-button')
            });
            e.classList.add('border-4');
            e.classList.add('border-button');
            mainImage.src = e.src;


        }
    </script>
@endsection
