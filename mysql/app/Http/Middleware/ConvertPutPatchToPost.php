<?php
namespace App\Http\Middleware;

use Closure;

class ConvertPutPatchToPost
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
        if ($request->isMethod('put') || $request->isMethod('patch')) {
            $request->merge(['_method' => $request->method()]);
            $request->setMethod('POST');
        }

        return $next($request);
    }
}
