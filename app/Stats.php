<?php

namespace App;

use Illuminate\Support\Facades\DB;

use App\Character;
use App\Counter;

class Stats
{
    public static function totalCharacters()
    {
        return Character::count();
    }

    public static function totalMoney()
    {
        return Character::all()->sum('money');
    }

    public static function totalBullets()
    {
        return Character::all()->sum('bullets');
    }

    public static function newestCharacter()
    {
        return Character::orderBy('created_at', 'desc')->first();
    }

    public static function highestRankingCharacter()
    {
        return Character::orderBy('experience', 'desc')->first();
    }

    public static function totalCrimeAttempts()
    {
        return Counter::all()->sum('trivial_crime');
    }

    public static function totalOrganizedCrimeAttempts()
    {
        return Counter::all()->sum('organized_crime');
    }

    public static function totalKillFail()
    {
        return Counter::all()->sum('kill_fail');
    }

    public static function totalKillSuccess()
    {
        return Counter::all()->sum('kill_success');
    }

    public static function totalNumbersGameLoss()
    {
        return Counter::all()->sum('numbers_game_loss');
    }

    public static function totalRouletteLoss()
    {
        return Counter::all()->sum('roulette_loss');
    }
}
