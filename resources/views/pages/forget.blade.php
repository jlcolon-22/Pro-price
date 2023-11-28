@extends('layouts.app')
@section('title', 'Forget Password')
@section('content')
    {{-- header --}}
    <x-buyer.header/>

    <section class="container mx-auto py-10 px-3 md:px-0 flex justify-center">

            <form action="{{ route('send_forgot_password') }}" method="POST" class="bg-body shadow-md border px-2 py-7 w-[30rem]">
                @csrf

                <h1 class="text-center text-2xl font-semibold">Forgot password?</h1>
                <x-alert/>

               <div class="mt-9 px-10">
                <div class="relative">
                    <input type="text" name="email"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('email') }}">
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                </div>
                <button type="submit" class="py-3 px-2 bg-blue-500 text-white w-full mt-3">Reset password</button>
               </div>

            </form>

    </section>
@endsection
@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
