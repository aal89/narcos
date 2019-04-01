@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form method="POST" action="{{ route('character.release') }}">
            @csrf
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th><span aria-hidden="true" class="li_user"></span> {{ __('Character death') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <h3>Game over</h3>
                                Someone somewhere got to you. You were killed and can no longer play as {{ Auth::user()->character->name }}.
                                You could release this character and start over. But that's up to you, for now its game over. 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Release character') }}
                                </button>
                                <a href="{{ route('logout') }}" class="btn btn-link float-right"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
