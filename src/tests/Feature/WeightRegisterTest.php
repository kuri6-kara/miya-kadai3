<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class WeightRegisterTest extends TestCase
{
    use RefreshDatabase;
    protected User $user;
    protected function setUp():void
    {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_体重登録_登録完了()
    {
        $response = $this->post('/weight_logs/create', [
            'date' => "2023-10-27",
            'weight' => 75.5,
            'calories' => 1300,
            'exercise_time' => "00:00:10",
            'exercise_content' => "縄跳び",
            ]);

        $this->assertDatabaseHas('weight_logs', [
            'user_id' => $this->user->id,
            // 'date' => "2023-10-27",
            'weight' => 75.5,
            'calories' => 1300,
            'exercise_time' => "00:00:10",
            'exercise_content' => "縄跳び",
        ]);

        $response->assertRedirect('/weight_logs');
    }

    public function test_体重登録_必須入力エラー()
    {
        $response = $this->post('/weight_logs/create', [
        ]);

        // $response->assertStatus(302);

        $response->assertSessionHasErrors([
            // 'date' => '日付を入力してください',
            'weight' => '体重を入力してください',
            'calories' => '摂取カロリーを入力してください',
            'exercise_time' => '運動時間をを入力してください',
            // 'exercise_content' => '120文字以内で入力してください',
        ]);
    }

    public function test_体重登録_小数点エラー()
    {
        $response = $this->post('/weight_logs/create', [
            'date' => "2023-10-27",
            'weight' => 75.54,
            'calories' => 1300,
            'exercise_time' => "00:00:10",
            'exercise_content' => "縄跳び",
        ]);

        // $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'weight' => '小数点は１桁で入力してください',
        ]);
    }

    public function test_体重登録_数字エラー()
    {
        $response = $this->post('/weight_logs/create', [
            'date' => "2023-10-27",
            'weight' => 75.5,
            'calories' => "１３００",
            'exercise_time' => "00:00:10",
            'exercise_content' => "縄跳び",
        ]);

        // $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'calories' => '数字で入力してください',
        ]);
    }
}
