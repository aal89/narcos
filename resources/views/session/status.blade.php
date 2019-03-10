@if (isset($status))
    {!! '<p><font color=green><strong>'.$status.'</strong></font></p>' !!}
@endif
@if (session('status') || isset($status))
    {!! '<p><font color=green><strong>'.session('status').'</strong></font></p>' !!}
@endif
@if ($errors->has('general'))
    {!! '<p><font color=red><strong>'.$errors->first('general').'</strong></font></p>' !!}
@endif