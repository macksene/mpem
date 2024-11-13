var menu_encours = null;
var id_div_container = "div_container";

$("body").on("click", ".menu", function () {
  if ($(this).attr("id") == undefined) return false;

  menu_encours = $(this).attr("id");

  $(".menu").each(function (a) {
    $(this).removeClass("active");
    $(this).closest("li").removeClass("active");
  });

  $(this).addClass("active");
  $(this).closest("li").addClass("active");
  $(this).addClass("subdrop");

  var href = $(this).attr("href");
  //$('#' + id_div_container).empty().load(href, function () { cache: false }).fadeIn('slow');
  $("#loadingModal_menu").modal({
    show: true,
    keyboard: false,
    backdrop: "static",
  });

  $.ajax({
    type: "GET",
    url: href,
    dataType: "HTML",
    success: function (data) {
      $("#loadingModal_menu").modal("hide");
      $("#" + id_div_container)
        .empty()
        .html(data)
        .fadeIn("slow");
    },
    error: function () {
      alert("error");
    },
  });

  //pour le mobile, fermer le box si le menu est clicker
  if ($("body").hasClass("smallscreen") == true) {
    $(".button-menu-mobile").click();
  }
  return false;
});
function callBack_menu(href) {
  $("#loadingModal_menu").modal({
    show: true,
    keyboard: false,
    backdrop: "static",
  });
  $.ajax({
    type: "GET",
    url: href,
    dataType: "HTML",
    success: function (data) {
      $("#loadingModal_menu").modal("hide");
      $("#" + id_div_container)
        .empty()
        .html(data)
        .fadeIn("slow");
    },
    error: function () {
      alert("error");
    },
  });
  //$('#' + id_div_container).empty().load(href, function () { cache: false }).fadeIn('slow');
  return false;
}
