<div>
    {{-- Botón de Agregar con Dispatch --}}
    <div class="flex justify-end items-center mt-5 mb-2">
        <x-action-button class="bg-emerald-600 flex items-center gap-2 w-auto px-4 text-base rounded-md"
            wire:click="$dispatch('abrir-modal-registrar-evento', { idEvento: null })">
            <i class="fa-solid fa-plus"></i>
            <span>Agregar</span>
        </x-action-button>
    </div>

    <div class="overflow-x-auto">
        <div class="w-full lg:w-[900px] mx-auto my-4">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="text-centrado text-base p-2">Evento</th>
                        <th class="text-centrado text-base p-2">Lugar</th>
                        <th class="text-centrado text-base p-2">Fecha</th>
                        <th class="text-centrado text-base p-2">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($this->eventos as $evento)
                        <tr wire:key="evento-{{ $evento->id_evento }}">
                            <td class="text-centrado text-base p-2">
                                {{ $evento->nombre }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                {{ $evento->lugar }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                {{ $evento->fecha->format('d/m/Y') }}
                            </td>

                            <td class="text-centrado text-base p-2">
                                <div class="flex gap-2 justify-center">
                                    {{-- Botón Editar --}}
                                    <x-action-button class="bg-sky-600 ml-3" data-tippy="Editar"
                                        wire:click="$dispatch('abrir-modal-registrar-evento', {
                                                idEvento: {{ $evento->id_evento }}
                                            })">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </x-action-button>

                                    {{-- Botón Eliminar --}}
                                    <x-action-button class="bg-red-500 ml-3" data-tippy="Eliminar"
                                        wire:click="$dispatch('abrir-modal-eliminar-evento', {
                                                idEvento: {{ $evento->id_evento }},
                                                nombre: '{{ $evento->nombre }}'
                                            })">
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

    {{-- Componente del Modal de Registro --}}
    <livewire:eventos.registrar-evento-component />

    {{-- Componente del Modal de Eliminar --}}
    <livewire:eventos.eliminar-evento-component />
</div>
</div>
