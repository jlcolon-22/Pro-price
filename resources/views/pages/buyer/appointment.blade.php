@extends('layouts.app')

@section('title', 'My Appointment')

@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-11em)] px-3 md:px-0">
        {{-- filter button --}}
        <h1 class="text-text font-serif font-bold">-- APPOINTMENTS</h1>
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



                </tr>
            </thead>
            <tbody>
                {{-- fetch all property with pagination --}}
                @forelse ($appointments as $appointment)
                      <tr class="bg-white border-b ">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
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
                       <a href="/property/view/{{ $appointment->propertyDetails->id }}" class="underline text-blue-600"> {{ $appointment->propertyDetails?->title }}</a>
                    </td>
                    <td class="px-6 py-4 ">
                        @if (!!$appointment->details)
                        <pre class="block text-left">{!! $appointment->details !!}</pre>

                        @else
                        <p class="text-gray-400">The details section will show once the appointment request is approved.
                        </p>
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
        {{-- pagination link --}}
        <div class="py-2">
            {{ $appointments->links() }}
        </div>
    </section>

    {{-- footer --}}
    <x-buyer.footer/>
@endsection

@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
<script>
    const filterForm = document.querySelector('#filterForm');
    function showFIlter(){
        filterForm.classList.toggle('hidden');
    }
</script>
@endsection
