@extends('layouts.app')

@section('title', 'Admin Seller Account')



@section('content')
    <section class="bg-secondary flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">



            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="py-2">
                    {{-- alert section --}}
                    <x-alert />
                </div>
                {{-- seller table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
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
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                License
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sellers as $seller)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $seller->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $seller->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $seller->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $seller->phone_number }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($seller->status == 0)
                                        <span
                                            class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                                    @elseif ($seller->status == 1)
                                        <span
                                            class="px-2 py-2 bg-green-300 text-green-700 rounded-md text-xs">Approved</span>
                                    @elseif ($seller->status == 2)
                                        <span class="px-2 py-2 bg-red-300 text-red-700 rounded-md text-xs">Declined</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">

                                    <button onclick="viewLicense(this)" data-url="{{ $seller->license }}"
                                        class="underline text-blue-500">
                                        view
                                    </button>
                                    |
                                    <a href="{{ route('admin_license_download', ['id' => $seller->id]) }}"
                                        class="underline text-blue-500">download</a>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    @if ($seller->status != 1)
                                        <a href="{{ route('admin_seller_approve', ['id' => $seller->id]) }}"
                                            class="font-medium text-green-600 0 hover:underline">Aprove</a>
                                    @endif
                                    @if ($seller->status != 2)
                                        <a href="{{ route('admin_seller_decline', ['id' => $seller->id]) }}"
                                            class="font-medium text-red-600 0 hover:underline">Decline</a>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td>
                                    No Seller Found...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

           <div class="py-2">
            {{ $sellers->links() }}
           </div>

        </main>
    </section>

    {{-- license modal --}}
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
        // open license function
        function viewLicense(e) {
            const modal = document.querySelector("#modal");

            const img = document.querySelector("#viewImageID");
            img.src = e.dataset.url;

            modal.classList.toggle('hidden');
            modal.classList.toggle('fixed');

        }
          // close license function
        function closeModal() {
            modal.classList.toggle('hidden');
            modal.classList.toggle('fixed');
        }
    </script>
@endsection
