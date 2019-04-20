@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Reset Password') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="w-25">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                            </td>
                            <td>
                                <div class="col-md-8 col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                            </td>
                            <td>
                                <div class="col-md-8 col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                            </td>
                            <td>
                                <div class="col-md-8 col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <div class="col-md-8 col-lg-8">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
