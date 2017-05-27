<section class="program-schedule" id="program-schedule">
  <h2>{{ trans('main.program') }}</h2>
  <strong class="sub-title"><span id="count_activities">{{ $count['offers'] }}</span> {{ trans('main.activities_for') }} <span id="count_persons">{{ $count['persons'] }}</span> {{ trans('main.persons') }}</strong>
  <a href="/calendar" class="'btn btn-primary">{{ trans('button-links.my_agenda') }}</a>
</section>
