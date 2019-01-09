@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th>{{ __('Dashboard') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            You are logged in!
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
