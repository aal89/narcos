<?php
if (!function_exists('cooldownForAsset')) {

    /**
     * Returns an integer for a particular given 'grade' (level) and a count (
     * the amount of times that crime has already been committed). This integer
     * is between 0 and 100, but never surpasses those bounds.
     *
     * @param int $count
     * @param int $grade
     * @return int
     */
    function calculateCrimePercentage(int $count, int $grade)
    {
        // experience is the amount divided by the level of hardness of that crime
        // exp is floored to make it a bit harder
        $experience = floor($count / $grade);
        // the fluctuations are around +- 10, but the percentage fluctuates around
        // it's lowest bound and what it actually is, so the random is between
        // exp -10 and exp.
        $result = rand(($experience - 10), $experience);
        // then set the cutoffs at 0 and 95, mix in the $result and return it
        return min(95, max(0, $result));
    }
}
