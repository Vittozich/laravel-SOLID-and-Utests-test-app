<?php

namespace App\Classes;

class BladeDirective
{
    protected $cache;
    public function __construct(RussianCache $cache)
    {
        $this->cache = $cache;
    }

    public function foo(){

    }

    public function setUp($key)
    {
        $this->cache->has(
            $this->normalizeKey($key)
        );
    }

    protected function normalizeKey($item)
    {
        if (is_object($item) && method_exists($item, 'getCacheKey')){
            return $item->getCacheKey();
        }
        if (is_array($item)){
            return md5(implode($item));
        }

        return $item;
    }
}
