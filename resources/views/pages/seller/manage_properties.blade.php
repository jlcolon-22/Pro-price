@extends('layouts.app')

@section('title', 'Manage Properties')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10">

        <div class="pb-2">
            <a href="{{ route('seller_add_property') }}" class="px-5 text-text bg-button py-3 ">Add Properties</a>
        </div>
        <x-alert />
        {{-- property item --}}
        <div class="grid grid-cols-3 gap-10 py-10">

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
                    <p class="px-3 flex gap-x-2 text-paragraph">
                        <img src="{{ asset('icons/location_pin_black_24dp.svg') }}" class="w-[1rem]" alt="">
                        {{ $property->address }}
                    </p>
                    <div class="flex items-center justify-end px-3 gap-x-2 pb-3">
                        {{-- href="{{ route('seller_delete_property', ['id' => $property->id]) }}" --}}
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
            @endforelse



        </div>
        <div>
            {{ $properties->links() }}
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        $(document).ready(function() {

            $.fn.deleteProperty = function(id = 0) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result , ids = id) => {

                    var x = `/seller/property/delete/${ids}`;
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url:x,
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


        });
    </script>
@endsection
