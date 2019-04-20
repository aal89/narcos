@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Reset Password') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session('status'))
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-success mb-0" role="alert">
                                        {{ session('status') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
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
                            <td>&nbsp;</td>
                            <td>
                                <div class="col-md-8 col-lg-8">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Send Password Reset Link') }}
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
