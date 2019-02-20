@component('mail::message')
# You received an in-game message!

**{{ $msg->sender->name }}** sent: 

{{ $msg->message }}

@component('mail::button', ['url' => '{{ env('APP_URL') }}/messages/inbox'])
Open Messages
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
