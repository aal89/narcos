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
        $countries = [
            'colombia' => [
                1, 2, 3, 6, 7, 8, 9, 12, 13, 14, 15, 16, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
                31, 32, 33, 34, 35, 38, 39, 40, 44, 45, 46
            ],
            'puerto rico' => [
                0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22
            ],
            'mexico' => [
                0, 1, 2, 7, 8, 9, 10, 14, 15, 16, 17, 18, 22, 23, 24, 25, 30, 31, 32, 33, 34, 34, 38, 39, 40
            ],
            'united states of america' => [
                0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26,
                30, 31, 33
            ]
        ];
        if (isset($countries[$country])) {
            return in_array($tile, $countries[$country]);
        }
        return false;
    }
}
