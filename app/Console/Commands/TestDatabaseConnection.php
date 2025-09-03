<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class TestDatabaseConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test-connection {--show-config : Show current session configuration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba de conexion a la base de datos y configuracion de sesiones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Probando la conexión a la base de datos y la configuración de sesiones...');
        $this->newLine();

        // Test de conexion a la base de datos
        $this->testDatabaseConnection();
        
        // Muestra la configuracion de la sesion
        if ($this->option('show-config')) {
            $this->showSessionConfiguration();
        }
        
        $this->newLine();
        $this->info('✅ Prueba finalizada!');
        $this->newLine();
    }

    /**
     * Metodo simple de testeo de conexion a la base de datos
     */
    private function testDatabaseConnection(): void
    {
        $this->info('📊 Resultado de la prueba:');
        
        try {
            $pdo = DB::connection()->getPdo();
            $this->line('   ✅ Conexion a la base de datos: <fg=green>OK</>');
            $this->line('   📍 Driver: ' . DB::connection()->getDriverName());
            $this->line('   🏠 Host: ' . Config::get('database.connections.mysql.host'));
            $this->line('   🗄️  Base de datos: ' . Config::get('database.connections.mysql.database'));
            
        } catch (\Exception $e) {
            $this->line('   ❌ Conexion a la base de datos: <fg=red>ERROR</>');
            $this->line('   🚨 Error: ' . $e->getMessage());
        }
    }

    /**
     * Muestra la configuracion de la sesion
     */
    private function showSessionConfiguration(): void
    {
        $this->newLine();
        $this->info('⚙️  Configuracion de sesiones:');
        
        $driver = Config::get('session.driver');
        $lifetime = Config::get('session.lifetime');
        $encrypt = Config::get('session.encrypt') ? 'Yes' : 'No';
        
        $this->line('   🎯 Driver: ' . $driver);
        $this->line('   ⏰ Vida: ' . $lifetime . ' minutos');
        $this->line('   🔐 Encriptado: ' . $encrypt);
        
        if ($driver === 'database') {
            $table = Config::get('session.table');
            $connection = Config::get('session.connection') ?? 'default';
            $this->line('   📋 Tabla: ' . $table);
            $this->line('   🔗 Conexion: ' . $connection);
        } elseif ($driver === 'file') {
            $path = Config::get('session.files');
            $this->line('   📁 Ruta: ' . $path);
            $this->line('   📂 Existe: ' . (is_dir($path) ? 'Si' : 'No'));
        }
        
        $this->newLine();
        $this->info('🔄 Configuracion de fallback:');
        $fallbackDriver = Config::get('database-fallback.session.fallback_driver', 'file');
        $autoFallback = Config::get('database-fallback.session.auto_fallback', true) ? 'Yes' : 'No';
        
        $this->line('   🎯 Driver de fallback: ' . $fallbackDriver);
        $this->line('   🤖 Auto fallback: ' . $autoFallback);
    }
}
