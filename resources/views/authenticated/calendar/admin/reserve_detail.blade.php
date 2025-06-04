<x-sidebar>
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-75 h-75">
  <p class="reservation-date"><span>{{ $date }}</span><span class="ml-2">{{ $part }}部</span></p>
    <div>
      <table class="reservation-table">
        <tr class="text-center">
          <th style="width: 15%; padding: 4px;">ID</th>
          <th style="width: 45%; padding: 4px;">名前</th>
          <th style="width: 45%; padding: 4px;">場所</th>
        </tr>
        <tr class="text-center">
          <td class="w-20"></td>
          <td class="w-25"></td>
        </tr>

        @foreach ($reservePersons as $reservation)
          @foreach ($reservation->users as $user)
            <tr class="text-center">
              <td class="w-15" style="padding: 4px;">{{ $user->id }}</td>
              <td class="w-25" style="padding: 4px;">{{ $user->over_name }} {{ $user->under_name }}</td>
              <td class="w-25" style="padding: 4px;">リモート</td>
            </tr>
          @endforeach
        @endforeach

      </table>
    </div>
  </div>
</div>
</x-sidebar>
