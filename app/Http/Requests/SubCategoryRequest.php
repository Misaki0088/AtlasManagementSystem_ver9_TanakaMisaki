<?php

namespace App\Http\Requests;
use App\Models\Posts\Post;
use Illuminate\Foundation\Http\FormRequest;


class SubCategoryRequest extends FormRequest
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
        return [
            'sub_category_name' => 'required|string|max:50|unique:sub_categories,sub_category',
            'main_category_id' => 'required|integer|exists:main_categories,id',
        ];
    }

    public function messages()
    {
    return [
        'sub_category_name.required' => 'サブカテゴリー名を入力してください。',
        'sub_category_name.max' => 'サブカテゴリーは50文字以内で入力してください。',
        'sub_category_name.unique' => 'このサブカテゴリーは既に存在します。',
        'main_category_id.required' => 'メインカテゴリーを選択してください。',
        'main_category_id.exists' => '存在しないメインカテゴリーが指定されています。',
    ];
    }
}