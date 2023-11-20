<div class="border-b bg-body ">
    <header class="flex justify-between items-center container mx-auto h-20">
        {{-- logo --}}
        <h1 class="text-text text-2xl font-semibold tracking-wider">Pro price</h1>

        {{-- navlist --}}
        <nav class="flex items-center space-x-12">

            <div class="flex space-x-5">
                <a href="/"
                    class="text-text text-sm uppercase tracking-wider {{ request()->is('/') ? 'font-bold ' : '' }}">Homepage</a>
                <a href="/properties"
                    class="text-text text-sm uppercase tracking-wider {{ request()->is('properties') ? 'font-bold ' : '' }}">Properties</a>
                <a href="" class="text-text text-sm uppercase tracking-wider">About</a>
                <a href="" class="text-text text-sm uppercase tracking-wider">Contact</a>
            </div>
            {{-- login button --}}
            <div class="relative">
                @if (Auth::guard('seller')->check())
                    <button onclick="dropdownProfile()"
                        class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 "
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        @if (!!Auth::guard('seller')->user()->profile)
                            <img class="w-8 h-8 rounded-full" src="{{ asset(Auth::guard('seller')->user()->profile) }}"
                                alt="user photo">
                        @else
                            <img class="w-8 h-8 rounded-full"
                                src="https://ui-avatars.com/api/?background=random&name={{ Auth::guard('seller')->user()->name }}"
                                alt="user photo">
                        @endif
                    </button>
                @elseif (Auth::guard('buyer')->check())
                    <button onclick="dropdownProfile()"
                        class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 "
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        @if (!!Auth::guard('buyer')->user()->profile)
                            <img class="w-8 h-8 rounded-full" src="{{ asset(Auth::guard('buyer')->user()->profile) }}"
                                alt="user photo">
                        @else
                            <img class="w-8 h-8 rounded-full"
                                src="https://ui-avatars.com/api/?background=random&name={{ Auth::guard('buyer')->user()->name }}"
                                alt="user photo">
                        @endif
                    </button>
                @else
                    <button onclick="modalLoginToggle()"
                        class="bg-button  hover:bg-yellow-500 px-5 py-2 text-opacity-80 text-paragraph text-sm font-semibold uppercase tracking-wider hover:text-opacity-100">Login</button>
                @endif



                <!-- Dropdown menu -->
                <div id="profileDropdown"
                    class="z-10 absolute hidden left-auto right-0 top-9 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    @if (Auth::guard('seller')->check())
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div>{{ Auth::guard('seller')->user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownUserAvatarButton">
                            <li>
                                <a href="{{ route('seller_account') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 ">Account</a>
                            </li>
                            <li>
                                <a href="{{ route('seller_manage_properties') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 ">Manage Properties</a>
                            </li>

                        </ul>
                    @elseif (Auth::guard('buyer')->check())
                    <div class="px-4 py-3 text-sm text-gray-900 ">
                        <div>{{ Auth::guard('buyer')->user()->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownUserAvatarButton">
                        <li>
                            <a href="{{ route('seller_account') }}"
                                class="block px-4 py-2 hover:bg-gray-100 ">Account</a>
                        </li>
                        <li>
                            <a href="{{ route('seller_manage_properties') }}"
                                class="block px-4 py-2 hover:bg-gray-100 ">Bookmarks</a>
                        </li>

                    </ul>
                    @endif
                    <div class="py-2">
                        <a href="{{ route('auth_user_logout') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign
                            out</a>
                    </div>
                </div>

            </div>
        </nav>
    </header>
    {{-- login modal --}}
    <div id="modalLogin"
        class="fixed z-50 {{ $errors->has('email') || $errors->has('password') || Session::has('error') ? 'flex' : 'hidden' }} overflow-hidden w-full bg-black/60 h-screen top-0  justify-center pt-[5rem]">
        <div class="bg-body h-fit w-[30rem]">
            {{-- modal header --}}
            <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                <h1 class="font-semibold text-text  text-2xl">SIGN IN</h1>
                <button onclick="modalLoginToggle()" class="hover:opacity-90">
                    <img src="{{ asset('icons/x.svg') }}" alt="">
                </button>
            </div>
            {{-- modal body --}}

            <div>
                <x-alert />
                <form action="{{ route('auth_signin') }}" method="POST" class="px-4 py-7">
                    @csrf
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
                    <div class="relative mt-7 flex justify-center">
                        <p class="text-paragraph">Dont have an account yet? <a onclick="modalTypeToggle()"
                                class="text-blue-500 font-semibold"> Sign Up</a></p>

                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- account type modal --}}
    <div id="modalType"
        class="fixed z-50 hidden overflow-hidden w-full bg-black/60 h-screen top-0  justify-center pt-[5rem]">
        <div class="bg-body h-fit w-[30rem]">
            {{-- modal header --}}
            <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                <h1 class="font-semibold text-text  text-2xl">SIGN UP</h1>
                <button onclick="modalTypeToggle()" class="hover:opacity-90">
                    <img src="{{ asset('icons/x.svg') }}" alt="">
                </button>
            </div>
            {{-- modal body --}}
            <div>
                <form action="" class="px-4 py-7">

                    <div class="relative  space-y-3">
                        <button type="button" onclick="modalBuyerToggle()"
                            class="text-text bg-button px-2 w-full py-2 hover:bg-yellow-500">Buyer</button>
                        <button type="button" onclick="modalSellerToggle()"
                            class="text-text bg-button px-2 w-full py-2 hover:bg-yellow-500"">Seller</button>
                        <button type="button" onclick="modalAgentToggle()"
                            class="text-text bg-button px-2 w-full py-2 hover:bg-yellow-500"">Agent</button>
                    </div>
                    <div class="relative mt-7 flex justify-center">
                        <p class="text-paragraph">Already have an account? <a onclick="modalLoginToggle()"
                                class="text-blue-500 font-semibold"> Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- buyer customer --}}
    <div id="modalBuyer"
        class="fixed z-50 {{ $errors->has('email') || $errors->has('password') || Session::has('error') ? 'flex' : 'hidden' }}  overflow-hidden w-full bg-black/60 h-screen top-0  justify-center pt-[5rem] ">
        <div class="bg-body h-fit w-[30rem]">
            {{-- modal header --}}
            <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                <h1 class="font-semibold text-text  text-2xl">SIGN UP / BUYER</h1>
                <button onclick="modalBuyerToggle()" class="hover:opacity-90">
                    <img src="{{ asset('icons/x.svg') }}" alt="">
                </button>
            </div>
            {{-- modal body --}}
            <div>
                <x-alert />
                <form action="{{ route('auth_buyer_signup') }}" method="POST" class="px-4 py-7 z-0">
                    @csrf
                    <div class="relative">
                        <input type="text" name="name"
                            class="border-b outline-none bg-transparent z-0 border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('name') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm  text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Name</label>
                    </div>
                    <div class="relative mt-10">
                        <input type="email" name="email"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('email') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                    </div>
                    @error('email')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror
                    <div class="relative mt-10">
                        <input type="text" name="phone_number"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('phone_number') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Phone
                            Number</label>
                    </div>

                    <div class="relative mt-10">
                        <input type="password" name="password"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('password') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                    </div>
                    @error('password')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror
                    <div class="relative mt-10">
                        <input type="checkbox" required value="example">
                        <label class="text-sm">
                            I have read and agree to the Privacy Policy and Terms and Conditions.
                        </label>
                    </div>
                    <div class="relative mt-7">
                        <button class="text-text bg-button px-2 w-full py-2 font-medium">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- seller customer --}}
    <div id="modalSeller"
        class="fixed z-50 {{ Session::has('seller') ? 'flex' : 'hidden' }} overflow-y-auto w-full bg-black/60 h-screen top-0 left-0 justify-center py-[5rem] max-h-screen">
        <div class="bg-body h-fit w-[30rem]">
            {{-- modal header --}}
            <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                <h1 class="font-semibold text-text  text-2xl">SIGN UP / SELLER </h1>
                <button onclick="modalSellerToggle()" class="hover:opacity-90">
                    <img src="{{ asset('icons/x.svg') }}" alt="">
                </button>
            </div>
            {{-- modal body --}}
            <div>
                <x-alert />

                <form action="{{ route('auth_seller_signup') }}" autocomplete="off" method="POST"
                    class="px-4 py-7" enctype="multipart/form-data">

                    @csrf
                    <div class="relative">
                        <input type="text" name="name"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('name') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Name</label>
                    </div>
                    <div class="relative mt-10">
                        <input type="email" name="email"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('email') }}"">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                    </div>
                    @error('email')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror
                    <div class="relative mt-10">
                        <input type="text" name="phone_number"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('phone_number') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Phone
                            Number</label>
                    </div>
                    @error('phone_number')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror
                    <div class="relative mt-10">
                        <input type="password" name="password"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " required value="{{ old('password') }}">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                    </div>
                    @error('password')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror
                    <h1 class=" mt-10 text-center font-medium text-text">Upload License for validation</h1>
                    <div class="flex items-center justify-center w-full">

                        <label for="dropzone-file"
                            class="flex relative overflow-hidden flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to
                                        upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>

                            </div>
                            <img id="preview" src="" class="absolute" alt="...">
                            <input id="dropzone-file" onchange="uploadFile(this)" type="file" name="license"
                                class="hidden" />
                        </label>

                    </div>
                    @error('license')
                        <small class="text-red-500 font-semibold">{{ $message }}</small>
                    @enderror

                    <div class="relative mt-10">
                        <input type="checkbox" required value="example">
                        <label class="text-sm">
                            I have read and agree to the Privacy Policy and Terms and Conditions.
                        </label>
                    </div>
                    <div class="relative mt-7">
                        <button class="text-text bg-button px-2 w-full py-2 font-medium">Create Account</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- agent customer --}}
    <div id="modalAgent"
        class="fixed z-50 hidden overflow-y-auto w-full bg-black/60 h-screen top-0 left-0 justify-center py-[5rem] max-h-screen">
        <div class="bg-body h-fit w-[30rem]">
            {{-- modal header --}}
            <div class="flex justify-between items-center border-b  px-2 h-[4rem]">
                <h1 class="font-semibold text-text  text-2xl">SIGN UP / Agent</h1>
                <button onclick="modalAgentToggle()" class="hover:opacity-90">
                    <img src="{{ asset('icons/x.svg') }}" alt="">
                </button>
            </div>
            {{-- modal body --}}
            <div>
                <form action="" class="px-4 py-7">
                    <div class="relative">
                        <input type="text"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" ">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Name</label>
                    </div>
                    <div class="relative mt-10">
                        <input type="email"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" ">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Email</label>
                    </div>
                    <div class="relative mt-10">
                        <input type="email"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" ">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Phone
                            Number</label>
                    </div>
                    <div class="relative mt-10">
                        <input type="password"
                            class="border-b outline-none border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" ">
                        <label for=""
                            class="absolute -top-4 left-0 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Password</label>
                    </div>
                    <h1 class=" mt-10 text-center font-medium text-text">Upload License for validation</h1>
                    <div class="flex items-center justify-center w-full">

                        <label for="agent-file"
                            class="flex relative overflow-hidden flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to
                                        upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>

                            </div>
                            <img id="previewAgent" src="" class="absolute" alt="...">
                            <input id="agent-file" onchange="uploadFileAgent(this)" type="file" class="hidden" />
                        </label>
                    </div>

                    <div class="relative mt-10">
                        <input type="checkbox" required value="example">
                        <label class="text-sm">
                            I have read and agree to the Privacy Policy and Terms and Conditions.
                        </label>
                    </div>
                    <div class="relative mt-7">
                        <button class="text-text bg-button px-2 w-full py-2 font-medium">Create Account</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
