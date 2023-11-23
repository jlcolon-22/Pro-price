@extends('layouts.app')

@section('title','About Us')



@section('content')
    {{-- header --}}
    <x-buyer.header/>
    <section  class="container  mx-auto py-10 font-serif">
            {{-- image --}}
           <div class="grid grid-cols-2 gap-x-20">
            <img src="{{ asset('assets/pngwing.com.png') }}" alt="">


            <div class="">
                <h2 class="my-8 text-2xl font-bold text-text md:text-4xl">Contact Us</h2>
                <div class="relative mt-10">
                    <input type="text" name="password"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('password') }}">
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Name</label>
                </div>
                <div class="relative mt-10">
                    <input type="text" name="password"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('password') }}">
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                </div>
                <div class="relative mt-10">
                    <textarea type="text" name="password"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('password') }}"></textarea>
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Message</label>
                </div>
                <div class="relative mt-10">
                    <button class="bg-button hover:bg-yellow-500 py-2 w-full flex items-center justify-center gap-x-2">
                        <img src="{{ asset('icons/send.svg') }}" class="w-[1rem]" alt="">
                        Send
                    </button>

                </div>
            </div>
           </div>
    </section>
@endsection


@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
