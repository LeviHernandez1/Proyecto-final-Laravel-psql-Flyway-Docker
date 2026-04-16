<x-dialog-modal wire:model="modalAbierto">

    <x-slot name="title">
        {{ $form->esEdicion ? 'Editar reservación' : 'Nueva reservación' }}
    </x-slot>

    <x-slot name="content">
        <div class="Leyenda mb-4">
            Los campos marcados con <span class="text-red-500">*</span> son obligatorios.
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <x-input-label>
                    Sala <span class="text-red-500">*</span>
                </x-input-label>
                <select wire:model="form.id_sala" wire:blur="liveValidation('id_sala')" class="border p-2">
                    <option value="">Seleccione una sala</option>
                    @foreach ($this->salas as $sala)
                        <option value="{{ $sala->id_sala }}">{{ $sala->nombre }}</option>
                    @endforeach
                </select>
                @error('form.id_sala')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <x-input-label>
                    Fecha de reservación <span class="text-red-500">*</span>
                </x-input-label>
                <input type="date" wire:model="form.fecha" wire:blur="liveValidation('fecha')" class="border p-2">
                @error('form.fecha')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <x-input-label>
                    Hora de inicio de la reservación <span class="text-red-500">*</span>
                </x-input-label>
                <input type="time" wire:model="form.hora_inicio" wire:blur="liveValidation('hora_inicio')"
                    class="border p-2">
                @error('form.hora_inicio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <x-input-label>
                    Hora de fin de la reservación <span class="text-red-500">*</span>
                </x-input-label>
                <input type="time" wire:model="form.hora_fin" wire:blur="liveValidation('hora_fin')"
                    class="border p-2">
                @error('form.hora_fin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>

    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <x-primary-button type="button" wire:click="guardar">
                Guardar
            </x-primary-button>

            <x-secondary-button type="button" wire:click="cancelar">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>

</x-dialog-modal>
