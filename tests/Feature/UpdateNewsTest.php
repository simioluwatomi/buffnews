<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\NewsController
 */
class UpdateNewsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
    public function guests_can_not_submit_form_to_update_user()
    {
        $this->expectException(AuthenticationException::class);

        $this->patch(route('news.update', ['news' => $this->news]));
    }

    /** @test */
    public function authenticated_users_can_not_submit_form_to_update_user()
    {
        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->patch(route('news.update', ['news' => $this->news]));
    }

    /** @test */
    public function authenticated_admins_can_update_news_item()
    {
        $this->actingAs($this->admin);

        $form = [
            'category_id' => factory(Category::class)->create()->id,
            'title'       => $this->faker->sentence,
            'body'        => $this->faker->paragraph,
        ];

        $this->patch(route('news.update', ['news' => $this->news]), $form);

        $this->assertEquals($form['title'], $this->news->fresh()->title);
        $this->assertEquals($form['body'], $this->news->fresh()->body);
    }
}
