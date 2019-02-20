<?php
if (!function_exists('inflateAmount')) {

    /**
     * Increases any given amount with preset interest rates.
     * > 0      12%
     * > 50000	10%
     * > 100000	9%
     * > 250000	8%
     * > 500000	7%
     * > 1000000	6%
     * > 10000000	2%
     *
     * @param int $amount
     * @return int
     */
    function inflateAmount(int $amount)
    {
        if ($amount < 50000)
        {
            return floor($amount * 1.12);
        }

        if ($amount > 50000 && $amount < 100000)
        {
            return floor($amount * 1.10);
        }

        if ($amount > 100001 && $amount < 250000)
        {
            return floor($amount * 1.09);
        }

        if ($amount > 250001 && $amount < 500000)
        {
            return floor($amount * 1.08);
        }

        if ($amount > 500001 && $amount < 1000000)
        {
            return floor($amount * 1.07);
        }

        if ($amount > 1000001 && $amount < 10000000)
        {
            return floor($amount * 1.06);
        }

        if ($amount > 10000001)
        {
            return floor($amount * 1.02); 
        }

        return 'Low-life';
    }
}
