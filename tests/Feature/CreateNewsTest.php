<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
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
class CreateNewsTest extends TestCase
{
    use RefreshDatabase;

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

        $this->seed(RoleSeeder::class);

        $this->user = factory(User::class)->create(['role_id' => Role::whereName('user')->first()->id]);
        $this->admin = factory(User::class)->create(['role_id' => Role::whereName('admin')->first()->id]);
    }

    /** @test */
    public function guests_can_not_see_form_to_create_news()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->get(route('news.create'));
    }

    /** @test */
    public function authenticated_users_can_not_see_form_to_create_news()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->get(route('news.create'));
    }

    /** @test */
    public function authenticated_admins_can_see_form_to_create_news()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $this->get(route('news.create'))
            ->assertViewIs('news.create')
            ->assertViewHas('categories');
    }
}
