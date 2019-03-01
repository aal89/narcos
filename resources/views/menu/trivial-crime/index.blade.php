@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_fire"></span> {{ __('Trivial crime') }}</h3>
<p>
    Committing trivial crimes are ideal to bring in some cash and experience, do them often. The pass rate (%) is only an indication. Crimes have a two minute cooldown.
</p>
<form method="POST" action="/trivial-crime">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Crime') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-75">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio1" value="motor" checked>
                        <label class="form-check-label" for="radio1">
                            Mug a teenager and sells his alcohol.
                        </label>
                    </div>
                </td>
                <td>0% chance</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio2" value="boat">
                        <label class="form-check-label" for="radio2">
                            Rob a gasstation and take the register.
                        </label>
                    </div>
                </td>
                <td>0% chance</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="asset" id="radio3" value="plane">
                        <label class="form-check-label" for="radio3">
                            Break into a home of a local narco.
                        </label>
                    </div>
                </td>
                <td>0% chance</td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-secondary" type="submit" name="action" value="commit">Commit</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@endsection