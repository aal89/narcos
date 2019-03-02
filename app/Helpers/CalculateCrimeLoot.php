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
            case 1: return rand(5, 25);
            case 2: return rand(15, 85);
            case 3: return rand(55, 255);
            default: return rand(5, 25);
        }
    }
}
