@extends('layouts.app')
@section('title', 'View')
@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 min-h-[calc(100svh-80px)]">
         <x-alert/>
        {{-- property image --}}
        <div class=" flex justify-between gap-x-2">
            <img id="mainImage" src="{{ asset($property?->photos[0]->photo) }}"
                class=" object-cover max-h-[40rem]  w-full overflow-hidden" loading="lazy" alt="">
                {{-- h-[33rem] --}}
            <div class="grid h-fit gap-y-2 max-h-[33rem] max-w-[11rem]">
                @foreach ($property?->photos as $photo)
                    @if ($loop->first)
                        <img onclick="changeImage(this)" src="{{ asset($photo->photo) }}"
                            class="itemImage cursor-pointer object-cover h-[6rem] border-4 border-button w-full  overflow-hidden"
                            loading="lazy" alt="">
                    @else
                        <img onclick="changeImage(this)" src="{{ asset($photo->photo) }}"
                            class="itemImage cursor-pointer object-cover h-[6rem]  w-full  overflow-hidden" loading="lazy"
                            alt="">
                    @endif
                @endforeach
            </div>

        </div>

        <div class="flex">
            {{-- details --}}
            <div class="w-full">
                <div class="flex justify-between py-2">
                    <div>
                        <h1 class=" text-text tracking-wider font-semibold uppercase font-serif text-3xl">
                            {{ $property->title }}</h1>
                        <p class="text-2xl text-paragraph font-serif ">
                            ₱ {{ number_format($property->price) }}
                        </p>
                    </div>
                    <div class="flex items-center gap-x-2">




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
            {{-- agent --}}
            <div class="w-[27rem] px-2 pt-4">
                <div class="border bg-body py-10 flex flex-col items-center ">
                    @if ($type == 'seller')
                        @if (!!$property->agentInfo->profile)
                            <img src="{{ asset($property->agentInfo->profile) }}"
                                class="h-[7rem] w-[7rem] rounded-full object-cover" alt="">
                        @else
                            <img src="https://ui-avatars.com/api/?background=random&name={{ $property->agentInfo->name }}"
                                class="h-[7rem] w-[7rem] rounded-full object-cover" alt="">
                        @endif
                    @else
                        @if (!!$property->agentInfo->profile)
                            <img src="{{ asset($property->agentInfo->profile) }}"
                                class="h-[7rem] w-[7rem] rounded-full object-cover" alt="">
                        @else
                            <img src="https://ui-avatars.com/api/?background=random&name={{ $property->agentInfo->name }}"
                                class="h-[7rem] w-[7rem] rounded-full object-cover" alt="">
                        @endif
                    @endif
                    <p class="text-paragraph pt-2 font-serif">
                        {{ $type == 'seller' ? $property->agentInfo->name : $property->agentInfo->name }}</p>
                    <div class="flex items-center space-x-1 pt-1">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                        <img src="{{ asset('icons/star.svg') }}" class="w-[1.3rem]" alt="">
                    </div>
                    <div class="flex items-center space-x-3 pt-3">
                        {{-- @if ($type == 'seller') --}}
                        {{-- href="{{ route('contact_seller_property', ['id' => $property->id]) }}" --}}
                           @if ($appointment)
                           <a type="button" onclick="alert('You have already submitted an appointment for this. Just check your appointment page for the status of your appointment request.')"
                           class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button hover:bg-yellow-500 {{ $appointment ? 'select-none cursor-not-allowed opacity-50' : '' }}"  >
                           <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt="">
                           Appointment
                       </a>
                           @else
                           <a type="button" onclick="toggleAppointment()"
                           class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button hover:bg-yellow-500 "  >
                           <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt="">
                           Appointment
                       </a>
                           @endif
                        {{-- @else
                            <a href=""
                                class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button hover:bg-yellow-500">
                                <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt="">
                                Message
                            </a>

                            <a href=""
                                class="text-text flex gap-x-2 text-sm px-3 py-2 bg-button  hover:bg-yellow-500">
                                <img src="{{ asset('icons/phone.svg') }}" class="w-[1rem]" alt="">
                                Call
                            </a>
                        @endif --}}
                    </div>

                </div>
            </div>

        </div>

        {{-- appointment modal --}}
        <div id="appointment" class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
                {{-- apppointment form --}}
                <form action="{{ route('buyer_add_ppointment',['property'=> $property->id, 'agent' => $property->agentInfo->id]) }}" class=" bg-white w-[30rem] relative" method="POST">
                    @csrf
                    <h1 class="px-2 py-3 shadow text-lg uppercase">Appointment</h1>
                    <div class="px-2 py-2 grid grid-cols-3 items-center">
                        <label for="">Date:</label>
                        <input type="date" name="date" required class="px-2 py-3 bg-gray-100 w-full col-span-2" placeholder="Date">
                    </div>
                    <div class="px-2 py-2 grid grid-cols-3 items-center">
                        <label for="">Time:</label>
                        <input type="time" name="time" required class="px-2 py-3 bg-gray-100 w-full col-span-2" placeholder="Date">
                    </div>
                    <div class="px-2 py-2 grid grid-cols-3 items-start">
                        <label for="">Purpose:</label>
                        <textarea name="purpose" class="px-2 py-3 bg-gray-100 w-full col-span-2" required placeholder="Message..." rows="2"></textarea>
                    </div>
                    <div class="px-2 py-2  items-start">
                        <button class="px-2 py-3 bg-blue-500 text-white w-full ">Submit</button>
                    </div>
                    <img onclick="toggleAppointment()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3" alt="">
                </form>
        </div>
    </section>

    {{-- footer --}}
    <x-buyer.footer />
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


        const appointment = document.querySelector('#appointment');

        function toggleAppointment()
        {
            appointment.classList.toggle('hidden')
            appointment.classList.toggle('flex')
        }
    </script>
    {{-- <script>
        const address = 'Santa Francesca, Spring Valley Ⅳ, Cupang, Antipolo, Rizal, Calabarzon, 1870, Philippines';

        // Initialize the map
        const map = L.map('map').setView([0, 0], 20);

        // Add a tile layer to the map (you can choose a different tile provider)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Use Nominatim to convert the address to coordinates
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
          .then(response => response.json())
          .then(data => {
            const location = data[0];
            const { lat, lon } = location;

            // Add a marker to the map
            L.marker([lat, lon]).addTo(map)
              .bindPopup(`<b>${address}</b>`).openPopup();

            // Pan the map to the marker's location
            map.panTo([lat, lon]);
          })
          .catch(error => console.error('Error:', error));
      </script> --}}
@endsection
