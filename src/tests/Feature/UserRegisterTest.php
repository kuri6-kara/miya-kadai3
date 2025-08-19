<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_新規会員登録ステップ1画面()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);

        $response->assertSeeInOrder(['PiGLy', '新規会員登録', 'STEP1 アカウント情報の登録' ]);
    }

    public function test_新規会員登録ステップ1_入力項目()
    {
        $step1Data = [
            'name' => '山田花子',
            'email' => 'test@example.com',
            'password' => 'test1024',
        ];

        $response = $this->post('/register/step1', $step1Data);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register/step2');

        $step2Data = [
            'current_weight' => '55.5',
            'target_weight' => '46.5',
        ];

        $response = $this->post('/register/step2', array_merge($step1Data, $step2Data));

        $response->assertRedirect('/weight_logs');

    }

    // public function test_新規会員登録ステップ1_リンクボタン()
    // {
    //     $response->assertSee('次に進む');

    //     $response->assertSee('ログインはこちら');
    // }
}
