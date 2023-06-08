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
            <h4 class="text-center "> {{ trans('backLang.forgotPassword') }}</h4>

                <p class="text-xs m-t">{{ trans('backLang.enterYourEmail') }}</p>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">

            <div class="divider">
                <div class="divider-text text-uppercase text-muted"><small>{{ trans('backLang.forgotPassword') }}</small>
                </div>
            </div>
           <div class="">

              @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form name="reset" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <div class="md-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email"  name="email" value="{{ old('email') }}" class="md-input" required>
                    <label>{{ trans('backLang.yourEmail') }}</label>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <button type="submit" class="btn primary btn-block p-x-md">{{ trans('backLang.sendPasswordResetLink') }}</button>
            </form>
          <p id="alerts-container"></p>
        </div>
                <hr>
                <div class="d-flex">

                        <div class="p-v-lg text-center">{{ trans('backLang.returnTo') }} <a href="{{ url('/login') }}" class="text-primary _600">{{ trans('backLang.signIn') }}</a></div>



                </div>
            </div>
        </div>
    </div>
</div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <div class="card-content">
                        <img class="img-fluid" src="{{ secure_asset('plugins/auto/img/forgot-password.png') }}" alt="branding logo">
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
