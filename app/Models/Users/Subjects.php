<?php

namespace App\Models\Users;
use App\Models\Categories\SubCategory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

// リレーションの定義
    public function users(){
        return $this->belongsToMany('App\Models\Users\User','subject_users','subject_id','user_id');
    }
}