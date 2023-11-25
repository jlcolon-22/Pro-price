@extends('layouts.app')

@section('title', 'Admin Homepage')



@section('content')
    <section class="bg-secondary flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full ">
            <div class="grid grid-cols-3 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">
                <a href="{{ route('admin_buyer_account') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-green-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Buyer</h3>
                        <p class="text-3xl">{{ number_format($buyerCount) }}</p>
                    </div>
                </a>
                <a href="{{ route('admin_agent_account') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-yellow-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Agent</h3>
                        <p class="text-3xl">{{ number_format($agentCount) }}</p>
                    </div>
                </a>
                <a href="{{ route('admin_seller_account') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-red-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Seller</h3>
                        <p class="text-3xl">{{ number_format($sellerCount) }}</p>
                    </div>
                </a>

                <a href="{{ route('admin_properties') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-blue-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Property</h3>
                        <p class="text-3xl">{{ number_format($propertyCount) }}</p>
                    </div>
                </a>
            </div>
        </main>
    </section>
@endsection
