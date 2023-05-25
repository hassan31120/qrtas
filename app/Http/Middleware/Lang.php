<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $lang = $request->header('Accept-Language');
        if (!$lang) {
            return response(['status' => false, 'msg' => trans('api.noLang'), 'data' => null]);
        }

        $this->setLang(str_replace(['_', 'EN', 'AR'], ' ', $lang));

        return $next($request);
    }
    public  function setLang($lang)
    {
        app()->setLocale($lang);
        Carbon::setLocale(config('app.locale'));
    }
}
