@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_banknote"></span> {{ __('Roulette') }}</h3>
<p>
    The best game in the world with the highest probabilities to win. European roulette rules apply, with the exception that
    you can't play on intersections. Minimum bet is &euro;100,- and maximum bet is &euro;100.000,-
</p>
@include('session.status')
<form method="POST" action="/roulette">
    @csrf
    <div class="row">
        <div class="d-none d-sm-block col-md-3 col-lg-3">
            <img src="/roulette.png" class="img-fluid" />
        </div>
        <div class="col-5 col-md-2 col-lg-2 my-auto">
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="1st 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="1 to 18">
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="Even">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="2nd 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center roulette-red" min="1" placeholder="Red">
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center roulette-black" min="1" placeholder="Black">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="3rd 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="Odd">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="19 to 36">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-secondary" type="submit">Wager</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="form-group mb-2 row">
                <div class="col-12 col-md-6 col-lg-6">
                    <input type="number" class="form-control form-control-sm text-center" min="1" placeholder="0">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="2">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="3">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="4">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="5">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="6">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="7">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="8">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="9">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="10">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="11">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="12">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="13">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="14">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="15">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="16">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="17">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="18">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="19">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="20">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="21">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="22">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="23">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="24">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="25">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="26">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="27">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="28">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="29">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="30">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="31">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="32">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="33">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="34">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="35">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="36">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="2 to 1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="2 to 1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center" placeholder="2 to 1">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection