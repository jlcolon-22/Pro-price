@component('mail::message')
# Forget Password Email

Please click the button below to change your password.

@component('mail::button', ['url' =>  $data['url'] ])
Change password
@endcomponent

@endcomponent
