@extends('layouts.app')

@section('title', 'Admin Seller Account')



@section('content')
    <section class="bg-secondary flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">



            <div class="relative overflow-x-auto  sm:rounded-lg">
                <h1 class="font-serif font-semibold py-4">-- BUYER ACCOUNT</h1>
                {{-- alert section --}}
                <div class="py-2">
                    <x-alert />
                </div>

                {{-- agent account table --}}
                <table class="w-full text-sm text-left shadow-md rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email Verified
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buyers as $buyer)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $buyer->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $buyer->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $buyer->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $buyer->phone_number }}
                                </td>
                                <td class="px-6 py-4">
                                    @if (!!$buyer->email_verified_at)
                                    <span class="text-green-500 font-bold">YES</span>
                                    @else
                                    <span class="text-red-500 font-bold">NO</span>
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

            {{-- pagination link --}}
           <div class="py-10">
            {{ $buyers->links() }}
           </div>

        </main>
    </section>

    {{-- view lincese modal --}}
    <div id="modal" class="hidden top-0 left-0 overflow-y-auto  w-full min-h-[100svh] bg-black/40 p-10">
        <div class="relative oveflow-y-auto max-h-[500px]">
            <img src="{{ asset('icons/x.svg') }}" onclick="closeModal()"
                class="absolute top-4 right-4 bg-gray-100 rounded-full" alt="">
            <img id="viewImageID" src="{{ asset('assets/r-architecture-JvQ0Q5IkeMM-unsplash.jpg') }}"
                class="w-[80%] mx-auto" alt="">

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // lincense modal view function
        function viewLicense(e) {
            const modal = document.querySelector("#modal");

            const img = document.querySelector("#viewImageID");
            img.src = e.dataset.url;

            modal.classList.toggle('hidden');
            modal.classList.toggle('fixed');

        }
        // lincense modal close function
        function closeModal() {
            modal.classList.toggle('hidden');
            modal.classList.toggle('fixed');
        }
    </script>
@endsection
