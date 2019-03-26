@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_truck"></span> {{ __('Kill') }}</h3>
<p>
    Attempt to kill another character.
</p>
@include('session.status')
hello world