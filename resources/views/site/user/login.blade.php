@extends('site.layouts.default-new')


{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="page-header">
					<h1><strong>Entrar en mi cuenta</strong></h1>
					<p>Haga login abajo para modificar sus aventuras y datos</p>
					{{ Confide::makeLoginForm()->render() }}
				</div>
			</div>
		</div>
	</div>
</main>
@stop
