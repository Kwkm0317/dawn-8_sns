// ドロップダウンメニュー
//.dropdown-menuを一旦隠す
$('.menu').find('.dropdown-menu').hide();
//.menuをclickした場合
$('.menu').click(function () {
//.dropdown-menuをslideDown
    $(this).toggleClass('active');
    $(".dropdown-menu:not(:animated)", this).slideToggle(300);
});

// 更新のモーダルウィンドウ
$(function () {
    $('.modal-open').each(function () {
      $(this).on('click', function () {
        $('.update-icon').remove();
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        $(modal).fadeIn();
        return false;
      });
    });
});


// const modal = $("#js-modal");
// const overlay = $("#js-overlay");
// const close = $("#js-close");
// const open = $("#js-open");

// open.on('click', function () { //ボタンをクリックしたら
//   modal.addClass("open"); // modalクラスにopenクラス付与
//   overlay.addClass("open"); // overlayクラスにopenクラス付与
// });
// close.on('click', function () { //×ボタンをクリックしたら
//   modal.removeClass("open"); // overlayクラスからopenクラスを外す
//   overlay.removeClass("open"); // overlayクラスからopenクラスを外す
// });
