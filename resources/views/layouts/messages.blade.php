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
</ul>
@yield('message-page')
@endsection