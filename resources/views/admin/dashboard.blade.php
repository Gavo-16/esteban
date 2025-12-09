<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="section-spacing">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="catholic-blue rounded-3xl shadow-2xl card-spacing mb-12 text-white relative overflow-hidden animate-slide-up">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute -top-16 -right-16 w-56 h-56 bg-white bg-opacity-10 rounded-full animate-float"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute top-10 right-10 w-24 h-24 bg-white bg-opacity-5 rounded-full animate-float" style="animation-delay: 4s;"></div>
                <div class="relative z-10 text-center">
                    <div class="mb-8">
                        <span class="text-9xl animate-bounce">✝️</span>
                    </div>
                    <h1 class="text-6xl font-bold mb-6 text-high-contrast" style="font-family: 'Playfair Display', serif;">Panel de Administración</h1>
                    <p class="text-blue-100 text-2xl mb-8 text-medium-contrast">Sistema de control de asistencias para eventos juveniles</p>
                    <div class="inline-flex items-center px-10 py-5 bg-white bg-opacity-20 backdrop-blur-enhanced rounded-full text-white font-bold text-xl animate-glow">
                        <span class="mr-4 text-3xl">📊</span>
                        Bienvenido al centro de control
                    </div>
                </div>
            </div>

            <!-- Action Cards Grid -->
            <div class="grid-responsive mb-12">
                <a href="{{ route('admin.users.index') }}" class="group card-enhanced hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 animate-fade-in-delayed">
                    <div class="card-spacing text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <span class="text-3xl">👥</span>
                        </div>
                        <h3 class="text-2xl font-bold text-high-contrast mb-3" style="font-family: 'Playfair Display', serif;">Gestionar Usuarios</h3>
                        <p class="text-medium-contrast text-lg mb-6 leading-relaxed">Crear y administrar usuarios del sistema</p>
                        <div class="inline-flex items-center text-blue-600 font-bold text-lg group-hover:text-blue-700 transition-colors">
                            Acceder <span class="ml-3 group-hover:translate-x-2 transition-transform text-2xl">→</span>
                        </div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-blue-400 to-blue-600 rounded-b-2xl"></div>
                </a>

                <a href="{{ route('admin.events.index') }}" class="group card-enhanced hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 animate-fade-in-delayed" style="animation-delay: 0.1s;">
                    <div class="card-spacing text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <span class="text-3xl">📅</span>
                        </div>
                        <h3 class="text-2xl font-bold text-high-contrast mb-3" style="font-family: 'Playfair Display', serif;">Gestionar Eventos</h3>
                        <p class="text-medium-contrast text-lg mb-6 leading-relaxed">Crear y organizar eventos juveniles</p>
                        <div class="inline-flex items-center text-green-600 font-bold text-lg group-hover:text-green-700 transition-colors">
                            Acceder <span class="ml-3 group-hover:translate-x-2 transition-transform text-2xl">→</span>
                        </div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-green-400 to-green-600 rounded-b-2xl"></div>
                </a>

                <a href="{{ route('admin.attendances.index') }}" class="group card-enhanced hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 animate-fade-in-delayed" style="animation-delay: 0.2s;">
                    <div class="card-spacing text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <span class="text-3xl">📊</span>
                        </div>
                        <h3 class="text-2xl font-bold text-high-contrast mb-3" style="font-family: 'Playfair Display', serif;">Ver <br> Asistencias</h3>
                        <p class="text-medium-contrast text-lg mb-6 leading-relaxed">Revisar y gestionar asistencias</p>
                        <div class="inline-flex items-center text-purple-600 font-bold text-lg group-hover:text-purple-700 transition-colors">
                            Acceder <span class="ml-3 group-hover:translate-x-2 transition-transform text-2xl">→</span>
                        </div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-purple-400 to-purple-600 rounded-b-2xl"></div>
                </a>

                <a href="{{ route('admin.scanner') }}" class="group card-enhanced hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 animate-fade-in-delayed" style="animation-delay: 0.3s;">
                    <div class="card-spacing text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <span class="text-3xl">📱</span>
                        </div>
                        <h3 class="text-2xl font-bold text-high-contrast mb-3" style="font-family: 'Playfair Display', serif;">Escanear <br> QR</h3>
                        <p class="text-medium-contrast text-lg mb-6 leading-relaxed">Marcar asistencia con códigos QR</p>
                        <div class="inline-flex items-center text-yellow-600 font-bold text-lg group-hover:text-yellow-700 transition-colors">
                            Acceder <span class="ml-3 group-hover:translate-x-2 transition-transform text-2xl">→</span>
                        </div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-b-2xl"></div>
                </a>
            </div>

            <!-- Statistics Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-12">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.4s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-700 dark:text-blue-300 text-lg font-bold mb-2">Total Usuarios</p>
                                <p class="text-4xl font-bold text-blue-900 dark:text-blue-100">{{ $users->count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-white text-3xl">👥</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.5s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-700 dark:text-green-300 text-lg font-bold mb-2">Total Eventos</p>
                                <p class="text-4xl font-bold text-green-900 dark:text-green-100">{{ $events->count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-white text-3xl">📅</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.6s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-700 dark:text-purple-300 text-lg font-bold mb-2">Próximos Eventos</p>
                                <p class="text-4xl font-bold text-purple-900 dark:text-purple-100">{{ $events->where('date', '>=', now())->count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-white text-3xl">⏰</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Blessing Message -->
                <div class="mt-12 text-center">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 card-enhanced animate-fade-in-delayed" style="animation-delay: 0.7s;">
                        <div class="card-spacing">
                            <div class="mb-6">
                                <span class="text-5xl animate-pulse">🙏</span>
                            </div>
                            <h3 class="text-2xl font-bold text-high-contrast mb-4" style="font-family: 'Playfair Display', serif;">Mensaje Espiritual</h3>
                            <p class="text-medium-contrast italic text-xl mb-4 leading-relaxed">
                                "El Señor es mi pastor, nada me falta."
                            </p>
                            <p class="text-low-contrast text-sm">Salmo 23:1</p>
                        </div>
                    </div>
                </div>

                <div class="card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.8s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-high-contrast flex items-center" style="font-family: 'Playfair Display', serif;">
                                <span class="mr-4 text-3xl">👥</span>
                                Usuarios Recientes
                            </h3>
                            <a href="{{ route('admin.users.index') }}" class="btn-secondary text-sm px-4 py-2">
                                Ver todos →
                            </a>
                        </div>
                        <div class="space-y-6">
                            @foreach($users->take(4) as $user)
                                <div class="flex items-center p-5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-2xl hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mr-5 shadow-lg">
                                        <span class="text-white font-bold text-lg">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-bold text-high-contrast text-lg">{{ $user->name }}</div>
                                        <div class="text-medium-contrast">{{ $user->email }}</div>
                                    </div>
                                    <span class="px-4 py-2 text-xs rounded-2xl font-bold {{ $user->is_admin ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Usuario' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.9s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-high-contrast flex items-center" style="font-family: 'Playfair Display', serif;">
                                <span class="mr-4 text-3xl">📅</span>
                                Eventos Próximos
                            </h3>
                            <a href="{{ route('admin.events.index') }}" class="btn-secondary text-sm px-4 py-2">
                                Ver todos →
                            </a>
                        </div>
                        <div class="space-y-6">
                            @foreach($events->sortBy('date')->take(4) as $event)
                                <div class="flex items-center p-5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-2xl hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mr-5 shadow-lg">
                                        <span class="text-white text-xl">📅</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-bold text-high-contrast text-lg">{{ $event->name }}</div>
                                        <div class="text-medium-contrast flex items-center">
                                            <span class="mr-3 text-lg">📅</span>
                                            {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-low-contrast text-xs mb-1">Creado por</div>
                                        <div class="font-bold text-medium-contrast">{{ $event->creator->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>