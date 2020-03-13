<?php

namespace Tests\Feature;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use RoleSeeder;
use Tests\TestCase;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
class EditNewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var News
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

        $this->news = factory(News::class)->create();
        $this->user = factory(User::class)->create(['role_id' => Role::whereName('user')->first()->id]);
        $this->admin = factory(User::class)->create(['role_id' => Role::whereName('admin')->first()->id]);
    }

    /** @test */
    public function guest_users_can_not_see_form_to_edit_news()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('news.edit', ['news' => $this->news]));
    }

    /** @test */
    public function authenticated_users_can_not_see_form_to_edit_news()
    {
        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->get(route('news.edit', ['news' => $this->news]));
    }

    /** @test */
    public function authenticated_admins_can_see_form_to_edit_news()
    {
        $this->actingAs($this->admin);

        $this->get(route('news.edit', ['news' => $this->news]))
            ->assertViewIs('news.edit')
            ->assertViewHas('newsItem', $this->news);
    }
}
