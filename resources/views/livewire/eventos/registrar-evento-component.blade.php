<x-dialog-modal wire:model="mostrarModal">
    <x-slot name="title">
        {{-- Ajustamos para usar la propiedad esEdicion del form --}}
        {{ $form->esEdicion ? 'Editar Evento' : 'Nuevo Evento' }}
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 gap-4">
            <div class="flex flex-col">
                <x-input-label>Nombre del Evento <span class="text-red-500">*</span></x-input-label>
                {{-- Agregamos form. antes del nombre de la propiedad --}}
                <x-text-input wire:model="form.nombre" type="text" class="w-full" />
                
                @error('form.nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <x-input-label>Fecha <span class="text-red-500">*</span></x-input-label>
                    <x-text-input wire:model="form.fecha" type="date" />
                    @error('form.fecha')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <x-input-label>Capacidad <span class="text-red-500">*</span></x-input-label>
                    <x-text-input wire:model="form.capacidad" type="number" />
                    @error('form.capacidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col">
                <x-input-label>Lugar <span class="text-red-500">*</span></x-input-label>
                <x-text-input wire:model="form.lugar" type="text" />
                @error('form.lugar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        {{-- Usamos mostrarModal para cerrar, coincidiendo con el componente PHP --}}
        <x-secondary-button wire:click="cancelar">Cancelar</x-secondary-button>
        <x-primary-button class="ml-3" wire:click="guardar">Guardar</x-primary-button>
    </x-slot>
</x-dialog-modal>