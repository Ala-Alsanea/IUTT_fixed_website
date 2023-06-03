@extends('backEnd.layout')

@section('content')
 <?php  
$DetailPage=(object)config('Page.DetailPage'); 
?>

    @if(@Auth::user()->permissionsGroup->webmaster_status)
        @include('backEnd.Permissions.viewSection')
    @endif
        
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
                <button type="button" onclick="document.getElementById('PrimationUpdateAll').submit()"
                        class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
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
