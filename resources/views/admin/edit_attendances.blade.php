<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                ✏️ {{ __('Editar Asistencias') }} - {{ $event->name }}
            </h2>
            <a href="{{ route('admin.attendances.index') }}" class="btn-secondary">
                ← {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Información del Evento -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-6 mb-6 text-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-blue-100 text-sm">📅 Fecha</p>
                        <p class="font-bold text-lg">{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm">👥 Total Asistencias</p>
                        <p class="font-bold text-lg">{{ $attendances->where('attended', true)->count() }} / {{ $attendances->count() }}</p>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm">📊 Porcentaje</p>
                        <p class="font-bold text-lg">
                            {{ $attendances->count() > 0 ? round(($attendances->where('attended', true)->count() / $attendances->count()) * 100, 1) : 0 }}%
                        </p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tabla de Asistencias Editables -->
            <div class="card">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        📋 Lista de Asistencias
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Marca o desmarca las casillas para actualizar la asistencia de cada usuario
                    </p>
                </div>

                <form action="{{ route('admin.attendances.update') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Usuario
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Asistió
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Fecha Registro
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($attendances as $attendance)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                                    {{ strtoupper(substr($attendance->user->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $attendance->user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $attendance->user->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" 
                                                           name="attendances[{{ $attendance->id }}]" 
                                                           value="1" 
                                                           class="sr-only peer"
                                                           {{ $attendance->attended ? 'checked' : '' }}>
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gradient-to-r peer-checked:from-green-500 peer-checked:to-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $attendance->created_at->isoFormat('D MMM YYYY, HH:mm') }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                </svg>
                                                <p class="text-lg font-medium">No hay asistencias registradas</p>
                                                <p class="text-sm mt-1">Todavía no se han registrado asistencias para este evento</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($attendances->count() > 0)
                        <div class="mt-6 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                💡 <strong>Tip:</strong> Los cambios se aplicarán al hacer clic en "Guardar Cambios"
                            </div>
                            <div class="flex space-x-3">
                                <button type="button" 
                                        onclick="window.location.reload()" 
                                        class="btn-secondary">
                                    🔄 Cancelar
                                </button>
                                <button type="submit" class="btn-primary">
                                    💾 Guardar Cambios
                                </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Acciones Rápidas -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.events.index') }}" class="card p-6 hover:shadow-lg transition-shadow duration-200 text-center group">
                    <div class="text-4xl mb-2 group-hover:scale-110 transition-transform duration-200">📅</div>
                    <h4 class="font-bold text-gray-900 dark:text-gray-100">Ver Eventos</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Administrar todos los eventos</p>
                </a>
                <a href="{{ route('admin.users.index') }}" class="card p-6 hover:shadow-lg transition-shadow duration-200 text-center group">
                    <div class="text-4xl mb-2 group-hover:scale-110 transition-transform duration-200">👥</div>
                    <h4 class="font-bold text-gray-900 dark:text-gray-100">Ver Usuarios</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Gestionar usuarios del sistema</p>
                </a>
                <a href="{{ route('admin.attendances.index') }}" class="card p-6 hover:shadow-lg transition-shadow duration-200 text-center group">
                    <div class="text-4xl mb-2 group-hover:scale-110 transition-transform duration-200">📊</div>
                    <h4 class="font-bold text-gray-900 dark:text-gray-100">Ver Asistencias</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Revisar todas las asistencias</p>
                </a>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
    @endpush
</x-app-layout>