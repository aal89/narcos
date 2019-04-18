@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_fire"></span> {{ __('Trivial crime') }}</h3>
<p>
    Committing trivial crimes are ideal to bring in some cash and experience, do them often. The pass rate (%) is only an indication and crimes have a two minute cooldown.
</p>
@include('session.status')
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
                <td>
                    <div class="">
                        <input class="" type="radio" name="crime" id="radio1" value="1" checked>
                        <label class="form-check-label" for="radio1">
                            Mug a teenager and sells his alcohol and cigarettes.
                        </label>
                    </div>
                </td>
                <td class="cell-fit">{{ $crime1Percentage }}% chance</td>
            </tr>
            <tr>
                <td>
                    <div class="">
                        <input class="" type="radio" name="crime" id="radio2" value="2">
                        <label class="form-check-label" for="radio2">
                            Rob a gasstation to plunder the register.
                        </label>
                    </div>
                </td>
                <td>{{ $crime2Percentage }}% chance</td>
            </tr>
            <tr>
                <td>
                    <div class="">
                        <input class="" type="radio" name="crime" id="radio3" value="3">
                        <label class="form-check-label" for="radio3">
                            Break into a home of a local narco and take the very first thing you see.
                        </label>
                    </div>
                </td>
                <td>{{ $crime3Percentage }}% chance</td>
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