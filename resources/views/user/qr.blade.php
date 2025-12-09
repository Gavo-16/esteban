<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Código QR de Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl shadow-2xl p-10 mb-12 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white bg-opacity-10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white bg-opacity-10 rounded-full"></div>
                <div class="relative z-10 text-center">
                    <div class="mb-6">
                        <span class="text-7xl animate-bounce">🙏</span>
                    </div>
                    <h1 class="text-5xl font-bold mb-3" style="font-family: 'Playfair Display', serif;">¡Hola, {{ auth()->user()->name }}!</h1>
                    <p class="text-blue-100 text-xl mb-6">Bienvenido al sistema de asistencias juveniles</p>
                    <div class="inline-flex items-center px-8 py-4 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl text-white font-bold text-lg">
                        <span class="mr-3 text-xl">✝️</span>
                        Que Dios te bendiga en este encuentro
                    </div>
                </div>
            </div>

            <!-- Event Selection -->
            <div class="card-enhanced mb-12 animate-fade-in-delayed" style="animation-delay: 0.2s;">
                <div class="card-spacing">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-high-contrast mb-4" style="font-family: 'Playfair Display', serif;">Seleccionar Evento</h2>
                        <p class="text-medium-contrast text-xl">Elige el evento al que deseas registrar tu asistencia</p>
                    </div>

                    <form action="{{ route('user.qr') }}" method="GET" class="max-w-md mx-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xl">📅</span>
                            </div>
                            <select class="form-input-enhanced text-lg appearance-none" id="event_id" name="event_id" onchange="this.form.submit()">
                                <option value="">Selecciona un evento...</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                        {{ $event->name }} - {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        @if($events->isEmpty())
                            <div class="text-center mt-8">
                                <div class="text-6xl mb-6 animate-bounce">📅</div>
                                <p class="text-medium-contrast text-xl">No hay eventos disponibles en este momento</p>
                                <p class="text-low-contrast mt-3">Contacta con el administrador para más información</p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            @if($selectedEvent)
                <!-- QR Code Display -->
                <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.4s;">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-10 text-white text-center">
                        <div class="mb-6">
                            <span class="text-7xl animate-pulse">📱</span>
                        </div>
                        <h2 class="text-4xl font-bold mb-3" style="font-family: 'Playfair Display', serif;">Tu Código QR de Asistencia</h2>
                        <p class="text-green-100 text-xl">Muestra este código al administrador para registrar tu asistencia</p>
                    </div>

                    <div class="p-10">
                        <!-- Event Info -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-3xl p-8 mb-10 border border-blue-200 dark:border-blue-800">
                            <div class="text-center">
                                <h3 class="text-3xl font-bold text-blue-800 dark:text-blue-200 mb-4" style="font-family: 'Playfair Display', serif;">{{ $selectedEvent->name }}</h3>
                                <div class="flex items-center justify-center space-x-8 text-medium-contrast text-lg">
                                    <div class="flex items-center">
                                        <span class="mr-3 text-xl">📅</span>
                                        <span class="font-bold">{{ \Carbon\Carbon::parse($selectedEvent->date)->format('l, d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-3 text-xl">👤</span>
                                        <span class="font-bold">Organizado por {{ $selectedEvent->creator->name }}</span>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <span class="inline-flex items-center px-6 py-3 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-2xl text-lg font-bold">
                                        {{ $selectedEvent->date >= now() ? '📅 Evento Próximo' : '✅ Evento Realizado' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Container -->
                        <div class="text-center mb-10">
                            <div class="inline-block p-8 bg-white rounded-3xl shadow-2xl border-4 border-gray-100 dark:border-gray-600 relative">
                                <!-- Corner decorations -->
                                <div class="absolute -top-3 -left-3 w-8 h-8 border-t-4 border-l-4 border-blue-500 rounded-tl-lg"></div>
                                <div class="absolute -top-3 -right-3 w-8 h-8 border-t-4 border-r-4 border-blue-500 rounded-tr-lg"></div>
                                <div class="absolute -bottom-3 -left-3 w-8 h-8 border-b-4 border-l-4 border-blue-500 rounded-bl-lg"></div>
                                <div class="absolute -bottom-3 -right-3 w-8 h-8 border-b-4 border-r-4 border-blue-500 rounded-br-lg"></div>

                                <img id="qrcode"
                                     alt="QR Code de Asistencia"
                                     src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(auth()->id() . '-' . $selectedEvent->id) }}"
                                     class="w-80 h-80 rounded-2xl shadow-lg mx-auto block transition-transform duration-300 hover:scale-105"
                                     onload="showQRCode()" />

                                <!-- Loading state -->
                                <div id="qrLoading" class="absolute inset-0 flex items-center justify-center bg-white rounded-3xl">
                                    <div class="text-center">
                                        <div class="text-5xl mb-4 animate-spin">⏳</div>
                                        <p class="text-medium-contrast text-xl">Generando código QR...</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-3xl p-8 mb-8 border border-yellow-200 dark:border-yellow-800">
                            <div class="text-center">
                                <div class="mb-6">
                                    <span class="text-5xl">📋</span>
                                </div>
                                <h3 class="text-2xl font-bold text-yellow-800 dark:text-yellow-200 mb-6" style="font-family: 'Playfair Display', serif;">Instrucciones</h3>
                                <div class="grid md:grid-cols-3 gap-8 text-lg">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-yellow-500 rounded-3xl flex items-center justify-center mb-4 shadow-lg">
                                            <span class="text-white font-bold text-xl">1</span>
                                        </div>
                                        <p class="text-high-contrast text-center leading-relaxed">
                                            Muestra este código QR al administrador del evento
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-yellow-500 rounded-3xl flex items-center justify-center mb-4 shadow-lg">
                                            <span class="text-white font-bold text-xl">2</span>
                                        </div>
                                        <p class="text-high-contrast text-center leading-relaxed">
                                            El administrador escaneará el código con su dispositivo
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-yellow-500 rounded-3xl flex items-center justify-center mb-4 shadow-lg">
                                            <span class="text-white font-bold text-xl">3</span>
                                        </div>
                                        <p class="text-high-contrast text-center leading-relaxed">
                                            Recibirás confirmación de tu asistencia registrada
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Blessing Message -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-3xl p-8 text-center border border-purple-200 dark:border-purple-800">
                            <div class="mb-6">
                                <span class="text-5xl animate-pulse">🙏</span>
                            </div>
                            <h3 class="text-2xl font-bold text-purple-800 dark:text-purple-200 mb-4" style="font-family: 'Playfair Display', serif;">Mensaje de Bendición</h3>
                            <p class="text-purple-600 dark:text-purple-400 italic text-xl leading-relaxed">
                                "Que el Señor te bendiga y te guarde; que el Señor haga resplandecer su rostro sobre ti y te conceda su favor."
                            </p>
                            <p class="text-purple-500 dark:text-purple-500 text-lg mt-4">Números 6:24-25</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Event Selected -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 card-enhanced text-center animate-fade-in-delayed" style="animation-delay: 0.3s;">
                    <div class="card-spacing">
                        <div class="max-w-md mx-auto">
                            <div class="text-8xl mb-8 animate-bounce">🎯</div>
                            <h3 class="text-3xl font-bold text-high-contrast mb-6" style="font-family: 'Playfair Display', serif;">Selecciona un Evento</h3>
                            <p class="text-medium-contrast mb-8 text-xl leading-relaxed">
                                Elige un evento de la lista superior para generar tu código QR de asistencia
                            </p>
                            <div class="flex items-center justify-center space-x-8 text-lg text-medium-contrast">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-blue-400 rounded-full mr-3 shadow-lg"></span>
                                    Selecciona evento
                                </div>
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-green-400 rounded-full mr-3 shadow-lg"></span>
                                    Genera QR
                                </div>
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-purple-400 rounded-full mr-3 shadow-lg"></span>
                                    Registra asistencia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function showQRCode() {
            document.getElementById('qrLoading').style.display = 'none';
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const qrCode = document.getElementById('qrcode');
            if (qrCode) {
                qrCode.addEventListener('load', function() {
                    this.style.animation = 'fadeIn 0.5s ease-in-out';
                });
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
            </div>
        </div>
    </x-app-layout>