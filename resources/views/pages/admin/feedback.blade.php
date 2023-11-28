@extends('layouts.app')

@section('title', 'Admin Seller Account')



@section('content')
    <section class="bg-secondary flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">



            <div class="relative overflow-x-auto  sm:rounded-lg">
                <h1 class="font-serif font-semibold py-4">-- FEEDBACKS</h1>
                {{-- alert section --}}
                <div class="py-2">
                    <x-alert />
                </div>

                {{-- agent account table --}}
                <table class="w-full text-sm text-left shadow-md rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Feedback
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $feedback->created_at }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $feedback->feedback }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $feedback->user_type }}
                                </td>
                                <td class="px-6 py-4 text-blue-500 font-medium">
                                    @if ($feedback->user_type == 'agent')
                                    {{ $feedback->agent->name }}
                                    @elseif ($feedback->user_type == 'seller')
                                    {{ $feedback->seller->name }}
                                    @else
                                    {{ $feedback->buyer->name }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin_feedback_delete',['id' =>$feedback->id]) }}" class="text-red-500 hover:underline font-semibold">Delete</a>
                                </td>


                            </tr>

                        @empty
                            <tr>
                                <td class="p-2">
                                    No Feedback Found...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- pagination link --}}
           <div class="py-10">
            {{-- {{ $buyers->links() }} --}}
           </div>

        </main>
    </section>


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
