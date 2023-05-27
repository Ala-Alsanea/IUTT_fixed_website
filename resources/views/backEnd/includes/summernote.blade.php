
<script type="text/javascript" src="{{ asset('plugins/backEnd/libs/jquery/summernote/dist/summernote-lite.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('plugins/backEnd/libs/jquery/summernote/dist/plugin/table/summernote-ext-table.js') }}"></script>
 
 

<script type="text/javascript">
         $(document).ready(function () {
            $('textarea[ui-jp="summernote"]').summernote({
                lang   : "en-US",
                height : 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline','clear']],
                    ['fontname', ['fontname', 'fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['insert', ['hr', 'jTable', 'link', 'picture']],
                    ['misc', ['undo', 'redo', 'fullscreen']],
                ],
                popover: {
                    table: [
                        ['merge', ['jMerge']],
                        ['style', ['jBackcolor', 'jBorderColor', 'jAlign', 'jAddDeleteRowCol']],
                        ['info', ['jTableInfo']],
                        ['delete', ['jWidthHeightReset', 'deleteTable']],
                    ]
                },
                
                 
            });
        });
    </script>
 