<?php
if (!function_exists('generateBulletsAndCost')) {

    /**
     * Returns an array containing two elements. First one is amount of bullets
     * the second one is the price they should go for.
     * @return array
     */
    function generateBulletsAndCost()
    {
        $bullets = rand(500, 1500);
        $cost = rand(350, 1200);
        return [$bullets, $cost];
    }
}
