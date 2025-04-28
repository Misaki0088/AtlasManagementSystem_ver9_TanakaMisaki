<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        return $this->belongsTo(MainCategory::class, 'main_category_id');// リレーションの定義
    }

    public function posts(){
        return $this->belongsToMany(
        Post::class,               // 関連するモデル
        'post_sub_categories',     // 中間テーブル名
        'sub_category_id',         // このモデルの外部キー
        'post_id'                  // 関連モデルの外部キー
        );// リレーションの定義
    }
}