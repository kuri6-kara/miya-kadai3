<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class WeightRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_体重登録_登録完了()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/weight_logs/create', [
            'date' => "2023-10-27",
            'weight' => 75.5,
            'calories' => 1300,
            'exercise_time' => "00:00:10",
            'exercise_content' => "縄跳び",
            ]);

        // $this->assertDatabaseHas('weight_logs', [
        //     'user_id' => $user->id,
        //     'date' => "2023-10-27",
        //     'weight' => 75.5,
        //     'calories' => 1300,
        //     'exercise_time' => "00:00:10",
        //     'exercise_content' => "縄跳び",
        // ]);

        $response->assertRedirect('/weight_logs');
    }

    public function test_体重登録_必須入力エラー()
    {
        $response = $this->post('/weight_logs/create', [
        ]);

        $response->assertStatus(302);

        // $response->assertSessionHasErrors([
        //     'date' => '日付を入力してください',
        //     'weight' => '体重を入力してください',
        //     'weight' => '小数点は１桁で入力してください',
        //     'calories' => '摂取カロリーを入力してください',
        //     'calories' => '数字で入力してください',
        //     'exercise_time' => '運動時間をを入力してください',
        //     'exercise_content' => '120文字以内で入力してください',
        // ]);
    }
}
