@extends('layouts.app')

@section('title', 'Manage Properties')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10">
        <a href="{{ route('seller_add_property') }}" class="px-5 text-text bg-button py-3 ">Add Properties</a>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
