var loadPathabsolute=$(location).attr('protocol')+"//"+$(location).attr('hostname');
       if ($(location).attr('hostname')=='localhost') {
         loadPathabsolute=loadPathabsolute+'/iutt/';
       }
        loadPathabsolute+='/';
class App{

  // static setDefaultDate(year, month, day) {
  //   // A static property can be referred to without mentioning an instance
  //   // Instead, it's defined on the class
  //   SimpleDate._defaultDate = new SimpleDate(year, month, day);
  // }

  constructor() {
    // If constructing without arguments,
    // then initialize "this" date by copying the static default date
    // if (arguments.length === 0) {
    //   this._year = SimpleDate._defaultDate._year;
    //   this._month = SimpleDate._defaultDate._month;
    //   this._day = SimpleDate._defaultDate._day;

    //   return;
    // }
     
 

 
  }

   ViewAttachment(elem){

  var   Attachment_Id=$(elem).attr('id');
   var Title=$(elem).attr('Title');


    $.ajax({
            url:this.UrlVistor,
            method : 'post',
            dataType: 'text',
            data: {
                'RouteOpration':'ViewFile',
                'TypeRequest':'Vistor',
                'Attachment_Id'  : Attachment_Id
             },
            success: function(data) {
                 

           $.fancybox.open('<div class="Containfancybox">'+data+'</div> ');
      

         }
   });

      
    }

     FancyboxLink(elem) {
       $(elem).fancybox({
            maxWidth  : 800,
            maxHeight : 600,
            fitToView : false,
            width   : '70%',
            height    : '70%',
            'type'      : 'iframe',
            autoSize  : false,
            closeClick  : false,
            openEffect  : 'fade in',
            closeEffect : 'none'
          });
    }

  addDays(nDays) {
    // Increase "this" date by n days
    // ...
  }

  getDay() {
    return this._day;
  }

  OpenFileManager(elem){


      // var  Url=$(elem).attr('Url'); 
      var field_id=$(elem).attr('field_id');
      var type=$(elem).attr('type');
      var multiple=$(elem).attr('multi');
       var relative_url=false;
      if ($(elem).attr('relative_url')!=undefined) {
         relative_url=$(elem).attr('relative_url');
      }
   

var PaseUrl=loadPathabsolute+"/filemanager/dialog.php?type="+type+"&field_id="+field_id+"&multiple="+multiple+"&relative_url="+relative_url;

      var LinkField='link-'+field_id;
      var imgField='img-'+field_id;
 $.fancybox( $(elem), {
          'href'     : PaseUrl,
          'width'     : 900,
    'height'    : 600,
    'type'      : 'iframe',
    'autoScale' : false
    });
         



  }
}

 


 
 App=new App();
 function responsive_filemanager_callback(field_id){

       var parent_id=jQuery('#'+field_id).closest('div');
      var url=jQuery('#'+field_id).val();
    var newl=url.replace('http://localhost/','');
    var newurl=loadPathabsolute+newl;
     if ($('img.'+field_id+'.groupMediaPhoto').length>0) {
      $('img.'+field_id+'.groupMediaPhoto').attr('src',newurl);
     }else{

     // $(parent_id).find('img.'+field_id+'.groupMediaPhoto').remove();
      var img = $('<img id="dynamic" class="img-responsive '+field_id+' groupMediaPhoto ">'); //Equivalent: $(document.createElement('img'))
img.attr('src',newurl);

img.appendTo(parent_id);
     }
  //  

    // $('.ImageFileMa').find('img').remove();
     // var myImage = $('<img/>');

     //   myImage.attr('width', 300);
     //   myImage.attr('height', 300);
     //   myImage.attr('class', "groupMediaPhoto img-responsive");
     //   myImage.attr('src', newurl).prepend($('#'+field_id));

   // alert('update '+field_id+" with "+url+'--'+newurl);
    //your code
}
