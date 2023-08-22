<?php

namespace App\Http\Middleware;

use App\Http\Services\CurrentTableService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TabletCheckMiddleware
{
    private CurrentTableService $currentTableService;

    public function __construct(CurrentTableService $currentTableService)
    {
        $this->currentTableService = $currentTableService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->currentTableService->has()) {
            return redirect()->route('tablets.index');
        }

        return $next($request);
    }
}
