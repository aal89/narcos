<?php
if (!function_exists('integerToRank')) {

    /**
     * Converts an integer (experience) to a string (rank).
     *
     * @param string $exp
     * @return boolean
     */
    function integerToRank($exp)
    {
        if ($exp < 100)
        {
            return 'Low-life';
        }

        if ($exp > 101 && $exp < 1000)
        {
            return 'Falcon';
        }

        if ($exp > 1001 && $exp < 10000)
        {
            return 'Hitmen';
        }

        if ($exp > 10001 && $exp < 100000)
        {
            return 'Lieutenant';
        }

        if ($exp > 100001 && $exp < 1000000)
        {
            return 'Drug lord';
        }

        return 'Low-life';
    }
}
