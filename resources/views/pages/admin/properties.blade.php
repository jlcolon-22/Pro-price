@extends('layouts.app')

@section('title', 'Admin Properties')



@section('content')
    <section class="bg-secondary flex min-h-screen relative">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">
            <h1 class="py-10">-- Properties</h1>

            <div class="py-2">
                {{-- alert section --}}
                <x-alert />
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">



                {{-- properties table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seller
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Agent
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $property)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $property->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $property->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $property->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $property->address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $property->sellerInfo->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($property->agentInfo?->name)
                                        {{ $property->agentInfo?->name }}
                                    @else
                                        <button type="button" onclick="$.fn.showAgent({{ $property->id }})"
                                            class=" text-blue-500 whitespace-nowrap flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather fill-blue-500 w-[1rem] feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            <span>Assign</span>
                                        </button>
                                    @endif

                                </td>
                                <td class="px-6 py-4">
                                    @if ($property->status == 0)
                                        <span
                                            class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                                    @elseif ($property->status == 1)
                                        <span
                                            class="px-2 py-2 bg-green-300 text-green-700 rounded-md text-xs">Approved</span>
                                    @elseif ($property->status == 2)
                                        <span class="px-2 py-2 bg-red-300 text-red-700 rounded-md text-xs">Declined</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin_property_view', ['id' => $property->id]) }}"
                                        class="font-medium text-blue-600 0 hover:underline">View</a>
                                    @if ($property->status != 1)
                                        <a href="{{ route('admin_property_approve', ['id' => $property->id]) }}"
                                            class="font-medium text-green-600 0 hover:underline">Aprove</a>
                                    @endif
                                    @if ($property->status != 2)
                                        <a href="{{ route('admin_property_decline', ['id' => $property->id]) }}"
                                            class="font-medium text-red-600 0 hover:underline">Decline</a>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td class="p-2">
                                    No Seller Found...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

         <div class="py-2">
            {{ $properties->links() }}
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
