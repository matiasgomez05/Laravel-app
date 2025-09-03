<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Intentar hacer una consulta simple para verificar la conexión
            DB::connection()->getPdo();
            
            // Si llegamos aquí, la conexión está bien
            return $next($request);
            
        } catch (\Exception $e) {
            // Log del error para debugging
            Log::error('Falló la conexion a la base de datos desde el Middleware', [
                'error' => $e->getMessage(),
                'url' => $request->url(),
                'method' => $request->method(),
            ]);
            
            // Si es una petición API, devolver JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de conexión a la base de datos',
                    'error' => 'No se puede establecer una conexión con la base de datos.',
                    'error_code' => 'DATABASE_CONNECTION_ERROR'
                ], 503);
            }
            
            // Para peticiones web, mostrar página de error
            return response()->view('errors.database-connection', [
                'message' => 'No se puede establecer una conexión con la base de datos.',
                'title' => 'Error de conexión a la Base de Datos'
            ], 503);
        }
    }
}
