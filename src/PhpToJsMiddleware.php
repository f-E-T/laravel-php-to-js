<?php

namespace Fet\PhpToJs;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class PhpToJsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$content = $response->getContent()) {
            return $response;
        }

        $scriptTag = View::make(
            'phptojs::scriptTag',
            ['namespaces' => PhpToJsFacade::all()]
        );

        $position = strripos($content, '</body>');

        if ($position !== false) {
            $start = substr($content, 0, $position);
            $end = substr($content, $position);
            $content = $start . $scriptTag->render() . $end;

            $response->setContent($content);
        }

        return $response;
    }
}
