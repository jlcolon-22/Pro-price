@extends('layouts.app')

@section('title', 'Admin Sales Report')



@section('content')
    <section class="bg-secondary flex min-h-screen">


        {{-- main content --}}
        <main class="w-full px-10 py-10">


            <div class="relative overflow-x-auto  sm:rounded-lg">
                {{--                <h1 class="font-serif font-semibold py-4">-- Sales Report</h1>--}}
                {{--                --}}{{-- alert section --}}
                {{--                <div class="py-2">--}}
                {{--                    <x-alert/>--}}
                {{--                </div>--}}

                {{--                <form action="" method="get" class="bg-white p-5 w-[18rem]" autocomplete="off">--}}

                {{--                    <h1>Generate Report</h1>--}}
                {{--                    <div class="flex gap-x-10 items-center justify-end mt-3">--}}
                {{--                        <label for="type" class="text-gray-600">Type:</label>--}}
                {{--                        <select id="type" name="type" class="px-4 py-2 min-w-[10rem] rounded" required>--}}
                {{--                            <option value="" selected>Choose...</option>--}}
                {{--                            <option value="Day">Day</option>--}}
                {{--                            <option value="Month">Month</option>--}}
                {{--                            <option value="Year">Year</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                    <div class="flex gap-x-10 items-center justify-end mt-2" id="dateContainer">--}}

                {{--                    </div>--}}
                {{--                    <div class="mt-2">--}}
                {{--                        <button class="px-4 py-2 w-fit rounded bg-button w-full">Generate</button>--}}
                {{--                    </div>--}}

                {{--                </form>--}}
                {{-- agent account table --}}
                @if(!!$reports)
                    @if(request()->get('type') == 'Month')
                        <h1 class="text-2xl py-4 font-bold text-center">Sales Report for the Month
                            of {{\Carbon\Carbon::parse('01-'.request()->get('date'))->format('M Y') }}</h1>
                    @elseif(request()->get('type') == 'Day')
                        <h1 class="text-2xl py-4 font-bold text-center">Sales Report for
                            {{\Carbon\Carbon::parse(request()->get('date'))->format('M d, Y') }}</h1>
                    @elseif(request()->get('type') == 'Year')
                        <h1 class="text-2xl py-4 font-bold text-center">Annual Sales Report for the Year

                            {{\Carbon\Carbon::parse('01-01-'.request()->get('date'))->format('Y') }}</h1>
                    @endif
                    <table id="table" class=" w-full text-sm text-left shadow-md rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr class="border border-dashed border-black">
                            <th scope="col" class="px-6 py-3 border-r border-dashed border-black">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-dashed border-black">
                                PROPERTY NAME
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-dashed border-black">
                                AMOUNT
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-dashed border-black">
                                SELLER
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-dashed border-black">
                                PAID_AT
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($reports as $report)
                            <tr class="bg-white border border-dashed border-black ">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border-r border-dashed border-black">
                                    {{ $report->id }}
                                </th>
                                <td class="px-6 py-4 border-r border-dashed border-black">
                                    {{ $report->property->title }}
                                </td>
                                <td class="px-6 py-4 border-r border-dashed border-black">
                                    ₱{{ number_format((float)$report->amount)}}
                                </td>
                                <td class="px-6 py-4 border-r border-dashed border-black">
                                    {{ $report->sellerInfo->name }}
                                </td>
                                <td class="px-6 py-4 border-r border-dashed border-black">
                                    {{ \Carbon\Carbon::parse($report->created_at)->format('M d Y - h:m A') }}
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
                        <tfoot>
                        <tr class="bg-gray-50 border border-dashed border-black ">
                            <td class="px-6 py-4">

                            </td>
                            <td class="px-6 py-4">

                            </td>
                            <td class="px-6 py-4 border-r border-dashed border-black">

                            </td>
                            <td class="px-6 py-4 font-bold border-r border-dashed border-black">
                                TOTAL
                            </td>
                            <td class="px-6 py-4 border-r border-dashed border-black">
                                ₱{{$total}}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                @endif
            </div>

            {{-- pagination link --}}
            <div class="py-10">
                {{--                {{ $buyers->links() }}--}}
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        window.print();
    </script>
@endsection
