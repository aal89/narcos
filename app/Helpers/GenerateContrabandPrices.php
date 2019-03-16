<?php
if (!function_exists('generateContrabandPrices')) {

    /**
     * Returns an associative array containing several elements (for each country one, where
     * country is the key) wherein all the prices for narcotics are listed (also as an
     * associative array). Example:
     * [
     *   'colombia' => [
     *     'weed' => 100,
     *     ...
     *    ],
     *    ...
     * ];
     * @return array
     */
    function generateContrabandPrices()
    {
        $nrCountries = 4;
        $nrNarcoticTypes = 4;
        // construct an array with random prices in the same range
        $prices = array_map(function ($element) {
            return rand(400, 600);
        }, array_fill(0, $nrCountries * $nrNarcoticTypes, 0));
        // add one higher than the rest
        $prices[0] = rand(700, 900);
        // shuffle the array so that the drug route becomes random
        shuffle($prices);
        return [
            'colombia' => [
                'weed' => $prices[0],
                'lsd' => $prices[1],
                'speed' => $prices[2],
                'cocaine' => $prices[3]
            ],
            'mexico' => [
                'weed' => $prices[4],
                'lsd' => $prices[5],
                'speed' => $prices[6],
                'cocaine' => $prices[7]
            ],
            'puerto rico' => [
                'weed' => $prices[8],
                'lsd' => $prices[9],
                'speed' => $prices[10],
                'cocaine' => $prices[11]
            ],
            'united states of america' => [
                'weed' => $prices[12],
                'lsd' => $prices[13],
                'speed' => $prices[14],
                'cocaine' => $prices[15]
            ]
        ];
    }
}
