@extends('layouts.app')

@section('title', 'Manage Properties')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    @if (Auth::guard('seller')->user()->status == 0)
        <section class="px-10 py-10">
            <div class="bg-body border shadow flex items-center gap-x-3 py-4 px-4 text-paragraph">
                <img src="{{ asset('icons/warning_black_24dp.svg') }}" class="
        p-1 bg-yellow-200 rounded-full"
                    alt="">
                <h3> Your account has not been approved yet. That's why you can't use this feature for now.</h3>
            </div>
        </section>
    @elseif (Auth::guard('seller')->user()->status == 2)
        <section class="px-10 py-10">
            <div class="bg-body border shadow flex items-center gap-x-3 py-4 px-4 text-paragraph">
                <img src="{{ asset('icons/error_black_24dp.svg') }}" class="
        p-1 bg-red-200 rounded-full"
                    alt="">
                <h3>Your account was declined because it did not meet the necessary requirements</h3>
            </div>

        </section>
    @else
        <section class="container mx-auto py-10 px-3 md:px-0">

            <div class="pb-2 flex justify-between">
                <a href="{{ route('seller_add_property') }}" class="px-5 text-text bg-button py-2 ">Add Properties</a>

                <form action="" id="sortForm" method="GET" class="flex items-center gap-x-2">
                    <h1 class="text-base text-gray-500 whitespace-nowrap">
                        Sort By:

                    </h1>
                    <select id="sortSelect" name="sortby"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2">
                        <option value="">All</option>

                        <option value="pending" {{ app('request')->input('sortby') == 'pending' ? 'selected' : '' }}>pending
                        </option>
                        <option value="approved" {{ app('request')->input('sortby') == 'approved' ? 'selected' : '' }}>
                            approved</option>
                        <option value="sold" {{ app('request')->input('sortby') == 'sold' ? 'selected' : '' }}>sold
                        </option>

                    </select>
                </form>

            </div>
            {{-- alert section --}}
            <x-alert />
            {{-- property item --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 py-10">
                {{-- fetch all seller propery with pagination --}}
                @forelse ($properties as $property)
                    <div class="bg-body border  h-fit rounded relative">
                        @if (!!$property->boosted)
                            <h1
                                class="bg-cyan-400 px-2 py-1 text-white absolute top-0 left-0 transform -rotate-45 -translate-x-4 text-sm">
                                Boosted</h1>
                        @endif
                        @if ($property->closed_date && $property->status == 1)
                            <h1 class="bg-violet-500 px-2 py-1 text-white absolute top-0 right-0 text-sm">Waiting for approval</h1>
                        @elseif($property->status == 0)
                            <h1 class="bg-violet-500 px-2 py-1 text-white absolute top-0 right-0 text-sm">Processing</h1>
                        @elseif ($property->status == 1)
                            <h1 class="bg-green-500 px-2 py-1 text-white absolute top-0 right-0 text-sm">Approved</h1>
                        @elseif ($property->status == 2)
                            <h1 class="bg-red-500 px-2 py-1 text-white absolute top-0 right-0 text-sm">Declined</h1>
                        @elseif ($property->status == 3)
                            <h1 class="bg-yellow-400 px-2 py-1 text-white absolute top-0 right-0 text-sm">Sold</h1>
                        @endif
                        <div class="p-3">

                            <img src="{{ asset($property->photo?->photo) }}" loading="lazy" class="h-64 w-full object-cover"
                                alt="">
                        </div>
                        <h1 class="px-3 text-text tracking-wider font-semibold uppercase ">{{ $property->title }}</h1>
                        <p class="px-3 flex gap-x-2 text-paragraph pt-2">
                            <img src="{{ asset('icons/local_offer_black_24dp.svg') }}" class="w-[1rem]" alt="">
                            ₱{{ number_format($property->price) }}
                        </p>
                        <p class="px-3 flex items-start gap-x-2 text-paragraph line-clamp-2">
                            <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                            <span class="line-clamp-2">{{ $property->address }}</span>
                        </p>
                        <div class="flex items-center justify-end px-3 gap-x-2 pb-3 relative mt-2">

                            @if ($property->appointments)
                                @foreach ($property->appointments as $appointment)
                                    @if ($appointment?->reports->isEmpty() != 1)

                                        @if ($appointment?->reports[8]?->status == true)
                                            @if ($property->status == 3)
                                                <a id="sold" data-appointment="{{ $property }}"
                                                    class="bg-green-500 text-white border border-green-400 rounded px-4 py-2 font-medium hover:bg-green-500 hover:text-white transition-all ease-in-out cursor-pointer soldDetails">
                                                    Sold Details
                                                </a>
                                            @else
                                                <a id="sold" data-appointment="{{ $property }}"
                                                    class="bg-green-500 text-white border border-green-400 rounded px-4 py-2 font-medium hover:bg-green-500 hover:text-white transition-all ease-in-out cursor-pointer sold">
                                                    Sold
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                    {{ $appointment?->reports }}
                                    @endif

                                @endforeach
                            @endif
                            @if ($property->boosted == null)
                                <a id="boostBtn" data-ids="{{ $property->id }}"
                                    class="bg-transparent border border-blue-400 cursor-pointer rounded px-4 py-2 text-blue-600 font-medium hover:bg-blue-500 hover:text-white transition-all ease-in-out boostBtn">
                                    Boost
                                </a>
                            @endif
                            <a onclick="$.fn.deleteProperty({{ $property->id }})" data-ids="dsadad"
                                class="bg-transparent border border-red-400 rounded px-4 py-2 text-red-600 font-medium hover:bg-red-500 hover:text-white transition-all ease-in-out">
                                Delete
                            </a>
                            <a href="{{ route('seller_edit_property', ['id' => $property->id]) }}"
                                class="bg-transparent border border-green-400 rounded px-4 py-2  text-green-600 font-medium hover:bg-green-500 hover:text-white transition-all ease-in-out">
                                Edit
                            </a>
                        </div>
                    </div>
                @empty
                    <h1>no property found ...</h1>
                @endforelse



            </div>
            <div class="py-2">
                {{ $properties->links('pagination::tailwind') }}
            </div>
        </section>
    @endif
    {{-- popup Sold Property Report --}}
    <div id="reportContainer"
        class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center px-2 md:px-0  bg-black/40">
        <div class=" bg-white w-[40rem] relative">
            <h1 class="px-2 py-3 shadow text-lg">Update Status</h1>
            <form id="formSold" action="" method="post" class="py-5 px-3 " id="reports">
                @csrf
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Property Name</h1>
                    <h1 class="border p-2" id="propertyName">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Price</h1>
                    <h1 class="border p-2" id="price">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Buyer</h1>
                    <h1 class="border p-2" id="buyer">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Agent</h1>
                    <h1 class="border p-2" id="agent">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Closed Date<span class="text-red-600 opacity-100">*</span></h1>
                    <div class="p-2 border">
                        <input type="date" name="date" class="border p-2 bg-gray-100 w-full"
                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="flex justify-end gap-x-2 mt-3">
                    <button type="submit"
                        class="bg-green-500 text-white border border-green-400 rounded px-4 py-2 font-medium hover:bg-green-500 hover:text-white transition-all ease-in-out cursor-pointer">
                        Sold
                    </button>
                    <a onclick="$.fn.closeSoldModal()" type="button"
                        class="bg-red-500 text-white border border-red-400  rounded px-4 py-2 font-medium hover:bg-red-500 hover:text-white transition-all ease-in-out cursor-pointer">
                        Cancel
                    </a>
                </div>
            </form>

            <img onclick="$.fn.closeSoldModal()" type="button" src="{{ asset('icons/x.svg') }}"
                class="absolute top-4 right-3 cursor-pointer" alt="">
        </div>
    </div>
    {{-- popup Sold Property Report --}}
    <div id="soldDetailsContainer"
        class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center px-2 md:px-0 bg-black/40">
        <div class=" bg-white w-[40rem] relative">
            <h1 class="px-2 py-3 shadow text-lg">Sold Details</h1>
            <form id="formSold" action="" method="post" class="py-5 px-3 " id="reports">
                @csrf
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Property Name</h1>
                    <h1 class="border p-2" id="propertyNameDetails">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Price</h1>
                    <h1 class="border p-2" id="priceDetails">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Buyer</h1>
                    <h1 class="border p-2" id="buyerDetails">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Agent</h1>
                    <h1 class="border p-2" id="agentDetails">Property</h1>
                </div>
                <div class="grid grid-cols-2">
                    <h1 class="border p-2 opacity-60">Closed Date<span class="text-red-600 opacity-100">*</span></h1>
                    <div class="p-2 border" id="dateDetails">
                        2024-12-2
                    </div>
                </div>
                <div class="flex justify-end gap-x-2 mt-3">

                    <a onclick="$.fn.closeSoldDetailsModal()" type="button"
                        class="bg-red-500 text-white border border-red-400  rounded px-4 py-2 font-medium hover:bg-red-500 hover:text-white transition-all ease-in-out cursor-pointer">
                        Close
                    </a>
                </div>
            </form>

            <img  onclick="$.fn.closeSoldDetailsModal()" type="button" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3 cursor-pointer"
                alt="">
        </div>
    </div>
    {{-- boosting Modal --}}
    <div id="boostContainer"
        class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">


        <form id="boostForm" action="" method="POST"
            class="relative py-6 md:mr-8 px-8 rounded-lg bg-gray-100 w-full md:w-5/12 mt-6 md:mb-0">
            @csrf
            <img onclick="$.fn.closeBoostModal()" src="{{ asset('icons/x.svg') }}"
                class="absolute top-4 right-3 cursor-pointer" alt="">
            <div class="flex justify-between">
                <div class="w-full">
                    <div class="text-blue-900 text-lg font-medium mb-2">Lifetime</div>
                    <div class="text-dark-2 text-sm leading-tight">Access forever</div>
                </div>
                <div class="text-dark-1 text-4xl leading-none text-right">
                    ₱699<span class="ml-1 text-dark-2 text-base">/once</span></div>
            </div>
            <div class="border-b border-light-2 w-full mt-6 mb-8"></div>
            <ul class="mb-10">
                <li class="flex items-center gap-1 text-blue-900 text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" viewBox="0 0 24 24">
                        <path
                            d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5.676,8.237-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,1,1,1.414-1.414l2.323,2.323,5.294-4.853a1,1,0,1,1,1.352,1.474Z" />
                    </svg>
                    <span>You only need to pay once. Your property will be boosted for a lifetime.
                    </span>
                </li>
                <li class="flex items-center gap-1 text-blue-900 text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" viewBox="0 0 24 24">
                        <path
                            d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5.676,8.237-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,1,1,1.414-1.414l2.323,2.323,5.294-4.853a1,1,0,1,1,1.352,1.474Z" />
                    </svg>
                    <span>Your property is guaranteed to be the buyer's first choice.
                    </span>
                </li>
            </ul>
            <button
                class="inline-flex items-center justify-center bg-blue-400 text-white h-10 px-5 rounded-lg text-sm font-medium leading-none transition-all duration-200 whitespace-nowrap disabled:opacity-50 disabled:cursor-default hover:bg-blue-4 w-full"
                type="submit">
                <span>Get started</span>
            </button>
        </form>



    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        $(document).ready(function() {

            // delete function
            $.fn.deleteProperty = function(id = 0) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result, ids = id) => {

                    var x = `/seller/property/delete/${ids}`;
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url: x,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            }
                        })



                    }
                });
            }

            // show sold modal
            $('.sold').on('click', function() {
                var data = $(this).data('appointment');

                $('#propertyName').text(data.title)
                $('#buyer').text(data.appointments[0]?.buyer_info.name)
                $('#agent').text(data.agent_info.name)
                $('#price').text('₱ ' + data.price.toLocaleString("en-US"))
                $('#formSold').attr('action', '/seller/property/sold/' + data.id);
                $('#reportContainer').removeClass('hidden');
                $('#reportContainer').addClass('flex');
            })
            $('.soldDetails').on('click', function() {
                var data = $(this).data('appointment');

                $('#propertyNameDetails').text(data.title)
                $('#buyerDetails').text(data.appointments[0]?.buyer_info.name)
                $('#agentDetails').text(data.agent_info.name)
                $('#dateDetails').text(data.closed_date)
                $('#priceDetails').text('₱ ' + data.price.toLocaleString("en-US"))
                $('#soldDetailsContainer').removeClass('hidden');
                $('#soldDetailsContainer').addClass('flex');
            })
            $.fn.closeSoldDetailsModal = function() {
                $('#soldDetailsContainer').removeClass('flex');
                $('#soldDetailsContainer').addClass('hidden');
            }
            $.fn.closeSoldModal = function() {
                $('#reportContainer').removeClass('flex');
                $('#reportContainer').addClass('hidden');
            }
            $('#sortSelect').on('change', function() {
                if ($(this).val() != '') {
                    $('#sortForm').submit()
                } else {
                    document.location = '/seller/manage_properties'
                }
            })

            $('.boostBtn').on('click', function() {
                $('#boostForm').attr('action', '/seller/property/boost/' + $(this).data('ids'))
                console.log('click')
                $('#boostContainer').removeClass('hidden');
                $('#boostContainer').addClass('flex');
            })
            $.fn.closeBoostModal = function() {
                $('#boostContainer').removeClass('flex');
                $('#boostContainer').addClass('hidden');
            }
        });
    </script>
@endsection
