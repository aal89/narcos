@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_news"></span> {{ __('News') }}</h3>
<div class="container">
    <div class="row">
        <h5 class="text-secondary">Update #9</h5>
    </div>
    <div class="row">
        - Added online characters view and logic.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">27-02-2019 21:35 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #8</h5>
    </div>
    <div class="row">
        - Changed the way cooldowns are handled. It used to be in the backend datastore as persistent data. Now it is all saved in a cache.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">26-02-2019 23:30 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #7</h5>
    </div>
    <div class="row">
        - Added two store options (you can now buy a weapon and bullets).<br>
        - Changed what you see on the profile page.<br>
        - Added online indicator to the profile page.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">24-02-2019 23:34 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #6</h5>
    </div>
    <div class="row">
        - Added money transfer options at banking.<br>
        - Added a store where you can buy a transportation vehicle.<br>
        - Changed the way error messages and good messages are displayed.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">22-02-2019 21:25 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #5</h5>
    </div>
    <div class="row">
        - You can now deposit and withdraw money at the bank.<br>
        - You can now travel between the different countries.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">16-02-2019 16:07 by aal</span>
    </div>
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
