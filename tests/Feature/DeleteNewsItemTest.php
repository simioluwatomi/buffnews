<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\NewsController
 */
class DeleteNewsItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $news;
    /**
     * @var User
     */
    private $user;
    /**
     * @var User
     */
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->seed(RoleSeeder::class);

        $this->news = factory(News::class, 10)->create();
        $this->user = factory(User::class)->create(['role_id' => Role::whereName('user')->first()->id]);
        $this->admin = factory(User::class)->create(['role_id' => Role::whereName('admin')->first()->id]);
    }

    /** @test */
    public function guests_can_not_delete_news_items()
    {
        $this->expectException(AuthenticationException::class);

        $this->delete(route('news.delete', ['news' => $this->news->last()]));
    }

    /** @test */
    public function authenticated_users_can_not_delete_news_items()
    {
        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->delete(route('news.delete', ['news' => $this->news->last()]));
    }

    /** @test */
    public function authenticated_admins_can_delete_news_items()
    {
        $this->actingAs($this->admin);

        $deletedNews = $this->news->last();

        $this->delete(route('news.delete', ['news' => $deletedNews]));

        $this->assertNotNull($deletedNews->fresh()->deleted_at);
    }
}
