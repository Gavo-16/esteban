<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ver Asistencias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-3xl shadow-2xl p-10 mb-12 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white bg-opacity-5 rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-32 h-32 bg-white bg-opacity-5 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-6xl mr-6 animate-bounce">📊</span>
                            <div>
                                <h1 class="text-4xl font-bold mb-2" style="font-family: 'Playfair Display', serif;">Control de Asistencias</h1>
                                <p class="text-purple-100 text-lg">Monitorea y gestiona las asistencias a eventos</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-white border-white hover:bg-white hover:text-purple-700 px-6 py-3 text-lg">
                            <span class="mr-3">←</span> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Selector -->
            <div class="card-enhanced mb-12 animate-fade-in-delayed" style="animation-delay: 0.2s;">
                <div class="card-spacing">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-high-contrast flex items-center" style="font-family: 'Playfair Display', serif;">
                            <span class="mr-4 text-3xl">🎯</span>
                            Seleccionar Evento
                        </h3>
                        <div class="flex items-center space-x-6">
                            <div class="text-lg text-medium-contrast">
                                Eventos disponibles: <span class="font-bold text-purple-600">{{ $events->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.attendances.index') }}" method="GET" class="flex flex-col md:flex-row gap-6 items-end">
                        <div class="flex-1">
                            <label for="event_id" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <span class="mr-3 text-xl">📅</span>
                                    Evento para revisar asistencias
                                </span>
                            </label>
                            <select class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all" id="event_id" name="event_id" onchange="this.form.submit()">
                                <option value="" class="text-gray-900 dark:text-gray-100">Selecciona un evento para ver asistencias</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }} class="text-gray-900 dark:text-gray-100">
                                        {{ $event->name }} - {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                        ({{ $event->attendances->count() }} asistencias)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if(request('event_id'))
                            <a href="{{ route('admin.attendances.edit', request('event_id')) }}" class="btn-primary text-lg py-4 px-8">
                                <span class="mr-3 text-xl">✏️</span>
                                Editar Asistencias
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if($attendances->isNotEmpty())
                <?php
                    $selectedEvent = $events->find(request('event_id'));
                    $totalAttendances = $attendances->count();
                    $presentCount = $attendances->where('attended', true)->count();
                    $absentCount = $totalAttendances - $presentCount;
                    $attendanceRate = $totalAttendances > 0 ? round(($presentCount / $totalAttendances) * 100, 1) : 0;
                ?>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.3s;">
                        <div class="card-spacing">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-700 dark:text-green-300 text-lg font-bold mb-2">Presentes</p>
                                    <p class="text-4xl font-bold text-green-900 dark:text-green-100">{{ $presentCount }}</p>
                                </div>
                                <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-3xl">✅</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.4s;">
                        <div class="card-spacing">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-red-700 dark:text-red-300 text-lg font-bold mb-2">Ausentes</p>
                                    <p class="text-4xl font-bold text-red-900 dark:text-red-100">{{ $absentCount }}</p>
                                </div>
                                <div class="w-16 h-16 bg-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-3xl">❌</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.5s;">
                        <div class="card-spacing">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-700 dark:text-blue-300 text-lg font-bold mb-2">Total</p>
                                    <p class="text-4xl font-bold text-blue-900 dark:text-blue-100">{{ $totalAttendances }}</p>
                                </div>
                                <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-3xl">👥</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 card-enhanced hover:shadow-xl transition-all duration-300 animate-fade-in-delayed" style="animation-delay: 0.6s;">
                        <div class="card-spacing">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-700 dark:text-purple-300 text-lg font-bold mb-2">Asistencia</p>
                                    <p class="text-4xl font-bold text-purple-900 dark:text-purple-100">{{ $attendanceRate }}%</p>
                                </div>
                                <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-3xl">📊</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Info & Progress -->
                <div class="card-enhanced mb-12 animate-fade-in-delayed" style="animation-delay: 0.7s;">
                    <div class="card-spacing">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-3xl font-bold text-high-contrast mb-4" style="font-family: 'Playfair Display', serif;">{{ $selectedEvent->name }}</h3>
                                <p class="text-medium-contrast flex items-center text-lg">
                                    <span class="mr-3 text-xl">📅</span>
                                    {{ \Carbon\Carbon::parse($selectedEvent->date)->format('l, d F Y') }}
                                    <span class="mx-4 text-2xl">•</span>
                                    <span class="mr-3 text-xl">👤</span>
                                    Organizado por {{ $selectedEvent->creator->name }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-medium-contrast text-lg mb-2">Estado del evento</div>
                                <span class="px-6 py-3 rounded-2xl text-lg font-bold {{ $selectedEvent->date >= now() ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' }}">
                                    {{ $selectedEvent->date >= now() ? 'Próximo' : 'Realizado' }}
                                </span>
                            </div>
                        </div>

                        <!-- Attendance Progress Bar -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between text-xl mb-4">
                                <span class="font-bold text-high-contrast">Progreso de Asistencias</span>
                                <span class="font-bold text-high-contrast">{{ $presentCount }} de {{ $totalAttendances }} ({{ $attendanceRate }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-2xl h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 h-4 rounded-2xl transition-all duration-1000 ease-out"
                                     style="width: {{ $attendanceRate }}%"></div>
                            </div>
                            <div class="flex justify-between text-medium-contrast mt-3 text-lg">
                                <span>0%</span>
                                <span>25%</span>
                                <span>50%</span>
                                <span>75%</span>
                                <span>100%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance List -->
                <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.8s;">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-8">
                        <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                            <span class="mr-4 text-3xl">📋</span>
                            Lista de Asistencias
                        </h3>
                        <p class="text-purple-100 text-base mt-2">Registro detallado de participantes</p>
                    </div>

                    <div class="p-8">
                        <div class="grid gap-6">
                            @foreach($attendances as $attendance)
                                <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-700 dark:to-gray-600 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] border border-gray-100 dark:border-gray-600 animate-fade-in-delayed" style="animation-delay: {{ 0.9 + ($loop->index * 0.1) }}s;">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-6">
                                            <!-- Status Icon -->
                                            <div class="w-16 h-16 rounded-3xl flex items-center justify-center shadow-lg {{ $attendance->attended ? 'bg-gradient-to-br from-green-400 to-green-600' : 'bg-gradient-to-br from-red-400 to-red-600' }}">
                                                <span class="text-3xl">{{ $attendance->attended ? '✅' : '❌' }}</span>
                                            </div>

                                            <!-- User Info -->
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-4 mb-4">
                                                    <h4 class="text-2xl font-bold text-high-contrast" style="font-family: 'Playfair Display', serif;">{{ $attendance->user->name }}</h4>
                                                    <span class="px-4 py-2 text-sm rounded-2xl font-bold {{ $attendance->user->is_admin ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                                        {{ $attendance->user->is_admin ? '👑 Admin' : '🙏 Usuario' }}
                                                    </span>
                                                    <span class="px-4 py-2 text-sm rounded-2xl font-bold {{ $attendance->attended ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                        {{ $attendance->attended ? 'Presente' : 'Ausente' }}
                                                    </span>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-medium-contrast text-lg">
                                                    <div class="flex items-center">
                                                        <span class="mr-3 text-xl">📧</span>
                                                        {{ $attendance->user->email }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span class="mr-3 text-xl">📅</span>
                                                        Registrado: {{ $attendance->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex items-center space-x-4">
                                            <div class="w-4 h-4 rounded-full {{ $attendance->attended ? 'bg-green-400 animate-pulse' : 'bg-red-400' }} shadow-lg"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- No Event Selected State -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 card-enhanced text-center animate-fade-in-delayed" style="animation-delay: 0.3s;">
                    <div class="card-spacing">
                        <div class="max-w-md mx-auto">
                            <div class="text-9xl mb-8 animate-bounce">🎯</div>
                            <h3 class="text-3xl font-bold text-high-contrast mb-6" style="font-family: 'Playfair Display', serif;">Selecciona un Evento</h3>
                            <p class="text-medium-contrast mb-8 text-xl leading-relaxed">
                                Elige un evento de la lista superior para ver el registro de asistencias y estadísticas detalladas.
                            </p>
                            <div class="flex items-center justify-center space-x-8 text-lg text-medium-contrast">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-green-400 rounded-full mr-3 shadow-lg"></span>
                                    Presentes
                                </div>
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-red-400 rounded-full mr-3 shadow-lg"></span>
                                    Ausentes
                                </div>
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-blue-400 rounded-full mr-3 shadow-lg"></span>
                                    Total
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>