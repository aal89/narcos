@extends('layouts.messages')

@section('message-page')
<div class="container">
    <form method="POST" action="/messages/compose">
    @csrf
        <div class="row">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th colspan="2">{{ __('Compose') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-10">
                            <label for="character" class="col-form-label">Recipient</label>
                        </td>
                        <td>
                            <div class="col-md-8 col-lg-6">
                                <div class="input-group input-group-sm">
                                    <input id="character" type="input"  minlength="3" maxlength="25" class="form-control{{ $errors->has('character') ? ' is-invalid' : '' }}" name="character" value="{{ old('character') ? old('character') : $character }}" required>
                                    <br><small class="form-text text-muted">Enter the exact character name for which this message is meant.</small>
                                    @if ($errors->has('character'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('character') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="subject" class="col-form-label">Subject</label>
                        </td>
                        <td>
                            <div class="col-md-8 col-lg-6">
                                <div class="input-group input-group-sm">
                                    <input id="subject" type="input" maxlength="255" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') ? old('subject') : $subject }}" required maxlength="500">
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="message" class="col-form-label">Message</label>
                        </td>
                        <td>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group mb-0">
                                    <textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" rows="5" id="message" name="message" required autofocus maxlength="500">{{ old('message') }}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <div class="col-md-12 col-lg-12">
                                <button class="btn btn-secondary float-right" type="submit">Send</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
@endsection
