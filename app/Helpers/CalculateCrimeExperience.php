<?php
if (!function_exists('calculateCrimeExperience')) {

    /**
     * Returns an integer indicating a result from a probable successful crime.
     *
     * @param string $grade
     * @return int
     */
    function calculateCrimeExperience(int $grade, int $multiplier = 1)
    {
        switch ($grade)
        {
            case 1: return floor(rand(5, 25) * $multiplier);
            case 2: return floor(rand(15, 85) * $multiplier);
            case 3: return floor(rand(55, 155) * $multiplier);
            default: return floor(rand(5, 25) * $multiplier);
        }
    }
}
