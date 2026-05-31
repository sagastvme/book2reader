<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class DeviceIsReader
{
    /**
     * Check if the device is an e-reader or not.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eReaders = ['kobo', 'kindle', 'tolino', 'ereader'];
        $agent = $request->headers->get('User-Agent');
        $isReader = Str::contains($agent, $eReaders, ignoreCase: true);
        $request->attributes->set('is_reader', $isReader);
        return $next($request);
    }
}
