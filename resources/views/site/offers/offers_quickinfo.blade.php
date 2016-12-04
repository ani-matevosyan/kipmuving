<section class="program-schedule" id="program-schedule">
  <h2>{{ trans('main.program') }}</h2>
  {{--<strong class="sub-title"><span>{{ $offers_count }}</span> actividades para <span>{{ $offers_persons }}</span> personas</strong>--}}
  <strong class="sub-title">{{ trans('main.activities_for_persons', ['activities' => $count['offers'], 'persons' => $count['persons']]) }}</strong>
  <a href="/calendar" class="'btn btn-primary">{{ trans('button-links.my_agenda') }}</a>
</section>
