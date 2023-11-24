@extends('layouts.app')

@section('title', 'My Appointment')

@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-11em)] px-3 md:px-0">
        {{-- filter button --}}
        <h1 class="text-text font-serif font-bold">-- APPOINTMENTS</h1>
        {{-- alert section --}}
        <x-alert />
          {{-- appointment table --}}
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-10">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Purpose
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Agent
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Property
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Details of appointment
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>



                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $appointment->date }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $appointment->time }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->purpose }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($appointment->status == 0)
                                <span class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                            @elseif ($appointment->status == 1)
                                <span class="px-2 py-2 bg-green-300 text-green-700 rounded-md text-xs">Approved</span>
                            @elseif ($appointment->status == 2)
                                <span class="px-2 py-2 bg-red-300 text-red-700 rounded-md text-xs">Declined</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->agentInfo?->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/property/view/{{ $appointment->propertyDetails->id }}"
                                class="underline text-blue-600"> {{ $appointment->propertyDetails?->title }}</a>
                        </td>
                        <td class="px-6 py-4">
                            <pre class="block text-left">{!! $appointment->details !!}</pre>
                        </td>
                        <td class="px-6 py-4 ">

                            <div>
                                <button onclick="toggleDetailsModal(0,{{ $appointment->id }})"
                                    class="px-4 py-2 bg-green-500 text-white">Approve.</button>
                                <button onclick="toggleDetailsModal(1,{{ $appointment->id }})"
                                    class="px-4 py-2 bg-red-500 text-white">Decline.</button>
                            </div>

                        </td>

                    </tr>
                @empty
                @endforelse



            </tbody>
        </table>
        {{-- appointment pagination --}}
        <div class="py-2">
            {{ $appointments->links() }}
        </div>


        <div id="detailsModal"
            class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
            {{-- apppointment form --}}
        </div>
    </section>

    {{-- footer --}}
    <x-buyer.footer />
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script>
        const filterForm = document.querySelector('#filterForm');

        function showFIlter() {
            filterForm.classList.toggle('hidden');
        }
        const detailsModal = document.querySelector('#detailsModal');

        function toggleDetailsModal(type, id) {
            if (type == 0) {
                detailsModal.innerHTML = `<form  action="/agent/appointment/approve/${id}" class=" bg-white w-[30rem] relative" method="POST">
                @csrf
                <h1 class="px-2 py-3 shadow text-lg uppercase">Appointment</h1>

                <div class="px-2 py-2 grid grid-cols-3 items-start">
                    <label for="">Details:</label>
                    <textarea name="details" class="px-2 py-3 bg-gray-100 w-full col-span-2" required placeholder="Details..." rows="3" cols="1"></textarea>
                </div>
                <div class="px-2 py-2  items-start">
                    <button class="px-2 py-3 bg-green-500 text-white w-full ">Approve</button>
                </div>
                <img onclick="closeDetailsModal()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3" alt="">
            </form>`;
                detailsModal.classList.toggle('hidden')
                detailsModal.classList.toggle('flex')
            } else {
                detailsModal.innerHTML = `<form action="/agent/appointment/decline/${id}" class=" bg-white w-[30rem] relative" method="POST">
                @csrf
                <h1 class="px-2 py-3 shadow text-lg uppercase">Appointment</h1>

                <div class="px-2 py-2 grid grid-cols-3 items-start">
                    <label for="">Details:</label>
                    <textarea name="details" class="px-2 py-3 bg-gray-100 w-full col-span-2" required placeholder="Details..." rows="3"></textarea>
                </div>
                <div class="px-2 py-2  items-start">
                    <button class="px-2 py-3 bg-red-500 text-white w-full ">Decline</button>
                </div>
                <img onclick="closeDetailsModal()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3" alt="">
            </form>`;
                detailsModal.classList.toggle('hidden')
                detailsModal.classList.toggle('flex')
            }
        }

        function closeDetailsModal() {
            detailsModal.classList.toggle('hidden')
            detailsModal.classList.toggle('flex')
        }
    </script>
@endsection
