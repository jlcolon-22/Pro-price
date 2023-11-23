@extends('layouts.app')

@section('title', 'Admin Properties')



@section('content')
    <section class="bg-body flex min-h-screen">
        {{-- aside --}}
        <x-admin-aside />

        {{-- main content --}}
        <main class="w-full px-10 py-10">
            <h1 class="py-10">-- Properties</h1>

            <div class="py-2">
                <x-alert/>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">




                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seller
                             </th>
                            <th scope="col" class="px-6 py-3">
                               Status
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $property)
                        <tr class="bg-white border-b ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                               {{ $property->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $property->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $property->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $property->address }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $property->sellerInfo->name .' / '. $property->sellerInfo->email  }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($property->status == 0)
                                    <span class="px-2 py-2 bg-yellow-300 text-yellow-700 rounded-md text-xs">Processing</span>
                                @elseif ($property->status == 1)
                                    <span class="px-2 py-2 bg-green-300 text-green-700 rounded-md text-xs">Approved</span>
                                @elseif ($property->status == 2)
                                    <span class="px-2 py-2 bg-red-300 text-red-700 rounded-md text-xs">Declined</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin_property_view',['id' =>$property->id]) }}"
                                    class="font-medium text-blue-600 0 hover:underline">View</a>
                                @if ($property->status != 1)
                                <a href="{{ route('admin_property_approve',['id'=>$property->id]) }}"
                                    class="font-medium text-green-600 0 hover:underline">Aprove</a>

                                @endif
                                @if ($property->status != 2)

                                <a href="{{ route('admin_property_decline',['id' =>$property->id]) }}"
                                    class="font-medium text-red-600 0 hover:underline">Decline</a>
                                @endif
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td>
                                    No Seller Found...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $properties->links() }}

        </main>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
