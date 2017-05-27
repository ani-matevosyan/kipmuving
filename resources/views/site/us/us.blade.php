@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="#">HOME</a></li>
					<li><a href="#">SU AGENDA</a></li>
					<li>RESERVA</li>
				</ul>
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<form class="registration reser">
							<h1>Inicia sesión</h1>
							<p>Para confirmar la reserva, por favor, registrase en Kipmuving o si ya eres registrado, haga login con su email y clave.</p>
							<div class="holder">
								<div class="social-likes add">
									<!-- <ul>
										<li><a href="#" class="facebook">Registrate con Facebook</a></li>
										<li><a href="#" class="google">Registrate con Google</a></li>
									</ul> -->
									<a href="/registro" class="btn-email">Regístrate utilizando tu dirección de correo eletrónico</a>
								</div>
							</div>
							<footer>
								<div class="text-logout">¿Ya eres miembro de <a href="/login">Kipmuving?</a> Iniciar sesión</div>
							</footer>
						</form>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
