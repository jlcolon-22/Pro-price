
{{-- admin aside panel --}}
<aside class="border-r min-w-[18rem] max-w-[18rem] bg-body">
    <h1 class="text-2xl font-medium text-center py-7">ADMIN PANEL</h1>

    <div class="grid space-y-3">

        {{-- homepage link --}}
        <a href="{{ route('admin_homepage') }}" class="{{ request()->is('admin/homepage') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}  py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/home.svg') }}" class="w-[1.2rem]" alt="">
            Homepage
        </a>
        {{-- buyer link --}}
        <a href="{{ route('admin_buyer_account') }}" class="{{ request()->is('admin/buyer_account') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}  py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/users.svg') }}" class="w-[1.2rem]" alt="">
            Buyer Account
        </a>
        {{-- seller link --}}
        <a href="{{ route('admin_seller_account') }}" class="{{ request()->is('admin/seller_account') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}  py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/users.svg') }}" class="w-[1.2rem]" alt="">
            Seller Account
        </a>
        {{-- agent link --}}
        <a href="{{ route('admin_agent_account') }}" class="{{ request()->is('admin/agent_account') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}   py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/users.svg') }}" class="w-[1.2rem]" alt="">
            Agent Account
        </a>
        {{-- properties link --}}
        <a href="{{ route('admin_properties') }}" class="{{ request()->is('admin/properties') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}  py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/list.svg') }}" class="w-[1.2rem]" alt="">
            Properties
        </a>
         {{-- feedback link --}}
         <a href="{{ route('admin_feedback') }}" class="{{ request()->is('admin/feedback') ? 'border-l-4 border-blue-500 bg-gray-200 px-3' : 'px-4' }}  py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/list.svg') }}" class="w-[1.2rem]" alt="">
            Feedback
        </a>
        {{-- logout link --}}
        <a href="{{ route('admin_logout') }}" class=" px-4 py-2 flex gap-x-2 items-center">
            <img src="{{ asset('icons/log-out.svg') }}" class="w-[1.2rem]" alt="">
            Logout
        </a>
    </div>
</aside>
