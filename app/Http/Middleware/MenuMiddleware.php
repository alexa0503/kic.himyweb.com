<?php

namespace App\Http\Middleware;

use Closure;
use Menu;

class MenuMiddleware
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
        Menu::make('menu', function ($menu) {
            $menu->add('控制面板', ['url'=>'admin/dashboard','class'=>'bg-palette1']);
            $menu->add('作品管理', ['route'=>('work.index'),'class'=>'bg-palette2']);
        });
        return $next($request);
    }
}
