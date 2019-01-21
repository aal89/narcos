@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10">
            @if (session('status'))
                <div class="alert alert-success" role="alert">asd
                    {{ session('status') }}
                </div>
            @endif
            @include('character.info')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2 col-lg-2">
            @include('layouts.menu')
        </div>
        <div class="col-md-8 col-lg-8">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th><span aria-hidden="true" class="li_news"></span> {{ __('News') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="container">
                                <div class="row">
                                    <h5 class="">Update #1</h5>
                                </div>
                                <div class="row">
                                    - Created character creation and death controllers, views and migrations.<br>
                                    - Created middleware to respond accordingly to character state (see above line).<br>
                                    - Cleanup code a lot.<br>
                                    - Added comments throughout code base.<br>
                                </div>
                                <div class="row">
                                    <span class="small mt-2">21-01-2019 21:23 by aal</span>
                                </div>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <h5 class="">Development</h5>
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
                                    <span class="small mt-2">13-01-2019 21:43 by aal</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
