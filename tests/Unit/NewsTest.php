<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\News
 */
class NewsTest extends TestCase
{
    use RefreshDatabase;

    private $news;

    protected function setUp(): void
    {
        parent::setUp();

        $this->news = News::create([
            'publisher_id' => factory(User::class)->create()->id,
            'category_id'  => factory(Category::class)->create()->id,
            'title'        => 'This is a random news title',
            'body'         => 'This is a random news body',
        ]);
    }

    /** @test */
    public function it_has_a_title_attribute()
    {
        $this->assertEquals('This is a random news title', $this->news->title);
    }

    /** @test */
    public function it_has_a_body_attribute()
    {
        $this->assertEquals('This is a random news body', $this->news->body);
    }

    /** @test */
    public function it_has_a_slug_attribute()
    {
        $this->assertEquals(Str::slug('This is a random news title'), $this->news->slug);
    }

    /** @test */
    public function it_was_published_by_a_user()
    {
        $this->assertInstanceOf(User::class, $this->news->publisher);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->news->category);
    }
}
