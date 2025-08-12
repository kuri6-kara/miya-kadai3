<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/register/step1');

        $response->assertStatus(200);

        $response->assertSee('お名前');

        $response->assertSee('メールアドレス');

        $response->assertSee('パスワード');

        $response->assertSee('次に進む');

        $response->assertSee('ログインはこちら');
    }
}
