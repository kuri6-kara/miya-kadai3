<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'required': 入力がない場合
            // 'numeric': 数値であること
            // 'regex:/^\d{1,4}(\.\d{1})?$/': 整数1～4桁、かつ小数点以下1桁または小数点なし
            'target_weight' => ['required', 'numeric', 'regex:/^\d{1,4}(\.\d{1})?$/'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            // 'numeric' と 'regex' の両方で「4桁までの数字」と「小数点は1桁」をカバー
            'target_weight.numeric' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
