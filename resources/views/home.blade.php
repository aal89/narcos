@extends('layouts.basic')

@section('page')
<h3 class="page-title"><span aria-hidden="true" class="li_news"></span> {{ __('News') }}</h3>
<div class="container">
    <div class="row">
        <h5 class="text-secondary">Update #16</h5>
    </div>
    <div class="row">
        - Updated two views (oc and store) to reflect changes of earlier updates.<br>
        - You can now offer a wager in a numbers game.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">03-04-2019 20:03 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #15</h5>
    </div>
    <div class="row">
        - Decreased the amount of experience given by the third trivial crime.<br>
        - The random witness for attacks is now chosen between the last 50 active characters in the same country.<br>
        - Failed and successful attacks are now being recorded.<br>
        - The attacked target in Kill is now always notified of the attack, however he/she does not always see who did it.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">02-04-2019 19:48 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #14</h5>
    </div>
    <div class="row">
        - Fixed a bug regarding the expiration of oc invites.<br>
        - Resolved two caching bugs. Oc groups now automatically disbanden and narcotic prices now vary every day.<br>
        - Implemented killing logic, you can now attempt killing each ohter. Death is forever, so think twice!<br>
        - Lowered the trivial crime percentage cap to 95%.<br>
        - Fixed an issue regarding html in received mails.<br>
        - Increased oc invite & oc party disband timeouts.<br>
        - Fixed some typos in the oc messages.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">02-04-2019 00:25 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #13</h5>
    </div>
    <div class="row">
        - Fix for internal counter for organized crime attempts per character.<br>
        - Fixed input size for smaller viewports on the organized crime page.<br>
        - Reversed cooldown times for traveling.<br>
        - Removed implicit text from narcotics trade page.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">25-03-2019 23:09 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #12</h5>
    </div>
    <div class="row">
        - Implemented narcotics trade, you can now buy and sell drugs around the globe.<br>
        - You can no longer create player names containing non alpanumeric characters.<br>
        - Resolved a bug where joining a party wouldn't check if the inviter was not on a cooldown (it only checked if the invitee was not on a cooldown).<br>
        - Attempting a robbery (organized crime) now requires all party members to be in the same country.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">24-03-2019 19:50 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #11</h5>
    </div>
    <div class="row">
        - Refactored contraband data, logics and migrations to support multiple types of contraband to buy and sell in the future.<br>
        - Finished organized crime, you can now attempt them!<br>
        - Added an all players page and restyled the online players page, they also have pagination now.<br>
        - Fixed several smaller issues.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">16-03-2019 14:32 by aal</span>
    </div>
    <div class="row">
        <h5 class="text-secondary">Update #10</h5>
    </div>
    <div class="row">
        - Changed and rewrote internal logics for some operational parts.<br>
        - Introduced trivial crimes, you can now make money and level up your character.<br>
    </div>
    <div class="row">
        <span class="small mt-2 mb-2">02-03-2019 14:37 by aal</span>
    </div>
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
