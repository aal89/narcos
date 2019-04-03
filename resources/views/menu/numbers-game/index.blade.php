@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_banknote"></span> {{ __('Numbers game') }}</h3>
<p>
    Feeling lucky? Here to offer a wager? Go ahead and guess any number under 10. Bet minimum is &euro;100,- and maximum is &euro;100.000,-.
    Payout is 10x.
</p>
@include('session.status')
<form method="POST" action="/numbers-game">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Numbers game') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Guess</td>
                <td>
                    <div class="col-md-8 col-lg-6 pl-0">
                        <div class="form-group input-group-sm mb-0">
                            <input type="number" min="1" max="10" class="form-control{{ $errors->has('guess') ? ' is-invalid' : '' }}" name="guess" value="{{ old('guess') }}" placeholder="Guess (e.g. 7)" required>
                            @if ($errors->has('guess'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('guess') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Bet</td>
                <td>
                    <div class="col-md-8 col-lg-6 pl-0">
                        <div class="form-group input-group-sm mb-0">
                            <input min="100" max="100000" type="number" class="form-control{{ $errors->has('bet') ? ' is-invalid' : '' }}" name="bet" value="{{ old('bet') }}" placeholder="Bet (e.g. 100)" required>
                            @if ($errors->has('bet'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bet') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><button class="btn btn-secondary" type="submit">Wager</button></td>
            </tr>
        </tbody>
    </table>
</form>
@endsection