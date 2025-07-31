<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            // 既存のルール
            'weight' => ['required', 'digits_between:1,4', 'regex:/^\d{1,4}(\.\d{1})?$/'],
            'target_weight' => ['required', 'digits_between:1,4', 'regex:/^\d{1,4}(\.\d{1})?$/'],
            // 新規追加のルール
            'name' => ['required'], // 名前の入力がない場合
            'email' => ['required', 'email'], // メールアドレスの入力がない場合、メールアドレス形式ではない場合
            'password' => ['required'], // パスワードの入力がない場合
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
            // 既存のメッセージ
            'weight.required' => '現在の体重を入力してください',
            'weight.max_digits' => '４桁までの数字で入力してください',
            'weight.regex' => '小数点は１桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.max_digits' => '４桁までの数字で入力してください',
            'target_weight.regex' => '小数点は１桁で入力してください',
            // 新規追加のメッセージ
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
