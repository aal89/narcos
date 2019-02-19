<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="2"><a href="{{ env('APP_URL') }}/profile/{{ $msg->sender->name }}">{{ $msg->sender->name }}</a></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <span><strong>Subject</strong></span>
            </td>
            <td>
                <span class="not-bold text-wrap">{{ $msg->subject }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span><strong>Message</strong></span>
            </td>
            <td>
                <span class="not-bold text-wrap">{{ $msg->message }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small>{{ $msg->created_at }}</small>
            </td>
        </tr>
    </tbody>
</table>
<p>
    <a href="{{ env('APP_URL') }}/messages/inbox">Open messages</a>
</p>