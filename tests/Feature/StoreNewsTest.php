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
class StoreNewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var array
     */
    private $form;
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

        $this->form = factory(News::class)->make()->toArray();

        $this->seed(RoleSeeder::class);

        $this->user = factory(User::class)->create(['role_id' => Role::whereName('user')->first()->id]);
        $this->admin = factory(User::class)->create(['role_id' => Role::whereName('admin')->first()->id]);

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guest_users_can_not_submit_form_to_store_news_item()
    {
        $this->expectException(AuthenticationException::class);

        $this->post(route('news.store'));
    }

    /** @test */
    public function unauthorized_users_can_not_submit_form_to_store_news_item()
    {
        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->post(route('news.store', $this->form));
    }

    /** @test */
    public function authenticated_admins_can_submit_form_to_store_news_item()
    {
        $this->actingAs($this->admin);

        $this->post(route('news.store', $this->form));

        $this->assertDatabaseHas('news', [
            'publisher_id' => $this->admin->id,
            'category_id'  => $this->form['category_id'],
            'title'        => $this->form['title'],
            'body'         => $this->form['body'],
        ]);
    }
}
