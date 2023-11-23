@extends('layouts.app')


@section('title','Login Admin')

@section('content')
        <section class="bg-secondary min-h-[100svh] flex justify-center items-center">
            <form action="{{ route('admin_login_post') }}" method="post" class="bg-body w-[30rem] py-10">
                <h1 class="text-lg  text-text font-semibold text-center">SIGN IN ADMIN ACCOUNT</h1>
                @csrf

                <div class="mt-10 px-10">
                    <x-alert/>
                    <div class="relative">
                        <input type="text" name="email"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                            value="{{ old('email') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                    </div>

                    @error('email')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror

                    <div class="relative mt-10">
                        <input type="password" name="password"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" "
                            value="{{ old('password') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                    </div>

                    @error('password')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror

                    <div class="relative mt-7">
                        <button type="submit" class="text-text bg-button px-2 w-full py-2">Login</button>

                    </div>
                </div>
            </form>
        </section>
@endsection
