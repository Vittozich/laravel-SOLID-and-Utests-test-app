<?php

namespace Tests\Unit;

use App\Classes\BladeDirective;
use App\Classes\ModelStub;
use App\Classes\RussianCache;
use PHPUnit\Framework\TestCase;

class DiggingDipperUnitTest extends TestCase
{

    /** @test */
    public function test_something()
    {
        $directive = $this->prophesize(BladeDirective::class);
        $directive->foo('bar')->shouldBeCalled()->willReturn('foobar');
        $response = $directive->reveal()->foo('bar');
        $this->assertEquals('foobar', $response);
    }

    /** @test */
    public function it_normalizes_a_string_for_te_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive =  new BladeDirective($cache->reveal());

        $cache->has('cache-key')->shouldBeCalled();

        $directive->setUp('cache-key');
    }

    /** @test */
    public function it_normalizes_a_cacheable_model_for_te_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive =  new BladeDirective($cache->reveal());

        $cache->has('stub-cache-key')->shouldBeCalled();

        $directive->setUp(new ModelStub);
    }


    /** @test */
    public function it_normalizes_an_array_for_te_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive =  new BladeDirective($cache->reveal());

        $item = ['foo','bar'];
        $cache->has(md5('foobar'))->shouldBeCalled();

        $directive->setUp($item);
    }
}
