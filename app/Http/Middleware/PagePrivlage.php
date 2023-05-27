<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class PagePrivlage
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
         $fullPagePath = Request::url(); 
            $envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
            $urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
            $ThisPageName=$urlAfterRoot;
             if(strpos($urlAfterRoot,'/') !== false){
            $ThisPageName=str_replace('/','_',$urlAfterRoot);

             }

            $DetailPage=array();
            $DetailPage=Helper::GetDetailPageAdmin($ThisPageName);
             
 
        return $next($request);
    }
}
