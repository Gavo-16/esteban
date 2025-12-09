<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestionar Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl shadow-2xl p-10 mb-12 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white bg-opacity-5 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-6xl mr-6 animate-bounce">👥</span>
                            <div>
                                <h1 class="text-4xl font-bold mb-2" style="font-family: 'Playfair Display', serif;">Gestión de Usuarios</h1>
                                <p class="text-blue-100 text-lg">Administra los usuarios del sistema de asistencias</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" title="Volver al Dashboard" class="btn-secondary text-white border-white hover:bg-white hover:text-blue-700 px-6 py-3 text-lg">
                            <span class="mr-3">←</span> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Create User Form -->
                <div class="lg:col-span-1">
                    <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.2s;">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-8">
                            <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                                <span class="mr-4 text-3xl">➕</span>
                                Crear Nuevo Usuario
                            </h3>
                            <p class="text-blue-100 text-base mt-2">Añade un nuevo usuario al sistema</p>
                        </div>

                        <form action="{{ route('admin.users.create') }}" method="POST" class="p-8 space-y-8" id="createUserForm">
                            @csrf

                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-lg font-bold text-high-contrast mb-3">
                                    <span class="flex items-center">
                                        <span class="mr-3 text-xl">👤</span>
                                        Nombre Completo
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" class="form-input-enhanced" id="name" name="name" required placeholder="Ingresa el nombre completo">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <span class="text-gray-400 text-xl" id="nameIcon">✏️</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-lg font-bold text-high-contrast mb-3">
                                    <span class="flex items-center">
                                        <span class="mr-3 text-xl">📧</span>
                                        Correo Electrónico
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="email" class="form-input-enhanced" id="email" name="email" required placeholder="usuario@ejemplo.com">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <span class="text-gray-400 text-xl" id="emailIcon">✉️</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-lg font-bold text-high-contrast mb-3">
                                    <span class="flex items-center">
                                        <span class="mr-3 text-xl">🔒</span>
                                        Contraseña
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="password" class="form-input-enhanced" id="password" name="password" required placeholder="Contraseña segura">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <span class="text-gray-400 cursor-pointer text-xl" id="passwordToggle" onclick="togglePassword()">👁️</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin Checkbox -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-600">
                                <div class="flex items-center">
                                    <input type="checkbox" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" id="is_admin" name="is_admin" value="1">
                                    <label class="ml-4 block text-lg font-bold text-high-contrast" for="is_admin">
                                        <span class="flex items-center">
                                            <span class="mr-3 text-xl">👑</span>
                                            Otorgar permisos de Administrador
                                        </span>
                                    </label>
                                </div>
                                <p class="text-medium-contrast mt-3 ml-10">
                                    Los administradores pueden gestionar usuarios, eventos y asistencias
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-primary w-full text-lg py-4 px-8" id="submitBtn">
                                <span class="mr-3 text-xl" id="submitIcon">✅</span>
                                <span id="submitText">Crear Usuario</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Users List -->
                <div class="lg:col-span-2">
                    <div class="card-enhanced animate-fade-in-delayed" style="animation-delay: 0.4s;">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-8">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                                        <span class="mr-4 text-3xl">📋</span>
                                        Lista de Usuarios
                                    </h3>
                                    <p class="text-green-100 text-base mt-2">{{ $users->count() }} usuarios registrados</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="px-4 py-2 bg-white bg-opacity-20 rounded-2xl text-white text-sm font-bold">
                                        Total: {{ $users->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid gap-6">
                                @foreach($users as $user)
                                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-600 p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] border border-gray-100 dark:border-gray-600 animate-fade-in-delayed" style="animation-delay: {{ 0.5 + ($loop->index * 0.1) }}s;">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-6">
                                                <!-- Avatar -->
                                                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl flex items-center justify-center shadow-lg">
                                                    <span class="text-white font-bold text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                </div>

                                                <!-- User Info -->
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-4">
                                                        <h4 class="text-2xl font-bold text-high-contrast" style="font-family: 'Playfair Display', serif;">{{ $user->name }}</h4>
                                                        <span class="px-4 py-2 text-sm rounded-2xl font-bold {{ $user->is_admin ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                                            {{ $user->is_admin ? '👑 Admin' : '🙏 Usuario' }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center mt-2">
                                                        <span class="text-medium-contrast mr-3 text-lg">📧</span>
                                                        <p class="text-medium-contrast text-lg">{{ $user->email }}</p>
                                                    </div>
                                                    <div class="flex items-center mt-2">
                                                        <span class="text-medium-contrast mr-3 text-lg">📅</span>
                                                        <p class="text-low-contrast">
                                                            Registrado: {{ $user->created_at->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex items-center space-x-3">
                                                <button onclick="editUser({{ $user->id }})" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold transition-all duration-200 transform hover:scale-105 shadow-md flex items-center" title="Editar usuario">
                                                    <span class="mr-2">✏️</span>
                                                    Editar
                                                </button>
                                                @if(auth()->id() !== $user->id)
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold transition-all duration-200 transform hover:scale-105 shadow-md flex items-center" title="Eliminar usuario">
                                                        <span class="mr-2">🗑️</span>
                                                        Eliminar
                                                    </button>
                                                </form>
                                                @else
                                                <div class="px-4 py-2 bg-gray-300 text-gray-600 rounded-xl font-bold cursor-not-allowed" title="No puedes eliminar tu propia cuenta">
                                                    <span class="mr-2">🔒</span>
                                                    Tú
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if($users->isEmpty())
                                <div class="text-center py-16">
                                    <div class="text-8xl mb-6 animate-bounce">👥</div>
                                    <h3 class="text-2xl font-bold text-medium-contrast mb-4">No hay usuarios registrados</h3>
                                    <p class="text-low-contrast text-lg">Crea el primer usuario usando el formulario</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-8 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-white flex items-center" style="font-family: 'Playfair Display', serif;">
                        <span class="mr-4 text-3xl">✏️</span>
                        Editar Usuario
                    </h3>
                    <button onclick="closeEditModal()" class="text-white hover:text-gray-200 text-3xl font-bold">×</button>
                </div>
            </div>

            <form id="editUserForm" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_name" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">👤</span>
                            Nombre Completo
                        </span>
                    </label>
                    <input type="text" class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_name" name="name" required>
                </div>

                <div>
                    <label for="edit_email" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">📧</span>
                            Correo Electrónico
                        </span>
                    </label>
                    <input type="email" class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_email" name="email" required>
                </div>

                <div>
                    <label for="edit_password" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                        <span class="flex items-center">
                            <span class="mr-3 text-xl">🔒</span>
                            Nueva Contraseña (opcional)
                        </span>
                    </label>
                    <input type="password" class="w-full px-4 py-3 text-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" id="edit_password" name="password" placeholder="Dejar en blanco para mantener la actual">
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-2xl">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-6 h-6 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500" id="edit_is_admin" name="is_admin" value="1">
                        <label class="ml-4 block text-lg font-bold text-gray-900 dark:text-gray-100" for="edit_is_admin">
                            <span class="flex items-center">
                                <span class="mr-3 text-xl">👑</span>
                                Administrador
                            </span>
                        </label>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-bold text-lg transition-all">
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
        // Edit user modal
        function editUser(userId) {
            fetch(`/admin/users/${userId}/edit`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('edit_name').value = user.name;
                    document.getElementById('edit_email').value = user.email;
                    document.getElementById('edit_password').value = '';
                    document.getElementById('edit_is_admin').checked = user.is_admin;
                    document.getElementById('editUserForm').action = `/admin/users/${userId}`;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Form validation and loading states
        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitIcon = document.getElementById('submitIcon');
            const submitText = document.getElementById('submitText');

            submitBtn.disabled = true;
            submitIcon.textContent = '⏳';
            submitText.textContent = 'Creando usuario...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        });

        // Real-time validation feedback
        document.getElementById('name').addEventListener('input', function() {
            const icon = document.getElementById('nameIcon');
            if (this.value.length > 0) {
                icon.textContent = '✅';
                icon.className = 'text-green-500';
            } else {
                icon.textContent = '✏️';
                icon.className = 'text-gray-400';
            }
        });

        document.getElementById('email').addEventListener('input', function() {
            const icon = document.getElementById('emailIcon');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(this.value)) {
                icon.textContent = '✅';
                icon.className = 'text-green-500';
            } else if (this.value.length > 0) {
                icon.textContent = '❌';
                icon.className = 'text-red-500';
            } else {
                icon.textContent = '✉️';
                icon.className = 'text-gray-400';
            }
        });
    </script>
</x-app-layout>