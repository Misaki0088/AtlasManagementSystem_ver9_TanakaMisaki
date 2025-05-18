<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
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
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">予約キャンセル確認</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- 予約キャンセルモーダルの中で予約日と時間を表示 -->
      <div class="reserveDate">
        <p id="reserveDateText">予約日: </p>
      </div>
      <div class="reservePart">
        <p id="reservePartText">時間: </p>
      </div>
        <p id="cancelModalMessage">上記の予約をキャンセルしますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <form method="POST" action="{{ route('deleteParts') }}">
          @csrf
          <input type="hidden" name="reserve_id" id="cancelReserveId">
          <button type="submit" class="btn btn-danger">キャンセルする</button>
        </form>
      </div>
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

console.log('予約日:', reserveDate); // ← 一度これでブラウザで確認！

// 値の表示

$('#reserveDateText').text('予約日: ' + reserveDate);
$('#reservePartText').text('時間: ' + reservePart);
$('#cancelReserveId').val(reserveId);

});

});
  </script>


</x-sidebar>
