<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestionar Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-3xl shadow-2xl p-10 mb-12 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white bg-opacity-5 rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-32 h-32 bg-white bg-opacity-5 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-6xl mr-6 animate-bounce">📅</span>
                            <div>
                                <h1 class="text-4xl font-bold mb-2" style="font-family: 'Playfair Display', serif;">Gestión de Eventos</h1>
                                <p class="text-green-100 text-lg">Organiza y administra los eventos juveniles</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" title="Volver al Dashboard" class="btn-secondary text-white border-white hover:bg-white hover:text-green-700 px-6 py-3 text-lg">
                            <span class="mr-3">←</span> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Create Event Form -->
                <div class="lg:col-span-1">
                    <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.2s;">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-8">
                            <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                                <span class="mr-4 text-3xl">➕</span>
                                Crear Nuevo Evento
                            </h3>
                            <p class="text-green-100 text-base mt-2">Programa un nuevo evento juvenil</p>
                        </div>

                        <form action="{{ route('admin.events.create') }}" method="POST" class="p-8 space-y-8" id="createEventForm">
                            @csrf

                            <!-- Event Name -->
                            <div>
                                <label for="name" class="block text-lg font-bold text-high-contrast mb-3">
                                    <span class="flex items-center">
                                        <span class="mr-3 text-xl">📝</span>
                                        Nombre del Evento
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" class="form-input-enhanced" id="name" name="name" required placeholder="Ej: Encuentro Juvenil de Oración">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <span class="text-gray-400 text-xl" id="nameIcon">📝</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Event Date -->
                            <div>
                                <label for="date" class="block text-lg font-bold text-high-contrast mb-3">
                                    <span class="flex items-center">
                                        <span class="mr-3 text-xl">📅</span>
                                        Fecha del Evento
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="date" class="form-input-enhanced" id="date" name="date" required min="{{ date('Y-m-d') }}">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <span class="text-gray-400 text-xl" id="dateIcon">📅</span>
                                    </div>
                                </div>
                                <p class="text-sm text-medium-contrast mt-2">
                                    Selecciona una fecha futura para el evento
                                </p>
                            </div>

                            <!-- Event Preview -->
                            <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-2xl border border-green-200 dark:border-green-700">
                                <h4 class="text-lg font-bold text-green-800 dark:text-green-200 mb-4 flex items-center">
                                    <span class="mr-3 text-xl">👁️</span>
                                    Vista Previa
                                </h4>
                                <div class="text-medium-contrast">
                                    <div id="previewName" class="font-bold text-lg text-high-contrast">Nombre del evento aparecerá aquí</div>
                                    <div id="previewDate" class="text-base mt-2">Fecha aparecerá aquí</div>
                                    <div class="text-sm mt-3 text-green-600 dark:text-green-400">
                                        Creado por: {{ auth()->user()->name }}
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-primary w-full text-lg py-4 px-8" id="submitBtn">
                                <span class="mr-3 text-xl" id="submitIcon">✅</span>
                                <span id="submitText">Crear Evento</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Events List -->
                <div class="lg:col-span-2">
                    <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.4s;">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-8">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                                        <span class="mr-4 text-3xl">📋</span>
                                        Eventos Programados
                                    </h3>
                                    <p class="text-blue-100 text-base mt-2">{{ $events->count() }} eventos registrados</p>
                                </div>
                                <div class="flex items-center space-x-6">
                                    <div class="px-4 py-2 bg-white bg-opacity-20 rounded-2xl text-white text-sm font-bold">
                                        Próximos: {{ $events->where('date', '>=', now())->count() }}
                                    </div>
                                    <div class="px-4 py-2 bg-white bg-opacity-20 rounded-2xl text-white text-sm font-bold">
                                        Total: {{ $events->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid gap-8">
                                @foreach($events->sortByDesc('date') as $event)
                                    <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-700 dark:to-gray-600 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] border border-gray-100 dark:border-gray-600 relative overflow-hidden animate-fade-in-delayed" style="animation-delay: {{ 0.5 + ($loop->index * 0.1) }}s;">
                                        <!-- Status indicator -->
                                        <div class="absolute top-6 right-6">
                                            @if($event->date >= now())
                                                <span class="px-4 py-2 bg-green-100 text-green-800 text-sm rounded-2xl font-bold animate-pulse">
                                                    Próximo
                                                </span>
                                            @else
                                                <span class="px-4 py-2 bg-gray-100 text-gray-800 text-sm rounded-2xl font-bold">
                                                    Pasado
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-start space-x-6">
                                            <!-- Event Icon -->
                                            <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-3xl flex items-center justify-center shadow-lg flex-shrink-0">
                                                <span class="text-3xl">📅</span>
                                            </div>

                                            <!-- Event Details -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <h4 class="text-2xl font-bold text-high-contrast mb-4" style="font-family: 'Playfair Display', serif;">{{ $event->name }}</h4>

                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                                            <div class="flex items-center">
                                                                <span class="text-blue-500 mr-3 text-xl">📅</span>
                                                                <div>
                                                                    <div class="text-lg font-bold text-high-contrast">
                                                                        {{ \Carbon\Carbon::parse($event->date)->format('l, d F Y') }}
                                                                    </div>
                                                                    <div class="text-medium-contrast">
                                                                        {{ \Carbon\Carbon::parse($event->date)->diffForHumans() }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center">
                                                                <span class="text-purple-500 mr-3 text-xl">👤</span>
                                                                <div>
                                                                    <div class="font-bold text-high-contrast text-lg">{{ $event->creator->name }}</div>
                                                                    <div class="text-medium-contrast">Organizador</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center space-x-6">
                                                                <div class="flex items-center text-medium-contrast text-lg">
                                                                    <span class="mr-2 text-xl">📊</span>
                                                                    Asistencias: {{ $event->attendances->count() }}
                                                                </div>
                                                                <div class="flex items-center text-medium-contrast text-lg">
                                                                    <span class="mr-2 text-xl">✅</span>
                                                                    Confirmados: {{ $event->attendances->where('attended', true)->count() }}
                                                                </div>
                                                            </div>

                                                            <div class="text-medium-contrast">
                                                                Creado: {{ $event->created_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-6 flex justify-end space-x-3 border-t border-gray-200 dark:border-gray-600 pt-6">
                                            <button onclick="editEvent({{ $event->id }})" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold transition-all duration-200 transform hover:scale-105 shadow-md flex items-center" title="Editar evento">
                                                <span class="mr-2">✏️</span>
                                                Editar
                                            </button>
                                            <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este evento? Se eliminarán también todas las asistencias asociadas.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold transition-all duration-200 transform hover:scale-105 shadow-md flex items-center" title="Eliminar evento">
                                                    <span class="mr-2">🗑️</span>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Progress bar for attendance -->
                                        @if($event->attendances->count() > 0)
                                            <div class="mt-6">
                                                <div class="flex items-center justify-between text-lg mb-3">
                                                    <span class="text-medium-contrast">Progreso de asistencias</span>
                                                    <span class="font-bold text-high-contrast">
                                                        {{ $event->attendances->where('attended', true)->count() }}/{{ $event->attendances->count() }}
                                                    </span>
                                                </div>
                                                <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-2xl h-3">
                                                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-2xl transition-all duration-500"
                                                         style="width: {{ $event->attendances->count() > 0 ? ($event->attendances->where('attended', true)->count() / $event->attendances->count()) * 100 : 0 }}%"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if($events->isEmpty())
                                <div class="text-center py-16">
                                    <div class="text-8xl mb-6 animate-bounce">📅</div>
                                    <h3 class="text-2xl font-bold text-medium-contrast mb-4">No hay eventos programados</h3>
                                    <p class="text-low-contrast text-lg">Crea el primer evento usando el formulario</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div id="editEventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-8 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                        <span class="mr-4 text-3xl">✏️</span>
                        Editar Evento
                    </h3>
                    <button onclick="closeEditEventModal()" class="text-white hover:text-gray-200 text-3xl font-bold">×</button>
                </div>
            </div>

            <form id="editEventForm" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_event_name" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">📝</span>
                            Nombre del Evento
                        </span>
                    </label>
                    <input type="text" class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_event_name" name="name" required>
                </div>

                <div>
                    <label for="edit_event_date" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">📅</span>
                            Fecha del Evento
                        </span>
                    </label>
                    <input type="date" class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_event_date" name="date" required>
                </div>

                <div>
                    <label for="edit_event_description" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">📄</span>
                            Descripción (opcional)
                        </span>
                    </label>
                    <textarea class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_event_description" name="description" rows="4"></textarea>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeEditEventModal()" class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-bold text-lg transition-all">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold text-lg transition-all">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Edit event modal
        function editEvent(eventId) {
            fetch(`/admin/events/${eventId}/edit`)
                .then(response => response.json())
                .then(event => {
                    document.getElementById('edit_event_name').value = event.name;
                    document.getElementById('edit_event_date').value = event.date.split(' ')[0]; // Solo la fecha
                    document.getElementById('edit_event_description').value = event.description || '';
                    document.getElementById('editEventForm').action = `/admin/events/${eventId}`;
                    document.getElementById('editEventModal').classList.remove('hidden');
                });
        }

        function closeEditEventModal() {
            document.getElementById('editEventModal').classList.add('hidden');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditEventModal();
            }
        });
        // Real-time preview
        function updatePreview() {
            const nameInput = document.getElementById('name');
            const dateInput = document.getElementById('date');
            const previewName = document.getElementById('previewName');
            const previewDate = document.getElementById('previewDate');

            if (nameInput.value) {
                previewName.textContent = nameInput.value;
                document.getElementById('nameIcon').textContent = '✅';
                document.getElementById('nameIcon').className = 'text-green-500';
            } else {
                previewName.textContent = 'Nombre del evento aparecerá aquí';
                document.getElementById('nameIcon').textContent = '📝';
                document.getElementById('nameIcon').className = 'text-gray-400';
            }

            if (dateInput.value) {
                const date = new Date(dateInput.value);
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                previewDate.textContent = date.toLocaleDateString('es-ES', options);
                document.getElementById('dateIcon').textContent = '✅';
                document.getElementById('dateIcon').className = 'text-green-500';
            } else {
                previewDate.textContent = 'Fecha aparecerá aquí';
                document.getElementById('dateIcon').textContent = '📅';
                document.getElementById('dateIcon').className = 'text-gray-400';
            }
        }

        document.getElementById('name').addEventListener('input', updatePreview);
        document.getElementById('date').addEventListener('input', updatePreview);

        // Form submission loading state
        document.getElementById('createEventForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitIcon = document.getElementById('submitIcon');
            const submitText = document.getElementById('submitText');

            submitBtn.disabled = true;
            submitIcon.textContent = '⏳';
            submitText.textContent = 'Creando evento...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        });

        // Initialize preview
        updatePreview();
    </script>
        </div>
    </div>
</x-app-layout>