<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="section-spacing">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="catholic-blue rounded-3xl shadow-2xl card-spacing mb-12 text-white relative overflow-hidden animate-slide-up">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white bg-opacity-10 rounded-full animate-float"></div>
                <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute top-10 right-10 w-32 h-32 bg-white bg-opacity-5 rounded-full animate-float" style="animation-delay: 4s;"></div>
                <div class="relative z-10 text-center">
                    <div class="mb-8">
                        <span class="text-9xl animate-bounce">🙏</span>
                    </div>
                    <h1 class="text-6xl font-bold mb-6 text-high-contrast" style="font-family: 'Playfair Display', serif;">¡Bienvenido, {{ auth()->user()->name }}!</h1>
                    <p class="text-blue-100 text-2xl mb-8 text-medium-contrast">Sistema de control de asistencias para eventos juveniles</p>
                    <div class="inline-flex items-center px-10 py-5 bg-white bg-opacity-20 backdrop-blur-enhanced rounded-full text-white font-bold text-xl animate-glow">
                        <span class="mr-4 text-3xl">✝️</span>
                        Que Dios te bendiga en este día
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid lg:grid-cols-2 gap-10">
                @if(auth()->user()->is_admin)
                    <!-- Admin Panel -->
                    <div class="card-enhanced hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-delayed">
                        <div class="catholic-blue card-spacing text-white">
                            <div class="flex items-center">
                                <div class="text-7xl mr-6 animate-float">👑</div>
                                <div>
                                    <h2 class="text-4xl font-bold mb-3 text-high-contrast" style="font-family: 'Playfair Display', serif;">Panel de Administración</h2>
                                    <p class="text-blue-100 text-xl text-medium-contrast">Gestiona el sistema completo</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-spacing">
                            <p class="text-medium-contrast mb-8 text-xl leading-relaxed">
                                Gestiona usuarios, eventos y controla las asistencias de los participantes con herramientas avanzadas.
                            </p>
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-2xl border border-blue-200 dark:border-blue-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">👥</div>
                                    <div class="font-bold text-blue-900 dark:text-blue-100 text-lg">Usuarios</div>
                                    <div class="text-sm text-blue-700 dark:text-blue-300 mt-1">Gestionar participantes</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-2xl border border-green-200 dark:border-green-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">📅</div>
                                    <div class="font-bold text-green-900 dark:text-green-100 text-lg">Eventos</div>
                                    <div class="text-sm text-green-700 dark:text-green-300 mt-1">Crear y organizar</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-2xl border border-purple-200 dark:border-purple-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">📊</div>
                                    <div class="font-bold text-purple-900 dark:text-purple-100 text-lg">Estadísticas</div>
                                    <div class="text-sm text-purple-700 dark:text-purple-300 mt-1">Ver reportes</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-2xl border border-orange-200 dark:border-orange-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">📱</div>
                                    <div class="font-bold text-orange-900 dark:text-orange-100 text-lg">Scanner QR</div>
                                    <div class="text-sm text-orange-700 dark:text-orange-300 mt-1">Registrar asistencias</div>
                                </div>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary w-full text-center text-xl font-bold uppercase tracking-wider focus-enhanced">
                                <span class="mr-3 text-2xl">🚀</span>
                                Acceder al Panel de Admin
                            </a>
                        </div>
                    </div>
                @else
                    <!-- User QR Panel -->
                    <div class="card-enhanced hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-delayed">
                        <div class="catholic-green card-spacing text-white">
                            <div class="flex items-center">
                                <div class="text-7xl mr-6 animate-float">🙏</div>
                                <div>
                                    <h2 class="text-4xl font-bold mb-3 text-high-contrast" style="font-family: 'Playfair Display', serif;">Mi Código QR</h2>
                                    <p class="text-green-100 text-xl text-medium-contrast">Registra tu asistencia</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-spacing">
                            <p class="text-medium-contrast mb-8 text-xl leading-relaxed">
                                Muestra tu código QR personalizado para que el administrador pueda registrar tu asistencia a los eventos juveniles.
                            </p>
                            <div class="grid grid-cols-3 gap-6 mb-8">
                                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-2xl border border-green-200 dark:border-green-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">📱</div>
                                    <div class="font-bold text-green-900 dark:text-green-100 text-lg">Generar QR</div>
                                    <div class="text-sm text-green-700 dark:text-green-300 mt-1">Código único</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-2xl border border-blue-200 dark:border-blue-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">📅</div>
                                    <div class="font-bold text-blue-900 dark:text-blue-100 text-lg">Seleccionar</div>
                                    <div class="text-sm text-blue-700 dark:text-blue-300 mt-1">Evento específico</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-2xl border border-purple-200 dark:border-purple-700 hover:shadow-lg transition-all duration-300">
                                    <div class="text-4xl mb-3">✅</div>
                                    <div class="font-bold text-purple-900 dark:text-purple-100 text-lg">Confirmar</div>
                                    <div class="text-sm text-purple-700 dark:text-purple-300 mt-1">Asistencia registrada</div>
                                </div>
                            </div>
                            <a href="{{ route('user.qr') }}" class="btn-success w-full text-center text-xl font-bold uppercase tracking-wider focus-enhanced">
                                <span class="mr-3 text-2xl">📱</span>
                                Ver mi QR de Asistencia
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Quick Stats / Info Panel -->
                <div class="card-enhanced hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-delayed">
                    <div class="catholic-purple card-spacing text-white">
                        <div class="flex items-center">
                            <div class="text-7xl mr-6 animate-float">📊</div>
                            <div>
                                <h2 class="text-4xl font-bold mb-3 text-high-contrast" style="font-family: 'Playfair Display', serif;">Información del Sistema</h2>
                                <p class="text-purple-100 text-xl text-medium-contrast">Estado y estadísticas</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-spacing">
                        <div class="space-y-8">
                            <!-- System Status -->
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-2xl border border-gray-200 dark:border-gray-500 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="w-5 h-5 bg-green-500 rounded-full mr-4 animate-pulse"></div>
                                    <div>
                                        <div class="font-bold text-high-contrast text-lg">Estado del Sistema</div>
                                        <div class="text-medium-contrast text-base">Todo funcionando correctamente</div>
                                    </div>
                                </div>
                                <span class="text-green-600 font-bold text-lg">✅ Activo</span>
                            </div>

                            <!-- User Role -->
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-2xl border border-gray-200 dark:border-gray-500 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="w-5 h-5 bg-blue-500 rounded-full mr-4"></div>
                                    <div>
                                        <div class="font-bold text-high-contrast text-lg">Tu Rol</div>
                                        <div class="text-medium-contrast text-base">
                                            {{ auth()->user()->is_admin ? 'Administrador del Sistema' : 'Participante Juvenil' }}
                                        </div>
                                    </div>
                                </div>
                                <span class="text-blue-600 font-bold text-lg">
                                    {{ auth()->user()->is_admin ? '👑 Admin' : '🙏 Usuario' }}
                                </span>
                            </div>

                            <!-- Quick Actions -->
                            <div class="border-t-2 border-gray-200 dark:border-gray-600 pt-8">
                                <h3 class="text-2xl font-bold text-high-contrast mb-6" style="font-family: 'Playfair Display', serif;">Acciones Rápidas</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl hover:shadow-lg transition-all duration-300 focus-enhanced border border-blue-200 dark:border-blue-700">
                                            <span class="mr-3 text-2xl">👥</span>
                                            <span class="text-lg font-bold text-blue-900 dark:text-blue-100">Usuarios</span>
                                        </a>
                                        <a href="{{ route('admin.events.index') }}" class="flex items-center justify-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl hover:shadow-lg transition-all duration-300 focus-enhanced border border-green-200 dark:border-green-700">
                                            <span class="mr-3 text-2xl">📅</span>
                                            <span class="text-lg font-bold text-green-900 dark:text-green-100">Eventos</span>
                                        </a>
                                        <a href="{{ route('admin.attendances.index') }}" class="flex items-center justify-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl hover:shadow-lg transition-all duration-300 focus-enhanced border border-purple-200 dark:border-purple-700">
                                            <span class="mr-3 text-2xl">📊</span>
                                            <span class="text-lg font-bold text-purple-900 dark:text-purple-100">Asistencias</span>
                                        </a>
                                        <a href="{{ route('admin.scanner') }}" class="flex items-center justify-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-xl hover:shadow-lg transition-all duration-300 focus-enhanced border border-orange-200 dark:border-orange-700">
                                            <span class="mr-3 text-2xl">📱</span>
                                            <span class="text-lg font-bold text-orange-900 dark:text-orange-100">Scanner</span>
                                        </a>
                                    @else
                                        <a href="{{ route('user.qr') }}" class="flex items-center justify-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl hover:shadow-lg transition-all duration-300 focus-enhanced border border-green-200 dark:border-green-700">
                                            <span class="mr-3 text-2xl">📱</span>
                                            <span class="text-lg font-bold text-green-900 dark:text-green-100">Mi QR</span>
                                        </a>
                                        <div class="flex items-center justify-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl border border-gray-200 dark:border-gray-500">
                                            <span class="mr-3 text-2xl">📊</span>
                                            <span class="text-lg font-bold text-low-contrast">Próximamente</span>
                                        </div>
                                        <div class="flex items-center justify-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl border border-gray-200 dark:border-gray-500">
                                            <span class="mr-3 text-2xl">📈</span>
                                            <span class="text-lg font-bold text-low-contrast">Estadísticas</span>
                                        </div>
                                        <div class="flex items-center justify-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl border border-gray-200 dark:border-gray-500">
                                            <span class="mr-3 text-2xl">🏆</span>
                                            <span class="text-lg font-bold text-low-contrast">Logros</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Message -->
            <div class="mt-16 text-center animate-slide-up">
                <div class="card-enhanced p-10 bg-gradient-to-r from-gray-50 via-white to-gray-100 dark:from-gray-800 dark:via-gray-700 dark:to-gray-600 border-2 border-gray-200 dark:border-gray-600">
                    <div class="mb-6">
                        <span class="text-6xl animate-float">🙏</span>
                    </div>
                    <h3 class="text-3xl font-bold text-high-contrast mb-4" style="font-family: 'Playfair Display', serif;">Mensaje Espiritual</h3>
                    <p class="text-medium-contrast italic text-xl mb-4 leading-relaxed" style="font-family: 'Playfair Display', serif;">
                        "Todo lo que hagan, háganlo de corazón, como para el Señor y no para los hombres."
                    </p>
                    <p class="text-low-contrast text-lg">Colosenses 3:23</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
