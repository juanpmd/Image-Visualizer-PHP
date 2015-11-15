var widthimage = parseInt($("#images-section").css("width"), 10);
widthimage = (widthimage * 0.14666666667) - 2;
var heightimage = widthimage + 30;
$(".image-box").css("width", widthimage);
$(".image-box").css("height", heightimage);

$(document).ready(function(){

  $("#setting-button").click(function(){
    $("#settings-box").toggleClass("hidden");
  });

  //-------------Entrar a menu Upload----------->>>
  $("#upload-open-main").click(function(){
    $("#upload-page").fadeIn(200).removeClass("hidden");
  });
  //-------------Salir de menu Upload----------->>>
  $("#upload-cancel-button").click(function(){
    $("#upload-page").fadeOut(200).addClass("hidden");
  });

  $("#image-edit-box").click(function(){
    $("#image_info_page").fadeIn(200).removeClass("hidden");
  });
  $("#image-info-page-close").click(function(){
    $("#image_info_page").fadeOut(200).addClass("hidden");
  });

});
