@extends('backEnd.layout')

@section('content')

<style type="text/css">
textarea#files {
    width:100%;
    height: 200px;
    cursor: pointer
}
</style>
    <div class="padding">
        <div class="box1 shadow bkcg">
            <div class="box-header">
                <h3>Editor</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">Editor</a>
                </small>
            </div>
  
         <div class="box-body">
                  <div class="row p-a">
                    <div class="col-sm-12">

               <textarea name="" id="contentEditor" cols="30" rows="50"></textarea>

             </div>
           </div>
          
    </div>
        
        
    </div>
</div>

@endsection

@section('footerInclude')
<script type="text/javascript" src="{{ asset('plugins/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        tinymce.init({
    selector: "#contentEditor",
    theme: "modern",


         paste_data_images: true,
 
 
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak  filemanager ",
      "searchreplace wordcount visualblocks visualchars code  fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo  localautosave| styleselect formatselect fontselect fontsizeselect | cut copy paste | bold italic underline removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image quickupload searchreplace contextmenu template directionality",
    toolbar2: "print preview media visualblocks fullscreen  code| forecolor backcolor emoticons",
     
  
    style_formats:[

{title: 'Inline', items: [
    {title: 'Strikethrough', inline: 'span', styles : {textDecoration : 'line-through'}, icon: 'strikethrough'},
    {title: 'Superscript', inline: 'sup', icon: 'superscript'},
    {title: 'Subscript', inline: 'sub', icon: 'subscript'},
    {title: 'Marker',           inline: 'mark'},
    {title: 'Big',              inline: 'big'},
    {title: 'Small',            inline: 'small'},
    {title: 'Typewriter',       inline: 'tt'},
    {title: 'Computer Code',    inline: 'code', icon: 'code'},
    {title: 'Keyboard Phrase',  inline: 'kbd'},
    {title: 'Sample Text',      inline: 'samp'},
    {title: 'Variable',     inline: 'var'},
    {title: 'Deleted Text', inline: 'del'},
    {title: 'Inserted Text',    inline: 'ins'},
    {title: 'Cited Work',       inline: 'cite'},
    {title: 'Inline Quotation', inline: 'q'},
 
]},
{title: 'Containers', items: [
    {title: 'section', block: 'section', wrapper: true, merge_siblings: false},
    {title: 'article', block: 'article', wrapper: true, merge_siblings: false},
    {title: 'blockquote', block: 'blockquote', wrapper: true},
    {title: 'hgroup', block: 'hgroup', wrapper: true},
    {title: 'aside', block: 'aside', wrapper: true},
    {title: 'figure', block: 'figure', wrapper: true}
]},
{title: 'Images', items: [
    {title: 'Styled image (left)',
        selector: 'img',
        classes: 'img-left'
    },
    {title: 'Styled image (right)',
        selector: 'img',
        classes: 'img-right'
    },
    {title: 'Styled image (center)',
        selector: 'img',
        classes: 'img-center'
    },
]}    ],
    image_advtab: true,
    subfolder:"",
    image_advtab: true, 
       file_browser_callback: "openmanager",
        open_manager_upload_path: 'uploads/',
        external_image_list_url : "list.php",
      moxiemanager_filelist_context_menu: 'cut copy paste | view edit rename download addfavorite | zip unzip | remove', 
      
 

     file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onload = function(e) {
            callback(e.target.result, {
              alt: ''

            });
          };
          reader.readAsDataURL(file);
        });
      }
    },
 
  
 templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }

    ]
  });

    });
</script>

@endsection