<x-admin-layout>
    <div class="w-full h-full mx-auto flex-1 flex justify-center items-center">

        {{-- Módulo: Notificaciones Push --}}
        @can('admin.enviar-notificaciones-push')
            <section class="w-full max-w-2xl lg:max-w-5xl rounded-2xl bg-primary backdrop-blur shadow-lg py-4 sm:py-6 px-4 sm:px-6 mb-6">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <span class="icon-[material-symbols--notifications-active-outline-rounded] w-6 h-6 lg:w-8 lg:h-8 text-secondary"></span>
                        <h2 class="font-semibold text-light text-lg lg:text-2xl">Enviar notificación</h2>
                    </div>
                </div>

                @if (session('status'))
                    <div class="js-flash-alert mb-4 flex items-center gap-3 rounded-lg border border-green-400 bg-green-700/30 px-4 py-3 text-sm text-green-400 transition-opacity duration-500"
                        role="status">
                        <span class="icon-[material-symbols--check-circle-outline-rounded] w-5 h-5"></span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="js-flash-alert mb-4 flex items-center gap-3 rounded-lg border border-amber-400 bg-amber-700/30 px-4 py-3 text-sm text-amber-300 transition-opacity duration-500"
                        role="alert">
                        <span class="icon-[material-symbols--warning-outline-rounded] w-5 h-5"></span>
                        <span>{{ session('warning') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="js-flash-alert mb-4 flex items-start gap-3 rounded-lg border border-red-400 bg-red-700/30 px-4 py-3 text-sm text-red-300 transition-opacity duration-500"
                        role="alert">
                        <span class="icon-[material-symbols--error-outline-rounded] w-5 h-5 shrink-0 mt-0.5"></span>
                        <span class="wrap-break-word">{{ session('error') }}</span>
                    </div>
                @endif

                <x-toast-errors :errors="$errors" />

                <div class="w-full flex flex-col lg:flex-row gap-6">

                    {{-- Formulario de envío --}}
                    <form
                        action="{{ route('web.admin.notifications.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="flex-1 min-w-0 space-y-5"
                    >
                        @csrf

                        {{-- Audiencia --}}
                        <div>
                            <label for="user_type_id" class="block mb-2 text-sm font-medium text-light">Audiencia</label>
                            <select id="user_type_id"
                                    name="user_type_id"
                                    class="block w-full py-2.5 px-3 text-sm rounded-lg bg-light text-dark border border-complementary-dark/30 focus:ring-secondary focus:border-secondary">
                                <option value="">Todos los participantes</option>
                                @foreach($userTypes as $userType)
                                    <option value="{{ $userType->id }}" @selected(old('user_type_id') == $userType->id)>{{ $userType->plural_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- País y Línea --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="country_id" class="block mb-2 text-sm font-medium text-light">País</label>
                                <select id="country_id"
                                        name="country_id"
                                        class="block w-full py-2.5 px-3 text-sm rounded-lg bg-light text-dark border border-complementary-dark/30 focus:ring-secondary focus:border-secondary">
                                    <option value="">Todos los países</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="line_id" class="block mb-2 text-sm font-medium text-light">Línea</label>
                                <select id="line_id"
                                        name="line_id"
                                        class="block w-full py-2.5 px-3 text-sm rounded-lg bg-light text-dark border border-complementary-dark/30 focus:ring-secondary focus:border-secondary">
                                    <option value="">Todas las líneas</option>
                                    @foreach($lines as $line)
                                        <option value="{{ $line->id }}" @selected(old('line_id') == $line->id)>{{ $line->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Título --}}
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-light">Título</label>
                            <input type="text"
                                id="title"
                                name="title"
                                maxlength="100"
                                value="{{ old('title') }}"
                                placeholder="Ej. ¡Nueva jornada disponible!"
                                class="block w-full py-2.5 px-3 text-sm rounded-lg border bg-light text-dark border-complementary-dark/30 placeholder-zinc-400 focus:ring-secondary focus:border-secondary"
                                required />
                            <p class="mt-1 text-xs text-complementary-light">Máximo 100 caracteres.</p>
                        </div>

                        {{-- Mensaje --}}
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-light">Mensaje</label>
                            <textarea id="description"
                                    name="description"
                                    rows="4"
                                    maxlength="240"
                                    placeholder="Escribe el contenido de la notificación..."
                                    class="block w-full p-2.5 text-sm rounded-lg bg-light text-dark border-complementary-dark/30 placeholder-zinc-400 focus:ring-secondary focus:border-secondary"
                                    required>{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-complementary-light">Máximo 240 caracteres.</p>
                        </div>

                        {{-- Imagen opcional --}}
                        <div>
                            <label for="image" class="block mb-2 text-sm font-medium text-light">Imagen <span class="text-complementary-light font-normal">(opcional)</span></label>
                            <input type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                data-max-size="512000"
                                class="block w-full text-sm text-complementary-dark rounded-lg cursor-pointer bg-light border focus:outline-none focus:ring-secondary focus:border-secondary file:mr-3 file:py-2.5 file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-light hover:file:brightness-110" />
                            <p id="image-help" class="mt-1 text-xs text-complementary-light">Solo imágenes. Tamaño máximo 500 KB.</p>
                        </div>

                        {{-- Programar envío --}}
                        @php
                            $scheduleEnabledOld = old('schedule_enabled', '1') === '1';
                            $defaultScheduleDate = now()->addDay()->toDateString();
                            $defaultScheduleTime = '08:00';
                        @endphp
                        <div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="hidden" name="schedule_enabled" value="0">
                                <input type="checkbox"
                                       id="schedule_toggle"
                                       name="schedule_enabled"
                                       value="1"
                                       @checked($scheduleEnabledOld)
                                       class="sr-only peer">
                                <div class="relative w-11 h-6 bg-complementary-dark/40 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-secondary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:inset-s-0.5 after:bg-white after:border-complementary-dark/30 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary"></div>
                                <span class="ms-3 text-sm font-medium text-light">Programar envío</span>
                            </label>

                            <div id="schedule_fields" class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-5 {{ $scheduleEnabledOld ? '' : 'hidden' }}">
                                <div>
                                    <label for="send_at_date" class="block mb-2 text-sm font-medium text-light">Fecha de envío</label>
                                    <input type="date"
                                           id="send_at_date"
                                           name="send_at_date"
                                           min="{{ now()->toDateString() }}"
                                           value="{{ old('send_at_date', $defaultScheduleDate) }}"
                                           data-default="{{ $defaultScheduleDate }}"
                                           class="block w-full py-2.5 px-3 text-sm rounded-lg bg-light text-dark border border-complementary-dark/30 focus:ring-secondary focus:border-secondary" />
                                </div>
                                <div>
                                    <label for="send_at_time" class="block mb-2 text-sm font-medium text-light">Hora de envío</label>
                                    <input type="time"
                                           id="send_at_time"
                                           name="send_at_time"
                                           step="60"
                                           value="{{ old('send_at_time', $defaultScheduleTime) }}"
                                           data-default="{{ $defaultScheduleTime }}"
                                           class="block w-full py-2.5 px-3 text-sm rounded-lg bg-light text-dark border border-complementary-dark/30 focus:ring-secondary focus:border-secondary" />
                                </div>
                                <p class="sm:col-span-2 -mt-2 text-xs text-complementary-light">Se enviará a partir de la fecha y hora indicadas (mínimo 5 minutos en el futuro).</p>
                            </div>
                        </div>

                        {{-- Acciones --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-2">
                            <button type="reset"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-zinc-200  bg-red-800 hover:bg-red-700 hover:text-light transition-colors">
                                <span class="icon-[material-symbols--close-rounded] w-5 h-5"></span>
                                Limpiar
                            </button>
                            <button type="submit"
                                    id="submit_button"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold bg-secondary text-light hover:brightness-110 transition-colors">
                                <span id="submit_icon" class="{{ $scheduleEnabledOld ? 'icon-[material-symbols--schedule-send-outline-rounded]' : 'icon-[material-symbols--send-rounded]' }} w-5 h-5"></span>
                                <span id="submit_label">{{ $scheduleEnabledOld ? 'Programar notificación' : 'Enviar notificación' }}</span>
                            </button>
                        </div>
                    </form>

                    {{-- Vista previa --}}
                    <aside class="w-full lg:max-w-xs lg:shrink-0">
                        <p class="text-xs uppercase tracking-wider text-complementary-light mb-2">Vista previa</p>
                        <div class="rounded-xl border border-zinc-100 bg-zinc-600 backdrop-blur-xl p-4">
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('images/logos/logo-sm-dark.png') }}"
                                    alt="{{ config('app.name', 'Quiniela') }}"
                                    class="shrink-0 w-10 h-10 rounded-lg object-contain bg-complementary-primary p-1" />
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-sm font-semibold text-light truncate">{{ config('app.name', 'Quiniela') }}</span>
                                        <span class="text-[10px] text-complementary-light whitespace-nowrap">ahora</span>
                                    </div>
                                    <p id="preview-title" class="text-sm font-medium text-light mt-0.5">Título de la notificación</p>
                                    <p id="preview-body" class="text-xs text-complementary-light mt-1 line-clamp-3">El contenido de tu mensaje aparecerá aquí mientras lo escribes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl border border-zinc-400 bg-primary/20 p-4">
                            <p class="text-xs uppercase tracking-wider text-light mb-2">Tips</p>
                            <ul class="space-y-2 text-xs text-complementary-light">
                                <li class="flex items-start gap-2">
                                    <span class="icon-[material-symbols--check-circle-outline-rounded] w-4 h-4 text-secondary shrink-0 mt-0.5"></span>
                                    <span>Sé breve y claro en el título.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="icon-[material-symbols--check-circle-outline-rounded] w-4 h-4 text-secondary shrink-0 mt-0.5"></span>
                                    <span>Evita enviar más de 2 notificaciones al día.</span>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </section>

            <script>
                (() => {
                    document.querySelectorAll('.js-flash-alert').forEach((alert) => {
                        setTimeout(() => {
                            alert.classList.add('opacity-0');
                            setTimeout(() => alert.remove(), 500);
                        }, 3000);
                    });

                    const titleInput = document.getElementById('title');
                    const bodyInput = document.getElementById('description');
                    const imageInput = document.getElementById('image');
                    const imageHelp = document.getElementById('image-help');
                    const previewTitle = document.getElementById('preview-title');
                    const previewBody = document.getElementById('preview-body');

                    const defaultTitle = 'Título de la notificación';
                    const defaultBody = 'El contenido de tu mensaje aparecerá aquí mientras lo escribes.';
                    const defaultHelp = 'Solo imágenes. Tamaño máximo 500 KB.';

                    titleInput?.addEventListener('input', (e) => {
                        previewTitle.textContent = e.target.value.trim() || defaultTitle;
                    });

                    bodyInput?.addEventListener('input', (e) => {
                        previewBody.textContent = e.target.value.trim() || defaultBody;
                    });

                    const scheduleToggle = document.getElementById('schedule_toggle');
                    const scheduleFields = document.getElementById('schedule_fields');
                    const scheduleDate = document.getElementById('send_at_date');
                    const scheduleTime = document.getElementById('send_at_time');
                    const submitIcon = document.getElementById('submit_icon');
                    const submitLabel = document.getElementById('submit_label');

                    const sendIconClass = 'icon-[material-symbols--send-rounded]';
                    const scheduleIconClass = 'icon-[material-symbols--schedule-send-outline-rounded]';

                    const applyScheduleState = (enabled) => {
                        scheduleFields.classList.toggle('hidden', !enabled);
                        if (enabled) {
                            if (!scheduleDate.value) scheduleDate.value = scheduleDate.dataset.default ?? '';
                            if (!scheduleTime.value) scheduleTime.value = scheduleTime.dataset.default ?? '';
                        } else {
                            scheduleDate.value = '';
                            scheduleTime.value = '';
                        }
                        submitIcon?.classList.toggle(sendIconClass, !enabled);
                        submitIcon?.classList.toggle(scheduleIconClass, enabled);
                        if (submitLabel) {
                            submitLabel.textContent = enabled ? 'Programar notificación' : 'Enviar notificación';
                        }
                    };

                    scheduleToggle?.addEventListener('change', (e) => {
                        applyScheduleState(e.target.checked);
                    });

                    imageInput?.addEventListener('change', (e) => {
                        const file = e.target.files?.[0];

                        imageHelp.classList.remove('text-red-400');
                        imageHelp.classList.add('text-complementary-light');
                        imageHelp.textContent = defaultHelp;

                        if (!file) return;

                        const maxSize = parseInt(imageInput.dataset.maxSize, 10);

                        if (!file.type.startsWith('image/')) {
                            imageInput.value = '';
                            imageHelp.classList.remove('text-complementary-light');
                            imageHelp.classList.add('text-red-400');
                            imageHelp.textContent = 'El archivo seleccionado no es una imagen válida.';
                            return;
                        }

                        if (file.size > maxSize) {
                            imageInput.value = '';
                            imageHelp.classList.remove('text-complementary-light');
                            imageHelp.classList.add('text-red-400');
                            imageHelp.textContent = 'La imagen supera el tamaño máximo permitido (500 KB).';
                            return;
                        }

                        const sizeKb = (file.size / 1024).toFixed(1);
                        imageHelp.textContent = `Imagen seleccionada: ${file.name} (${sizeKb} KB).`;
                    });
                })();
            </script>
        @endcan

        {{-- Historial de envíos --}}
        {{-- @can('admin.ver-reportes')
        <section class="rounded-2xl bg-complementary-primary/80 backdrop-blur shadow-lg py-4 sm:py-6 px-4 sm:px-6 mb-6">

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <span class="icon-[material-symbols--history-rounded] w-6 h-6 lg:w-7 lg:h-7 text-secondary"></span>
                    <h2 class="font-semibold text-light text-base lg:text-xl">Historial reciente</h2>
                </div>
            </div>

            <div class="relative overflow-x-auto rounded-lg border border-complementary-dark/20">
                <table class="w-full text-sm text-left rtl:text-right text-complementary-light">
                    <thead class="text-xs uppercase bg-primary/70 text-light">
                        <tr>
                            <th scope="col" class="px-4 py-3">Fecha</th>
                            <th scope="col" class="px-4 py-3">Título</th>
                            <th scope="col" class="px-4 py-3">Audiencia</th>
                            <th scope="col" class="px-4 py-3 text-right">Destinatarios</th>
                            <th scope="col" class="px-4 py-3 text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $ejemplos = [
                                ['fecha' => '2026-04-20 18:05', 'titulo' => 'Recuerda enviar tus predicciones', 'audiencia' => 'Todos',       'destinatarios' => 420, 'ok' => true],
                                ['fecha' => '2026-04-18 09:30', 'titulo' => 'Resultados de la jornada 3',        'audiencia' => 'Activos',     'destinatarios' => 312, 'ok' => true],
                                ['fecha' => '2026-04-15 14:12', 'titulo' => 'Nueva trivia disponible',           'audiencia' => 'Dependientes','destinatarios' => 178, 'ok' => false],
                            ];
                        @endphp

                        @foreach($ejemplos as $row)
                            <tr class="border-t border-complementary-dark/20 hover:bg-primary/30 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap tabular-nums">{{ $row['fecha'] }}</td>
                                <td class="px-4 py-3 font-medium text-light">{{ $row['titulo'] }}</td>
                                <td class="px-4 py-3">{{ $row['audiencia'] }}</td>
                                <td class="px-4 py-3 text-right tabular-nums font-semibold text-light">{{ number_format($row['destinatarios']) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($row['ok'])
                                        <span class="inline-flex items-center gap-1 bg-secondary/20 text-secondary text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                            Enviada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-red-500/20 text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-300"></span>
                                            Parcial
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-4 text-xs text-complementary-light">
                <span>Mostrando <span class="font-semibold text-light">3</span> de <span class="font-semibold text-light">3</span> envíos</span>
            </div>
        </section>
        @endcan --}}
    </div>
</x-admin-layout>
