@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 px-3 md:px-0 flex justify-center">

        <form action="{{ route('update_change_password', ['email' => $email, 'type' => $type]) }}" method="POST"
            class="bg-body shadow-md border px-2 py-7 w-[30rem]">
            @csrf

            <h1 class="text-center text-2xl font-semibold">Change password?</h1>
            <x-alert />

            <div class="mt-9 px-10">
                {{-- password input --}}
                <div class="relative mt-10">
                    <input type="password" name="password"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('password') }}">
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                    <button onclick="togglePassword(this)" type="button" class="absolute top-3 right-3"><img
                            src="{{ asset('icons/eye-off.svg') }}" class="w-[1rem]" alt=""></button>

                </div>

                    @error('password')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror

                {{-- password input --}}
                <div class="relative mt-10">
                    <input type="password" name="password_confirmation"
                        class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                        value="{{ old('password') }}">
                    <label for=""
                        class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Confirm
                        Password</label>
                    <button onclick="togglePassword(this)" type="button" class="absolute top-3 right-3"><img
                            src="{{ asset('icons/eye-off.svg') }}" class="w-[1rem]" alt=""></button>

                </div>

                    @error('password_confirmation')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror

                <button type="submit" class="py-3 px-2 bg-red-500 text-white w-full mt-3">Reset password</button>
            </div>

        </form>

    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
