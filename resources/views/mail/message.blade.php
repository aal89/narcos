@component('mail::message')
# **{{ $msg->sender->name }}** sent: 

{{ $msg->message }}

@component('mail::button', ['url' => env('APP_URL').'/messages/inbox'])
Open Messages
@endcomponent

@endcomponent
