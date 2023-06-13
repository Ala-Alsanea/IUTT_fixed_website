  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    
    // Prevent default anchor event
    e.preventDefault();
    
    // Set values for window
    intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (blnResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
        strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
        objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
  }
var Functions ={
  APIPath:function() {
       var Back='';
      var  APIPath=Back+'resource/API/index.php';
             var InstedArray=['admin','Agent','Customer'];
              var PathArray = window.location.pathname.split('/');
                for (i = 0; i <PathArray.length; i++) { 
                    if($.inArray(PathArray[i],InstedArray)!= -1){
                     //console.log(PathArray[i]);
                      Back='../';
                     
                    }
                    
           }
       APIPath=Back+'resource/API/index.php';
 
  return APIPath;
  },
  SpinerHtml:function() {
        var Content='<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
      return Content;
  },
   SpinerCss:function() {
  var Content= '<style type="text/css">.lds-spinner{color:#000;display:inline-block;position:absolute;width:80px;height:80px;top: 50%;left: 50%;}.lds-spinner div{transform-origin:40px 40px;animation:lds-spinner 1.2s linear infinite}.lds-spinner div:after{content:" ";display:block;position:absolute;top:3px;left:37px;width:6px;height:18px;border-radius:20%;background:#fff}.lds-spinner div:nth-child(1){transform:rotate(0);animation-delay:-1.1s}.lds-spinner div:nth-child(2){transform:rotate(30deg);animation-delay:-1s}.lds-spinner div:nth-child(3){transform:rotate(60deg);animation-delay:-.9s}.lds-spinner div:nth-child(4){transform:rotate(90deg);animation-delay:-.8s}.lds-spinner div:nth-child(5){transform:rotate(120deg);animation-delay:-.7s}.lds-spinner div:nth-child(6){transform:rotate(150deg);animation-delay:-.6s}.lds-spinner div:nth-child(7){transform:rotate(180deg);animation-delay:-.5s}.lds-spinner div:nth-child(8){transform:rotate(210deg);animation-delay:-.4s}.lds-spinner div:nth-child(9){transform:rotate(240deg);animation-delay:-.3s}.lds-spinner div:nth-child(10){transform:rotate(270deg);animation-delay:-.2s}.lds-spinner div:nth-child(11){transform:rotate(300deg);animation-delay:-.1s}.lds-spinner div:nth-child(12){transform:rotate(330deg);animation-delay:0s}@keyframes lds-spinner{0%{opacity:1}100%{opacity:0}}</style>'; 
 return Content;
  },
   
  windowRightClick : function() {
    
       window.oncontextmenu = function () {
        return false;
      }
      $(document).keydown(function (event) {
        if (event.keyCode == 123) {
          return false;
        }
        else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
          return false;
        }
      });
    },
  FunceyBoxShow: function(elem) {

    $('#'+elem).show();
    var minWidth=$('#'+elem).attr('minWidth');
            if (minWidth==undefined) {
              minWidth=300;
        }
     $.fancybox.open($('#'+elem), {
          touch: false,
          minWidth  :minWidth, 
    });

  },

 ShowSpinner : function(elem) {
   if ($(elem).attr("disabled") == "disabled") {
          e.preventDefault();
        }

        $(elem).attr("disabled", "disabled");
        $(elem).attr('data-btn-text', $(elem).text());
         $(elem).html('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>Loading');
        $(elem).addClass('active');
  
 }, 
 
 RemoveSpinner : function(elem) {
   $(elem).html($(elem).attr('data-btn-text'));
        $(elem).removeClass('active');
        //enable buttons after finish loading
   $(elem).removeAttr("disabled");

  },   
 showLoadingImage : function(id) {
 


     $('#'+id).addClass('relative_position');
    $('#'+id).append('<div class="indicator">'+this.SpinerCss()+this.SpinerHtml()+'</div>');
    
     $('#'+id+' .indicator').css(
       {
        "position": "absolute",
         "width":"100%",
          "height":"100%",
          "opacity":"0.7",
          "filter":"alpha(opacity=70)",
          "top":"0px",
          "left":"0px",
          "background": "url() #000 no-repeat 50% 50%"
        });

     return true;
},

 removeLoadingImage : function(id) {
 
    $('#'+id).removeClass('relative_position');
    $('#'+id+' .indicator').remove();
      $('#'+id+' .indicator').css(
       {
        "position": "", 
        "width":"", 
        "height":"",
        "opacity":"",
        "filter":"",
        "top":"",
        "left":"",
        "background": ""
      });
 
   

},
    
   isNumberKey :function(evt) {         
 
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      },


 ResetForm : function(Form) { 
 
           $(Form).each(function(){
               this.reset();
          }); 
      },
 ValidationTrans: function(APIPath) {
      
          $.ajax({
                  type: 'POST',
                  url:APIPath, 
                   method : 'post',
                  dataType: 'json',
                  data: {
                      'Route':'ValidationTrans',  
                  },

                        success: function(data){ 
                        
  
                    // alert(data['FullNameValidation']);
                   //return   JSON.parse(JSON.stringify(data));
                       return data;
                            
                       
                                     
                  }
          });

      

    },
      OnChangeCountry: function(Dialing=false) {


       // var APIPath='resource/API/index.php';
        var Country_id=$('#Country_id').val();
         this.LoadCityList(Country_id);
         if (Dialing) {
          this.GetDialingCode(Country_id);
         }
         
      $('#Country_id').on('change',function () {
          var Country_id=$(this).val();
           Functions.LoadCityList(Country_id);
            if (Dialing) {
          Functions.GetDialingCode(Country_id);
         }
            

      });

       
      

    },
   
    LoadCityList: function(Country_id=0) {
     $.ajax({
                  type: 'POST',
                  url:this.APIPath(), 
                   method : 'post',
                  dataType: 'json',
                  data: {
                      'Route':'LoadCityList',  
                      'Country_id':Country_id,  
                  },success: function(data){ 
                        
                       $('#City_id').empty();
                       $('#City_id').html(data);    
                                     
                  }
          });
    },
     GetDialingCode: function(Country_id) {


     $.ajax({
                  type: 'POST',
                  url:this.APIPath(), 
                   method : 'post',
                  dataType: 'text',
                  data: {
                      'Route':'GetDialingCode',  
                      'Country_id':Country_id,  
                  },

                        success: function(data){ 
                        
                       $('.DialingCodeContent').empty();
                       $('.DialingCodeContent').html(data);    
                                     
                  }
          });
    },
   
    LoadSelectQuery: function(elem,Target,Query,grid) {


       var APIPath='../resource/API/index.php';
      $('#'+elem).on('change',function () {
          var Country_id=$(this).val();
           $.ajax({
                  type: 'POST',
                  url:'?grid_id='+grid, 
                   method : 'post',
                  dataType: 'text',
                  data: {
                      'Route':'LoadSelectQuery',  
                      'Query':Query,  
                  },

                        success: function(data){ 
                        
                       $('#'+Target).empty().html(data);
                    
                            
                       
                                     
                  }
          });

      });

       
      

    },
    LoadWalletListByBaram: function(elem,Target,Query,grid) {


       var APIPath='../resource/API/index.php';
      $('#'+elem).on('change',function () {
          var Country_id=$(this).val();
           $.ajax({
                  type: 'POST',
                  url:'?grid_id='+grid, 
                   method : 'post',
                  dataType: 'text',
                  data: {
                      'Route':'LoadSelectQuery',  
                      'Query':Query,  
                  },

                        success: function(data){ 
                        
                       $('#'+Target).empty().html(data);
                    
                            
                       
                                     
                  }
          });

      });

       
      

    },
  setShareLinks:function() {

     var pageUrl = encodeURIComponent(document.URL);
  var tweet = encodeURIComponent($("meta[property='og:description']").attr("content"));

  $(".custom-share.facebook").on("click", function(e) {
    url = "https://www.facebook.com/sharer.php?u=" + pageUrl;
     $(this).attr('href',url);
     $(this).customerPopup(e);
    //this.SocialWindow(url);
  });

  $(".custom-share.twitter").on("click", function(e) {
    url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + tweet;
       $(this).attr('href',url);
     $(this).customerPopup(e);
    //this.SocialWindow(url);
  });

  $(".custom-share.linkedin").on("click", function(e) {

    
    url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl;
      $(this).attr('href',url);
     $(this).customerPopup(e);
    //this.SocialWindow(url);
  })

   $(".custom-share.whatsapp").on("click", function() {


     // if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      var text = $(this).attr("data-text");
    //  var url = $(this).attr("data-link");
      var message = encodeURIComponent(text) + " - " + encodeURIComponent(pageUrl);
      var whatsapp_url = "whatsapp://send?text=" + message;
      window.location.href = whatsapp_url;
      this.SocialWindow(whatsapp_url);
    //} else {
    //  alert("Please use an Mobile Device to Share this Article");
   // }

    
  })

  
  },  
  SocialWindow:function(url) {

     var left = (screen.width - 570) / 2;
  var top = (screen.height - 570) / 2;
  var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
  // Setting 'params' to an empty string will launch
  // content in a new tab or window rather than a pop-up.
  // params = "";
  window.open(url,"NewWindow",params);
    
  },

  customerPopup11:function (e, intWidth, intHeight, blnResize) {
     e.preventDefault();
         intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (blnResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
        strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
        objWindow = window.open(this.attr('href'), strTitle, strParam).focus();

  }, 
 setNavigation:function() {

     let url = window.location.href;
    //let filename = url.split('/').pop();
var filename = url.split('/').pop().split('#')[0].split('?')[0];
      
    // var path = window.location.pathname;
    // path = path.replace(/\/$/, "");
 
   var path = decodeURIComponent(filename);

    $(".sidebar-menu a").each(function () {
        var href = $(this).attr('href');
             $(this).removeClass('active');

         if (path=== href) {
             $(this).addClass('active');
             $(this).parent('li').addClass('active');
             $(this).parent('li').addClass('child');
             $(this).parents('.sidebar-submenu').addClass('menu-open');
             $(this).parents('.sidebar-submenu').addClass('active');
             $(this).parents('.sidebar-submenu').css('display','block');
             $(this).parents('.sidebar-submenu').parent('li').addClass('active'); 
        }
        // if (path.substring(0, href.length) === href) {
        //     $(this).closest('li').addClass('active');
        // }
    });

 
},
setNavigationMenu:function() {

      var url = window.location;
        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href != url;
        }).parent().removeClass('active');

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
}

 
};
 
 

(function($) {
  "use strict";
  Functions.setShareLinks();
  //OprationPages.windowRightClick();
     // $('.sidebar-menu a').click(function() {
     //  // alert(this);
     //      $(this).parents('.sidebar-submenu').removeClass('menu-open');
     //      $(this).parents('.sidebar-submenu').removeClass('active');
     //      $(this).parents('.sidebar-submenu').css('display','unset');
         
     // });
 
})(jQuery);

  
function showLoadingImage(id){
    $('#'+id).addClass('relative_position');
    $('#'+id).append('<div class="indicator">&nbsp;</div>');
}

function removeLoadingImage(id){
    $('#'+id).removeClass('relative_position');
    $('#'+id+' .indicator').remove();
}
    
           
function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }

       jQuery('.se-link.copy').each(function(){
        jQuery(this).click(function(){
            var _url = jQuery(this).parent().find("a").attr('href');
            var _link = _url.replace('https://www.facebook.com/sharer/sharer.php?u=','');
            var _decodedUrl = decodeURIComponent(_link);
            jQuery(this).after('<div class="hidden123" id="tmp-copy">'+_decodedUrl+'</div>')
            yyCopyToClipboard(document.getElementById("tmp-copy"));
            jQuery('#tmp-copy').remove();
            
            console.log(_decodedUrl);
        });
    });



       function yyCopyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}