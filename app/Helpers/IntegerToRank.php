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
        if ($exp < 101)
        {
            return 'Low-life';
        }

        if ($exp > 100 && $exp < 1001)
        {
            return 'Falcon';
        }

        if ($exp > 1000 && $exp < 10001)
        {
            return 'Hitmen';
        }

        if ($exp > 10000 && $exp < 100001)
        {
            return 'Lieutenant';
        }

        if ($exp > 100000 && $exp < 1000001)
        {
            return 'Drug lord';
        }

        if ($exp > 1000000)
        {
            return 'Kingpin';
        } 

        return 'Low-life';
    }
}
