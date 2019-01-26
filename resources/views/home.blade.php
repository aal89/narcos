@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            @if ($errors->any())
                {!! implode('', $errors->all('
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    :message
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ')) !!}
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @include('character.info')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3 col-lg-3">
            @include('layouts.menu')
        </div>
        <div class="col-md-9 col-lg-9">
            <h3 class="page-title"><span aria-hidden="true" class="li_news"></span> {{ __('News') }}</h3>
            <div class="container">
                <div class="row">
                    <h5 class="text-secondary">Update #2</h5>
                </div>
                <div class="row">
                    - Rewrote great portions of the code.<br>
                    - Added code to collapse menus by default on smaller devices.<br>
                    - Deleted unused components.<br>
                    - Added password reset for logged in users.<br>
                    - Added errors (top) dialog.<br>
                    - Finalized the top menu regarding functionality.<br>
                </div>
                <div class="row">
                    <span class="small mt-2 mb-2">26-01-2019 13:28 by aal</span>
                </div>
                <div class="row">
                    <h5 class="text-secondary">Update #1</h5>
                </div>
                <div class="row">
                    - Created character creation and death controllers, views and migrations.<br>
                    - Created middleware to respond accordingly to character state (see above line).<br>
                    - Cleanup code a lot.<br>
                    - Added comments throughout code base.<br>
                </div>
                <div class="row">
                    <span class="small mt-2 mb-2">21-01-2019 21:23 by aal</span>
                </div>
                <div class="row">
                    <h5 class="text-secondary">Development</h5>
                </div>
                <div class="row">
                    Groundwork done.<br>
                    - Scaffoulded out a authentication system.<br>
                    - Created a css to reflect a mafia/narcos style game.<br>
                    - Created logo.<br>
                    - Setup environmental variables, so that emailing and verifying works etc.<br>
                    - Setup deployment pipeline.<br>
                </div>
                <div class="row">
                    <span class="small mt-2 mb-2">13-01-2019 21:43 by aal</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
