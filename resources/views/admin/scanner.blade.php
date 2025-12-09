<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Escáner de QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white bg-opacity-5 rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-32 h-32 bg-white bg-opacity-5 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-5xl mr-4">📱</span>
                            <div>
                                <h1 class="text-3xl font-bold mb-1">Escáner QR de Asistencias</h1>
                                <p class="text-yellow-100">Registra asistencias escaneando códigos QR</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl text-white font-semibold hover:bg-opacity-30 transition-all duration-300">
                            <span class="mr-2">←</span> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Event Selection & Controls -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Event Selector -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <span class="mr-3 text-2xl">🎯</span>
                                Seleccionar Evento
                            </h3>
                            <p class="text-yellow-100 text-sm mt-1">Elige el evento para registrar asistencias</p>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="event_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        <span class="flex items-center">
                                            <span class="mr-2">📅</span>
                                            Evento Activo
                                        </span>
                                    </label>
                                    <select class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-gray-300 transition-all duration-300 text-sm" id="event_id">
                                        <option value="">Selecciona un evento</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="bg-yellow-50 dark:bg-yellow-900/10 p-4 rounded-xl border border-yellow-200 dark:border-yellow-700">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-yellow-800 dark:text-yellow-200 font-medium">Estado:</span>
                                        <span id="eventStatus" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                            Esperando selección
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Camera Controls -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <span class="mr-3 text-2xl">📷</span>
                                Controles de Cámara
                            </h3>
                            <p class="text-green-100 text-sm mt-1">Gestiona la captura de QR</p>
                        </div>

                        <div class="p-6 space-y-4">
                            <button id="start-button" class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 border border-transparent rounded-xl font-bold text-white text-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <span class="mr-3 text-2xl" id="startIcon">📷</span>
                                <span id="startText">Iniciar Cámara</span>
                            </button>

                            <button id="stop-button" class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-xl font-bold text-white text-lg hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 shadow-lg hidden">
                                <span class="mr-3 text-2xl" id="stopIcon">⏹️</span>
                                <span id="stopText">Detener Cámara</span>
                            </button>

                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600 dark:text-gray-400">Estado de la cámara:</span>
                                    <span id="cameraStatus" class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">
                                        Inactiva
                                    </span>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Asegúrate de permitir el acceso a la cámara en tu navegador
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <span class="mr-3 text-2xl">📊</span>
                                Estadísticas Rápidas
                            </h3>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Escaneos hoy:</span>
                                <span id="scansToday" class="font-bold text-blue-600">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Último escaneo:</span>
                                <span id="lastScan" class="font-bold text-green-600">-</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Tasa de éxito:</span>
                                <span id="successRate" class="font-bold text-purple-600">0%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Camera & Results -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Camera View -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <span class="mr-3 text-2xl">📱</span>
                                Vista de Cámara
                            </h3>
                            <p class="text-purple-100 text-sm mt-1">Enfoca el código QR dentro del área marcada</p>
                        </div>

                        <div class="p-6">
                            <div class="relative">
                                <div id="reader" class="w-full max-w-md mx-auto bg-gray-100 dark:bg-gray-700 rounded-2xl overflow-hidden shadow-inner border-4 border-dashed border-gray-300 dark:border-gray-600 relative" style="aspect-ratio: 1;" role="region" aria-label="Área de escaneo de códigos QR">
                                    <!-- Crosshair / focus overlay -->
                                    <div class="scan-crosshair pointer-events-none absolute inset-0 flex items-center justify-center" aria-hidden="true">
                                        <div class="w-64 h-64 border-2 border-white/40 rounded-md"></div>
                                        <svg class="absolute w-12 h-12 text-white/80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 2v4M12 18v4M2 12h4M18 12h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Scanning overlay -->
                                <div id="scanningOverlay" class="absolute inset-0 bg-green-500 bg-opacity-20 hidden">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-4 animate-bounce">
                                                <span class="text-white text-2xl">✅</span>
                                            </div>
                                            <p class="text-green-800 font-bold">¡Código detectado!</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- No camera message -->
                                <div id="noCameraMessage" class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-2xl hidden">
                                    <div class="text-center p-6">
                                        <div class="text-6xl mb-4">📷</div>
                                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Cámara no disponible</h4>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Activa la cámara para comenzar a escanear códigos QR</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Coloca el código QR dentro del área de escaneo para una detección automática. Pulsa <kbd class="px-2 py-1 bg-gray-100 rounded">S</kbd> para iniciar/detener la cámara, <kbd class="px-2 py-1 bg-gray-100 rounded">C</kbd> para limpiar el historial.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Results & Messages -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-6">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <span class="mr-3 text-2xl">📋</span>
                                Resultados y Mensajes
                            </h3>
                            <p class="text-indigo-100 text-sm mt-1">Historial de escaneos y notificaciones</p>
                        </div>

                        <div class="p-6">
                            <div id="result" class="space-y-4">
                                <!-- Default message -->
                                <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <span class="text-2xl mr-3">ℹ️</span>
                                        <div>
                                            <h4 class="font-semibold text-blue-800 dark:text-blue-200">Listo para escanear</h4>
                                            <p class="text-blue-600 dark:text-blue-400 text-sm">Selecciona un evento e inicia la cámara para comenzar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent scans -->
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <span class="mr-2">🕒</span>
                                    Escaneos Recientes
                                </h4>
                                <div id="recentScans" class="space-y-2 max-h-48 overflow-y-auto">
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                                        <span class="text-2xl mb-2 block">📋</span>
                                        No hay escaneos recientes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <style>
        /* Small custom styles for scanner crosshair and subtle animation */
        .scan-crosshair > div { box-shadow: 0 8px 30px rgba(9,10,31,0.08); }
        @keyframes pulseBorder { 0% { box-shadow: 0 0 0 0 rgba(99,102,241,0.08);} 70% { box-shadow: 0 0 0 18px rgba(99,102,241,0);} 100% { box-shadow: 0 0 0 0 rgba(99,102,241,0);} }
        .scanning-border { animation: pulseBorder 1.6s infinite; }
        .animate-fade-in { animation: fadeIn 0.35s ease-in-out; }
    </style>
    <script>
        // Keyboard shortcuts: S -> start/stop, C -> clear history
        document.addEventListener('keydown', function(e) {
            // avoid interfering with inputs
            const tag = document.activeElement.tagName.toLowerCase();
            if (tag === 'input' || tag === 'textarea' || document.activeElement.isContentEditable) return;

            if (e.key.toLowerCase() === 's') {
                const startBtn = document.getElementById('start-button');
                const stopBtn = document.getElementById('stop-button');
                if (startBtn && !startBtn.classList.contains('hidden')) startBtn.click();
                else if (stopBtn && !stopBtn.classList.contains('hidden')) stopBtn.click();
            }

            if (e.key.toLowerCase() === 'c') {
                recentScans = [];
                updateRecentScansList();
                showMessage('Historial limpiado', 'info');
            }
        });
        let html5QrcodeScanner = null;
        let eventId = null;
        let scanCount = 0;
        let successCount = 0;
        let recentScans = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateEventStatus();
            updateStats();
        });

        // Event selection handler
        document.getElementById('event_id').addEventListener('change', function() {
            eventId = this.value;
            updateEventStatus();

            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                resetCameraUI();
            }
        });

        // Start camera
        document.getElementById('start-button').addEventListener('click', function() {
            if (!eventId) {
                showMessage('Selecciona un evento primero', 'warning');
                return;
            }

            const readerElement = document.getElementById('reader');
            readerElement.innerHTML = '';

            html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                aspectRatio: 1.0,
                showTorchButtonIfSupported: true,
                showZoomSliderIfSupported: true
            }, false);

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);

            updateCameraStatus('Activa');
            toggleCameraButtons(true);
            document.getElementById('noCameraMessage').classList.add('hidden');
        });

        // Stop camera
        document.getElementById('stop-button').addEventListener('click', function() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            resetCameraUI();
        });

        // Scan success handler
        function onScanSuccess(decodedText, decodedResult) {
            scanCount++;
            showScanningOverlay();

            if (!eventId) {
                showMessage('Selecciona un evento primero', 'warning');
                hideScanningOverlay();
                return;
            }

            fetch('{{ route("admin.markAttendance") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    qr_data: decodedText,
                    event_id: eventId
                })
            })
            .then(response => response.json())
            .then(data => {
                hideScanningOverlay();

                if (data.success) {
                    successCount++;
                    showMessage(data.message, 'success');
                    addRecentScan(data.user_name || 'Usuario', 'success');
                } else {
                    showMessage(data.message, 'error');
                    addRecentScan('Error', 'error');
                }

                updateStats();
            })
            .catch(error => {
                hideScanningOverlay();
                showMessage('Error de conexión', 'error');
                addRecentScan('Error de conexión', 'error');
                updateStats();
            });
        }

        // Scan failure handler
        function onScanFailure(error) {
            // Silent failure - only log if needed
            console.warn(`Scan error: ${error}`);
        }

        // UI Helper functions
        function showMessage(message, type) {
            const resultDiv = document.getElementById('result');
            const colors = {
                success: 'bg-green-100 border-green-400 text-green-700',
                error: 'bg-red-100 border-red-400 text-red-700',
                warning: 'bg-yellow-100 border-yellow-400 text-yellow-700',
                info: 'bg-blue-100 border-blue-400 text-blue-700'
            };

            const icons = {
                success: '✅',
                error: '❌',
                warning: '⚠️',
                info: 'ℹ️'
            };

            resultDiv.innerHTML = `
                <div class="border-l-4 p-4 rounded-r-xl ${colors[type]} animate-fade-in">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">${icons[type]}</span>
                        <div>
                            <p class="font-semibold">${message}</p>
                            <p class="text-sm opacity-75">${new Date().toLocaleTimeString()}</p>
                        </div>
                    </div>
                </div>
            `;

            // Auto-hide success messages after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    resultDiv.innerHTML = `
                        <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">ℹ️</span>
                                <div>
                                    <h4 class="font-semibold text-blue-800 dark:text-blue-200">Listo para escanear</h4>
                                    <p class="text-blue-600 dark:text-blue-400 text-sm">Selecciona un evento e inicia la cámara para continuar</p>
                                </div>
                            </div>
                        </div>
                    `;
                }, 5000);
            }
        }

        function showScanningOverlay() {
            document.getElementById('scanningOverlay').classList.remove('hidden');
            // add subtle effect to reader border
            const reader = document.getElementById('reader');
            if (reader) reader.classList.add('scanning-border');
        }

        function hideScanningOverlay() {
            document.getElementById('scanningOverlay').classList.add('hidden');
            const reader = document.getElementById('reader');
            if (reader) reader.classList.remove('scanning-border');
        }

        function updateEventStatus() {
            const statusElement = document.getElementById('eventStatus');
            if (eventId) {
                statusElement.textContent = 'Evento seleccionado';
                statusElement.className = 'px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold';
            } else {
                statusElement.textContent = 'Esperando selección';
                statusElement.className = 'px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold';
            }
        }

        function updateCameraStatus(status) {
            const statusElement = document.getElementById('cameraStatus');
            const colors = {
                'Activa': 'bg-green-100 text-green-800',
                'Inactiva': 'bg-gray-100 text-gray-800',
                'Error': 'bg-red-100 text-red-800'
            };

            statusElement.textContent = status;
            statusElement.className = `px-2 py-1 rounded-full text-xs font-medium ${colors[status] || colors['Inactiva']}`;
        }

        function toggleCameraButtons(isScanning) {
            const startBtn = document.getElementById('start-button');
            const stopBtn = document.getElementById('stop-button');

            if (isScanning) {
                startBtn.classList.add('hidden');
                stopBtn.classList.remove('hidden');
            } else {
                startBtn.classList.remove('hidden');
                stopBtn.classList.add('hidden');
            }
        }

        function resetCameraUI() {
            updateCameraStatus('Inactiva');
            toggleCameraButtons(false);
            document.getElementById('noCameraMessage').classList.remove('hidden');
        }

        function updateStats() {
            document.getElementById('scansToday').textContent = scanCount;
            document.getElementById('successRate').textContent = scanCount > 0 ? Math.round((successCount / scanCount) * 100) + '%' : '0%';
            document.getElementById('lastScan').textContent = recentScans.length > 0 ? new Date().toLocaleTimeString() : '-';
        }

        function addRecentScan(name, status) {
            const time = new Date().toLocaleTimeString();
            recentScans.unshift({ name, status, time });

            // Keep only last 10 scans
            if (recentScans.length > 10) {
                recentScans = recentScans.slice(0, 10);
            }

            updateRecentScansList();
        }

        function updateRecentScansList() {
            const container = document.getElementById('recentScans');

            if (recentScans.length === 0) {
                container.innerHTML = `
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                        <span class="text-2xl mb-2 block">📋</span>
                        No hay escaneos recientes
                    </div>
                `;
                return;
            }

            container.innerHTML = recentScans.map(scan => `
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center">
                        <span class="text-lg mr-3">${scan.status === 'success' ? '✅' : '❌'}</span>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-gray-100">${scan.name}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">${scan.time}</div>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full ${scan.status === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${scan.status === 'success' ? 'Éxito' : 'Error'}
                    </span>
                </div>
            `).join('');
        }
    </script>
</x-app-layout>