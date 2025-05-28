<x-sidebar>
<div class="w-75">
  <div class="w-100 border calender_admin">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
</x-sidebar>
