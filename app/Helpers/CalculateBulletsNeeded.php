<?php
if (!function_exists('calculateBulletsNeeded')) {

    /**
     * Returns an integer indicating the bullets needed to 100% kill some character
     * for a given experience count.
     *
     * @param int $exp
     * @return int
     */
    function calculateBulletsNeeded(int $exp)
    {
        return 8998 + (196 - 8998) / (1 + pow(($exp / 707677), 0.5319177));
    }
}
