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

            <div class="pb-2">
                <a href="{{ route('seller_add_property') }}" class="px-5 text-text bg-button py-3 ">Add Properties</a>
            </div>
            {{-- alert section --}}
            <x-alert />
            {{-- property item --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 py-10">
                {{-- fetch all seller propery with pagination --}}
                @forelse ($properties as $property)
                    <div class="bg-body border  h-fit rounded ">
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
                        <div class="flex items-center justify-end px-3 gap-x-2 pb-3 relative">
                            <small class="absolute bottom-2 left-2">status:
                                @if ($property->status == 0)
                                    <span class="px-2 py-2  text-yellow-700 rounded-md text-xs">Processing</span>
                                @elseif ($property->status == 1)
                                    <span class="px-2 py-2  text-green-700 rounded-md text-xs">Approved</span>
                                @elseif ($property->status == 2)
                                    <span class="px-2 py-2  text-red-700 rounded-md text-xs">Declined</span>
                                @elseif ($property->status == 3)
                                    <span class="px-2 py-2  text-green-700 rounded-md text-xs">Sold</span>
                                @endif
                            </small>
                            {{-- href="{{ route('seller_delete_property', ['id' => $property->id]) }}" --}}
                            @if ($property->appointments)
                            @foreach ($property->appointments as $appointment)
                                @if ($appointment?->reports[0]->status == true)

                                <a id="sold" data-appointment="{{ $property }}"
                                class="bg-green-500 text-white border border-green-400 rounded px-4 py-2 font-medium hover:bg-green-500 hover:text-white transition-all ease-in-out cursor-pointer">
                                Sold
                            </a>
                                @endif
                            @endforeach

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
 class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
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
                    <input type="date" name="date" class="border p-2 bg-gray-100 w-full" required>
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

     <img onclick="closeReport()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3 cursor-pointer"
         alt="">
 </div>
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
            $('#sold').on('click',function(){
                var data = $(this).data('appointment');

                $('#propertyName').text(data.title)
                $('#buyer').text(data.appointments[0]?.buyer_info.name)
                $('#agent').text(data.agent_info.name)
                $('#price').text('₱ '+data.price)
                $('#formSold').attr('action','/seller/property/sold/'+data.id);
                $('#reportContainer').removeClass('hidden');
                $('#reportContainer').addClass('flex');
            })
            $.fn.closeSoldModal = function () {
                $('#reportContainer').removeClass('flex');
                $('#reportContainer').addClass('hidden');
              }
        });
    </script>
@endsection
