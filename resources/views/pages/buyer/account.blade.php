@extends('layouts.app')

@section('title', 'Manage Properties')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 px-3 lg:px-0 relative ">
        <h1 class="text-text font-serif font-bold">- ACCOUNT INFORMATION</h1>
        <x-alert />

        {{-- update informatiom form --}}
        <form action="{{ route('buyer_update_account') }}" method="POST"  class="w-full overflow-hidden">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 mt-6">
                <div class="grid justify-center items-center w-full ">
                    @if (!!Auth::guard('buyer')->user()->profile)
                        <img id="previewAgent" src="{{ asset(Auth::guard('buyer')->user()->profile) }}"
                            class="h-60 w-60 object-cover" alt="...">
                    @else
                        <img id="previewAgent"
                            src="https://ui-avatars.com/api/?background=random&name={{ Auth::guard('buyer')->user()->name }}"
                            class="h-60 w-60 object-cover" alt="...">
                    @endif
                    <button type="button" onclick="modalProfilefn()" class="text-blue-500">Change Profile</button>
                </div>

                <div class="col-span-2">
                    <div class="grid md:grid-cols-2 md:gap-x-6 ">
                        <div class="relative mt-10">
                            <input type="text" name="name"
                                class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                                placeholder=" " value="{{ Auth::guard('buyer')->user()->name }}">
                            <label for=""
                                class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Name</label>
                        </div>

                        <div class="relative mt-10">
                            <input type="text" name="email"
                                class="border-b outline-none border-text  bg-transparent w-full pt-3 peer focus:border-b-2"
                                placeholder=" " value="{{ Auth::guard('buyer')->user()->email }}">
                            <label for=""
                                class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-x-6 ">
                        <div class="relative mt-10">
                            <input type="text" name="phone_number"
                                class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                                placeholder=" " value="{{ Auth::guard('buyer')->user()->phone_number }}">
                            <label for=""
                                class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Phone
                                Number</label>
                        </div>


                    </div>

                </div>
            </div>
            <div class="float-right py-10 md:py-0">
                <button class="bg-green-500 text-white px-3 py-2 rounded">Save Changes</button>
                <button type="button" onclick="modalPasswordfn()" class="bg-red-500 text-white px-3 py-2 rounded">Update
                    Password</button>
            </div>
        </form>

        {{-- profile modal --}}
        <div id="modalProfile"
            class="fixed z-50 left-0 hidden overflow-hidden w-full bg-black/60 h-screen top-0  justify-center pt-[5rem]">
            <div class="bg-body h-fit w-[30rem]">
                {{-- modal header --}}
                <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                    <h1 class="font-semibold text-text  text-2xl">UPDATE PROFILE</h1>
                    <button onclick="modalProfilefn()" class="hover:opacity-90">
                        <img src="{{ asset('icons/x.svg') }}" alt="">
                    </button>
                </div>
                {{-- modal body --}}

                <div>
                    {{-- update profile form --}}
                    <form action="{{ route('buyer_update_account_profile') }}" method="POST" enctype="multipart/form-data"
                        class="px-4 py-7">
                        @csrf

                        <div class="relative ">
                            <input type="file" name="profile"
                                class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2" placeholder=" ">
                            <label for=""
                                class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Profile</label>
                        </div>
                        @error('password')
                            <small class="text-red-500 font-semibold">{{ $message }}</small>
                        @enderror
                        <div class="relative mt-7">
                            <button type="submit"
                                class=" bg-green-600 hover:bg-green-500 text-white px-2 w-full py-2">UPDATE</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- password modal --}}
        <div id="modalPassword"
            class="fixed z-50 left-0 {{ Session::has('error_password') ? 'flex' : 'hidden' }}    overflow-hidden w-full bg-black/60 h-screen top-0  justify-center pt-[5rem]">
            <div class="bg-body h-fit w-[30rem]">
                {{-- modal header --}}
                <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                    <h1 class="font-semibold text-text  text-2xl">UPDATE PASSWORD</h1>
                    <button onclick="modalPasswordfn()" class="hover:opacity-90">
                        <img src="{{ asset('icons/x.svg') }}" alt="">
                    </button>
                </div>
                {{-- modal body --}}

                <div>
                    {{-- update password form --}}
                    <form action="{{ route('buyer_update_account_password') }}" method="POST"
                        enctype="multipart/form-data" class="px-4 py-7">
                        @csrf

                        <div class="relative">
                            <input type="password" name="password"
                                class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                                placeholder=" ">
                            <label for=""
                                class="absolute -top-4 left-0 -z-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                        </div>
                        @error('password')
                            <small class="text-red-500 font-semibold">{{ $message }}</small>
                        @enderror
                        <div class="relative mt-10">
                            <input type="password" name="confirm_password"
                                class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                                placeholder=" " ">
                        <label for=""
                            class="absolute -top-4 left-0 -z-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Confirm password</label>
                    </div>
                    @error('confirm_password')
        <small class="text-red-500 font-semibold">{{ $message }}</small>
    @enderror
                    <div class="relative mt-7">
                        <button type="submit" class=" bg-red-600 hover:bg-red-500 text-white px-2 w-full py-2">UPDATE PASSWORD</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
        </section>
@endsection

@section('scripts')
        <script src="{{ asset('js/modal.js') }}"></script>
@endsection
