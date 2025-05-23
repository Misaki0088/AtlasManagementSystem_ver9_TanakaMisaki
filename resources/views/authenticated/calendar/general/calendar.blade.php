<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 " style="border-radius:10px; background:#FFF; box-shadow: 0 0 5px;">
    <!-- custom-calendar-wrapper mx-auto p-4" style="background: #FFF; border-radius: 10px; box-shadow: 0 0 10px; " -->
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

{{-- 予約キャンセルモーダル --}}
  <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ route('deleteParts') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">予約キャンセル確認</h5>

        </button>
      </div>
      <div class="modal-body">
        <!-- 予約キャンセルモーダルの中で予約日と時間を表示 -->
      <div class="reserveDate">
        <p id="reserveDateText">予約日: </p>
        <input type="hidden" name="reserve_date" id="cancelReserveDate">
      </div>
      <div class="reservePart">
        <p id="reservePartText">時間: </p>
        <input type="hidden" name="reserve_part" id="cancelReservePart">
      </div>
        <p id="cancelModalMessage">上記の予約をキャンセルしますか？</p>
      </div>

      <div class="modal-footer">
        @csrf
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-danger" id="cancelReservationButton">キャンセルする</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- 予約キャンセルモーダルのJS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
  $(function () {

$('.open-cancel-modal').on('click', function () {
const reserveDate = $(this).data('reserve-date');
const reservePart = $(this).data('reserve');
const reserveId = $(this).data('reserve-id');

console.log('予約日:', reserveDate);
console.log('予約時間:', reservePart);

$('#reserveDateText').text('予約日: ' + reserveDate);
$('#reservePartText').text('時間:リモ' + reservePart+ '部');

$('#cancelReserveDate').val(reserveDate);
$('#cancelReservePart').val(reservePart);

$('#cancelModal').modal('show');
});
});

  </script>


</x-sidebar>
