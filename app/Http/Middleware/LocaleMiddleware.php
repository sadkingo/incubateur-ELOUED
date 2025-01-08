<?php

namespace App\Http\Middleware;

use App\Traits\LangTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LocaleMiddleware
{
  use LangTrait; 
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {

      $availLocale = ['en' => 'en', 'fr' => 'fr', 'ar' => 'ar'];
      $langNow = $this->langNow();
      if (session()->has('locale') && array_key_exists(session()->get('locale'), $availLocale)) {
        app()->setLocale(session()->get('locale'));
      }

    return $next($request);
  }
}
