@extends('layouts.app')

@section('title', 'Admin Payment')



@section('content')
    <section class="bg-secondary flex min-h-screen relative">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">
            <h1 class="font-serif font-semibold py-4">-- PAYMENTS</h1>

            <div class="py-2">
                {{-- alert section --}}
                <x-alert />
            </div>

{{-- appointment table --}}
<div class="overflow-x-auto w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Property
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Payment Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>



            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{ $payment->property->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $payment->amount }}
                    </td>

                    <td class="px-6 py-4">
                        @if ($payment->status == 0)
                            <span
                                class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                        @elseif ($payment->status == 'paid')
                            <span class="px-2 py-2  text-green-700 rounded-md text-xs">PAID</span>
                        @elseif ($payment->status == 'unpaid')
                            <span class="px-2 py-2  text-red-700 rounded-md text-xs">UNPAID</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $payment->created_at }}
                    </td>


                </tr>
            @empty
                <tr>
                    <td class="p-4"> no payment found</td>
                </tr>
            @endforelse



        </tbody>
    </table>
</div>
{{-- appointment pagination --}}
<div class="py-2">
    {{ $payments->links() }}
</div>

        </main>
    </section>

    {{-- agent modal --}}
    <div id="agentContainer"
        class="fixed top-0 left-0 w-screen h-[100svh]   bg-black/50 hidden justify-center items-center">
        <div class="w-[24rem] bg-body relative">
            <h1 class="px-3 py-4 font-medium shadow">All Agents</h1>
            <div id="container" class="py-3 space-y-4 px-2">
                <div class="flex justify-between px-2">
                    <div class="flex items-center gap-x-2">
                        <img class="w-8 h-8 rounded-full"
                            src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" alt="user photo">
                        <h1 class="text-sm">Hdsda dsa dsada</h1>
                    </div>
                    <button type="button"
                        class=" text-blue-500 whitespace-nowrap flex items-center hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather fill-blue-500 w-[1rem] feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Assign</span>
                    </button>
                </div>
                <div class="flex justify-between px-2">
                    <div class="flex items-center gap-x-2">
                        <img class="w-8 h-8 rounded-full"
                            src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" alt="user photo">
                        <h1 class="text-sm">Hdsda dsa dsada</h1>
                    </div>
                    <button type="button"
                        class=" text-blue-500 whitespace-nowrap flex items-center hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather fill-blue-500 w-[1rem] feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Assign</span>
                    </button>
                </div>

            </div>
            <button onclick=" $.fn.closeAgent()" class="top-4 right-2 absolute cursor-pointer hover:fill-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-x hover:fill-red-400">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.fn.showAgent = function(id) {
                var url = '/admin/property/agents';
                $.ajax({
                    type: 'get',
                    url: url,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#container').empty()


                        data.forEach(element => {
                            $('#container').append(`
                            <div class="flex justify-between px-2">
                    <div class="flex items-center gap-x-2">
                        <img class="w-8 h-8 rounded-full"
                            src="{{ asset('assets/r-architecture-2gDwlIim3Uw-unsplash(1).jpg') }}" alt="user photo">
                        <h1 class="text-sm">${element.name}</h1>
                    </div>
                    <a href="/admin/property/assign/${element.id}/${id}"
                        class=" text-blue-500 whitespace-nowrap flex items-center hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather fill-blue-500 w-[1rem] feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Assign</span>
                    </a>
                </div>
                            `);

                            $('#agentContainer').removeClass('hidden')
                            $('#agentContainer').addClass('flex')

                        });
                    }
                })



            }

            $.fn.closeAgent = function() {
                $('#agentContainer').addClass('hidden')
                $('#agentContainer').removeClass('flex')
            }
        })
    </script>
@endsection












