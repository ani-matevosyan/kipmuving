<section class="program-schedule @if(isset($classPlace)) {{$classPlace}} @endif" id="program-schedule">
  <strong><span id="program_activities" data-activities="{{ $count['offers'] }}">{{ $count['offers'] }}</span> {{ trans('main.activities') }} {{ trans('main.and') }}
    <br> <span id="program_subscriptions" data-subscriptions="{{ $count['special_offers'] }}">{{ $count['special_offers'] }}</span> {{ trans('main.subscriptions') }} {{ trans('main.for') }} <span id="program_persons">{{ $count['persons'] }}</span> {{ trans('main.persons_s') }}</strong>
  <p>{{ trans('main.total_of') }} <span {{ session('currency.type') === 'BRL' ? 'class=brl-curr' : '' }} id="program_total">{{ number_format($count['total'], 0, ".", ".") }}</span></p>
  <a href="{{ action('CalendarController@index') }}" class="btn btn-success">{{ trans('button-links.my_agenda') }}</a>
  <a href="{{ action('ReservationController@index') }}" class="btn btn-primary">{{ trans('button-links.confirm') }}</a>
</section>
