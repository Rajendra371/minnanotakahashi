@component('mail::message')
# Welcome From CMS

Hello New User Click The Button Below To Verify Your Email

@component('mail::button', ['url' => ''])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
