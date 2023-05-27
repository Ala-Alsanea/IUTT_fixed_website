<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    @include('backEnd.includes.head')
   <link rel="stylesheet" type="text/css" href="{{ asset('plugins/auto/auto.css') }}">
</head>

 <style type="text/css">

    </style>
<body class="blank-page bg-full-screen-image">
<div class="app" id="app">

   
 <div class="app-content content p-a-md">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
  <section id="auth-login" class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
    <div class="col-md-6 col-12 px-0">
    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
    <div class="card-header pb-1">
        <div class="card-title">
            <h4 class="text-center mb-2"> {{ trans('backLang.signedInToControl') }}</h4>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
      
           
           <div class="">
            
            <form name="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                <div class="md-form-group float-label {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{ old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.connectEmail') }}</label>
                </div>
                <div class="md-form-group float-label {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="md-input" required>
                    <label>{{ trans('backLang.connectPassword') }}</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="m-b-md">
                    <label class="md-check">
                        <input type="checkbox" name="remember"><i
                                class="primary"></i> {{ trans('backLang.keepMeSignedIn') }}
                    </label>

                </div>
                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.signIn') }}</button>
            </form>
            @if(Helper::GeneralWebmasterSettings("register_status"))
                <br>
                <div class="text-center">
                    <a href="{{ url('/register') }}" class="btn info btn-block p-x-md"><i class="material-icons">&#xe7fe;</i> {{ trans('backLang.createNewAccount') }}
                    </a>
                </div>
            @endif
        </div>
                <hr>
                <div class="d-flex">
                     <div class="p-v-lg btn-block">
                    <div class="m-b">
                      {{-- <a href="{{ url('/register') }}" class="text-primary _600">{{ trans('backLang.createNewAccount') }}</a> --}}
                                        </div>
                </div>
                   
                    <div class="p-v-lg btn-block text-left">
                    <div class="m-b"><a href="{{ url('/password/reset') }}"
                                        class="text-primary _600">{{ trans('backLang.forgotPassword') }}</a></div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <div class="card-content">
                        <img class="img-fluid" src="{{ URL::asset('plugins/auto/img/login.png') }}" alt="branding logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

          </div>
       </div>
    </div>
 </div>

   
 
</div>
@include('backEnd.includes.foot')
</body>
</html>

