<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Administración de Sesiones</h1>
        @livewire('sesiones.registrar-sesion-component')
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">Evento</th>
                <th class="px-4 py-2 border">Ponente</th>
                <th class="px-4 py-2 border">Fecha</th>
                <th class="px-4 py-2 border">Horario</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->sesiones as $sesion)
                <tr wire:key="{{ $sesion->id_sesion }}">
                    <td class="px-4 py-2 border">{{ $sesion->evento->nombre }}</td>
                    <td class="px-4 py-2 border">{{ $sesion->ponente }}</td>
                    <td class="px-4 py-2 border">{{ $sesion->fecha }}</td>
                    <td class="px-4 py-2 border">{{ $sesion->horario }}</td>
                    <td class="px-4 py-2 border">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
