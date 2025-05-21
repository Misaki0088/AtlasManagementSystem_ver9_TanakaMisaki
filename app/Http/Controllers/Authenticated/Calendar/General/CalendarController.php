<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
    // dd($request->all());

        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            // dd($getDate);
            $reserveDays = [];
        foreach ($getDate as $i => $date) {
            if (!empty($getPart[$i]) && !empty($date)) {
                $reserveDays[$date] = $getPart[$i];
            }
        }
        // dd($reserveDays);
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
            // dd($reserve_settings);
                if (!$reserve_settings) {
                    DB::rollBack();
                    return back()->with('error', 'この日程には予約できませんでした。もう一度確認してください。');
                    }

                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        $reserveDate = $request->input('reserve_date');
        $reservePart = $request->input('reserve_part');
        // dd($reserveDate);

        // 予約設定（部・日付）を取得
        $reserveSetting = \App\Models\Calendars\ReserveSettings::where('setting_reserve', $reserveDate)
        ->where('setting_part', $reservePart)
        ->first();

        if ($reserveSetting) {
            // ユーザーの予約（中間テーブル）を削除
            $reserveSetting->users()->detach(Auth::id());

            // 人数を1つ戻す
            $reserveSetting->increment('limit_users');

        return redirect()->back()->with('success', '予約をキャンセルしました');
        }

        return redirect()->back()->with('error', '予約が見つかりません');
        }

}
