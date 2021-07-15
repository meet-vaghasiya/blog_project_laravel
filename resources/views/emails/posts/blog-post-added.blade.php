@component('mail::message')
# some one added post

The body of your message.

@component('mail::button', ['url' => ''])
plese read this
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
