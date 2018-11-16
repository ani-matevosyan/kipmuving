{{--<span style="color: white;">{{ session('cities.current') }}</span>--}}
{{--<a style="color: white; {{ session('cities.current') == 'pucon' ? 'opacity: 1;' : 'opacity: 0.5' }}" href="{{ action('CityController@setCity', ['city' => 'pucon']) }}">Pucon</a>--}}
<style>
    .select2-selection.select2-selection--single{
        height: 32px;
    }
</style>

<a style="color: white; {{ app()->getLocale() == 'en' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'en') }}">
	<img src="/images/en-flag.svg" alt="EN">
</a>
<a style="color: white; {{ app()->getLocale() == 'es_ES' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'es_ES') }}">
	<img src="/images/es_ES-flag.svg" alt="EN">
</a>
<a style="color: white; {{ app()->getLocale() == 'pt' ? 'opacity: 1;' : 'opacity:0.5;' }}" class="admin_lang" href="{{ action('LocaleController@setLocale', 'pt') }}">
	<img src="/images/pt-flag.svg" alt="EN">
</a>

<script>
    if(location.pathname.split('/')[2] == 'activities' && location.pathname.split('/')[4] == 'edit'){
        $(document.body).undelegate('button[name=next_action]', 'click')
            .delegate('button[name=next_action]', "click", function(ev) {
                ev.preventDefault();
                const activity_id = location.pathname.split('/')[3];
                const tripadvisor_link = $('input[name=tripadvisor_link]').val();
                const instagram_link = $('input[name=instagram_link]').val();
                const google_place_id = $('input[name=google_place_id]').val();
                const google_search_word = $('input[name=google_search_word]').val();
                $.ajax({
                    type: 'POST',
                    url: `/updateActivityWidgetsPhotosData`,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': activity_id,
                        'tripadvisor_link': tripadvisor_link,
                        'instagram_link': instagram_link,
                        'google_place_id': google_place_id,
                        'google_search_word': google_search_word,
                    },
                    success: function(res){
//                        console.log(res);
                    },
                    complete: (data) => {
                        $('form').submit();
                    }
                });
        });
	}
</script>