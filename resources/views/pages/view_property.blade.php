@extends('layouts.app')
@section('title', 'View')
@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 min-h-[calc(100svh-80px)]">
        {{-- property image --}}
        <div class=" flex justify-between gap-x-2">
            <img id="mainImage" src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}"
                class=" object-cover   h-[33rem] w-full overflow-hidden" loading="lazy" alt="">

            <div class="grid max-h-[33rem] max-w-[11rem]">
                <img onclick="changeImage(this)" src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}"
                    class="itemImage cursor-pointer object-cover h-[6rem] border-4 border-button w-full  overflow-hidden" loading="lazy" alt="">
                <img onclick="changeImage(this)" src="{{ asset('assets/r-architecture-JvQ0Q5IkeMM-unsplash.jpg') }}"
                    class="itemImage cursor-pointer object-cover h-[6rem] overflow-hidden w-full" loading="lazy" alt="">
                <img onclick="changeImage(this)" src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}"
                    class="itemImage cursor-pointer object-cover h-[6rem] overflow-hidden w-full" loading="lazy" alt="">
                <img onclick="changeImage(this)" src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}"
                    class="itemImage cursor-pointer object-cover h-[6rem] overflow-hidden w-full" loading="lazy" alt="">
                <img onclick="changeImage(this)" src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}"
                    class="itemImage cursor-pointer object-cover h-[6rem] overflow-hidden w-full" loading="lazy" alt="">
            </div>

        </div>

        <div class="flex">
            {{-- details --}}
            <div class="w-full">
                <div class="flex justify-between py-2">
                    <div>
                        <h1 class=" text-text tracking-wider font-semibold uppercase  text-3xl">House 12313</h1>
                        <p class="text-2xl text-paragraph ">
                            ₱ 21,313
                        </p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <button class=" border  rounded px-4 py-2 text ">
                            <img src="{{ asset('icons/heart.svg') }}" alt="">
                        </button>
                        <button
                            class=" border flex gap-2 items-center rounded px-4 py-2 text-text bg-button  hover:bg-yellow-500  ">
                            See Price Prediction <img src="{{ asset('icons/search.svg') }}" class="w-[1.3rem]"
                                alt="">
                        </button>
                    </div>
                </div>
                <hr>
                {{-- description and graph --}}
                <div class="flex py-4">
                    {{-- DESCRIPTION --}}
                    <div class="w-full">
                        <h1 class="text-text">Description</h1>
                        <p class="text-paragraph px-3 py-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ea sint atque qui
                            accusantium laudantium voluptatem eligendi nihil! Ratione, accusamus.
                        </p>
                    </div>
                    {{-- grap --}}
                    <div class="w-[20rem]">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- agent --}}
            <div class="w-[27rem] px-2 pt-4">
                <div class="border bg-body py-10 flex flex-col items-center ">
                    <img src="{{ asset('assets/r-architecture-JvQ0Q5IkeMM-unsplash.jpg') }}"
                        class="h-[7rem] w-[7rem] rounded-full object-cover" alt="">
                    <p class="text-paragraph">Joshua Garcia</p>
                    <div class="flex items-center space-x-1 pt-1">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                    </div>
                    <div class="flex items-center space-x-3 pt-3">
                        <a href="" class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button hover:bg-yellow-500">
                            <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt="">
                            Message
                        </a>

                        <a href="" class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button  hover:bg-yellow-500">
                            <img src="{{ asset('icons/phone.svg') }}" class="w-[1rem]" alt="">
                            Call
                        </a>
                    </div>

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
        const mainImage = document.querySelector('#mainImage');
        const itemImage = document.querySelectorAll('.itemImage');
        function changeImage(e)
        {
            itemImage.forEach(element => {
                element.classList.remove('border-4')
                element.classList.remove('border-button')
            });
            e.classList.add('border-4');
            e.classList.add('border-button');
           mainImage.src = e.src;


        }














        const labels = [
            '2019',
            '2020',
            '2021',
            '2022',
            '2023',

        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Price Growth ',
                borderColor: 'rgb(0,191,255)',
                borderColor: 'rgb(0,191,255)',
                data: [10, 5, 2, 20, 30],
            }]
        };

        const config = {
            type: 'line',

            legend: {
                display: false,
            },
            data: data,
            options: {

            }
        };

        new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
