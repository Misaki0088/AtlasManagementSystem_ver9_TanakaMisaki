$(function(){
$('.open-cancel-modal').on('click', function () {
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
});
// $(function () {

// alert('ハローワールド');

// });