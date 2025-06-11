<x-sidebar>
<div style="background:#ECF1F6; min-height: 100vh;">
  <div class="custom-calendar-wrapper">
    <div class="w-90 calendar_style">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div>
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="reserveParts_btn">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
    <div style="height:20px;"></div>
  </div>
</div>

{{-- 予約キャンセルモーダル --}}
  <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ route('deleteParts') }}">
      <div class="modal-header">
        <div class="modal-title" id="cancelModalLabel"></div>

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
        <button type="button" class="btn btn-primary close_button"  data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-danger" id="cancelReservationButton">キャンセル</button>
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
