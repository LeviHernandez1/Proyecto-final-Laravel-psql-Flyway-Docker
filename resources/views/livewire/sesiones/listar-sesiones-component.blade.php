<div>
    {{-- Botón de Agregar con Dispatch --}}
    <div class="flex justify-end items-center mt-5 mb-2">
        <x-action-button class="bg-emerald-600 flex items-center gap-2 w-auto px-4 text-base rounded-md"
            wire:click="$dispatch('editar-sesion', { id: null })">
            <i class="fa-solid fa-plus"></i>
            <span>Agregar Sesión</span>
        </x-action-button>
    </div>

    <div class="overflow-x-auto">
        <div class="w-full lg:w-[900px] mx-auto my-4">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="text-centrado text-base p-2">Evento</th>
                        <th class="text-centrado text-base p-2">Ponente</th>
                        <th class="text-centrado text-base p-2">Fecha y Hora</th>
                        <th class="text-centrado text-base p-2">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($this->sesiones as $sesion)
                        <tr wire:key="sesion-{{ $sesion->id_sesion }}">
                            <td class="text-centrado text-base p-2">
                                {{ $sesion->evento->nombre }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                {{ $sesion->ponente }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                {{ $sesion->fecha->format('d/m/Y') }} - {{ $sesion->horario }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                <div class="flex gap-2 justify-center">
                                    {{-- Botón Editar --}}
                                    <x-action-button class="bg-sky-600 ml-3" data-tippy="Editar"
                                        wire:click="$dispatch('editar-sesion', { id: {{ $sesion->id_sesion }} })">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </x-action-button>

                                    {{-- Botón Eliminar --}}
                                    <x-action-button class="bg-red-500 ml-3" data-tippy="Eliminar"
                                        wire:click="eliminar({{ $sesion->id_sesion }})"
                                        wire:confirm="¿Deseas eliminar la sesión de {{ $sesion->ponente }}?">
                                        <i class="fa-solid fa-trash"></i>
                                    </x-action-button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Componente del Modal de Registro (Asegúrate de que el nombre sea correcto) --}}
    @livewire('sesiones.registrar-sesiones-component')

    {{-- Si tienes un componente específico para eliminar sesiones, lo agregas aquí --}}
</div>