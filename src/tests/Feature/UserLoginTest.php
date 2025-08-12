<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create(['email' => 'test @example . com', 'password' => bcrypt('test1024'),]);

        $response = $this->post('/login', ['email' => 'test @example . com', 'password' => 'test1024']);

        $response->assertRedirect('/weight_logs');
        $this->assertAuthenticatedAs($user);
    }
}
