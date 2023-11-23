@extends('layouts.app')


@section('title','Terms & Conditions')

@section('content')
    {{-- header --}}
    <x-buyer.header />


    {{-- main section --}}
    <section class="container mx-auto py-10 font-serif space-y-8">
        <h1 class="text-2xl text-center font-semibold ">Terms and Conditions for Pro-Price</h1>

        <div>
            <h1 class="font-semibold text-text">1. Acceptance of Terms</h1>
            <p class="text-paragraph">
                By accessing or using the Pro-Price service, you agree to comply with these terms and conditions. If you do not agree with any part of these terms, you are not authorized to use the service.</p>
        </div>

        <div>
            <h1 class="font-semibold text-text">2. Services Offered</h1>
            <p class="text-paragraph">
                Pro-Price offers house and lot price predictions based on historical data, market trends, and analysis. The service provides estimates and projections, but it does not guarantee the accuracy or reliability of the information provided.
</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">3. User Conduct</h1>
            <p class="text-paragraph">
                Users of the Pro-Price service agree to use it for lawful purposes only. Any misuse or interference that affects the service's functionality or other users' experiences is strictly prohibited.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">4. Accuracy of Information</h1>
            <p class="text-paragraph">
                All intellectual property, including content, trademarks, and logos associated with Pro-Price, is owned by the service. Users are not permitted to use, reproduce, distribute, or modify any content from Pro-Price without prior written consent. </p>
        </div>
        <div>
            <h1 class="font-semibold text-text">6. Privacy Policy</h1>
            <p class="text-paragraph">
                The collection and handling of personal information are governed by our Privacy Policy. Your use of Pro-Price implies consent to the collection and use of your information in accordance with the Privacy Policy.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">7. Limitation of Liability</h1>
            <p class="text-paragraph">
                Pro-Price and its affiliates shall not be held liable for any direct, indirect, incidental, special, or consequential damages arising from the use or inability to use the application or any information provided within.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">8. Modifications to Terms</h1>
            <p class="text-paragraph">
                Pro-Price reserves the right to modify or revise these terms and conditions in accordance with Philippine laws. Users will be informed of significant changes, and their continued use of the application after such modifications constitutes acceptance of the updated terms.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">9. Termination</h1>
            <p class="text-paragraph">
                Pro-Price reserves the right to terminate access to the service at any time, without prior notice, for violation of these terms or for any other reason deemed necessary.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">10. Governing Law</h1>
            <p class="text-paragraph">
                These terms and conditions are governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts in that jurisdiction.</p>
        </div>
    </section>
    <x-buyer.footer/>
@endsection
@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
