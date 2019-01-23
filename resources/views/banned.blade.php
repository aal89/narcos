@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-9">
            <h3 class="page-title"><span aria-hidden="true" class="li_news"></span> {{ __('Hmm') }}</h3>
            <div class="container">
                <div class="row">
                    <h5 class="text-danger">Banned</h5>
                </div>
                <div class="row">
                    It seems like you did something that wasn't suppose to happen. If you're interested in getting your account back
                    please contact the helpdesk and resolve any outstanding issue. See the menu in the navigation bar.<br><br>
                    <i>Note: your character is left untouched, and if it's alive other players can still interact with it.</i>
                </div>
        </div>
    </div>
</div>
@endsection
