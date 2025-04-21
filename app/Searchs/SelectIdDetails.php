<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectIdDetails implements DisplayUsers{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    if(is_null($keyword)){
      $keyword = User::pluck('id')->toArray();
    }else{
      $keyword = [$keyword];
    }
    if (empty($gender)) {
      $gender = ['1', '2', '3'];
  } else {
      $gender = [$gender];
  }
  if (empty($role)) {
    $role = ['1', '2', '3', '4'];
  } else {
    $role = [$role];
  }
    $query = User::with('subjects')
    ->whereIn('id', $keyword)
    ->where(function($q) use ($role, $gender){
      $q->whereIn('sex', $gender)
      ->whereIn('role', $role);
    });

    //科目が選ばれてるか(選ばれているときにだけ！)
    if (!empty($subjects)) {
      $query->whereHas('subjects', function($q) use ($subjects){
        $q->where('subjects.id', $subjects);
      });
    }

    // 並び替えて取得！
    return $query->orderBy('id', $updown)->get();
  }
}
