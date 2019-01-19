@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <table class="table table-sm table-dark">
                <tbody>
                    @if (session('status'))
                        <tr>
                            <td>
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            <span>
                                <span aria-hidden="true" class="li_user"></span> aal
                                <a href="#" class="float-right">(edit profile)</a>
                                <br>
                                <span aria-hidden="true" class="li_heart"></span> 100%
                                <span aria-hidden="true" class="li_data pl-2"></span> Low-life
                            </span>
                            <span class="float-right"><span aria-hidden="true" class="li_stack"></span> Messages (0)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span aria-hidden="true" class="li_banknote"></span> &euro; 322.000,-
                            <span aria-hidden="true" class="li_truck pl-2"></span> 12kg
                            <span aria-hidden="true" class="li_location pl-2"></span> United States of America
                            <span aria-hidden="true" class="li_world pl-2"></span> Plane
                        </td>
                    </tr>
                </tbody>
            </table>
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
