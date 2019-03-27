@extends('layouts.basic')

@section('page')
<h3 class="page-title"><img src="/weapon_icon.svg" height="23"> {{ __('Kill') }}</h3>
<p>
    Beef with someone? Or the next guy in line being weaker and holding you up? Solve it yourself. Death is forever, plus
    if you're succesful you can rob the person too. Make some money while you're at it.
</p>
@include('session.status')
<table class="table table-sm table-dark">
    <thead>
        <tr>
            <th colspan="4">{{ __('Resources to use') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="form-group input-group-sm mb-0">
                    <input form="form-1" id="bullets" type="number" class="form-control{{ $errors->has('bullets') ? ' is-invalid' : '' }}" name="id1" value="{{ old('bullets') }}" placeholder="Amount (e.g. 1)" required>
                    @if ($errors->has('bullets'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('bullets') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
        </tr>
    </tbody>
</table>
@endsection