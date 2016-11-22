<form class="form-horizontal registration " method="POST" action="/login" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" for="email">Email</label>
            <div class="col-md-10 ">
              <div class="text-field">
                <input class="form-control" tabindex="1" placeholder="{{ Lang::get('confide::confide.username_e_mail') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
              </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="password">
                {{ Lang::get('confide::confide.password') }}
            </label>
            <div class="col-md-10">
              <div class="text-field">
                <input class="form-control" tabindex="2" placeholder="{{ Lang::get('confide::confide.password') }}" type="password" name="password" id="password">
              </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <div class="checkbox">
                    <label for="remember" style="padding-left: 0px;">&nbsp;&nbsp;Recordarme
                        <input type="hidden" name="remember" value="0">
                        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1" style="margin-right: 5px;">
                    </label>
                </div>
            </div>
        </div>

        @if ( Session::get('success') )
            <div class="alert">{{ Session::get('success') }}</div>
        @endif

        @if ( Session::get('error') )
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button tabindex="3" type="submit" class="btn btn-primary">Entrar</button>
                <!-- <a class="btn btn-default" href="forgot">{{ Lang::get('confide::confide.login.forgot_password') }}</a> -->
            </div>
        </div>
    </fieldset>
</form>
