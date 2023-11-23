@extends('layouts.app')

@section('title', 'About Us')



@section('content')
    {{-- header --}}
    <x-buyer.header />
    <section class="container mx-auto py-10">
        <div class="sm:flex flex-row-reverse items-start max-w-screen-xl">
            <div class="sm:w-1/2 ">
                <div class="image object-center text-center">
                    <img src="{{ asset('assets/pngwing.com(2).png') }}">
                </div>

            </div>
            <div class="sm:w-1/2 p-5">
                <div class="text">
                    <span class="text-gray-500 border-b-2 border-indigo-600 uppercase">About Pro-Price</span>
                    <h2 class="my-4 font-bold text-3xl  sm:text-4xl "> <span class="text-indigo-600"> Your Ideal Real Estate Companion</span>
                    </h2>
                    <p class="text-gray-700">
                        At Pro-Price, we aim to transform your approach to real estate decision-making. Our goal is straightforward: to equip property buyers, sellers, and agents with unparalleled knowledge about house and lot prices, utilizing cutting-edge technology and predictive analytics.
                    </p>
                    <h2 class="my-4 font-bold text-3xl  sm:text-4xl "> <span class="text-indigo-600">What Motivates Us</span>
                    </h2>
                    <p class="text-gray-700">
                        In the constantly evolving real estate landscape, informed decision-making is crucial. We believe that understanding property pricing intricacies shouldn't be uncertain. Transparency, accuracy, and ease of access are our guiding principles in forecasting property prices.
                    </p>
                    <h2 class="my-4 font-bold text-3xl  sm:text-4xl "> <span class="text-indigo-600">Our Pledge</span>
                    </h2>
                    <p class="text-gray-700">
                        We are devoted to delivering dependable, data-backed forecasts that leverage historical trends, market analysis, and advanced algorithms. Our platform is user-friendly, ensuring that both seasoned investors and first-time buyers have easy access to the necessary tools and information.                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="https://npmcdn.com/leaflet-geometryutil"></script>



@endsection
