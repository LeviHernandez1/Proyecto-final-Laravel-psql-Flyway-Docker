<x-dialog-modal wire:model="modalAbierto">

    <x-slot name="title">
        Confirmar eliminación        
    </x-slot>

    <x-slot name="content">
        {{-- Agregamos un mensaje informativo con el nombre del evento --}}
        <div class="text-base text-gray-600">
            ¿Estás seguro de que deseas eliminar el evento: 
            <span class="font-bold text-black">{{ $nombre }}</span>?
        </div>
        <div class="mt-2 text-sm text-red-500">
            Esta acción no se puede deshacer.
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <x-primary-button type="button" wire:click="eliminar">
                Eliminar
            </x-primary-button>
            <x-secondary-button type="button" wire:click="cancelar">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>

</x-dialog-modal>