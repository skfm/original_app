// indexページのクリップボードのコピー
function copyToClipboard() {
  const text = document.getElementById("copyTarget").innerText;
  const area = document.createElement("textarea");
  area.textContent = text;
  document.body.appendChild(area);
  area.select();
  document.execCommand("copy");
  document.body.removeChild(area);
  alert("コピー完了！");
}

$(function () {
  // questionページのボタンアクション
  $(".form_item:not(:first-child)").hide();

  $("input[name]").on("click", function () {
    const number = $(this).attr("data-number");
    $("#" + number).css("background-color", "#ffcce5");
    $("#" + number).on("click", function () {
      $(this).parents(".form_item").css("display", "none");
      $(this).parents(".form_item").next(".form_item").css("display", "block");
      $(".btn.next").css("background-color", "#ddd");
    });
  });

  $(".btn.prev").on("click", function () {
    $(this).parents(".form_item").css("display", "none");
    $(this).parents(".form_item").prev(".form_item").css("display", "block");
    $(".btn.next").css("background-color", "#ffcce5");
  });

  // 結果ページのフェードイン、フェードアウト
  $(".result_wrapper").hide().fadeIn(3300);

  $(document).ready(function () {
    let hsize = $(section).height();
    $("body.result").css("height", hsize + "px");
  });

  $(window).resize(function () {
    let hsize = $(section).height();
    $("body.result").css("height", hsize + "px");
  });
});
