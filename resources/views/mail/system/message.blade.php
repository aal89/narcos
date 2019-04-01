@component('mail::message')
# {{ $msg->subject }}

@if ($msg->trusted)
{!! $msg->message !!}
@endif

@component('mail::button', ['url' => env('APP_URL').'/messages/inbox'])
Open Messages
@endcomponent

@endcomponent
