<div class="px-4 pt-2">

    {{-- success alert --}}
    @if (Session::has('success'))
    <div class="bg-body border shadow flex items-center gap-x-3 py-4 px-4 text-paragraph">
        <img src="{{ asset('icons/check_circle_black_24dp.svg') }}" class="
        p-1 bg-green-200 rounded-full" alt="">
       <h3>{{ Session::get('success') }}</h3>
    </div>
    @endif
    {{-- error alert --}}
    @if (Session::has('error'))
    <div class="bg-body border shadow flex items-center gap-x-3 py-4 px-4 text-paragraph">
        <img src="{{ asset('icons/error_black_24dp.svg') }}" class="
        p-1 bg-red-200 rounded-full" alt="">
        <h3>{{ Session::get('error') }}</h3>
    </div>
    @endif
    {{-- warning alert --}}
    @if (Session::has('warning'))
    <div class="bg-body border shadow flex items-center gap-x-3 py-4 px-4 text-paragraph">
        <img src="{{ asset('icons/warning_black_24dp.svg') }}" class="
        p-1 bg-yellow-200 rounded-full" alt="">
        <h3>{{ Session::get('warning') }}</h3>
    </div>
    @endif

</div>
