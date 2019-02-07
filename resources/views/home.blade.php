@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_news"></span> {{ __('News') }}</h3>
<div class="container">
    <div class="row">
        <h5 class="text-secondary">Update #4</h5>
    </div>
    <div class="row">
        - You can now send messages to each other.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">06-02-2019 19:28 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #3</h5>
    </div>
    <div class="row">
        - You can now view and edit your profile and see other peoples profiles.<br>
        - Designed and created NarcoScript to enhance profile editing.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">02-02-2019 13:58 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #2</h5>
    </div>
    <div class="row">
        - Rewrote great portions of the code.<br>
        - Added code to collapse menus by default on smaller devices.<br>
        - Deleted unused components.<br>
        - Added password reset for logged in users.<br>
        - Added errors (top) dialog.<br>
        - Finalized the top menu regarding functionality.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">26-01-2019 13:28 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #1</h5>
    </div>
    <div class="row">
        - Created character creation and death controllers, views and migrations.<br>
        - Created middleware to respond accordingly to character state (see above line).<br>
        - Cleanup code a lot.<br>
        - Added comments throughout code base.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">21-01-2019 21:23 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Development</h5>
    </div>
    <div class="row">
        Groundwork done.<br>
        - Scaffoulded out a authentication system.<br>
        - Created a css to reflect a mafia/narcos style game.<br>
        - Created logo.<br>
        - Setup environmental variables, so that emailing and verifying works etc.<br>
        - Setup deployment pipeline.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">13-01-2019 21:43 by aal</span>
    </div>
</div>
@endsection
