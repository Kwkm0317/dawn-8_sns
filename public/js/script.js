// ドロップダウンメニュー
//.dropdown-menuを一旦隠す
$('.menu').find('.dropdown-menu').hide();
//.menuをclickした場合
$('.menu').click(function () {
  //.dropdown-menuをslideDown
  $(".dropdown-menu:not(:animated)", this).slideToggle(300);
});

// 更新のモーダルウィンドウ
$(function () {
    $('.modalopen').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        $(modal).fadeIn();
        return false;
      });
    });
    // $('.modalClose').on('click', function () {
    //   $('.hide-area').fadeOut();
    //   return false;
    // });
  });
