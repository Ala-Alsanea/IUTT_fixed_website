 $(document).ready(function() {


   $('.fancybox').fancybox();
//   $('.iframe-btn').fancybox({
//     'width'     : 900,
//     'height'    : 600,
//     'type'      : 'iframe',
//     'autoScale' : false
// });



  // tinymce.init({
  //   selector: "textarea",
  //           width:"100%",height: 300,
  //           plugins: [
  //               "advlist autolink link image lists charmap print preview hr anchor pagebreak",
  //               "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
  //               "table contextmenu directionality emoticons paste textcolor filemanager code"
  //       ],
  //       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
  //       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
  //       image_advtab: true ,
  //       filemanager_access_key: '@filemanager_get_key()',
  //       filemanager_sort_by: '',
  //       filemanager_descending: '',
  //       filemanager_subfolder: '',
  //       filemanager_crossdomain:true,
  //       external_filemanager_path: '@filemanager_get_resource(dialog.php)',
  //       filemanager_title:"Responsive Filemanager" ,
  //       external_plugins: { "filemanager" : "/vendor/responsivefilemanager/plugin.min.js"}
  //       });

 });


function OnMessage(e){
  var event = e.originalEvent;
   // Make sure the sender of the event is trusted
   if(event.data.sender === 'responsivefilemanager'){
      if(event.data.field_id){
        var fieldID=event.data.field_id;
        var url=event.data.url;
  $('#'+fieldID).val(url).trigger('change');
  $.fancybox.close();

  // Delete handler of the message from ResponsiveFilemanager
  $(window).off('message', OnMessage);
      }
   }
}
 
// $('.opener-class').on('click',function(){
//   $(window).on('message', OnMessage);
// });

/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Frest HTML Admin Template
  Version: 1.0
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

 (function ($) {
  "use strict"
  var $html = $("html")
  var $body = $("body")
  var $danger = "#FF5B5C"
  var $primary = "#5A8DEE"
  var $primary_lighten = "#e7edf3"
  var $warning = "#FDAC41"
  var $textcolor = "#304156"

  function scrollTopFn(){
    var $scrollTop = $(window).scrollTop();
    if ($scrollTop > 10) {
      $("body").addClass("navbar-scrolled");
      $(".app-header").addClass("fixed-top");
    }else{
      $("body").removeClass("navbar-scrolled");
      $(".app-header").removeClass("fixed-top");
    }
    if ($scrollTop > 20) {
      $("body").addClass("page-scrolled");
    }
    else{
      $("body").removeClass("page-scrolled");
    }
  }


  $(window).on("load", function () {
    var rtl
    var compactMenu = false // Set it to true, if you want default menu to be compact

    if ($body.hasClass("menu-collapsed")) {
      compactMenu = true
    }

    if ($("html").data("textdirection") == "rtl") {
      rtl = true
    }

    setTimeout(function () {
      $html.removeClass("loading").addClass("loaded")
    }, 1200)

    

    // Livioncs are initialized for vertical menu
    $.each($(".menu-livicon"), function (i) {
      var $this = $(this),
        icon = $this.data("icon"),
        iconStyle = $("#main-menu-navigation").data("icon-style")

      $this.addLiviconEvo({
        name: icon,
        style: iconStyle,
        duration: 0.85,
        strokeWidth: "1.3px",
        eventOn: "none",
        strokeColor: menuIconColorsObj.iconStrokeColor,
        solidColor: menuIconColorsObj.iconSolidColor,
        fillColor: menuIconColorsObj.iconFillColor,
        strokeColorAlt: menuIconColorsObj.iconStrokeColorAlt,
        afterAdd: function () {
          if (i === $(".main-menu-content .menu-livicon").length - 1) {
            // When hover over any menu item, start animation and stop all other animation
            $(".main-menu-content .nav-item a").on("mouseenter", function () {
              if ($(".main-menu-content .menu-livicon").length) {
                $(".main-menu-content .menu-livicon").stopLiviconEvo()
                $(this)
                  .find(".menu-livicon")
                  .playLiviconEvo()
              }
            })
          }
        }
      })
    })

    function updateLivicon(el) {
      el.updateLiviconEvo({
        strokeColor: menuActiveIconColorsObj.iconStrokeColor,
        solidColor: menuActiveIconColorsObj.iconSolidColor,
        fillColor: menuActiveIconColorsObj.iconFillColor,
        strokeColorAlt: menuActiveIconColorsObj.iconStrokeColorAlt
      })
    }

    });

});

   $(window).scroll(function () {
    // scrollTopFn();
     if ($(this).scrollTop() > 20) {
       
        $(".app-header").addClass("fixed-top");
        // $(".app-header").addClass("white");
        // $(".app-header").addClass("box-shadow");
      
    } else {
       $(".app-header").removeClass("fixed-top");
       // $(".app-header").removeClass("white");
       // $(".app-header").removeClass("box-shadow");
     
    }
  });