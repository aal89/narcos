<?php
if (!function_exists('convertNarcoScript')) {

    /**
     * Replaces all occurences of the narco script into equivalent html entities.
     *
     * @param string $str
     * @return string
     */
    function convertNarcoScript($str)
    {
        $str = str_replace(':title-m:', '<h3>', $str);
        $str = str_replace(':/title-m:', '</h3>', $str);

        $str = str_replace(':b:', '<b>', $str);
        $str = str_replace(':/b:', '</b>', $str);

        $str = str_replace(':br:', '<br>', $str);
        $str = str_replace(':/br:', '</br>', $str);

        $str = str_replace(':img:', '<img src="', $str);
        $str = str_replace(':/img:', '" style="max-width: 100%;" />', $str);

        return $str;
    }
}
