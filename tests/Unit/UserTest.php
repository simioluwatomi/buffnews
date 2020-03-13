<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\User
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'role_id'    => factory(Role::class)->create()->id,
            'email'      => 'janedoe@example.com',
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'password'   => bcrypt('secret'),
        ]);
    }

    /** @test */
    public function it_has_an_email_attribute()
    {
        $this->assertEquals('janedoe@example.com', $this->user->email);
    }

    /** @test */
    public function it_has_a_first_name_attribute()
    {
        $this->assertEquals('Jane', $this->user->first_name);
    }

    /** @test */
    public function it_has_a_last_name_attribute()
    {
        $this->assertEquals('Doe', $this->user->last_name);
    }

    /** @test */
    public function it_has_a_full_name_attribute()
    {
        $this->assertEquals('Jane Doe', $this->user->full_name);
    }

    /** @test */
    public function it_has_an_initials_attribute()
    {
        $this->assertEquals('JD', $this->user->initials);
    }

    /** @test */
    public function it_has_a_password_attribute()
    {
        $this->assertTrue(Hash::check('secret', $this->user->password));
    }

    /** @test */
    public function it_publishes_news()
    {
        $this->assertInstanceOf(Collection::class, $this->user->news);
    }

    /** @test */
    public function it_has_a_role()
    {
        $this->assertInstanceOf(Role::class, $this->user->role);
    }
}
