<?php
namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay{
  protected $carbon;

  public function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  public function pastClassName(){
    return;
  }

  /**
   * @return
   */

  public function render(){
    return '<p class="day">' . $this->carbon->format("j"). '日</p>';
  }

  public function selectPart($ymd){
    $userReservations = $this->authReserveDate($ymd);
    $reservedParts = $userReservations->pluck('setting_part')->toArray(); // 予約済み部を配列で取得

    $html = [];

    // 1部〜3部のループ処理で書くとスッキリする！
    for ($i = 1; $i <= 3; $i++) {
        $frame = ReserveSettings::with('users')
            ->where('setting_reserve', $ymd)
            ->where('setting_part', $i)
            ->first();

        $limit = $frame ? $frame->limit_users : 0;

        // もしこの部を予約してたらボタン＋モーダル
        if (in_array($i, $reservedParts)) {
            $html[] = '<button type="button" class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#cancelModal_'.$ymd.'_'.$i.'">';
            $html[] = 'リモ' . $i . '部（予約済）';
            $html[] = '</button>';

            // モーダル表示部分
            $html[] = '<div class="modal fade" id="cancelModal_'.$ymd.'_'.$i.'" tabindex="-1" aria-labelledby="cancelModalLabel_'.$ymd.'_'.$i.'" aria-hidden="true">';
            $html[] = '<div class="modal-dialog">';
            $html[] = '<div class="modal-content">';
            $html[] = '<div class="modal-header">';
            $html[] = '<h5 class="modal-title" id="cancelModalLabel_'.$ymd.'_'.$i.'">キャンセル確認</h5>';
            $html[] = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            $html[] = '</div>';
            $html[] = '<div class="modal-body">';
            $html[] = '<p>予約日：' . $ymd . '</p>';
            $html[] = '<p>時間：リモ' . $i . '部</p>';
            $html[] = '</div>';
            $html[] = '<div class="modal-footer">';
            $html[] = '<form method="POST" action="/reserve/cancel">';
            $html[] = '<input type="hidden" name="_token" value="' . csrf_token() . '">';
            $html[] = '<input type="hidden" name="reserve_date" value="'.$ymd.'">';
            $html[] = '<input type="hidden" name="reserve_part" value="'.$i.'">';
            $html[] = '<button type="submit" class="btn btn-danger">キャンセルする</button>';
            $html[] = '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>';
            $html[] = '</form>';
            $html[] = '</div></div></div></div>';
        } else {
            // 空き枠のセレクトボックス用optionを出力
            if ($i == 1) $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts"><option value="" selected></option>';
            if ($limit == 0) {
                $html[] = '<option value="'.$i.'" disabled>リモ'.$i.'部(残り0枠)</option>';
            } else {
                $html[] = '<option value="'.$i.'">リモ'.$i.'部(残り'.$limit.'枠)</option>';
            }
            if ($i == 3) $html[] = '</select>';
        }
    }

    return implode('', $html);
}

  public function getDate(){
    return '<input type="hidden" value="'. $this->carbon->format('Y-m-d') .'" name="getData[]" form="reserveParts">';
  }

  public function everyDay(){
    return $this->carbon->format('Y-m-d');
  }

  public function authReserveDay(){
    return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
  }

  public function authReserveDate($reserveDate){
    return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
  }

  public function cancelBtn() {
    $ymd = $this->carbon->format('Y-m-d');
    $reservations = $this->authReserveDate($ymd);

    if ($reservations->isEmpty()) {
        return ''; // 予約がなければ表示しない
    }

    $html = [];
    $html[] = '<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal_'.$ymd.'">';
    $html[] = 'キャンセル';
    $html[] = '</button>';

    // モーダル表示部分
    $html[] = '<div class="modal fade" id="cancelModal_'.$ymd.'" tabindex="-1" aria-labelledby="cancelModalLabel_'.$ymd.'" aria-hidden="true">';
    $html[] = '<div class="modal-dialog">';
    $html[] = '<div class="modal-content">';
    $html[] = '<div class="modal-header">';
    $html[] = '<h5 class="modal-title" id="cancelModalLabel_'.$ymd.'">キャンセル確認</h5>';
    $html[] = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    $html[] = '</div>';
    $html[] = '<div class="modal-body">';

    foreach ($reservations as $reserve) {
        $html[] = '<p>予約日：' . $ymd . '</p>';
        $html[] = '<p>時間：リモ' . $reserve->setting_part . '部</p>';
    }

    $html[] = '</div>';
    $html[] = '<div class="modal-footer">';
    $html[] = '<form method="POST" action="/reserve/cancel">';
    $html[] = '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $html[] = '<input type="hidden" name="reserve_date" value="'.$ymd.'">';
    $html[] = '<button type="submit" class="btn btn-danger">キャンセルする</button>';
    $html[] = '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>';
    $html[] = '</form>';
    $html[] = '</div></div></div></div>';

    return implode('', $html);
  }

}