@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_user"></span> {{ $character->name }}</h3>
<div class="container">
    {{ $character->isOwn }}
</div>
@endsection
