<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class CacheableUntil
{

    /**
     * @param $key
     * @param $tags
     * @param $callable callable<CacheResultsWithDuration>
     * @return array|mixed|null
     */
    public function cacheUntil()
    {
        return function (string $key, array $tags, callable $callable) {
            if (Cache::tags($tags)->has($key)) {
                return Cache::tags($tags)->get($key);
            }

            /** @var CacheResultsWithDuration $cacheableResult */
            $cacheableResult = $callable();
            if (null !== $cacheableResult) {
                Cache::tags($tags)->put($key, $cacheableResult->result, $cacheableResult->seconds);

                return $cacheableResult->result;
            }

            return null;
        };
    }
}
