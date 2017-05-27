<?php

namespace App\Http\Composers;

use App;
use App\Locale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MainComposer
{
    public function compose(View $view)
    {
        $locales = Locale::where('active', true)->get();
        foreach ($locales as $key => $locale) {
            $localeCodes[] = $locale['code'];
            if ($locale['code'] === Session::get('currentLocale', config('app.locale'))) {
                $currentLocale = $locale;
                $locales = array_except($locales, $key);
            }
        }

        $view->with('locales', $locales);
        $view->with('currentUser', Auth::user());
        $view->with('currentLocale', $currentLocale);
    }
}