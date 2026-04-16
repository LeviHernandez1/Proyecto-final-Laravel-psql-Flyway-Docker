<div>
    <div class="flex justify-end items-center mt-5 mb-2">
        <x-action-button class="bg-emerald-600 flex items-center gap-2 w-auto px-4 text-base rounded-md"
            wire:click="$dispatch('abrir-modal-registrar-reservacion', { idReservacion: null })">
            <i class="fa-solid fa-plus"></i>
            <span>Agregar</span>
        </x-action-button>
    </div>

    <div class="overflow-x-auto">
        <div class="w-full lg:w-[900px] mx-auto my-4">

            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="text-centrado text-base">Sala</th>
                        <th class="text-centrado text-base">Fecha</th>
                        <th class="text-centrado text-base">Horario</th>
                        <th class="text-centrado text-base">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($this->reservaciones as $reservacion)
                        <tr>
                            <td class="text-centrado text-base">
                                {{ $reservacion->sala->nombre }}
                            </td>

                            <td class="text-centrado text-base">
                                {{ $reservacion->fecha }}
                            </td>

                            <td class="text-centrado text-base">
                                {{ $reservacion->hora_inicio }} - {{ $reservacion->hora_fin }}
                            </td>

                            <td class="text-centrado text-base">
                                <div class="flex gap-2 justify-center">
                                    <x-action-button class="bg-sky-600 ml-3" data-tippy="Editar"
                                        wire:click="$dispatch('abrir-modal-registrar-reservacion', {
                                                idReservacion: {{ $reservacion->id_reservaciones }}
                                            })">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </x-action-button>
                                    <x-action-button class="bg-red-500 ml-3" data-tippy="Eliminar"
                                        wire:click="$dispatch('abrir-modal-eliminar-reservacion', {
                                                idReservacion: {{ $reservacion->id_reservaciones }},
                                                sala: '{{ $reservacion->sala->nombre }}'
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
    <livewire:reservaciones.registrar-reservaciones-component />
</div>
