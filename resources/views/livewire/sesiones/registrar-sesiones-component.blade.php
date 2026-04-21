<x-dialog-modal wire:model="mostrarModal">
    <x-slot name="title">
        {{ $form->id_sesion ? 'Editar Sesión' : 'Nueva Sesión' }}
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 gap-4 text-left">
            {{-- Selección de Evento --}}
            <div class="flex flex-col">
                <x-input-label>Evento Correspondiente <span class="text-red-500">*</span></x-input-label>
                <select wire:model="form.id_evento" 
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="">-- Selecciona un evento --</option>
                    @foreach ($eventos as $evento)
                        <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                    @endforeach
                </select>
                @error('form.id_evento')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Nombre del Ponente --}}
            <div class="flex flex-col">
                <x-input-label>Nombre del Ponente <span class="text-red-500">*</span></x-input-label>
                <x-text-input wire:model="form.ponente" type="text" class="w-full" placeholder="Ej. Dr. Juan Pérez" />
                @error('form.ponente')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Fecha --}}
                <div class="flex flex-col">
                    <x-input-label>Fecha <span class="text-red-500">*</span></x-input-label>
                    <x-text-input wire:model="form.fecha" type="date" />
                    @error('form.fecha')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Horario --}}
                <div class="flex flex-col">
                    <x-input-label>Horario <span class="text-red-500">*</span></x-input-label>
                    <x-text-input wire:model="form.horario" type="time" />
                    @error('form.horario')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="cancelar">Cancelar</x-secondary-button>
        <x-primary-button class="ml-3" wire:click="guardar">Guardar</x-primary-button>
    </x-slot>
</x-dialog-modal>