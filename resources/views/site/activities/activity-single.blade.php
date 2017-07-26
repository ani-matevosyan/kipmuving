@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="visual activity-single"
	         @if ($activity->image) style="background-image: url('/{{ $activity['image'] }}')" @endif>
		<div class="gradoverlay"></div>
	</section>

	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a></li>
						@if($activity->name)
							<li>{{ strtoupper($activity->name) }}</li>
						@endif
					</ul>
					@include('site.offers.offers_quickinfo')
					<div class="your-reservation activity add new">
						<div class="row">
							<div id="activity-single-sidebar" class="col-md-4 col-sm-12 col-xs-12">
								@include('site.activities.activity-single-sidebar')
							</div>
							<div class="col-md-8 col-sm-12 col-xs-12">
								<header class="activity-title">
									@if($activity->name)
										<h1>{{ $activity->name }}</h1>
									@endif
									@if($activity->subtitle)
										<p>{{ $activity->subtitle }}</p>
									@endif
								</header>
								<section class="post-box">
									<div class="title-box">
										@if($activity->description)
											<span class="activity-description">{{ $activity->description }}</span>
										@endif
										@if ($activity->weather_embed)
											<div class="weather-box">
												<h2>{{ trans('main.activity_depends_on_the_weather') }}</h2>
												<p>{{ trans('main.this_activity_is_subject_to_weather') }}</p>
												{!! $activity->weather_embed !!}
											</div>
										@endif

										@if ($activity->instagram_name)
											<div class="activity-instagram">
												<span class="activity-tag">{{ $activity->instagram_name }}</span>
												<div id="instafeed5" class="instafeed" data-tag="{{ $activity->instagram_name }}"></div>
												<div class="clearfix"></div>
											</div>
										@endif
										<nav class="subnav">
											<div class="date-time">
												<div class="text-field">
													<input id="reserve-date"
														   type="text"
														   data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
														   placeholder=""
														   value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}">
												</div>
											</div>
											<ul role="tablist">
												<li>{{ trans('main.sort_by') }}</li>
												<li class="active"><a href="#tab2" data-toggle="tab">{{ trans('main.recommendation') }}</a></li>
												<li><a href="#tab3" data-toggle="tab">{{ trans('main.lowest_price') }}</a></li>
												<li><a href="#tab4" data-toggle="tab">{{ trans('main.includes_more_services') }}</a></li>
											</ul>
										</nav>
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="tab2">
											<ul class="accordion">
												@foreach ($activity->offers->sortByDesc('recommendation') as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
											</ul>
										</div>
										<div class="tab-pane" id="tab3">
											<ul class="accordion">
												@foreach ($activity->offers->sortBy('price') as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
											</ul>
										</div>
										<div class="tab-pane" id="tab4">
											<ul class="accordion">
												@foreach ($activity->offers->sortByDesc('includes') as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
											</ul>
										</div>
									</div>

									<div class="comments-block">

										<header class="comments-block__header">
											<div class="comments-block__titles @if (auth()->user()) comments-block__titles_registered @endif">
												<h3 class="comments-block__title">{{ trans('main.ask') }}</h3>
												<p class="comments-block__description">{{ trans('main.you_should_be_registered') }}</p>
											</div>
											@if (auth()->user())
												<form class="comments-block__form" action="{{ action('ActivityController@addComment') }}" method="post">
													{{ csrf_field() }}
													<textarea class="comments-block__textarea" name="message" id="message" rows="3"></textarea>
													<input type="hidden" value="" name="comment_id">
													<input type="hidden" value="{{ $activity->id }}" name="activity_id">
													<button type="submit" class="btn btn-dark-blue comments-block__send-button">{{ trans('main.send') }}</button>
												</form>
											@else
												<a href="{{ url('/login') }}" class="btn btn-dark-blue comments-block__enter-button">{{ trans('button-links.login') }}</a>
											@endif
										</header>

										<ul class="comments-block__comments">
											@if(auth()->user()->hasRole(['developer', 'admin']))

												@if(isset($activity->comments) && count($activity->comments))
													@foreach($activity->comments as $comment)
														<li class="comments-block__comment">
															<header class="comments-block__comment-header">
																<img src="{{ asset($comment->user->avatar) }}" alt="User name" class="comments-block__user-image">
																<strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
																<span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>

																@if(!isset($comment->answer))
																	<a href="#">answer</a>
																@endif

															</header>
															<p class="comments-block__text">{{ $comment->question }}</p>
														</li>

														@if(isset($comment->answer))
															<li class="comments-block__comment comments-block__comment_answer">
																<p class="comments-block__text">{{ $comment->answer }}</p>
															</li>
														@endif

													@endforeach
												@endif

											@else

												@if(isset($activity->comments) && count($activity->comments->where('answer', '<>', null)))
													@foreach($activity->comments->where('answer', '<>', null) as $comment)
														<li class="comments-block__comment">
															<header class="comments-block__comment-header">
																<img src="{{ asset($comment->user->avatar) }}" alt="User name" class="comments-block__user-image">
																<strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
																<span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>
															</header>
															<p class="comments-block__text">{{ $comment->question }}</p>
														</li>
														<li class="comments-block__comment comments-block__comment_answer">
															<p class="comments-block__text">{{ $comment->answer }}</p>
														</li>
													@endforeach
												@endif

											@endif
										</ul>

									</div>

								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div id="myModalX" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<!-- <h4 class="modal-title">Confirmation</h4> -->
				</div>
				<div class="modal-body">
					<div id="the-image">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.close') }}</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL END -->
	<div id="data"></div> <!-- Keep this div for instafeed information -->
@stop
