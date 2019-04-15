<?php
if (!function_exists('isTileForSale')) {

    /**
     * Checks if a given integer as tile is available for purchase for a given
     * string as country. Returns false for unknown countries.
     *
     * @param string $country
     * @param int $tile
     * @return boolean
     */
    function isTileForSale(string $country, int $tile)
    {
        // array to hold all sellable tile numbers
        $colombia = [
            1, 2, 3, 6, 7, 8, 9, 12, 13, 14, 15, 16, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
            31, 32, 33, 34, 35, 38, 39, 40, 44, 45, 46
        ];
        if (isset(${$country})) {
            return in_array($tile, ${$country});
        }
        return false;
    }
}
