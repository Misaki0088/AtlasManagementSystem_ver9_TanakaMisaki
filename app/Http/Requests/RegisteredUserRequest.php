<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $birthdate = request('old_year') . '-' . request('old_month') . '-' . request('old_day');
        return [
            'old_year' => ['required', 'digits:4'],
            'old_month' => ['required', 'integer', 'between:1,12'],
            'old_day' => ['required', 'integer', 'between:1,31'],
        // 合成した日付に対してバリデーション
            'birthdate' => [
            'required',
            'date',
            'after_or_equal:2000-01-01',
            'before_or_equal:today',
            'date_format:Y-m-d',],

            'over_name'  => 'required|string|max:10',
            'under_name'   => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana'  => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address'   => 'required|unique:users,mail_address|max:100',
            'sex' => 'required|in:1,2,3',
            'role'  => 'required|in:1,2,3,4',
            'password'   => 'required|alpha_num:ascii|between:8,30|confirmed',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'birthdate' => $this->old_year . '-' . str_pad($this->old_month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($this->old_day, 2, '0', STR_PAD_LEFT),
        ]);
    }

    public function attributes(){
        return [
            'over_name'  => '姓',
            'under_name'   => '名',
            'over_name_kana' => 'セイ',
            'under_name_kana'  => 'メイ',
            'mail_address'   => 'メールアドレス',
            'sex' => '性別',
            'birthdate'  => '生年月日',
            'role'  => '権限',
            'password'   => 'パスワード',
        ];
    }

    public function messages(){
        return [
            'required'=>':attributeは必須項目です',
            'unique' => ':attributeはメール形式かつ、登録していないアドレスで入力してください',
            'max:100'=> '100文字以内で入力してください',
            'max:10'=> ':attributeは10文字以内で入力してください',
            'max:30'=> ':attributeは30文字以内で入力してください',
            'regex'=> ':attributeは全角カタカナ で入力してください',
            'sex.in' => '「男性」「女性」「その他」のいずれかを選択してください。',
            'between'=> ':attributeは8文字以上30文字以内で入力してください',
            'alpha_num'=> ':attributeは半角の英数字のみで入力してください',
            'confirmed'=> ':attributeは確認用と完全一致するようにしてください',
            'after_or_equal'=> ':attributeは2000年以降で設定してください',
        ];
    }
}
