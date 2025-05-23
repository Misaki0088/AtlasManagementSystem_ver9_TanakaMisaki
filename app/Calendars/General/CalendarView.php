<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $today = Carbon::today();
        $date = new Carbon($day->everyDay());
        $isPast = $date->lt($today);

        if ($isPast) {
          $html[] = '<td class="calendar-td" style="background-color:#EDEDEE">';
          $html[] = $day->render();

          if (in_array($day->everyDay(), $day->authReserveDay())) {
            $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
            $html[] = '<div>' . $reservePart . '部参加</div>';
          } else {
            $html[] = '<div>受付終了</div>';
          }
          } else {
            $startDay = $this->carbon->copy()->format("Y-m-01");
            $toDay = $this->carbon->copy()->format("Y-m-d");

          if ($startDay <= $day->everyDay() && $toDay >= $day->everyDay()) {
            $html[] = '<td class="calendar-td">';
          } else {
            $html[] = '<td class="calendar-td ' . $day->getClassName() . '">';
          }
          $html[] = $day->render();

      if (in_array($day->everyDay(), $day->authReserveDay())) {
        // まず予約データを取得
        $reserveData = $day->authReserveDate($day->everyDay())->first();

        // 安全に日付や部数を取り出す
        $reserveDate = optional($reserveData)->setting_reserve ?? '';
        $reserveId = optional($reserveData)->id ?? '';
        $reservePart = optional($reserveData)->setting_part ?? '';

        $reservePartLabel = '';
          if($reservePart == 1){
            $reservePartLabel = "リモ1部";
          }else if($reservePart == 2){
            $reservePartLabel = "リモ2部";
          }else if($reservePart == 3){
            $reservePartLabel = "リモ3部";
          }

            $html[] = '<button type="button"
              class="btn btn-danger p-0 w-75 open-cancel-modal"
              data-toggle="modal"
              data-target="#cancelModal"
              data-reserve="' . $reservePart . '"
              data-reserve-date="' . $reserveDate . '"
              style="font-size:12px">'
            . $reservePartLabel .
          '</button>';

        }else{
          $html[] = $day->selectPart($day->everyDay());
          $html[] = $day->getDate();
        }
      }

        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}