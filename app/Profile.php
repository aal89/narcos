<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    /**
     * Returns the characters profile description filtered for any user entered html
     * tags and converted into narcoscript (which essentially converts narcotags back
     * into html tags). This string can be considered safe.
     */
    public function description()
    {
        return convertNarcoScript(htmlentities($this->description));
    }
}
