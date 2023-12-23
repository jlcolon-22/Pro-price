@extends('layouts.app')

@section('title', 'Admin Homepage')



@section('content')
    <section class="bg-secondary flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside/>

        {{-- main content --}}
        <main class="max-w-[calc(100svw-18rem)] ">
            <div class="grid grid-cols-3 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">
                <a href="{{ route('admin_buyer_account') }}"
                   class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Buyer</h3>
                        <p class="text-3xl">{{ number_format($buyerCount) }}</p>
                    </div>
                </a>
                <a href="{{ route('admin_agent_account') }}"
                   class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Agent</h3>
                        <p class="text-3xl">{{ number_format($agentCount) }}</p>
                    </div>
                </a>
                <a href="{{ route('admin_seller_account') }}"
                   class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Seller</h3>
                        <p class="text-3xl">{{ number_format($sellerCount) }}</p>
                    </div>
                </a>

                <a href="{{ route('admin_properties') }}"
                   class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Property</h3>
                        <p class="text-3xl">{{ number_format($propertyCount) }}</p>
                    </div>
                </a>
            </div>

            <div class="mt-10 p-8">

                <div class="min-h-[30rem] max-h-[30rem] max-w-[100%] bg-white px-2 py-5 ">
                    <h1 class="text-2xl font-bold text-center ">SALES REPORT</h1>
                    <canvas id="myChart" class="mt-10"></canvas>
                </div>
            </div>
        </main>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var myData = {!! json_encode($reports) !!};

        var labelsData = [];
        var dataPrice = [];
        for (const [key, value] of Object.entries(myData)) {
            console.log(`${key}: ${value.length}`);
            labelsData.push(key)
            dataPrice.push(value.length)
        }

        var data = {
            labels:
            labelsData

            ,
            datasets: [{
                label: 'SALES',
                data: dataPrice,
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
            type: 'line', // You can use any initial type here
            data: data,
            options: options
        });
    </script>

@endsection
