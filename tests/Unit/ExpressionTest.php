<?php

namespace Tests\Unit;

use App\Classes\Expression;
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{

    /** @test */
    public function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');

        $this->assertRegExp($regex, 'www');


        $regex = Expression::make()->then('www');

        $this->assertRegExp($regex, 'www');
    }

    /** @test */
    public function it_checks_for_anything()
    {
        $regex = Expression::make()->anything();
        $this->assertRegExp($regex, 'foo');
    }

    /** @test */
    public function it_maybe_has_a_value()
    {
         $regex = Expression::make()->maybe('http');

        $this->assertRegExp($regex, 'http');
        $this->assertRegExp($regex, '');
    }

    /** @test */
    public function in_can_chain_method_calls()
    {
        $regex = Expression::make()->find('Vittozich')->maybe('.')->then('com');

        $this->assertRegExp($regex, 'Vittozich.com');
        $this->assertRegExp($regex, 'Vittozichcom');
        $this->assertNotRegExp($regex, 'VittozichDcom');
        $this->assertNotRegExp($regex, 'VittozichDsdfsdfcom');
    }

    /** @test */
    public function it_can_exclude_values()
    {
        $regex = Expression::make()
            ->find('foo')
            ->anythingBut('bar')
            ->then('biz');

        $this->assertRegExp($regex, 'foobazbiz');
        $this->assertNotRegExp($regex, 'foobarbiz');
    }
}
