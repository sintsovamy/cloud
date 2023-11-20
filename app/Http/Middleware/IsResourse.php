<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsResourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($file_id, Closure $next): Response
    {
        $exists = File::where('file_id', '=', $file_id)->exists();

	if(!$exists) {
		return response()->json([
			'message' => 'Not found',
			'code' => 404
		], 404);
	}

        return $next($request);
    }
}

