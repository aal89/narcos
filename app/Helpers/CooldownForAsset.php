<?php
if (!function_exists('cooldownForAsset')) {

    /**
     * Returns cooldown values for any given asset.
     *
     * @param string $asset
     * @return int
     */
    function cooldownForAsset($asset)
    {
        switch ($asset)
        {
            case 'none': return 90;
            case 'motor': return 60;
            case 'boat': return 45; 
            case 'plane': return 35;
        }
    }
}
