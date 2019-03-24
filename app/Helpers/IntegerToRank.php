<?php
if (!function_exists('integerToRank')) {

    /**
     * Converts an integer (experience) to a string (rank) in the form of an array. First
     * element is the rank number (low-life is rank 1, falcon rank 2, etc), and the
     * second element is the actual rank name itself.
     *
     * @param string $exp
     * @return boolean
     */
    function integerToRank($exp)
    {
        if ($exp < 101)
        {
            return [1, 'Low-life'];
        }

        if ($exp > 100 && $exp < 1001)
        {
            return [2, 'Falcon'];
        }

        if ($exp > 1000 && $exp < 10001)
        {
            return [3, 'Hitman'];
        }

        if ($exp > 10000 && $exp < 100001)
        {
            return [4, 'Lieutenant'];
        }

        if ($exp > 100000 && $exp < 1000001)
        {
            return [5, 'Drug lord'];
        }

        if ($exp > 1000000)
        {
            return [6, 'Kingpin'];
        } 

        return [1, 'Low-life'];
    }
}
