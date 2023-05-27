@if(Helper::GeneralWebmasterSettings("register_status"))
<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
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
    <div class="card-header">
        <div class="card-title">
            <h4 class="text-center "> {{ trans('backLang.control') }}</h4>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
         
            <div class="divider">
                <div class="divider-text text-uppercase text-muted"><small>{{ trans('backLang.newUser') }}</small>
                </div>
            </div>
           <div class="">
            
           <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                @if ($errors->has('name'))
                    <div class="alert alert-warning">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-warning">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="md-form-group">
                    <input id="name" type="text" class="md-input" name="name" value="{{ old('name') }}" required
                           autofocus>
                    <label>{{ trans('backLang.fullName') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="email" type="email" class="md-input" name="email" value="{{ old('email') }}" required>

                    <label>{{ trans('backLang.connectEmail') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password" type="password" class="md-input" name="password" required>
                    <label>{{ trans('backLang.connectPassword') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password-confirm" type="password" class="md-input" name="password_confirmation" required>
                    <label>{{ trans('backLang.confirmPassword') }}</label>
                </div>

                <button type="submit" class="btn primary btn-block p-x-md"><i
                            class="material-icons">&#xe7fe;</i> {{ trans('backLang.createNewAccount') }}</button>
            </form>
          
        </div>
                <hr>
                <div class="d-flex">
                     <div class="p-v-lg btn-block text-center">
                         <div>{{ trans('backLang.signedInToControl') }} <a href="{{ url('/login') }}"
                              class="text-primary _600">{{ trans('backLang.signIn') }}</a>
                        </div>
                    </div>
                   
                     

                </div>
            </div>
        </div>
    </div>
</div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <div class="card-content">
                        <img class="img-fluid" src="{{ URL::asset('plugins/auto/img/register.png') }}" alt="branding logo">
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
@else
    <script>
        window.location.href = '{{url("/login")}}';
    </script>
@endif

