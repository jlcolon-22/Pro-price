@extends('layouts.app')

@section('title', 'Feedback')


@section('content')
    {{-- header --}}
    <x-buyer.header />

    {{-- main section --}}
    <section class="container mx-auto py-10 min-h-[calc(100svh-11em)] px-3 md:px-0">
        <h1 class="text-text font-serif font-bold">-- FEEDBACK</h1>

        <x-alert/>
        <div class="grid md:grid-cols-2 items-start">
            <form action="{{ route('agent_add_feedback') }}" method="POST" class="flex justify-center p-3 md:p-10">
                @csrf
                <div class="w-[90%]">
                    <textarea name="feedback" class="border outline-none p-2 w-full" placeholder="send feedback..." rows="4"></textarea>
                    <button class="border w-full bg-button py-2 mt-5">Submit Feedback</button>
                </div>
            </form>

            {{-- feedback table --}}
            <div class="p-3 md:p-10">
                <table class="table table-auto border-collapse border w-full">
                    <thead>
                        <tr>
                            <td class="border p-2">Date</td>
                            <td class="border p-2">Feedback</td>
                            <td class="border p-2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                        <tr>
                            <td class="border p-2 text-paragraph whitespace-nowrap">{{ \Carbon\Carbon::parse($feedback->created_at)->format('M d Y') }}</td>
                            <td class="border p-2 text-paragraph">
                                <pre>{{ $feedback->feedback }}</pre>
                            </td>
                            <td class="border p-2 text-paragraph">
                                <a href="{{ route('agent_delete_feedback', ['id'=>$feedback->id]) }}" class="text-red-500 underline font-medium hover:text-red-300">Delete</a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="px-2 py-5 text-paragraph">no feedback found..</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="py-2">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
