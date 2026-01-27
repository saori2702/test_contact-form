<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
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
    public function rules():array
    {
        return [
            'email'=> 'required|email',
            'password'=>[
                'required',
                function ($attribute,$value,$fail){
                    $user=\App\Models\User::where('email',$this->email)->first();
                    if(!$user||!\Hash::check($value,$user->password)){
                        $fail('ログイン情報が登録されていません');
                    }
                }
            ],
        ];
    }

    public function messages():array
    {
        return [
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスはメール形式で入力してください',

            'password.required' => 'パスワードを入力してください',
        ];
    }
}