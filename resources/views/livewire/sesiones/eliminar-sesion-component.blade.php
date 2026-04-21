<x-dialog-modal wire:model="modalAbierto">

    <x-slot name="title">
        Confirmar eliminación        
    </x-slot>

    <x-slot name="content">
        {{-- Mensaje informativo con el nombre del ponente de la sesión --}}
        <div class="text-base text-gray-600">
            ¿Estás seguro de que deseas eliminar la sesión del ponente: 
            <span class="font-bold text-black">{{ $ponente }}</span>?
        </div>
        <div class="mt-2 text-sm text-red-500">
            Esta acción no se puede deshacer.
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            {{-- Botón Eliminar con el mismo estilo de componente que Eventos --}}
            <x-primary-button type="button" class="bg-red-600 hover:bg-red-700" wire:click="eliminar">
                Eliminar
            </x-primary-button>
            
            <x-secondary-button type="button" wire:click="cancelar">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>

</x-dialog-modal>