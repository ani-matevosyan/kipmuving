{{--<span style="color: white;">{{ session('cities.current') }}</span>--}}
{{--<a style="color: white; {{ session('cities.current') == 'pucon' ? 'opacity: 1;' : 'opacity: 0.5' }}" href="{{ action('CityController@setCity', ['city' => 'pucon']) }}">Pucon</a>--}}

<a style="color: white; {{ app()->getLocale() == 'en' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'en') }}">
	<img src="/images/en-flag.svg" alt="EN">
</a>
<a style="color: white; {{ app()->getLocale() == 'es_ES' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'es_ES') }}">
	<img src="/images/es_ES-flag.svg" alt="EN">
</a>
<a style="color: white; {{ app()->getLocale() == 'pt' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'pt') }}">
	<img src="/images/pt-flag.svg" alt="EN">
</a>