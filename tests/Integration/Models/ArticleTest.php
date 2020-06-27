<?php

namespace Tests\Integration\Models;


use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_fetches_trending_articles (){

        //Given
        factory(Article::class, 3)->create();
        factory(Article::class,)->create(['reads'=>10]);
        $mostPopular = factory(Article::class)->create(['reads'=>20]);

        //When
        $articles = Article::trending();

        //Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3,$articles);

        //When
        $articles = Article::trending(4);
        //Then
        $this->assertCount(4,$articles);
    }
}
