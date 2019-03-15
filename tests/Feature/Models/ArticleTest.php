<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_trending_articles()
    {
        // Given
        factory(Article::class, 3)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        // When
        $articles = Article::trending();

        // Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(5, $articles);

    }
}
