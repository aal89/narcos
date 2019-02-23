<?php
if (!function_exists('moneyToWealth')) {

    /**
     * Converts an integer (money) to a string (wealth indicator).
     *
     * @param string $money
     * @return boolean
     */
    function moneyToWealth($money)
    {
        if ($money < 1000)
        {
            return 'Broke';
        }

        if ($money > 1001 && $money < 100000)
        {
            return 'Getting by';
        }

        if ($money > 100001 && $money < 1000000)
        {
            return 'Rich';
        }

        if ($money > 1000001 && $money < 10000000)
        {
            return 'Nouveau riche';
        }

        if ($money > 10000001 && $money < 200000000)
        {
            return 'Plutocrat';
        }

        if ($money > 200000001)
        {
            return 'Parvenu';
        } 

        return 'Broke';
    }
}
