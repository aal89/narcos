@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            @if ($errors->has('top'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('top') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
            @yield('page')
        </div>
    </div>
</div>
@endsection
