@extends('layouts.messages')

@section('message-page')
<div class="container">
    @if (count(Auth::user()->character->messagesInbox) == 0)
        <p class="text-center"><i>No new inbox messages.</i></p>
    @endif
    @foreach (Auth::user()->character->messagesInbox as $message)
        <div class="row">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th colspan="2"><span aria-hidden="true" class="li_user"></span> <a href="/profile/{{ $message->sender->name }}">{{ $message->sender->name }}</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-10">
                            <span>Subject</span>
                        </td>
                        <td>
                            <span class="not-bold">{{ $message->subject }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Message</span>
                        </td>
                        <td>
                            <span class="not-bold">{{ $message->message }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <small><span aria-hidden="true" class="li_paperplane"></span> {{ $message->created_at }}<span aria-hidden="true" class="li_eye pl-2"></span> {{ $message->updated_at }}</small>
                            <a class="float-right pl-2" href="#">Delete</a><a class="float-right" href="#">Reply</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
