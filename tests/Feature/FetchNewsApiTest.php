<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\ApiNewsController
 */
class FetchNewsApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $news;

    protected function setUp(): void
    {
        parent::setUp();

        $this->news = factory(News::class, 50)->create();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_returns_a_paginated_news_collection()
    {
        $this->getJson(route('api.news.index'))
            ->assertOk()
            ->assertJsonStructure(['data' => ['*' => [
                'id',
                'publisher',
                'title',
                'body',
                'created_at',
                'updated_at', ],
            ], 'links', 'meta']);
    }

    /** @test */
    public function it_returns_a_single_news_item()
    {
        $this->getJson(route('api.news.show', ['news' => $this->news->last()]))
            ->assertOk();
    }
}
