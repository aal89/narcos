<?php
if (!function_exists('notVerifiedWhenLocal')) {

    /**
     * Returns true if the application is in development mode and the given variable is not equal to: 'verified'.
     *
     * @param string $var
     * @return boolean
     */
    function notVerifiedWhenLocal($var)
    {
        return App::isLocal() && $var !== 'verified';
    }
}
