@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="visual home" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
		<!-- <img src="images/img28.jpg" alt="image description"> -->
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<form action="/activity/search" class="activity-form" id="activity-form" method="post">
							{{ csrf_field() }}
							<strong class="title">{{ trans('main.what_activities_search') }}</strong>
							<div class="holder">
								<div class="col">
									<select class="form-control" id="activity_id" name="activity_id">
										@foreach ($activitiesList as $item)
											<option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
										@endforeach
									</select>
								</div>
								<div class="col">
									<div class="sub-col">
										<div class="text-field has-ico calender">
											<input id="activity_date"
													 type="text"
													 name="activity_date"
													 value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"
													 placeholder="{{ trans('form.date') }}"
													 class="form-control"
													 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'/>
										</div>
										<!-- <div class="text-field has-ico date"><input type="text" placeholder="Dia en Pucon" class="form-control"></div> -->
									</div>
									<div class="sub-col">
										<!-- <div class="text-field has-ico person"><input type="text" placeholder="Personas" class="form-control"></div> -->
										<input type="submit" value="{{ trans('button-links.search') }}" class="btn btn-primary">
									</div>
								</div>
							</div>
							<p class="form_under_p">{{ trans('main.less_in_all_activities', ['percent' => '10%']) }}</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<main id="main">
		<div class="line-box">
			<div class="line-wrap">
				<p>{{ trans('main.all_activities_in_single_place') }}</p>
			</div>
		</div>

		<div class="container your-reservation activity add" style="padding-bottom: 0px;">
			<div id="id="home-tour-step-2" class="clearfix">
				@include('site.offers.offers_quickinfo')
			</div>
		</div>
		<section id="guia" class="s_guia">
			<div class="container">
				<div class="col-md-5 col-md-push-2">
					<div class="section_title">
						<h2>
						@if(App::getLocale() == 'es_ES' || App::getLocale() == 'pt')
							<span class="size1">{{ trans('main.guide') }}</span>
							<span class="size4">{{ trans('main.complete') }}</span>
							<span class="size2">pucon</span>
							<span class="size3">{{ trans('main.free') }}</span>
						@elseif(App::getLocale() == 'en')
							<span class="size4">{{ trans('main.complete') }}</span>
							<span class="size2">pucon</span>
							<span class="size1">{{ trans('main.guide') }}</span>
							<span class="size3">{{ trans('main.free') }}</span>
						@endif
						</h2>
					{{--@if(App::getLocale() == 'es_ES' || App::getLocale() == 'pt')
						<h1>{{ trans('main.guide') }}</h1>
						<h4>{{ trans('main.complete') }}</h4>
						<h2>pucon</h2>
						<h3>{{ trans('main.free') }}</h3>
					@elseif(App::getLocale() == 'en')
						<h4>{{ trans('main.complete') }}</h4>
						<h2>pucon</h2>
						<h1>{{ trans('main.guide') }}</h1>
						<h3>{{ trans('main.free') }}</h3>
					@endif--}}
					</div>
				</div>
				<div class="col-md-2 col-md-pull-5">
					<ul>
						<li><a href="#">
								<svg xmlns="http://www.w3.org/2000/svg"
									  xmlns:xlink="http://www.w3.org/1999/xlink"
									  version="1.1" x="0px" y="0px" viewBox="0 0 459.486 459.486"
									  style="enable-background:new 0 0 459.486 459.486;"
									  width="512px"
									  height="512px">
									<g>
										<path
											d="M370.073,180.346c-12.088,0-23.621,2.416-34.149,6.783l-37.012-71.814h42.78c4.977,0,9.024,4.049,9.024,9.025   c0,4.977-4.048,9.025-9.024,9.025h-8.813c-4.143,0-7.5,3.358-7.5,7.5s3.357,7.5,7.5,7.5h8.813   c13.247,0,24.024-10.777,24.024-24.025c0-13.247-10.777-24.025-24.024-24.025h-55.083c-2.615,0-5.042,1.363-6.404,3.596   c-1.361,2.233-1.461,5.015-0.263,7.34l15.374,29.829H172.09l-13.146-25.765h20.805c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5   h-55.083c-4.143,0-7.5,3.358-7.5,7.5s3.357,7.5,7.5,7.5h17.438l16.805,32.936l-27.494,42.595c-12.53-6.696-26.829-10.5-42.002-10.5   C40.11,180.346,0,220.456,0,269.758c0,49.303,40.11,89.413,89.413,89.413c38.454,0,71.314-24.401,83.914-58.532l37.929,2.378   l-2.115,6.884c-1.218,3.959,1.005,8.156,4.964,9.374c0.734,0.226,1.478,0.333,2.208,0.333c3.206,0,6.174-2.072,7.166-5.297   l3.161-10.291c0.886,0.069,1.779,0.115,2.683,0.115c18.955,0,34.377-15.421,34.377-34.377c0-9.359-3.764-17.852-9.853-24.057   l53.128-81.998l15.627,30.32c-25.174,15.836-41.942,43.862-41.942,75.736c0,49.303,40.11,89.413,89.413,89.413   s89.413-40.11,89.413-89.413C459.486,220.456,419.376,180.346,370.073,180.346z M166.791,163.699l37.372,73.246l-30.836,1.933   c-5.87-15.901-16.139-29.686-29.322-39.88L166.791,163.699z M163.826,269.758c0,5.193-0.539,10.262-1.556,15.158l-50.252-3.151   c1.911-3.584,2.999-7.67,2.999-12.007s-1.087-8.423-2.998-12.007l50.252-3.151C163.287,259.497,163.826,264.565,163.826,269.758z    M89.413,259.154c5.847,0,10.604,4.757,10.604,10.604s-4.757,10.604-10.604,10.604c-5.848,0-10.604-4.757-10.604-10.604   S83.565,259.154,89.413,259.154z M115.942,242.476l19.89-30.815c9.332,7.471,16.828,17.133,21.706,28.207L115.942,242.476z    M89.413,344.171C48.382,344.171,15,310.79,15,269.758c0-41.031,33.382-74.413,74.413-74.413c12.177,0,23.669,2.959,33.826,8.166   l-25.904,40.131l-8.319,0.521c-13.936,0.214-25.208,11.609-25.208,25.594s11.272,25.381,25.208,25.594l68.521,4.296   C146.002,325.836,119.815,344.171,89.413,344.171z M177.37,253.654l22.385-1.404c-3.051,5.132-4.809,11.117-4.809,17.508   c0,6.391,1.759,12.376,4.809,17.508l-22.385-1.404c0.954-5.226,1.456-10.608,1.456-16.105S178.324,258.88,177.37,253.654z    M231.243,289.038l5.248-17.082c1.216-3.959-1.01-8.155-4.969-9.371c-3.958-1.215-8.155,1.009-9.371,4.969l-5.242,17.064   c-4.251-3.557-6.963-8.896-6.963-14.86c0-10.684,8.692-19.376,19.377-19.376s19.377,8.692,19.377,19.376   C248.7,279.795,241.03,288.071,231.243,289.038z M241.271,237.527c-3.724-1.385-7.749-2.145-11.948-2.145   c-1.331,0-2.642,0.084-3.934,0.232l-4.908,0.308l-40.738-79.841h114.297L241.271,237.527z M370.073,344.171   c-41.031,0-74.413-33.381-74.413-74.413c0-26.074,13.491-49.043,33.848-62.336l23.005,44.637c1.332,2.583,3.954,4.065,6.673,4.065   c1.157,0,2.331-0.269,3.43-0.835c3.683-1.897,5.129-6.42,3.231-10.103l-23.015-44.655c8.443-3.334,17.627-5.187,27.24-5.187   c41.031,0,74.413,33.381,74.413,74.413C444.486,310.79,411.104,344.171,370.073,344.171z"
											fill="#FFFFFF"/>
										<path
											d="M376.996,266.89c-2.517-6.272-11.728-5.909-13.984,0.341c-1.103,3.057-0.028,6.603,2.579,8.539   c2.471,1.835,5.886,1.968,8.489,0.318C377.11,274.168,378.395,270.214,376.996,266.89   C376.815,266.44,377.186,267.34,376.996,266.89z"
											fill="#FFFFFF"/>
									</g>
								</svg>
							</a>
							{{ trans('main.bicycle') }}
						</li>
						<li><a href="#">
								<svg version="1.1"
									  xmlns="http://www.w3.org/2000/svg"
									  x="0px"
									  y="0px"
									  width="512px"
									  height="512px"
									  viewBox="0 0 512 512"
									  enable-background="new 0 0 512 512">
									<g>
										<path fill="#FFFFFF" d="M123.029,343.463c-14.18,0-25.715,11.535-25.715,25.715s11.537,25.715,25.715,25.715
                                c14.178,0,25.714-11.535,25.714-25.715S137.207,343.463,123.029,343.463z M123.029,376.184c-3.864,0-7.007-3.145-7.007-7.006
                                c0-3.863,3.144-7.008,7.007-7.008c3.862,0,7.007,3.143,7.007,7.008C130.036,373.041,126.891,376.184,123.029,376.184z"/>
										<path fill="#FFFFFF" d="M388.972,343.463c-14.18,0-25.715,11.535-25.715,25.715s11.536,25.715,25.715,25.715
                                s25.715-11.535,25.715-25.715C414.688,354.998,403.15,343.463,388.972,343.463z M388.972,376.184c-3.863,0-7.007-3.145-7.007-7.006
                                c0-3.863,3.145-7.008,7.007-7.008s7.007,3.143,7.007,7.008C395.979,373.041,392.835,376.184,388.972,376.184z"/>
										<path fill="#FFFFFF" d="M500.127,324.055v-87.771v-95.59c0-29.772-24.222-53.994-53.994-53.994H95.751
                                c-46.25,0-83.877,37.628-83.877,83.878v153.475C4.669,329.465,0,338.08,0,347.764v1.147c0,16.333,13.288,29.621,29.621,29.621
                                h38.081c4.469,26.507,27.569,46.767,55.327,46.767c27.757,0,50.858-20.26,55.327-46.767h155.291
                                c4.469,26.507,27.568,46.767,55.326,46.767c27.759,0,50.858-20.26,55.327-46.767h38.08c16.334,0,29.621-13.288,29.621-29.621
                                v-1.147C512,338.08,507.33,329.465,500.127,324.055z M481.419,226.93h-25.671c-1.313,0-2.383-1.067-2.383-2.382V152.43
                                c0-1.313,1.066-2.382,2.383-2.382h25.671V226.93z M18.708,348.911v-1.147c0-6.022,4.895-10.926,10.913-10.926h47.582
                                c-4.76,6.727-8.078,14.537-9.502,22.986h-38.08C23.603,359.824,18.708,354.93,18.708,348.911z M123.029,406.591
                                c-20.63,0-37.414-16.784-37.414-37.415c0-20.63,16.784-37.414,37.414-37.414c20.63,0,37.414,16.784,37.414,37.414
                                C160.443,389.807,143.659,406.591,123.029,406.591z M333.645,359.824h-155.29c-4.467-26.508-27.569-46.77-55.327-46.77
                                c-8.303,0-16.181,1.825-23.279,5.075H30.582V170.579c0-35.936,29.235-65.169,65.169-65.169h350.382
                                c16.218,0,29.906,11.001,34.019,25.932h-24.404c-11.629,0-21.09,9.46-21.09,21.09v72.118c0,11.629,9.46,21.09,21.09,21.09h25.673
                                v72.493h-69.17c-7.097-3.249-14.976-5.076-23.278-5.076C361.214,313.057,338.111,333.316,333.645,359.824z M388.972,406.591
                                c-20.63,0-37.414-16.784-37.414-37.415c0-20.63,16.784-37.414,37.414-37.414s37.413,16.784,37.413,37.414
                                C426.385,389.807,409.602,406.591,388.972,406.591z M493.292,348.911c0,6.019-4.896,10.913-10.913,10.913H444.3
                                c-1.425-8.449-4.742-16.26-9.503-22.986h47.582c6.019,0,10.913,4.902,10.913,10.926V348.911z"/>
										<path fill="#FFFFFF" d="M407.057,224.548V152.43c0-11.629-9.46-21.09-21.09-21.09H97.958c-24.884,0-45.129,20.245-45.129,45.129
                                v48.08c0,11.629,9.46,21.09,21.09,21.09h312.049C397.597,245.638,407.057,236.177,407.057,224.548z M239.297,150.048h73.537v76.882
                                h-73.537V150.048L239.297,150.048z M220.589,226.93h-73.535v-76.882h73.535V226.93z M71.537,224.548v-48.08
                                c0-14.568,11.853-26.421,26.421-26.421h30.389v76.882H73.919C72.604,226.93,71.537,225.861,71.537,224.548z M388.349,224.548
                                c0,1.313-1.066,2.382-2.382,2.382H331.54v-76.882h54.427c1.313,0,2.382,1.068,2.382,2.382V224.548z"/>
										<path fill="#FFFFFF" d="M460.886,303.584c5.166,0,9.354-4.188,9.354-9.354v-8.314c0-5.166-4.188-9.354-9.354-9.354
                                s-9.354,4.188-9.354,9.354v8.314C451.532,299.396,455.72,303.584,460.886,303.584z"/>
									</g>
								</svg>
							</a>
							{{ trans('main.bus') }}
						</li>
						<li><a href="#">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									version="1.1"
									viewBox="0 0 470 470"
									enable-background="new 0 0 470 470"
									width="512px"
									height="512px">
									<g>
										<path
											d="m126.184,358.951c19.299,0 35-15.701 35-35s-15.701-35-35-35-35,15.701-35,35 15.701,35 35,35zm0-55c11.028,0 20,8.972 20,20s-8.972,20-20,20-20-8.972-20-20 8.971-20 20-20z"
											fill="#FFFFFF"/>
										<path
											d="m343.816,288.951c-19.299,0-35,15.701-35,35s15.701,35 35,35 35-15.701 35-35-15.701-35-35-35zm0,55c-11.028,0-20-8.972-20-20s8.972-20 20-20 20,8.972 20,20-8.971,20-20,20z"
											fill="#FFFFFF"/>
										<path
											d="m137.5,116.049h23.779c4.143,0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-23.779c-10.423,0-27.031,7.176-34.177,14.767l-60.088,63.845c-2.051,2.179-2.609,5.368-1.423,8.115 1.187,2.747 3.893,4.525 6.885,4.525h290.271c2.562,0 4.945-1.307 6.323-3.467 1.377-2.159 1.558-4.873 0.478-7.195l-30.854-66.365c-3.315-7.046-14.628-14.225-22.415-14.225h-101.221c-4.143,0-7.5,3.358-7.5,7.5l-.001,68.752h-117.722l48.19-51.204c4.243-4.508 17.066-10.048 23.254-10.048zm61.279,0h93.7c2.203,0.103 7.842,3.681 8.849,5.581l25.883,55.671h-128.433l.001-61.252z"
											fill="#FFFFFF"/>
										<path
											d="m470,257.692c0-26.631-20.555-55.149-45.819-63.57-0.017-0.006-35.078-11.693-35.078-11.693-5.854-1.951-13.576-8.812-16.203-14.394l-30.84-65.535c-8.299-17.636-30.068-31.451-49.56-31.451h-155c-18.639,0-43.247,10.632-56.022,24.206l-69.158,73.482c-6.909,7.34-12.32,20.984-12.32,31.064v94.15c0,20.678 16.822,37.5 37.5,37.5h14.06c3.775,37.846 35.8,67.5 74.624,67.5s70.849-29.654 74.624-67.5h45.509c4.143,0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-45.509c-3.775-37.846-35.8-67.5-74.624-67.5s-70.849,29.654-74.624,67.5h-14.06c-12.406,0-22.5-10.093-22.5-22.5v-94.15c0-6.294 3.929-16.2 8.242-20.783l69.159-73.483c9.941-10.563 30.594-19.486 45.099-19.486h155c13.682,0 30.162,10.458 35.987,22.838l30.84,65.535c4.421,9.395 15.182,18.955 25.031,22.238l28.498,9.499c-0.492,2.841-0.748,5.729-0.748,8.642 0,25.238 18.65,46.198 42.892,49.831v29.32c0,12.407-8.357,22.5-18.631,22.5h-17.929c-3.775-37.846-35.8-67.5-74.624-67.5-41.355,0-75,33.645-75,75s33.645,75 75,75c38.824,0 70.849-29.654 74.624-67.5h17.929c18.544,0 33.631-16.822 33.631-37.5v-36.26zm-343.816,6.259c33.084,0 60,26.916 60,60s-26.916,60-60,60-60-26.916-60-60 26.916-60 60-60zm217.632,120c-33.084,0-60-26.916-60-60s26.916-60 60-60 60,26.916 60,60-26.916,60-60,60zm83.292-169.15c0-0.969 0.04-1.934 0.117-2.893 13.16,7.627 23.787,22.37 26.864,37.266-15.466-3.785-26.981-17.756-26.981-34.373z"
											fill="#FFFFFF"/>
									</g>
								</svg>
							</a>
							{{ trans('main.car') }}
						</li>
						<li><a href="#">
								<svg version="1.1"
									  xmlns="http://www.w3.org/2000/svg"
									  x="0px"
									  y="0px"
									  width="491.52px"
									  height="491.52px"
									  viewBox="0 0 491.52 491.52"
									  enable-background="new 0 0 491.52 491.52">
									<path fill="#FFFFFF" d="M353.043,250.91l-0.83-7.609h-1.272l-0.343-6.239l-0.305-1.171c-0.217,0.056-0.429,0.122-0.637,0.195v7.215
                            h1.283l-0.343-6.239l1.615,6.239l0.81,7.612L353.043,250.91L353.043,250.91z M344.562,243.301h5.094v-7.215
                            c-3.187,1.125-5.224,4.203-5.094,7.507V243.301z M359.863,248.801l0.006,162.901c0,4.224-3.425,7.648-7.65,7.648
                            c-4.225,0-7.648-3.424-7.648-7.648V251.124h-33.647c-3.156,0-6.282-0.491-9.272-1.437c-2.965-0.938-5.805-2.34-8.408-4.173
                            l-7.422-5.222l-10.531,34.214c-0.675,2.2-1.51,4.348-2.488,6.436c-0.32,0.683-0.648,1.349-0.984,1.994l11.047,20.229
                            c0.115,0.176,0.226,0.356,0.33,0.545l-0.014,0.006c0.793,1.444,1.478,2.988,2.045,4.615c0.57,1.627,0.998,3.262,1.281,4.886
                            l14.062,80.874c1.449,8.341-0.623,16.489-5.147,22.922c-4.526,6.438-11.515,11.146-19.887,12.604
                            c-0.938,0.162-1.812,0.277-2.619,0.349c-0.897,0.078-1.783,0.117-2.647,0.117c-7.363,0-14.321-2.687-19.761-7.265
                            c-5.353-4.512-9.208-10.843-10.495-18.241l-13.201-75.895l-4.463-8.171l-3.688,11.573c-0.438,1.376-0.966,2.701-1.574,3.967
                            c-0.65,1.354-1.35,2.596-2.094,3.717l-47.582,71.645c-2.894,4.356-6.733,7.75-11.086,10.082c-4.471,2.396-9.477,3.644-14.533,3.645
                            v0.029c-2.968,0-5.957-0.429-8.871-1.312c-2.783-0.841-5.51-2.109-8.099-3.827c-7.061-4.69-11.554-11.812-13.115-19.537
                            c-1.556-7.707-0.177-16.003,4.503-23.054l45.205-68.062l39.479-127.43c0.24-0.784,0.449-1.423,0.625-1.924
                            c4.252-12.068,12.875-21.718,23.482-27.412c10.715-5.751,23.469-7.497,35.857-3.686c0.73,0.225,1.328,0.419,1.787,0.581
                            c14.953,5.271,49.371,32.862,58.311,40.148h23.613v-7.999c0-4.225,3.425-7.65,7.648-7.65c4.227,0,7.65,3.425,7.65,7.65v9.369
                            c8.018,2.622,12.746,8.811,14.09,10.57l0.092,0.121c2.021,2.629,3.625,5.599,4.715,8.811c1.062,3.127,1.638,6.449,1.638,9.87
                            c0,4.246-0.882,8.318-2.474,12.044c-1.644,3.847-4.043,7.285-7.011,10.128c-0.466,0.447-3.933,2.995-8.425,5.095
                            C361.665,248.043,360.786,248.43,359.863,248.801L359.863,248.801z M356.01,233.798c2.764-1.291,4.176-2.17,4.283-2.273
                            c1.5-1.437,2.709-3.165,3.529-5.088c0.778-1.826,1.212-3.868,1.212-6.045c0-1.764-0.28-3.428-0.797-4.95
                            c-0.546-1.61-1.354-3.104-2.374-4.431l-0.092-0.121c-0.817-1.07-4.196-5.492-9.035-5.746c-0.174,0.012-0.349,0.018-0.525,0.018
                            c-0.426,0-0.845-0.036-1.253-0.103c-0.192-0.02-0.354-0.034-0.481-0.042c-0.088-0.005-0.356-0.008-0.821-0.008h-31.438
                            c-1.994,0-3.811-0.759-5.177-2.006c-3.661-3.021-41.573-34.133-55.501-39.043c-0.529-0.187-0.925-0.32-1.188-0.401
                            c-8.271-2.544-16.848-1.346-24.098,2.546c-7.354,3.947-13.332,10.64-16.283,19.011c-0.199,0.57-0.35,1.014-0.445,1.324
                            l-39.817,128.518l-7.317-2.25l7.336,2.272c-0.278,0.896-0.707,1.707-1.248,2.41l-45.496,68.504
                            c-2.362,3.561-3.063,7.729-2.283,11.592c0.776,3.845,3.028,7.4,6.575,9.757c1.268,0.843,2.644,1.476,4.08,1.911
                            c1.447,0.436,2.939,0.648,4.43,0.648v0.03c2.545,0,5.07-0.631,7.334-1.844c2.137-1.146,4.044-2.84,5.506-5.042l47.582-71.646
                            c0.438-0.662,0.8-1.283,1.073-1.854c0.314-0.656,0.581-1.32,0.794-1.986l9.117-28.627l7.29,2.311l-7.317-2.33
                            c1.287-4.041,5.607-6.272,9.648-4.985c2.18,0.694,3.837,2.272,4.694,4.217l13.356,24.454l0.024-0.013
                            c0.488,0.893,0.781,1.841,0.89,2.793l13.345,76.712c0.647,3.723,2.563,6.887,5.216,9.122c2.698,2.271,6.189,3.604,9.918,3.604
                            c0.449,0,0.895-0.019,1.33-0.057c0.512-0.044,0.967-0.103,1.357-0.169c4.174-0.729,7.662-3.081,9.927-6.3
                            c2.265-3.221,3.3-7.314,2.567-11.521l-14.062-80.875c-0.15-0.862-0.357-1.675-0.619-2.425c-0.261-0.745-0.604-1.505-1.025-2.275
                            l6.72-3.688l-6.732,3.692c-0.108-0.197-0.206-0.396-0.297-0.6l-13.123-24.027l-0.022,0.012c-1.465-2.682-1.164-5.854,0.512-8.176
                            c0.835-1.303,1.555-2.586,2.145-3.847c0.651-1.391,1.227-2.875,1.709-4.452l13.637-44.304l7.318,2.25l-7.34-2.259
                            c1.248-4.054,5.547-6.329,9.602-5.081c0.961,0.296,1.822,0.763,2.561,1.358l15.639,11.002c1.277,0.9,2.7,1.597,4.208,2.074
                            c1.488,0.471,3.06,0.715,4.654,0.715h38.74c0.501,0,0.776-0.003,0.869-0.008c0.108-0.006,0.225-0.014,0.349-0.025
                            C352.758,235.197,354.508,234.5,356.01,233.798L356.01,233.798z M352.213,197.481l-0.867,7.601c0.295,0.033,0.595,0.05,0.897,0.049
                            L352.213,197.481L352.213,197.481z"/>
									<path fill="#FFFFFF" d="M324.256,107.104c0-8.368-3.392-15.945-8.877-21.43c-5.481-5.483-13.059-8.875-21.428-8.875
                            s-15.945,3.392-21.428,8.875c-5.504,5.502-8.906,13.081-8.906,21.429h0.029c0,8.371,3.393,15.949,8.875,21.433
                            c5.483,5.484,13.061,8.876,21.43,8.876s15.946-3.392,21.43-8.876C320.863,123.052,324.256,115.475,324.256,107.104L324.256,107.104z
                             M326.241,139.397c-8.266,8.264-19.679,13.376-32.289,13.376s-24.026-5.111-32.289-13.376c-8.265-8.264-13.375-19.682-13.375-32.292
                            h0.03c0-12.628,5.1-24.044,13.346-32.29c8.264-8.263,19.68-13.375,32.288-13.375c12.607,0,24.023,5.112,32.288,13.376
                            c8.264,8.265,13.376,19.681,13.376,32.289C339.616,119.714,334.506,131.132,326.241,139.397L326.241,139.397z"/>
									<path fill="#FFFFFF" d="M175.581,252.158L175.581,252.158c-3.126,11.326-12.745,16.182-23.587,16.336
                            c-3.828,0.053-7.771-0.5-11.538-1.569s-7.452-2.675-10.755-4.722c-9.553-5.917-15.89-15.398-13.197-26.75
                            c0.035-0.225,0.082-0.451,0.14-0.677l0.011,0.002l16.438-65.345c0.048-0.259,0.113-0.518,0.191-0.776l0.03,0.009
                            c1.906-6.242,5.822-10.921,10.742-14.201l4.261,6.39l-4.229-6.39c5.272-3.514,11.718-5.388,17.925-5.811
                            c1.926-0.131-0.445-1.577,1.093-3.354c4.636-5.359,9.487-10.96,15.734-9.055c8.12,2.48,14.464,8.008,18.151,14.942
                            c3.695,6.941,4.744,15.286,2.271,23.39l-23.541,77.12c-0.033,0.156-0.07,0.311-0.113,0.467l-0.027-0.008V252.158L175.581,252.158z
                             M184.622,170.138c1.245-4.079,0.723-8.271-1.128-11.749c-1.855-3.486-5.033-6.262-9.092-7.502c-3.264-0.995,1.74,2.753,0.283,4.436
                            c-3.676,4.248-7.213,8.332-11.651,8.635c-3.732,0.255-7.507,1.314-10.462,3.277l0.008,0.014c-2.071,1.38-3.705,3.212-4.51,5.513
                            h0.003l-0.097,0.382h0.002l-0.009,0.02l-16.438,65.348l-7.439-1.86l7.448,1.874c-0.051,0.201-0.108,0.398-0.175,0.591
                            c-0.752,3.82,2.186,7.471,6.377,10.068c2.05,1.27,4.4,2.282,6.855,2.979c2.457,0.698,4.929,1.06,7.218,1.028
                            c4.315-0.062,8.032-1.584,9.009-5.111l-0.021-0.007c0.079-0.291,0.177-0.576,0.286-0.849L184.622,170.138L184.622,170.138z"/>
									<path fill="#FFFFFF" d="M177.245,122.079l-6.378,16.932c-1.491,3.96,0.511,8.379,4.47,9.87c3.961,1.491,8.379-0.51,9.87-4.47
                            l6.378-16.932c1.491-3.96-0.51-8.379-4.47-9.87C183.155,116.118,178.736,118.119,177.245,122.079L177.245,122.079z"/>
									<path fill="#FFFFFF" d="M189.948,179.386c-4.107-0.977-8.232,1.562-9.209,5.67c-0.978,4.109,1.561,8.232,5.67,9.21l17.592,4.227
                            c4.109,0.977,8.233-1.562,9.211-5.67c0.977-4.108-1.562-8.232-5.67-9.21L189.948,179.386z"/>
									<path fill="#FFFFFF" d="M172.959,235.006c-4.108-0.978-8.233,1.562-9.211,5.67c-0.976,4.108,1.563,8.232,5.672,9.209l17.593,4.229
                            c4.107,0.977,8.231-1.562,9.211-5.671c0.976-4.107-1.564-8.231-5.67-9.208L172.959,235.006z"/>
								</svg>
							</a>
							{{ trans('main.walking') }}
						</li>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="go-to-guide">
						<p><span>{{ trans('main.all_answers_here') }}</span> {{ trans('main.what_you_need_to_know_to_enjoy') }}
						</p>
						<p class="tegs"><span>{{ trans('main.maps_guides_addresses_suggestions') }}</span></p>
						<a href="#" class="btn-orange">
							<img src="{{ asset('images/arrow.png') }}" alt="">
							{{ trans('button-links.go_to_guide') }}
						</a>
					</div>
				</div>
			</div>
		</section>
		<section id="howitworks" class="s_howitworks">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="section_title">
							<h2>{{ trans('main.how_does_it_work') }} <span>KipMuving</span></h2>
							<p>{{ trans('main.best_deals') }}</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="howitworks_block">
							<img src="{{ asset('images/10.svg') }}" alt="">
							<p><span>KipMuving</span> {{ trans('main.has_an_agreement') }}
								<span>{{ trans('main.preferential_prices') }}</span></p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="howitworks_block">
							<img src="{{ asset('images/umbrella.svg') }}" alt="">
							<p>
								<span>{{ trans('main.supporters') }}</span> {{ trans('main.with_a_small_commission') }}
								<span>U$ 5</span> {{ trans('main.for_any_reservation_will_pay_for_site') }}
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="howitworks_block last-child">
							<img src="{{ asset('images/broken-link.svg') }}" alt="">
							<p>{{ trans('main.we_make') }} <span>{{ trans('main.your_union_with_the_agency') }}</span>
								{{ trans('main.you_pay_your_tours') }}</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="text-bar">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12 col">
						<div class="img-holder"><img src="images/img33.png" alt=""></div>
						<div class="text">
							<strong class="value">1%</strong>
							<div class="txt">{{ trans('main.for_the_organization') }}
								<strong>{{ trans('main.parks_for_chili') }}</strong></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 col">
						<p>{{ trans('main.kipmuving_is_aware_that_nature') }} http://www.parquesparachile.cl/</p>
					</div>
				</div>
			</div>
		</div>
		<div class="all-activities" style="padding-top: 50px;">
			<div class="container">
				<header>
					<h1>{{ trans('main.activities_in_pucon') }}</h1>
					<p>{{ trans('main.first_choose_your_itinerary') }}</p>
				</header>


				<div class="row">
					<?php $key = 0; ?>
					@foreach($activities as $activity)
						<div class="col-md-3 col-sm-6 col-xs-12 col">
							@include('site.partials.activities.all-list-item-arr')
                        </div>
                        <?php ++$key?>
                        @if($key === 2)
                            <div class="clearfix visible-sm-block"></div>
                        @elseif($key===4)
                            <div class="clearfix visible-md-block"></div>
							<div class="clearfix visible-lg-block"></div>
							<div class="clearfix visible-sm-block"></div>
                            <?php $key = 0; ?>
                        @endif
					@endforeach
				</div>


				<div class="btn-holder">
					<a href="{{ action('ActivityController@index') }}"
						class="btn btn-success">{{ trans('button-links.see_all_activities') }}</a>
				</div>
			</div>
		</div>
		<section id="viagem" class="s_viagem">
			<div class="container">
				<div class="block">
					<h3>{{ trans('main.more_than_activities', ['activities' => 40]) }}</h3>
					<p>{{ trans('main.all_activities_in_one_place') }}</p>
				</div>
				<div class="block">
					<h3>{{ trans('main.more_time') }}</h3>
					<p>{{ trans('main.enjoy_your_entire_trip') }}</p>
				</div>
				<div class="block">
					<h3>{{ trans('main.all_agencies_together') }}</h3>
					<p>{{ trans('main.what_you_can_see_here') }}</p>
				</div>
			</div>
		</section>
	</main>
@stop
