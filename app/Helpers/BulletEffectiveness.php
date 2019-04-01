<?php
if (!function_exists('bulletEffectiveness')) {

    /**
     * Some bullets used will shard, other might just be duds and never fire.
     * This method will return an integer indicating the effectiveness of all
     * bullets. This is a figure random between 0.9-1.0. Up to 10% bullet loss.
     *
     * @return int
     */
    function bulletEffectiveness()
    {
        return 0.9 + (rand(0, 10) / 100);
    }
}
