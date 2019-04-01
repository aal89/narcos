<?php
if (!function_exists('weaponEffectiveness')) {

    /**
     * Returns an integer indicating a the effectiveness of a weapon.
     *
     * @param string $weapon
     * @return int
     */
    function weaponEffectiveness(string $weapon)
    {
        switch ($weapon)
        {
            case 'glock': return 0.7 + (rand(0, 10) / 100);
            case 'shotgun': return 0.8 + (rand(0, 10) / 100);
            case 'ak-47': return 0.9 + (rand(0, 10) / 100);
            case 'm-16': return 1.0;
            default: return 0.7 + (rand(0, 10) / 100);
        }
    }
}
