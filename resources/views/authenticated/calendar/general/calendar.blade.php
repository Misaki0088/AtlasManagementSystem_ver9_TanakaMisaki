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
          <p class="reserveDate">予約日: </p>
        </div>
        <div class="reservePart">
          <p class="reservePart">時間: </p>
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
    $('#cancelModal').on('click', function () {
      $('.modal.fade').fadeIn();
      var reserveDate = $(this).attr('data-reserve-date'); // 予約日
      var reservePart = $(this).attr('data-reserve'); //部数


  // モーダルに予約日と時間（部数）を表示
  $('.reserveDate p').text(reserveDate);
  $('.reservePart p').text(reservePart);
return false;

  // 予約IDを隠しフィールドにセット
  // modal.find('#cancelReserveId').val(reserveId);
});
  </script>


</x-sidebar>
