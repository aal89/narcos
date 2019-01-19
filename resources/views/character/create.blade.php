@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form method="POST" action="{{ route('character.create') }}">
            @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2"><span aria-hidden="true" class="li_user"></span> {{ __('Character creation') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                If you're new to this game, welcome! If not; welcome back!
                                <br><br>
                                Before you can start playing the game you will need to create a character.
                                You will only be able to create one character per account. If you get killed by another player you will end up here again.
                                <br><br>
                                A character name is unique among all players, even dead ones. That means you cannot use names of passed characters, even if
                                it was your own character that died.
                                <br><br>
                                Think about your character name carefully you can't ever change it again later in game. Also any threathing and/or abusive name
                                will get a change-request from a moderator. So keep it nice.
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25"><label for="name" class="col-form-label">{{ __('Name') }}</label></td>
                            <td>
                                <div class="col-md-8 col-lg-8">
                                    <div class="form-group input-group-sm mb-0">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        <small class="form-text text-muted">This will be your publicly visible character name.</small>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                            <div class="col-md-10 col-lg-8">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Start playing') }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
