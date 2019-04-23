<?php
if (!function_exists('calculateCrimeLoot')) {

    /**
     * Returns an integer indicating a result for a probable successful crime.
     *
     * @param string $grade
     * @return int
     */
    function calculateCrimeLoot(int $grade)
    {
        switch ($grade)
        {
            case 1: return rand(25, 65);
            case 2: return rand(55, 125);
            case 3: return rand(105, 255);
            default: return rand(5, 25);
        }
    }
}
