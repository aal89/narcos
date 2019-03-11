<div class="row">
    <div class="col-sm text-right">
        <h4>The driver</h4>
        <p>Minimum rank required: <b>Low-life</b>. Payout: 20%.</p>
        <div class="w-50 mb-3 float-right">
            @include('menu.organized-crime.member.options', ['member' => 'driver'])
        </div>
    </div>
    <div class="col-sm">
        <h4>The spotter</h4>
        <p>Minimum rank required: <b>Hitman</b>. Payout: 30%.</p>
        <div class="w-50 mb-3">
            @include('menu.organized-crime.member.options', ['member' => 'spotter'])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm text-center">
        <h4>The robber</h4>
        <p>Minimum rank required: <b>Lieutenant</b>. Payout: 50%.</p>
        <div class="">
            {{-- LOH: this include is probably not necessary, removing will probably simplify the options view too. Research. --}}
            @include('menu.organized-crime.member.options', ['member' => 'robber'])
        </div>
    </div>
</div>
@if ($party->driver !== null && $party->robber !== null && $party->spotter !== null)
<div class="row mt-5">
    <div class="col-sm text-center">
        <button type="button" class="btn btn-primary btn-lg">Attempt</button>
    </div>
</div>
@endif