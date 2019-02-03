@extends('layouts.messages')

@section('message-page')
<div class="container">
    @foreach (Auth::user()->character->messagesOutbox as $message)
        <div class="row">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th><span aria-hidden="true" class="li_user"></span> <a href="/profile/{{ $message->recipient->name }}">{{ $message->recipient->name }}</a> <small>(recipient)</small></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span>{{ $message->message }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
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
