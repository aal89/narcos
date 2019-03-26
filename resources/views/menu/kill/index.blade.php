@extends('layouts.basic')

@section('page')
<h3 class="page-title"><img src="/bullet_icon.svg" height="11"> {{ __('Kill') }}</h3>
<p>
    Attempt to kill another character.
</p>
@include('session.status')
<p>Hello world</p>
@endsection