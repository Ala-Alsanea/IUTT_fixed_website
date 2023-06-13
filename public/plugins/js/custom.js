$(document).ready(function() {
	"use strict";
    $('.chips').material_chip();
    $('select').material_select();

    //FILTER SELECT OPTIONS
    // $(".wed-fil-1").on('click', function() {
    //     $(".fil-1").addClass("filt-eff");
    //     $(".fil-2").addClass('filt-eff-1');
    // });
    // //FILTER SELECT OPTIONS
    // $(".wed-fil-2").on('click', function() {
    //     $(".fil-2").removeClass("filt-eff-1");
    //     $(".fil-3").addClass("filt-eff-1");
    // });
    // //FILTER SELECT OPTIONS
    // $(".wed-fil-3").on('click', function() {
    //     $(".fil-3").removeClass("filt-eff-1");
    //     $(".fil-4").addClass("filt-eff-1");
    // });
    // //FILTER SELECT OPTIONS
    // $(".wed-fil-4").on('click', function() {
    //     $(".fil-4").removeClass("filt-eff-1");
    //     $(".fil-5").addClass("filt-eff-1");
    // });

    //MEGA MENU	
    // $(".about-menu").hover(function() {
    //     $(".about-mm").fadeIn();
    // });
    // $(".about-menu").mouseleave(function() {
    //     $(".about-mm").fadeOut();
    // });
    // //MEGA MENU	
    //  $(".academics-menu").hover(function() {
    //     $(".academics-mm").fadeIn();
    // });
    // $(".academics-menu").mouseleave(function() {
    //     $(".academics-mm").fadeOut();
    // });
    //  $(".student-menu").hover(function() {
    //     $(".student-mm").fadeIn();
    // });
    // $(".student-menu").mouseleave(function() {
    //     $(".student-mm").fadeOut();
    // });

    // $(".admi-menu").hover(function() {
    //     $(".admi-mm").fadeIn();
    // });
    // $(".admi-menu").mouseleave(function() {
    //     $(".admi-mm").fadeOut();
    // });

 //   $(".menu").hover(function(e) {
 //    $('.m-menu').fadeOut();
 //       $(this).find('.m-menu').fadeIn();
 //       // $(".about-mm").fadeIn();
 //    });
 // $(".menu").mouseleave(function() {
 //        $(this).find('.m-menu').fadeOut();
 //    });

    $(".main-menu >ul >li ").hover(function(e) {
    //$('.main-menu >ul >li > div').css('z-index',0);
    // $(this).find('div.mm-pos').css('z-index',99);
    //$('.m-menu').fadeOut();
       $(this).find('.m-menu').fadeIn();
       // $(".about-mm").fadeIn();
    });
 $(".main-menu >ul >li").mouseleave(function() {
    // $('.main-menu >ul >li > div').css('z-index',0);
        $(this).find('.m-menu').fadeOut();
    });
    //MEGA MENU	
    // $(".cour-menu").hover(function() {
    //     $(".cour-mm").fadeIn();
    // });
    // $(".cour-menu").mouseleave(function() {
    //     $(".cour-mm").fadeOut();
    // });

    // $(".media-menu").hover(function() {
    //     $(".media-mm").fadeIn();
    // });
    // $(".media-menu").mouseleave(function() {
    //     $(".media-mm").fadeOut();
    // });
    // //SINGLE DROPDOWN MENU
    // $(".top-drop-menu").on('click', function() {
    //     $(".man-drop").fadeIn();
    // });
    // $(".man-drop").mouseleave(function() {
    //     $(".man-drop").fadeOut();
    // });
    // $(".wed-top").mouseleave(function() {
    //     $(".man-drop").fadeOut();
    // });

    //SEARCH BOX
    $("#sf-box").on('click', function() {
        $(".sf-list").fadeIn();
    });
    $(".sf-list").mouseleave(function() {
        $(".sf-list").fadeOut();
    });
    $(".search-top").mouseleave(function() {
        $(".sf-list").fadeOut();
    });
    $('.sdb-btn-edit').hover(function() {
        $(this).text("Click to edit my profile");
    });
    $('.sdb-btn-edit').mouseleave(function() {
        $(this).text("edit my profile");
    });

    //AWARDS
    // $(".time-hide-1-btn").on('click', function() {
    //     $(".time-hide-1, .time-hide-11-btn").slideDown();
    //     $(".time-hide-1-btn").fadeOut();
    // });
    // $(".time-hide-11-btn").on('click', function() {
    //     $(".time-hide-1, .time-hide-11-btn").slideUp();
    //     $(".time-hide-1-btn").fadeIn();
    // })
    // $(".time-hide-2-btn").on('click', function() {
    //     $(".time-hide-2, .time-hide-22-btn").slideDown();
    //     $(".time-hide-2-btn").fadeOut();
    // });
    // $(".time-hide-22-btn").on('click', function() {
    //     $(".time-hide-2, .time-hide-22-btn").slideUp();
    //     $(".time-hide-2-btn").fadeIn();
    // });
    // $(".time-hide-3-btn").on('click', function() {
    //     $(".time-hide-3, .time-hide-33-btn").slideDown();
    //     $(".time-hide-3-btn").fadeOut();
    // });
    // $(".time-hide-33-btn").on('click', function() {
    //     $(".time-hide-3, .time-hide-33-btn").slideUp();
    //     $(".time-hide-3-btn").fadeIn();
    // });
    // $(".time-hide-4-btn").on('click', function() {
    //     $(".time-hide-4, .time-hide-44-btn").slideDown();
    //     $(".time-hide-4-btn").fadeOut();
    // });
    // $(".time-hide-44-btn").on('click', function() {
    //     $(".time-hide-4, .time-hide-44-btn").slideUp();
    //     $(".time-hide-4-btn").fadeIn();
    // });

    //MOBILE MENU OPEN
    $(".ed-micon").on('click', function() {
        $(".ed-mm-inn").addClass("ed-mm-act");
    });
    //MOBILE MENU CLOSE
    $(".ed-mi-close").on('click', function() {
        $(".ed-mm-inn").removeClass("ed-mm-act");
    });
	   if ($(".counter").length) {
      $(".counter").counterUp({
        delay: 1,
        time: 500,
      });
    }
    //MATERIAL SELECT BOX
    $('select').material_select();

    //MATERIAL COLLAPSIBLE
    $('.collapsible').collapsible();

    //MATERIAL CHIP COMMON
    $('.chips').material_chip();
    $('.chips-initial').material_chip({
        data: [{
            tag: 'Apple',
        }, {
            tag: 'Microsoft',
        }, {
            tag: 'Google',
        }],
    });

    //MATERIAL CHIP PLACEHOLDER
    $('.chips-placeholder').material_chip({
        placeholder: 'Enter a tag',
        secondaryPlaceholder: '+Amini (press enter)',
    });

    //MATERIAL CHIP AUTO-COMPLETE
    $('.chips-autocomplete').material_chip({
        autocompleteOptions: {
            data: {
                'Apple': null,
                'Microsoft': null,
                'Google': null
            },
            limit: Infinity,
            minLength: 1
        }
    });
	
    //GOOGLE MAP - SCROLL REMOVE
    $('.contact-map')
        .on('click', function() {
            $(this).find('iframe').addClass('clicked')
        })
        .on('mouseleave', function() {
            $(this).find('iframe').removeClass('clicked')
        });

    //$(".desk-hide").click(function(){
    //$(".desk-hide").fadeOut();
    //$(".mob-close").fadeIn();
    //});
    //$(".mob-close").click(function(){
    //$(".man-drop").fadeOut();
    //$(".mob-close").fadeOut();
    //$(".desk-hide").fadeIn();
    //});	

    //RIGHT CLICK DISABLE	
    //$("body").on("contextmenu",function(){
    //return false;
    //}); 

     var myCarousel = $("#myCarousel");
    if (myCarousel.length) {
                    myCarousel.owlCarousel({ 
                        loop: true,rtl: true, 
                        margin: 30, items: 1,
                         animateOut: "fadeOut", 
                         autoplay: true, smartSpeed: 1000, 
                         responsiveClass: true, nav: true, 
                         navText: ['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>'],
                         dots: false });

      //   myCarousel.owlCarousel({
      //   loop: true,
      //   margin:0,
      //   items:1,
      //   autoplay: true,
      //   smartSpeed: 2000,
      //   responsiveClass: true,
      //   nav: true,
      //   dots: false,
      //   stagePadding: 0,
      //   navText: ['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>'],
        
      // });
    }
     var fslider_team = $("#fslider_team");
    if (fslider_team.length) {
      fslider_team.owlCarousel({
        loop: true,
        margin:0,
        items: 4,
        autoplay: true,
        smartSpeed: 2000,
        responsiveClass: true,
        nav: true,
        dots: false,
        stagePadding: 0,
        navText: ['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>'],
        responsive: {
          0: {
            items: 1,
            stagePadding: 0,
          },
          578: {
            items: 2,
            stagePadding: 0,
          },
          992: {
            items: 3,
            stagePadding: 0,
          },
          1200: {
            items: 4,
          },
        },
      });
    }

    $('.slider').slider({
        height: 500,
        interval: 1000
    });
    $('.dropdown-button').dropdown({
        inDuration: 400,
        outDuration: 525,
        constrainWidth: 400, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    $('.dropdown-button2').dropdown({
         
        inDuration: 400,
        outDuration: 525,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: ($('.dropdown-content').width() * 3) / 2.5 + 5, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left' // Displays dropdown with edge aligned to the left of button
    });
});





$("#morex").click(function(){
  $(this).toggleClass("active").siblings(".mega-menu2").slideToggle();
   $(".mega-menu2").toggle();
   $('.mega-menu2').toggleClass('shadow');
   // alert('ssss');
});
     
//AWARDS
    $(".time-hide-1-btn").on('click', function() {
        $(".time-hide-1, .time-hide-11-btn").slideDown();
        $(".time-hide-1-btn").fadeOut();
    });
    $(".time-hide-11-btn").on('click', function() {
        $(".time-hide-1, .time-hide-11-btn").slideUp();
        $(".time-hide-1-btn").fadeIn();
    })
    $(".time-hide-2-btn").on('click', function() {
        $(".time-hide-2, .time-hide-22-btn").slideDown();
        $(".time-hide-2-btn").fadeOut();
    });
    $(".time-hide-22-btn").on('click', function() {
        $(".time-hide-2, .time-hide-22-btn").slideUp();
        $(".time-hide-2-btn").fadeIn();
    });
    $(".time-hide-3-btn").on('click', function() {
        $(".time-hide-3, .time-hide-33-btn").slideDown();
        $(".time-hide-3-btn").fadeOut();
    });
    $(".time-hide-33-btn").on('click', function() {
        $(".time-hide-3, .time-hide-33-btn").slideUp();
        $(".time-hide-3-btn").fadeIn();
    });
    $(".time-hide-4-btn").on('click', function() {
        $(".time-hide-4, .time-hide-44-btn").slideDown();
        $(".time-hide-4-btn").fadeOut();
    });
    $(".time-hide-44-btn").on('click', function() {
        $(".time-hide-4, .time-hide-44-btn").slideUp();
        $(".time-hide-4-btn").fadeIn();
    });

