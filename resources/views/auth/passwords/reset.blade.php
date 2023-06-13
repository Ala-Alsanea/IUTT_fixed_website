<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('backEnd.includes.head')
        <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/auto/auto.css') }}">
</head>

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
    <div class="card-header">
        <div class="card-title">
            <h4 class="text-center "> {{ trans('backLang.control') }}</h4>

        </div>
    </div>
    <div class="card-content">
        <div class="card-body">

            <div class="divider">
                <div class="divider-text text-uppercase text-muted"><small>{{ trans('backLang.resetPassword') }}</small>
                </div>
            </div>
           <div class="">

             <div class="m-b">
                {{ trans('backLang.resetPassword') }}
            </div>
            <form name="reset" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <div class="md-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{ $email or old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.yourEmail') }}</label>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <div class="md-form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="md-input" required>
                    <label>{{ trans('backLang.newPassword') }}</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif


                <div class="md-form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="md-input" required>
                    <label>{{ trans('backLang.confirmPassword') }}</label>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif

                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.resetPassword') }}</button>
            </form>
        </div>


            </div>
        </div>
    </div>
</div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <div class="card-content">
                        <img class="img-fluid" src="{{ secure_asset('plugins/auto/img/reset-password.png') }}" alt="branding logo">
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

