@extends('layouts.app')


@section('title','Privacy Policy')


@section('content')
    {{-- header --}}
    <x-buyer.header />


    {{-- main section --}}
    <section class="container mx-auto py-10 font-serif space-y-8">
        <h1 class="text-2xl text-center font-semibold ">Privacy Policy</h1>

        <div>
            <h1 class="font-semibold text-text">Effective Date: November 30, 2023</h1>
            <p class="text-paragraph">
                At Proprice, protecting your privacy is paramount. This Privacy Policy explains how we collect, use,
                disclose, and manage your information when you use Proprice. By using Proprice, you agree to the practices
                described in this Privacy Policy.</p>
        </div>

        <div>
            <h1 class="font-semibold text-text">Legal Basis</h1>
            <p class="text-paragraph">
                Our data processing practices adhere to the provisions of the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines. We are committed to complying with this law and protecting your rights regarding your personal information.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Information Collection and Use</h1>
            <p class="text-paragraph">
                When you register or use Proprice, we collect basic personal information such as your name, email address, and location. This information is used to deliver our services, enhance user experience, and communicate with you.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Data Security and Retention</h1>
            <p class="text-paragraph">
                We maintain appropriate technical and organizational measures to safeguard your personal information. While we strive to protect your data, no method of transmission over the internet or electronic storage is completely secure. We retain your information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy. </p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Data Storage</h1>
            <p class="text-paragraph">
                Your information is securely stored on our servers or through reputable third-party hosting services. We take reasonable measures to safeguard your data, though no method of transmission over the internet or electronic storage is entirely secure.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Information Sharing</h1>
            <p class="text-paragraph">
                We do not sell, trade, or rent your personal information to third parties for their marketing purposes. However, we may share your data with trusted service providers or affiliates who assist us in operating, maintaining, or improving Proprice. These entities are contractually obligated to protect your information and comply with the Data Privacy Act.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">User Rights</h1>
            <p class="text-paragraph">
                You have the right to access, correct, update, or delete your personal information held by Proprice. If you wish to exercise these rights or have any inquiries regarding your data, please contact us using the details provided below.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Changes to This Privacy Policy</h1>
            <p class="text-paragraph">
                We reserve the right to update or modify this Privacy Policy periodically. Any changes will be posted on our website, and the effective date will be revised accordingly. Continued use of Proprice after such changes constitutes acceptance of the updated Privacy Policy.</p>
        </div>
        <div>
            <h1 class="font-semibold text-text">Contact Us</h1>
            <p class="text-paragraph">
                For any questions or concerns about our Privacy Policy or data practices, please contact us at proprice@gmail.com.</p>
        </div>
    </section>
    <x-buyer.footer/>
@endsection
@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection
