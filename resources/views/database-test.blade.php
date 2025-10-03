<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test de Base de Datos - Chanchamayo Tours</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <style>
            body { font-family: 'Instrument Sans', sans-serif; background: #f3f4f6; margin: 0; padding: 2rem; }
            .container { max-width: 800px; margin: 0 auto; }
            .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem; }
            .success { border-left: 4px solid #10b981; }
            .error { border-left: 4px solid #ef4444; }
            .btn { display: inline-block; padding: 12px 24px; background: #3b82f6; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 1rem; }
            .btn:hover { background: #2563eb; }
            .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem; }
            .stat { background: #f9fafb; padding: 1rem; border-radius: 8px; text-align: center; }
            .stat-number { font-size: 2rem; font-weight: bold; color: #10b981; }
            .stat-label { color: #6b7280; font-size: 0.875rem; }
            h1 { color: #1f2937; margin-bottom: 2rem; text-align: center; }
            h2 { color: #374151; margin-bottom: 1rem; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🗄️ Estado de Base de Datos - Chanchamayo Tours</h1>
            
            @if ($status === 'success')
                <div class="card success">
                    <h2>✅ {{ $message }}</h2>
                    
                    <div class="grid">
                        <div class="stat">
                            <div class="stat-number">{{ $users_count }}</div>
                            <div class="stat-label">Usuarios</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">{{ $companies_count ?? 0 }}</div>
                            <div class="stat-label">Empresas</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">{{ $tours_count ?? 0 }}</div>
                            <div class="stat-label">Tours</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">{{ $categories_count ?? 0 }}</div>
                            <div class="stat-label">Categorías</div>
                        </div>
                    </div>
                    
                    <h3 style="margin-top: 2rem; color: #374151;">Información de Conexión:</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><strong>Base de datos:</strong> {{ $database }}</li>
                        <li><strong>Conexión:</strong> MySQL</li>
                        <li><strong>Host:</strong> 127.0.0.1:3306</li>
                        <li><strong>Estado:</strong> <span style="color: #10b981;">Conectado</span></li>
                    </ul>
                    
                    <h3 style="margin-top: 2rem; color: #374151;">Tablas Creadas:</h3>
                    <div style="background: #f3f4f6; padding: 1rem; border-radius: 8px; margin-top: 1rem;">
                        @foreach ($tables as $table)
                            @php
                                $tableName = array_values((array) $table)[0];
                            @endphp
                            <span style="display: inline-block; background: #e5e7eb; padding: 4px 8px; margin: 2px; border-radius: 4px; font-size: 0.875rem;">{{ $tableName }}</span>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="card error">
                    <h2>❌ Error de Conexión</h2>
                    <p style="color: #ef4444;">{{ $message }}</p>
                </div>
            @endif
            
            <div class="card">
                <h2>🚀 Estado del Sistema</h2>
                <p>Sistema de autenticación personalizado implementado:</p>
                <ul>
                    <li>✅ Registro con campos específicos de turismo</li>
                    <li>✅ Roles de usuario (Turista, Empresa, Admin)</li>
                    <li>✅ Dashboard personalizado por tipo de usuario</li>
                    <li>✅ Middleware de autorización</li>
                    <li>✅ Estructura de base de datos completa</li>
                </ul>
            </div>
            
            <div style="text-align: center;">
                <a href="/" class="btn">🏠 Volver al Inicio</a>
                <a href="/register" class="btn" style="background: #10b981; margin-left: 1rem;">👤 Registrarse</a>
                <a href="/login" class="btn" style="background: #f59e0b; margin-left: 1rem;">🔑 Iniciar Sesión</a>
            </div>
        </div>
    </body>
</html>