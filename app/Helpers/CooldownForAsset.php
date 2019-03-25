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
            case 'motor': return 80;
            case 'boat': return 65; 
            case 'plane': return 35;
        }
    }
}
