<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd($request);
        if (!$request->expectsJson()) {
            $path = parse_url($request->url(), PHP_URL_PATH);
            $urlArray = explode('/',$path);
            // dd(in_array('client',$urlArray));
            if (in_array('client',$urlArray)) {
                // Pengguna adalah siswa dan mengakses URL siswa
                return route('siswa.login');
            }
            // dd($request->url());
            return route('admin');
        }
    }
}
