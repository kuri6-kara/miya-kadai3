<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeightRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('/weight-logs', [
                'date' => '2023-10-27',
                'weight' => 75.5,
                'calories' => 1300,
                'exercise_time' => 10,
                'exercise_content' => '縄跳び',
            ]);;

        $this->assertDatabaseHas('weight_logs', [
            'user_id' => $user->id,
            'date' => '2023-10-27',
            'weight' => 75.5,
            'calories' => 1300,
            'exercise_time' => 10,
            'exercise_content' => '縄跳び',
        ]);

        $response = $this->get('/weight_logs');

        $response->assertStatus(200);

        $response->assertSessionHasErrors([
            'date' => '日付をしてください',
            'weight' => '体重を入力してください',
            'weight' => '小数点は１桁で入力してください',
            'calories' => '摂取カロリーを入力してください',
            'calories' => '数字で入力してください',
            'exercise_time' => '運動時間をを入力してください',
            'exercise_content' => '120文字以内で入力してください',
        ]);
    }
}
