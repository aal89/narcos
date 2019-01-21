@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">asd
                    {{ session('status') }}
                </div>
            @endif
            @include('character.info')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
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
                                    <h5 class="">Development</h5>
                                </div>
                                <div class="row">
                                    Groundwork done.
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
