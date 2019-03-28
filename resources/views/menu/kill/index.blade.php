@extends('layouts.basic')

@section('page')
<h3 class="page-title"><img src="/weapon_icon.svg" height="23"> {{ __('Kill') }}</h3>
<p>
    Beef with someone? Or the next guy in line being weaker and holding you up? Solve it yourself. Death is forever, plus
    if you're succesful you can rob the person too. Make some money while you're at it.
</p>
@include('session.status')
<form method="POST" action="/kill" id="form-1">
@csrf
    <table class="table table-sm table-dark w-75">
        <thead>
            <tr>
                <th colspan="2">{{ __('Kill') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Character
                </td>
                <td>
                    <div class="form-group input-group-sm mb-0">
                        <input form="form-1" type="text" class="form-control{{ $errors->has('character') ? ' is-invalid' : '' }}" name="character" value="{{ old('character') }}" placeholder="Character" required>
                        @if ($errors->has('character'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('character') }}</strong>
                            </span>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td class="w-25">
                    Bullets
                </td>
                <td>
                    <div class="form-group input-group-sm mb-0">
                        <input form="form-1" type="number" class="form-control{{ $errors->has('bullets') ? ' is-invalid' : '' }}" name="bullets" value="{{ old('bullets') }}" placeholder="Amount (e.g. 1)" required>
                        @if ($errors->has('bullets'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bullets') }}</strong>
                            </span>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Bring a crew <small>(&euro;1.000.000,-)</small><br>
                    <small class="text-muted">Greatly increases the chance nobody witnesses you attempting this murder.</small>
                </td>
                <td>
                    <div class="form-group input-group-sm mb-0">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="crew">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    <button class="btn btn-danger" type="submit">Attempt</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@endsection