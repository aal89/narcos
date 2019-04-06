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
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n1st12') ? ' is-invalid' : '' }}" name="n1st12" value="{{ old('n1st12') }}" placeholder="1st 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n1to18') ? ' is-invalid' : '' }}" name="n1to18" value="{{ old('n1to18') }}" placeholder="1 to 18">
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('neven') ? ' is-invalid' : '' }}" name="neven" value="{{ old('neven') }}" placeholder="Even">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n2nd12') ? ' is-invalid' : '' }}" name="n2nd12" value="{{ old('n2nd12') }}" placeholder="2nd 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('nred') ? ' is-invalid' : '' }} roulette-red" name="nred" value="{{ old('nred') }}" placeholder="Red">
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('nblack') ? ' is-invalid' : '' }} roulette-black" name="nblack" value="{{ old('nblack') }}" placeholder="Black">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n3rd12') ? ' is-invalid' : '' }}" name="n3rd12" value="{{ old('n3rd12') }}" placeholder="3rd 12">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('nodd') ? ' is-invalid' : '' }}" name="nodd" value="{{ old('nodd') }}" placeholder="Odd">
                </div>
            </div>
            <div class="form-group row mb-1">
                <div class="col">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n19to36') ? ' is-invalid' : '' }}" name="n19to36" value="{{ old('n19to36') }}" placeholder="19 to 36">
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
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n0') ? ' is-invalid' : '' }}" name="n0" value="{{ old('n0') }}" placeholder="0">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n1') ? ' is-invalid' : '' }}" name="n1" value="{{ old('n1') }}" placeholder="1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n2') ? ' is-invalid' : '' }}" name="n2" value="{{ old('n2') }}" placeholder="2">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n3') ? ' is-invalid' : '' }}" name="n3" value="{{ old('n3') }}" placeholder="3">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n4') ? ' is-invalid' : '' }}" name="n4" value="{{ old('n4') }}" placeholder="4">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n5') ? ' is-invalid' : '' }}" name="n5" value="{{ old('n5') }}" placeholder="5">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n6') ? ' is-invalid' : '' }}" name="n6" value="{{ old('n6') }}" placeholder="6">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n7') ? ' is-invalid' : '' }}" name="n7" value="{{ old('n7') }}" placeholder="7">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n8') ? ' is-invalid' : '' }}" name="n8" value="{{ old('n8') }}" placeholder="8">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n9') ? ' is-invalid' : '' }}" name="n9" value="{{ old('n9') }}" placeholder="9">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n10') ? ' is-invalid' : '' }}" name="n10" value="{{ old('n10') }}" placeholder="10">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n11') ? ' is-invalid' : '' }}" name="n11" value="{{ old('n11') }}" placeholder="11">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n12') ? ' is-invalid' : '' }}" name="n12" value="{{ old('n12') }}" placeholder="12">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n13') ? ' is-invalid' : '' }}" name="n13" value="{{ old('n13') }}" placeholder="13">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n14') ? ' is-invalid' : '' }}" name="n14" value="{{ old('n14') }}" placeholder="14">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n15') ? ' is-invalid' : '' }}" name="n15" value="{{ old('n15') }}" placeholder="15">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n16') ? ' is-invalid' : '' }}" name="n16" value="{{ old('n16') }}" placeholder="16">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n17') ? ' is-invalid' : '' }}" name="n17" value="{{ old('n17') }}" placeholder="17">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n18') ? ' is-invalid' : '' }}" name="n18" value="{{ old('n18') }}" placeholder="18">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n19') ? ' is-invalid' : '' }}" name="n19" value="{{ old('n19') }}" placeholder="19">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n20') ? ' is-invalid' : '' }}" name="n20" value="{{ old('n20') }}" placeholder="20">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n21') ? ' is-invalid' : '' }}" name="n21" value="{{ old('n21') }}" placeholder="21">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n22') ? ' is-invalid' : '' }}" name="n22" value="{{ old('n22') }}" placeholder="22">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n23') ? ' is-invalid' : '' }}" name="n23" value="{{ old('n23') }}" placeholder="23">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n24') ? ' is-invalid' : '' }}" name="n24" value="{{ old('n24') }}" placeholder="24">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n25') ? ' is-invalid' : '' }}" name="n25" value="{{ old('n25') }}" placeholder="25">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n26') ? ' is-invalid' : '' }}" name="n26" value="{{ old('n26') }}" placeholder="26">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n27') ? ' is-invalid' : '' }}" name="n27" value="{{ old('n27') }}" placeholder="27">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n28') ? ' is-invalid' : '' }}" name="n28" value="{{ old('n28') }}" placeholder="28">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n29') ? ' is-invalid' : '' }}" name="n29" value="{{ old('n29') }}" placeholder="29">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n30') ? ' is-invalid' : '' }}" name="n30" value="{{ old('n30') }}" placeholder="30">
                </div>
            </div>
            <div class="form-group mb-1 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n31') ? ' is-invalid' : '' }}" name="n31" value="{{ old('n31') }}" placeholder="31">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n32') ? ' is-invalid' : '' }}" name="n32" value="{{ old('n32') }}" placeholder="32">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n33') ? ' is-invalid' : '' }}" name="n33" value="{{ old('n33') }}" placeholder="33">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n34') ? ' is-invalid' : '' }}" name="n34" value="{{ old('n34') }}" placeholder="34">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n35') ? ' is-invalid' : '' }}" name="n35" value="{{ old('n35') }}" placeholder="35">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n36') ? ' is-invalid' : '' }}" name="n36" value="{{ old('n36') }}" placeholder="36">
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-4 col-md-2 col-lg-2 pr-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n2to11') ? ' is-invalid' : '' }}" name="n2to11" value="{{ old('n2to11') }}" placeholder="2 to 1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 p-0">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n2to12') ? ' is-invalid' : '' }}" name="n2to12" value="{{ old('n2to12') }}" placeholder="2 to 1">
                </div>
                <div class="col-4 col-md-2 col-lg-2 pl-1">
                    <input type="number" class="form-control form-control-sm text-center{{ $errors->has('n2to13') ? ' is-invalid' : '' }}" name="n2to13" value="{{ old('n2to13') }}" placeholder="2 to 1">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection