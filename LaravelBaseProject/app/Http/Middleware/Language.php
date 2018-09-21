<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language {
    public function handle(Request $request, Closure $next) {
        // Check if the first segment matches a language code

        $lang = $request->segment(1);

        if (!array_key_exists($lang, config('translatable.locales'))) {

            // Store segments in array
            $segments = $request->segments();

            $currentLocale = $request->session()->get('applocale');

            if($currentLocale == null || empty($currentLocale)) {
                $currentLocale = config('translatable.fallback_locale');
            }

            // Set the default language code as the first segment
            $segments = array_prepend($segments, $currentLocale);

            // Redirect to the correct url
            return redirect()->to(implode('/', $segments));
        }
        else {
            $request->session()->put('applocale', $lang);
        }

        return $next($request);
    }
}