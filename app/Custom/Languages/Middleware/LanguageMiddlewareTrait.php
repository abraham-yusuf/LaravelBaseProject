<?php

namespace App\Custom\Languages\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait LanguageMiddlewareTrait {

    public function handle(Request $request, Closure $next) {
        // Check if the first segment matches a language code

        if(config('custom.languages.isActiveMultilang')) {

            $lang = $request->segment(1);

            if (!array_key_exists($lang, config('custom.languages.locales'))) {

                // Store segments in array
                $segments = $request->segments();

                $currentLocale = $request->session()->get('applocale');

                if($currentLocale == null || empty($currentLocale)) {
                    $currentLocale = config('app.fallback_locale');
                }

                // Set the default language code as the first segment
                $segments = Arr::prepend($segments, $currentLocale);

                // Redirect to the correct url
                return redirect()->to(implode('/', $segments));
            }
            else {
                $request->session()->put('applocale', $lang);
            }

        }
        return $next($request);
    }

}
