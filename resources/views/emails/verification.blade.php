@component('mail::message')
# HELLO {{ $data['email'] }}

Please click the button below to verify your email address.

@component('mail::button', ['url' =>  $data['url'] ])
Verify Email Address
@endcomponent

@endcomponent
