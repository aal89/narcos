@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_shop"></span> {{ __('Map') }}</h3>
@include('session.status')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <p>Buying property is</p>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
    <img src="/colombia.png" class="img-thumbnail" />
    </div>
</div>
@endsection
