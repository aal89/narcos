@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Register') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="name" class="col-form-label">{{ __('Name') }}</label></td>
                            <td>
                                <div class="col-md-8 col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
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
                            <td>
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                            </td>
                            <td>
                                <div class="col-md-8 col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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
                                        <input id="password-confirm" type="password" name="password_confirmation" required="required" class="form-control">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                            <div class="col-md-8 col-lg-6">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Register') }}
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
