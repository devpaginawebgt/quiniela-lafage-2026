<?php

namespace App\Http\Middleware;

use App\Http\Services\HelperService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestToSnakeCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->replace(HelperService::CamelCaseToSnake($request->all()));

        return $next($request);
    }
}
