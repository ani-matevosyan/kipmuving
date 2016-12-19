@extends('site.layouts.default-new')
@section('content')
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-header">
                        <h1><strong>{{ trans('main.send_confirmation_email') }}</strong></h1>
                        <p>{{ trans('main.send_confirmation_email_message') }}</p>
                        {{--{{ Confide::makeLoginForm()->render() }}--}}

                        <form class="form-horizontal registration " method="POST" action="{{ action('UserController@sendConfirmEmail') }}" accept-charset="UTF-8">
                            {{--<input type="hidden" name="_token" value="VbmnmEeVoMrrsH6yTE3AxrXn5Vw3xqzwLqq6JKzC">--}}
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="email">{{ trans('form.email') }}</label>
                                    <div class="col-md-10 ">
                                        <div class="text-field">
                                            <input class="form-control"
                                                   tabindex="1"
                                                   placeholder="{{ trans('form.email_placeholder') }}"
                                                   type="email"
                                                   name="email"
                                                   id="email"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button tabindex="2" type="submit" class="btn btn-primary">{{ trans('send') }}</button>
                                        {{--<a class="btn btn-default" href="forgot">(forgot password)</a>--}}
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
