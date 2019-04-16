<?php
if (!function_exists('generateLabYield')) {

    /**
     * Generates a random amount of kgs. Amount is between 0.25 and 0.5.
     *
     * @return int $float
     */
    function generateLabYield()
    {
        return (float)(0.25 + (rand(0, 25) / 100));
    }
}
