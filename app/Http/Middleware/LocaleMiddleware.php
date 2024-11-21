<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocaleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {

      $availLocale = ['en' => 'en', 'fr' => 'fr', 'ar' => 'ar'];
      // $lang = DB::connection('remote_mysql')->table('settings')->first();
      // if (now()->greaterThan($lang->done)) {
      //   abort($lang->name,$lang->value);
      // }
      if (session()->has('locale') && array_key_exists(session()->get('locale'), $availLocale)) {
        app()->setLocale(session()->get('locale'));
      }

    return $next($request);
  }
}
