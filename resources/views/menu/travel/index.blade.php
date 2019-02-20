@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_paperplane"></span> {{ __('Travel') }}</h3>
<p>
    Traveling allows you buy and sell narcotics in other countries. This can be lucrative business. In different countries you'll have
    different map layouts. Try to find an open spot and setup a farm to further increase your income.
</p>
@if ($errors->has('country'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('country') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form method="POST" action="/travel">
@csrf
    <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th colspan="2">{{ __('Countries') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-25">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country" id="radio1" value="colombia" checked>
                        <label class="form-check-label" for="radio1">
                            Colombia
                        </label>
                    </div>
                </td>
                <td>&euro;500,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country" id="radio2" value="puerto rico">
                        <label class="form-check-label" for="radio2">
                            Puerto Rico
                        </label>
                    </div>
                </td>
                <td>&euro;650,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country" id="radio3" value="mexico">
                        <label class="form-check-label" for="radio3">
                            Mexico
                        </label>
                    </div>
                </td>
                <td>&euro;800,-</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country" id="radio4" value="united states of america">
                        <label class="form-check-label" for="radio4">
                            United States of America
                        </label>
                    </div>
                </td>
                <td>&euro;1000,-</td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-secondary" type="submit">Travel</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@endsection