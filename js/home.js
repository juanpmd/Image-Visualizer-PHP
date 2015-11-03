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



});
