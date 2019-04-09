@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_mail"></span> {{ __('Messages') }}</h3>
<ul class="nav nav-pills justify-content-center mb-2">
    <li class="nav-item">
        <a class="nav-link {{ strpos($view_name, 'inbox') ? 'active' : '' }}" href="/messages/inbox">Inbox</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ strpos($view_name, 'outbox') ? 'active' : '' }}" href="/messages/outbox">Outbox</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ strpos($view_name, 'compose') ? 'active' : '' }}" href="/messages/compose">Compose</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" href="/messages/delete/all"
            onclick="event.preventDefault();
            document.getElementById('delete-all-form').submit();"><small>Clear messages</small></a>
    </li>
</ul>
<form id="delete-all-form" action="/messages/delete/all" method="POST" style="display: none;">
    @csrf
</form>
@include('session.status')
@yield('message-page')
@endsection