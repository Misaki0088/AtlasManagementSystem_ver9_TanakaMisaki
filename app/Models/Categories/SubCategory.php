<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Post::class);// リレーションの定義
    }
}