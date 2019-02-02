<?php
if (!function_exists('isForbiddenCharacterName')) {

    /**
     * Checks if the given string is contained in a list of forbidden character names.
     *
     * @param string $name
     * @return boolean
     */
    function isForbiddenCharacterName($name)
    {
        return in_array($name, [
            'delete',
            'Delete',
            'deleted',
            'Deleted',
            'admin',
            'Admin',
            'moderator',
            'Moderator'
        ]);
    }
}
