

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
                        <h1><strong>Entrar en mi cuenta</strong></h1>
                        <p>Haga login abajo para modificar sus aventuras y datos</p>
                        {{--{{ Confide::makeLoginForm()->render() }}--}}

                        <form class="form-horizontal registration " method="POST" action="/login" accept-charset="UTF-8">
                            {{--<input type="hidden" name="_token" value="VbmnmEeVoMrrsH6yTE3AxrXn5Vw3xqzwLqq6JKzC">--}}
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="email">Email</label>
                                    <div class="col-md-10 ">
                                        <div class="text-field">
                                            <input class="form-control" tabindex="1" placeholder="Username or Email" type="text" name="email" id="email" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="password">
                                        Password
                                    </label>
                                    <div class="col-md-10">
                                        <div class="text-field">
                                            <input class="form-control" tabindex="2" placeholder="Password" type="password" name="password" id="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <div class="checkbox">
                                            <label for="remember" style="padding-left: 0px;">&nbsp;&nbsp;Recordarme
                                                <input type="hidden" name="remember" value="0">
                                                <span class="jcf-checkbox jcf-unchecked"><span></span><input tabindex="4" type="checkbox" name="remember" id="remember" value="1" style="margin: 0px; position: absolute; height: 100%; width: 100%; opacity: 0;"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button tabindex="3" type="submit" class="btn btn-primary">Entrar</button>
                                        <!-- <a class="btn btn-default" href="forgot">(forgot password)</a> -->
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
