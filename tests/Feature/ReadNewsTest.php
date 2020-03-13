<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\NewsController
 */
class ReadNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homepage_shows_most_recently_published_news()
    {
        $this->withoutExceptionHandling();
        $news = factory(News::class, 40)->create();

        $this->get(route('news.index'))
            ->assertViewIs('news.index')
            ->assertViewHas('news', function () use ($news) {
                return $news->contains($news->first());
            });
    }

    /** @test */
    public function admins_can_read_a_news_item()
    {
        $this->withoutExceptionHandling();

        $news = factory(News::class)->create();

        $this->get(route('news.show', ['news' => $news]))
            ->assertViewIs('news.show')
            ->assertViewHas('newsItem', $news);
    }
}
