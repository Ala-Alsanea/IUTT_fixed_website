@extends('backEnd.layout')

@section('content')

        <!-- .modal -->
<div id="m-all" class="modal fade" data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <p>
                    {{ trans('backLang.confirmationDeleteMsg') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                <button type="button" onclick="document.getElementById('CatmenusUpdateAll').submit()"
                        class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->
 <?php  
$DetailPage=(object)config('Page.DetailPage'); 
?>
@foreach($ParentMenus as $ParentMenu)
        <!-- .modal -->
<div id="mg-{{ $ParentMenu->Cat_id }}" class="modal fade"
     data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <p>
                    {{ trans('backLang.confirmationDeleteMsg') }}
                    <br>
                    <strong>[ {{ $ParentMenu->CatTitle_ar }}
                        ]</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                <a href="{{ route("parentCatMenusDestroy",["id"=>$ParentMenu->Cat_id]) }}"
                   class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->
@endforeach

<?php
try {
    $edt_id = $EditedMenu->Cat_id;
} catch (Exception $e) {
    $edt_id = 0;
}
$edt_title = "";
?>
<div class="row-col">
     @include('backEnd.CategorieSection.index.SidebarCreateParntMenu')
     @include('backEnd.CategorieSection.index.ContentCreateParntMenu')
   
</div>
@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endsection
