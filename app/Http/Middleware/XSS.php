<?php

namespace App\Http\Middleware;

use Closure; 
use Illuminate\Http\Request;

class XSS
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
        // $input = $request->all();
        // array_walk_recursive($input, function(&$input) {
        //     $input = strip_tags($input);
        // });
        // $request->merge($input);
        // return $next($request);

         $url = str_replace($request->url(), "", $request->fullUrl());
        $input = $request->all();

        array_walk_recursive($input, function (&$input) {
            $input = strip_tags($input);
        });

        if (preg_match('/[\'^£$%&*()}{@#~><>|_+¬-]/', $url))
            return redirect($request->url() . "/" . preg_replace('/[\'^£$%&*()}{@#~><>|_+¬-]/',"",strip_tags($url)));

        $request->merge($input);
        return $next($request);

        
    }
}
