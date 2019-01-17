<?php
if (!function_exists('notVerified')) {

    /**
     * Returns true if the application is in development mode and the given variable is not equal to: 'verified'.
     *
     * @param string $var
     * @return boolean
     */
    function notVerified($var)
    {
        return $var !== 'verified';
    }
}
