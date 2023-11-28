@extends('layouts.app')

@section('title', 'Predict')



@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 px-3 md:px-0">
        <div class="sm:flex items-start max-w-screen-xl">
            {{-- image --}}
            <div class="sm:w-1/2 ">
                <div class="image object-center text-center">
                    <img src="{{ asset($property->photo->photo) }}">
                </div>

            </div>
            {{-- content --}}
            <div class="sm:w-1/2 p-5">
                <h1 class="text-center text-2xl p-3">Price Prediction Detailed</h1>
                <div style="max-height: 900px">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="grid grid-cols-3 mt-5 ">
                    <div class=" border">
                        <h2 class="bg-gray-300 w-full text-center py-3 uppercase">Current Price</h2>
                        <p class="px-2 py-5 text-text text-center">
                            ₱{{ number_format($property->price )}}
                        </p>
                    </div>
                    <div class=" border">
                        <h2 class="bg-gray-300 w-full text-center py-3 uppercase">PREDICTED Price</h2>
                        <p class="px-2 py-5 text-text text-center">
                            ₱{{ number_format(end($future_predictions)['prediction'] )}}
                        </p>
                    </div>
                    <div class=" border">
                        <h2 class="bg-gray-300 w-full text-center py-3 uppercase">Percentage Change</h2>
                        <p class="px-2 py-5 text-text text-center">
                            {{ round($changePercent,2) }}%
                        </p>
                    </div>
                </div>
                @if ($property->area_situation == 'flood_prone_area')
                    <p class="px-3 mt-10  text-paragraph">
                        The impact on the house price is due to its vulnerability to flooding. This makes it a crucial factor in determining the cost of the property.
                    </p>
                @elseif ($property->area_situation == 'earthquake')
                <p class="px-3 mt-10  text-paragraph">
                    The property's pricing is substantially affected by its location, strategically distant from flood and landslide-prone areas. This geographic advantage is a key factor considered by buyers and contributes to the overall value of the house. It reflects the emphasis on safety and resilience, making it an appealing investment.
                </p>
                @else
                    <p class="px-3 mt-10 text-paragraph">
                        The house's pricing is notably influenced by its vulnerability to landslides, making it a critical factor in determining the property's overall cost. The potential risk of landslides adds complexity to the valuation process, with safety considerations playing a pivotal role in prospective buyers' decisions. As a result, this vulnerability significantly shapes the perceived value and marketability of the property."
                    </p>
                @endif
            </div>
        </div>


        {{-- <div id="label"  data-my-var="{!! $future_predictions !!}"></div> --}}
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

var myData = {!! json_encode($future_predictions) !!};
var propertyPrice = {!! json_encode($property->price) !!};
    const dataLabel = [2023];
    const datas = [propertyPrice];
    myData.forEach(element => {
                   console.log( element.year)
                   dataLabel.push( element.year)
                   datas.push( element.prediction)
            });

        // Your JavaScript code will go here
        var data = {
            labels:
                dataLabel

            ,
            datasets: [{
                    label: 'Example',
                    data: datas,
                    //   borderColor: 'blue',
                    //   backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    fill: false,
                    type: 'line' // Set the type to line
                },

            ]
        };

        // Chart configuration
        var options = {
            plugins: {
                legend: {
                    display: false
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'category',
                    labels: data.labels,

                },

            }
        };

        // Create the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // You can use any initial type here
            data: data,
            options: options
        });
    </script>
@endsection
