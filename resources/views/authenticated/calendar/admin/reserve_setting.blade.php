<x-sidebar>
<div class="w-100 d-flex" style="justify-content:center; min-height: 100vh;">
  <div class="border setting_calender">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="reserveSetting_btn">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
</x-sidebar>
