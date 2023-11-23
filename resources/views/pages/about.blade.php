@extends('layouts.app')

@section('title', 'About Us')



@section('content')
    {{-- header --}}
    <x-buyer.header />
    <section class="container mx-auto py-10">
        <div class="p-4 min-h-screen">
            <div class="max-w-7xl mx-auto h-max px-6 md:px-12 xl:px-6">
                <div class="md:w-2/3 lg:w-1/2">


                    <h2 class="my-8 text-2xl font-bold text-text md:text-4xl">About Pro-Price</h2>
                    <p class="text-text"> Your Ideal Real Estate Companion</p>
                </div>

            </div>
        </div>
        <div id="map" style="height: 400px;"></div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>

    <script>
        const address = '1600 Amphitheatre Parkway, Mountain View, CA';
        const latitude = 14.548150402798472;
        const longitude = 121.11220967093111;

        // Initialize the map
        const map = L.map('map').setView([latitude, longitude], 13);

        // Add a tile layer to the map (you can choose a different tile provider)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        map.on('click', function(e) {
            const latitude = e.latlng.lat;
            const longitude = e.latlng.lng;
            const reverseGeocodeUrl =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
            fetch(reverseGeocodeUrl)
                .then(response => response.json())
                .then(data => {
                    // Extract and display the address
                    const address = data.display_name;
                    console.log(address)
                })
                .catch(error => console.error('Error fetching reverse geocoding data:', error));

            marker.setLatLng([latitude, longitude]);

            // Update the popup content if needed
            marker.getPopup().setContent("<b>Pin Location</b>").update();

            // Open the popup
            marker.openPopup();
        })
        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup("<b>Location Rizal</b>").openPopup();
    </script>
@endsection
