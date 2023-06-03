
   <script type="text/javascript" src="{{asset('plugins/js/Functions.js') }}"></script>
    <script type="text/javascript">

          function ReturnMessageAlert(Message,Type) {
         var ContentMessage='';
           if (Type=='error') {
           return  '<div class="alert alert-warning " id="alertMassage"> <button data-dismiss="" class="close close-sm" type="button"> <i class="fa fa-times"></i> </button><strong>تنبيه  !</strong>'+Message+'</div>';

           }else{
            return '<div class="alert alert-success"> <button data-dismiss="" class="close close-sm" type="button"> <i class="fa fa-times"></i> </button><strong>تنبيه  !</strong>'+Message+'</div>';

           }


      }
jQuery(document).ready(function ($) {
            "use strict";


   var Form=$('form.contactForm');
            //Contact


            Form.submit(function () {
 Functions.showLoadingImage(Form.attr('id'));
                var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                f.children('input').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'email':
                                if (!emailExp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'checked':
                                if (!i.attr('checked')) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'regexp':
                                exp = new RegExp(exp);
                                if (!exp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + ( ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '' )).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                f.children('textarea').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + ( ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '' )).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                if (ferror) return false;
                else var str = $(this).serialize();

                 $.ajax({
            type: 'POST',
            url: Form.attr('action'),
            data: new FormData(Form[0]),
            contentType: false,
            cache: false,
             dataType: 'json',
            processData:false,
               success: function (data) {
             Functions.removeLoadingImage(Form.attr('id'));
              $(window).scrollTop(Form.offset().top);
         var status=data['Status'];

          var Message=data['Message'];


             var ContentAlert=ReturnMessageAlert('','');
                Form.find('.alert').remove();
               if($.trim(status)=='0'){
                 ContentAlert=ReturnMessageAlert(Message,'error');
            //Form.prepend(ContentAlert);
            Form.append(ContentAlert);

               }else{


                 ContentAlert=ReturnMessageAlert(Message,'');
                Form.prepend(ContentAlert);
               // Form.append(ContentAlert);

                  // window.location.reload();

             //  Functions.ResetForm(Form);

                //

               }




               },
                error: function(data) {
                   Functions.removeLoadingImage(Form.attr('id'));
                 $(window).scrollTop(Form.offset().top);
                   var Message = JSON.parse(data.responseText);
                        var   ContentAlert=ReturnMessageAlert(Message,'');
              Form.prepend(ContentAlert);
                  }
         });

                //console.log(xhr);
                return false;
            });


     setTimeout(function(){

      Form.find('.alert').fadeOut("slow");

         }, 10000);

        });


    </script>
