@extends('layouts.app')

@section('title', 'Payments')

@section('content')
    {{-- header --}}
    <x-buyer.header />
    {{-- properties --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-11em)] px-3 md:px-0">
        {{-- filter button --}}
        <h1 class="text-text font-serif font-bold">-- PAYMENTS</h1>
        {{-- alert section --}}
        <x-alert />

        {{-- appointment table --}}
        <div class="overflow-x-auto w-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-10">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Property
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $payment->property->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $payment->amount }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($payment->status == 0)
                                    <span
                                        class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                                @elseif ($payment->status == 'paid')
                                    <span class="px-2 py-2  text-green-700 rounded-md text-xs">PAID</span>
                                @elseif ($payment->status == 'unpaid')
                                    <span class="px-2 py-2  text-red-700 rounded-md text-xs">UNPAID</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $payment->created_at }}
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td class="p-4"> no payment found</td>
                        </tr>
                    @endforelse



                </tbody>
            </table>
        </div>
        {{-- appointment pagination --}}
        <div class="py-2">
            {{ $payments->links() }}
        </div>


        <div id="detailsModal"
            class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
            {{-- apppointment form --}}
        </div>
        <div id="buyerInformation"
            class="fixed w-full h-screen hidden justify-center py-10 top-0 left-0 overflow-y-auto bg-black/60 z-[70] px-2 md:px-0">
            <div class="w-[26rem] h-fit bg-white relative">
                <h1 class="px-2 py-3 shadow text-lg">Buyer Information</h1>
                <div class="p-5 grid space-y-4 ">
                    <img id="buyerImage" src="{{ asset('assets/pngwing.com(2).png') }}" class="border w-[16rem]"
                        alt="">
                    <div class="flex gap-x-10">
                        <h3 class="text-gray-500">Name:</h3>
                        <h1 id="name">JAMES GARCIA</h1>
                    </div>
                    <div class="flex gap-x-10">
                        <h3 class="text-gray-500">Email:</h3>
                        <h1 id="email">JAMES@gmail.com</h1>
                    </div>
                    <div class="flex gap-x-10">
                        <h3 class="text-gray-500">Number:</h3>
                        <h1 id="number">09101421321</h1>
                    </div>
                    <div class=" gap-x-10">
                        <h3 class="text-gray-500">Goverment ID:</h3>
                        <img id="buyerGovId" src="{{ asset('assets/pngwing.com(2).png') }}" class="border w-full"
                            alt="">
                    </div>


                </div>
                <img onclick="buyerInformationToggle()" src="{{ asset('icons/x.svg') }}" class="absolute top-4 right-3"
                    alt="">
            </div>
        </div>
        {{-- popup reports --}}
        <div id="reportContainer"
            class="fixed top-0 left-0 w-full h-screen z-[100] hidden justify-center items-center  bg-black/40">
            <div class=" bg-white w-[40rem] relative">
                <h1 class="px-2 py-3 shadow text-lg">Reports</h1>
                <div class="py-5 px-3 space-y-3" id="reports">
                    {{-- <h1 class="space-x-2 flex items-center"><span class="bg-gray-300 px-2 py-1 rounded-full w-10 ">22</span>
                        <span>dsadad sdad</span> <button class="px-3 py-1 border border-green-400 "><img
                                src="{{ asset('icons/check_circle_black_24dp.svg') }}" class="w-[1.5rem]"
                                alt=""></button></h1> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        const buyerInformation = document.querySelector('#buyerInformation');

        function buyerInformationToggle() {
            buyerInformation.classList.toggle('hidden')
            buyerInformation.classList.toggle('flex')
        }
        const reportContainer = document.querySelector('#reportContainer');
        const reports = document.querySelector('#reports');
        var checkBool = false;

        function closeReport() {
            checkBool = false;
            reports.innerHTML = ''
            reportContainer.classList.remove('flex');
            reportContainer.classList.add('hidden');
        }

        $(document).ready(function() {
            $.fn.showBuyerInformation = function(id) {
                $.ajax({
                    type: "get",
                    url: "/agent/buyer_info/" + id,

                    success: function(response) {
                        $('#name').text(response.name);
                        $('#email').text(response.email);
                        $('#number').text(response.phone_number);
                        if (!!response.profile) {
                            $('#buyerImage').attr('src', `${response.profile}`)
                        } else {
                            $('#buyerImage').attr('src',
                                `https://ui-avatars.com/api/?background=random&name=${response.name}`
                            )
                        }

                        $('#buyerGovId').attr('src', `${response.goverment_id}`)
                        buyerInformationToggle();
                    }
                });
            }

            $.fn.showReport = function(id) {
                $.ajax({
                    type: "get",
                    url: "/agent/appointment/report/" + id,
                    success: function(response) {
                        var x = $('#reports');


                        response.forEach((element, index) => {

                            if (element.status) {
                                x.append(`
                            <h1 class="space-x-2 flex items-center"><span class="flex min-w-[2rem] min-h-[2rem] mx-1 justify-center items-center rounded-full border border-gray-200 bg-green-400  text-white  hover:border-gray-300 ">${index+1}</span> <span>${element.report}</span></h1>
                            `)
                            } else {
                                if (checkBool) {
                                    x.append(`
                            <h1 class="space-x-2 flex items-center"><span
                                class="flex min-w-[2rem] min-h-[2rem] mx-1 justify-center items-center rounded-full border border-gray-200 bg-white  text-black  hover:border-gray-300 ">${index+1}</span> <span>${element.report}</span> </h1>
                            `)
                                } else {

                                    if (index != 1) {
                                        x.append(`
                                            <h1 class="space-x-2 flex items-center"><span
                                                class="flex min-w-[2rem] min-h-[2rem] mx-1 justify-center items-center rounded-full border border-gray-200 bg-white  text-black  hover:border-gray-300 ">${index+1}</span> <span>${element.report}</span> <button onclick="$.fn.checkReport(${element.id})" class="px-3 py-1 border border-green-400 "><img src="{{ asset('icons/check_circle_black_24dp.svg') }}" class="w-[1.5rem]" alt=""></button></h1>
                                            `)
                                    }else{
                                        x.append(`
                            <h1 class="space-x-2 flex items-center"><span
                                class="flex min-w-[2rem] min-h-[2rem] mx-1 justify-center items-center rounded-full border border-gray-200 bg-white  text-black  hover:border-gray-300 ">${index+1}</span> <span>${element.report}</span> </h1>
                            `)
                                    }

                                    checkBool = true;
                                }
                            }
                        });

                    }
                });
                $('#reportContainer').removeClass('hidden');
                $('#reportContainer').addClass('flex');
            }


            $.fn.checkReport = function(id) {
                $('#reports').html(' ');
                checkBool = false;
                $.ajax({
                    type: "get",
                    url: "/agent/appointment/report/check/" + id,
                    success: function(response) {
                        $.fn.showReport(response.id)
                        Swal.fire({
                            title: "Updated Successfully!",
                            icon: "success"
                        });
                    }
                });
            }
        })
    </script>
@endsection
