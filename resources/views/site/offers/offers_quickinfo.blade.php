<section class="program-schedule @if(isset($classPlace)){{$classPlace}} @endif" id="program-schedule">
  <strong><span id="program_activities">{{ $count['offers'] }}</span> {{ trans('main.activities_for') }} <span id="program_persons">{{ $count['persons'] }}</span> {{ trans('main.persons') }}</strong>
  <p>Total de <span {{ session('currency.type') === 'BRL' ? 'class=brl-curr' : '' }} id="program_total">0</span></p>
  <a href="{{ action('CalendarController@index') }}" class="btn btn-success">{{ trans('button-links.my_agenda') }}</a>
  <a href="{{ action('ReservationController@index') }}" class="btn btn-primary">Confirmar</a>
</section>
