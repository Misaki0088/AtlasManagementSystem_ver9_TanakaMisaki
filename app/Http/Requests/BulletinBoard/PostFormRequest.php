<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;


class PostFormRequest extends FormRequest
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
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:2000',
            'post_category_id' => 'required|integer|exists:sub_categories,id',
            'main_category_id' => 'required|integer|exists:main_categories,id',
            'main_category_name' => 'required|string|max:50|unique:main_categories,main_category',
            'sub_category_name' => 'required|string|max:50|unique:sub_categories,sub_category',
        ];
    }

    public function messages(){
        return [
        'sub_category_name.required' => 'サブカテゴリー名を入力してください。',
        'sub_category_name.string' => 'サブカテゴリー名は文字列で入力してください。',
        'sub_category_name.max' => 'サブカテゴリー名は50文字以内で入力してください。',
        'sub_category_name.unique' => 'このサブカテゴリーは既に存在します。',
        'main_category_name.required' => 'メインカテゴリー名を入力してください。',
        'main_category_name.unique' => 'このメインカテゴリーは既に存在します。',
        'main_category_name.max' => 'メインカテゴリーは50文字以内で入力してください。',
        'main_category_id.required' => 'カテゴリーを選択してください。',
        'post_title.required' => 'タイトルは必ず入力してください。',
        'post_title.string' => 'タイトルは文字列である必要があります。',
        'post_title.max' => 'タイトルは100文字以内で入力してください。',
        'post_body.required' => '内容は必ず入力してください。',
        'post_body.string' => '内容は文字列である必要があります。',
        'post_body.max' => '最大文字数は2000文字です。',
        ];
    }

    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $mainCategoryName = $this->input('main_category_name');
        $subCategoryName = $this->input('sub_category_name');

        if ($mainCategoryName) {
            // メインカテゴリーに同じ名前がないかチェック！
            $existsInSub = SubCategory::where('sub_category', $mainCategoryName)->exists();

            if ($existsInSub) {
                $validator->errors()->add('main_category_name', 'この名前はすでにサブカテゴリーに存在します。別の名前を入力してください！');
            }
        }

        // サブカテゴリ名が存在する場合
        if ($subCategoryName) {
            // メインカテゴリと同じ名前がないかチェック
            $existsInMain = MainCategory::where('main_category', $subCategoryName)->exists();

            if ($existsInMain) {
                $validator->errors()->add('sub_category_name', 'この名前はすでにメインカテゴリーに存在します。別の名前を入力してください！');
            }

            // 同じサブカテゴリ名がすでにある場合（念のため）
            $existsInSub = SubCategory::where('sub_category', $subCategoryName)->exists();

            if ($existsInSub) {
                $validator->errors()->add('sub_category_name', 'このサブカテゴリーは既に存在します。');
            }
        }

    });
}
}
