@component('mail::message')
# **{{ $msg->sender->name }}** sent: 

@if ($msg->trusted)
{!! $msg->message !!}
@else
{{ $msg->message }}
@endif

@component('mail::button', ['url' => env('APP_URL').'/messages/inbox'])
Open Messages
@endcomponent

@endcomponent
