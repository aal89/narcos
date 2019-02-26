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
        if ($money < 1001)
        {
            return 'Broke';
        }

        if ($money > 1000 && $money < 100001)
        {
            return 'Getting by';
        }

        if ($money > 100000 && $money < 1000001)
        {
            return 'Rich';
        }

        if ($money > 1000000 && $money < 10000001)
        {
            return 'Nouveau riche';
        }

        if ($money > 10000000 && $money < 200000001)
        {
            return 'Plutocrat';
        }

        if ($money > 200000000)
        {
            return 'Parvenu';
        } 

        return 'Broke';
    }
}
