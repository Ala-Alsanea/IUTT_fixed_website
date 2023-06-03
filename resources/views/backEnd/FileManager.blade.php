@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box1 shadow bkcg">
            <div class="box-header">
                <h3>{{ trans('backLang.FileManager') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.FileManager') }}</a>
                </small>
            </div>

         <div class="box-body">


                  <iframe src="{{asset('filemanager/dialog.php?type=0')}}" style="zoom:0.60" frameborder="0" height="700px" width="99.6%"></iframe>

    </div>


    </div>
</div>

@endsection
