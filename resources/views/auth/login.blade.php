

@extends('site.layouts.default-new')


{{-- Web site Title --}}
{{--@section('title')--}}
    {{--{{ Lang::get('user/user.login') }} ::--}}
    {{--@parent--}}
{{--@stop--}}

{{-- Content --}}
@section('content')
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-header">
                        <h1><strong>{{ trans('main.login') }}</strong></h1>
                        <p>{{ trans('main.login_to_modify') }}</p>
                        <form class="form-horizontal registration " method="POST" action="/login" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="email">{{ trans('form.email') }}</label>
                                    <div class="col-md-10 ">
                                        <div class="text-field">
                                            <input class="form-control" tabindex="1" placeholder="{{ trans('form.email_placeholder') }}" type="text" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="password">
                                        {{ trans('form.password') }}
                                    </label>
                                    <div class="col-md-10">
                                        <div class="text-field">
                                            <input class="form-control" tabindex="2" placeholder="{{ trans('form.password_placeholder') }}" type="password" name="password" id="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <div class="checkbox">
                                            <label for="remember" style="padding-left: 0px;">
                                                <input type="checkbox" name="remember" id="remember" checked>&nbsp;&nbsp;{{ trans('form.remember_me') }}
                                                {{--<span class="jcf-checkbox jcf-unchecked">--}}
                                                    {{--<input tabindex="4" type="checkbox" name="remember" id="remember" value="1" style="margin: 0px; position: absolute; height: 100%; width: 100%; opacity: 0;">--}}
                                                {{--</span>--}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button tabindex="3" type="submit" class="btn btn-primary">{{ trans('button-links.login') }}</button>
                                        {{--<a class="btn btn-default" href="forgot">(forgot password)</a>--}}
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        @if($errors->has('email'))
                            <div class="alert alert-error alert-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        @if($errors->has('password'))
                            <div class="alert alert-error alert-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-info" role="alert">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-info" role="alert">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        @if(Session::has('info'))
                            <div class="alert alert-info" role="alert">
                                {{Session::get('info')}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
