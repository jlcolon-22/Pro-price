@extends('layouts.app')

@section('title', 'My Appointment')

@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-11em)]  px-3 md:px-0">
        {{-- filter button --}}
        <h1 class="text-text font-serif font-bold">-- APPOINTMENTS</h1>
        {{-- appointment table --}}
        <div class="overflow-x-auto w-full">
            <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 mt-10">
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
                            Reports
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
                    {{-- fetch all property with pagination --}}
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
                                    <span
                                        class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
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
                            <td class="px-6 py-4 space-y-3">
                                {{-- @foreach ($appointment->reports as $report)
                                    @if ($loop->first)
                                        <h1 class="whitespace-nowrap"><span
                                                class="bg-green-500 text-white px-2 py-1 rounded-full ">{{ $loop->iteration }}</span>.
                                            {{ $report->report }}</h1>
                                    @else
                                        <h1 class="whitespace-nowrap"><span
                                                class="bg-gray-300 px-2 py-1 rounded-full ">{{ $loop->iteration }}</span>.
                                            {{ $report->report }}</h1>
                                    @endif
                                @endforeach --}}
                                <button class="text-blue-500 underline font-semibold" onclick="$.fn.showReport({{ $appointment->id }})">reports</button>
                            </td>
                            <td class="px-6 py-4 ">
                                @if (!!$appointment->details)
                                    <pre class="block text-left">{!! $appointment->details !!}</pre>
                                @else
                                    <p class="text-gray-400">The details section will show once the appointment request is
                                        approved.
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-x-3 whitespace-nowrap">
                                @if ($appointment->status == 1)
                                    <a href="sms:{{ $appointment->agentInfo?->phone_number }}"
                                        class="text-button font-medium hover:underline ">
                                        Message Agent
                                    </a>
                                    <span>|</span>
                                    <a href="tel:{{ $appointment->agentInfo?->phone_number }}"
                                        class="text-button font-medium hover:underline">

                                        Call Agent
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No property Found...</td>
                        </tr>
                    @endforelse



                </tbody>
            </table>
        </div>

        {{-- pagination link --}}
        <div class="py-2">
            {{ $appointments->links() }}
        </div>

        {{-- popup reports --}}
        <div id="reportContainer"
            class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
            <div class=" bg-white w-[40rem] relative">
                <h1 class="px-2 py-3 shadow text-lg">Reports</h1>
                <div class="py-5 px-3 space-y-3" id="reports">

                </div>

                <img onclick="closeReport()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3 cursor-pointer"
                    alt="">
            </div>


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
        const reportContainer = document.querySelector('#reportContainer');
        const reports = document.querySelector('#reports');

        function closeReport() {
            reports.innerHTML = ''
            reportContainer.classList.remove('flex');
            reportContainer.classList.add('hidden');
        }
    </script>
    <script>
        $(document).ready(function() {

            $.fn.showReport = function(id) {
                $.ajax({
                    type: "get",
                    url: "/buyer/appointment/report/" + id,
                    success: function(response) {
                        var x = $('#reports');

                        response.forEach((element, index) => {
                            if (element.status) {
                                x.append(`
                            <h1 class="space-x-2"><span class="bg-green-500 text-white px-2 py-1 rounded-full ">${index+1}</span> <span>${element.report}</span></h1>
                            `)
                            } else {
                                x.append(`
                            <h1 class="space-x-2"><span
                                class="bg-gray-300 px-2 py-1 rounded-full ">${index+1}</span> <span>${element.report}</span></h1>
                            `)
                            }
                        });

                    }
                });
                $('#reportContainer').removeClass('hidden');
                $('#reportContainer').addClass('flex');
            }
        });
    </script>
@endsection
