<?php
if (!function_exists('calculateOrganizedCrimeLoot')) {

    /**
     * Returns an two integers (money + exp) indicating a result for a probable successful organized
     * crime.
     *
     * @return array First element is the amount of money made, second is the amount of exp.
     */
    function calculateOrganizedCrimeLoot()
    {
        return [rand(5000, 25000), rand(100, 300)];
    }
}
