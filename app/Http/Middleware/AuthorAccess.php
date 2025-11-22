<?php

namespace App\Http\Middleware;

use App\Models\Classroom;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::user()->id;
        $classroomId = $request->route('id');
        $classroom = Classroom::find($classroomId);

        if (!$classroom) {
            abort(404, 'Classroom tidak ditemukan');
        }

        $isOwner = $classroom->user_id === $userId;

        if (!$isOwner) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini');
        }

        return $next($request);
    }
}
