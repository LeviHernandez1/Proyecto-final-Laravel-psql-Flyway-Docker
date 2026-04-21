<div class="py-5">
    <div class="mb-6 border-b-2 border-primario-500 pb-2">
        <h2 class="text-2xl font-bold text-primario-600 uppercase tracking-wider">
            <i class="fa-solid fa-calendar-days mr-2"></i> Próximos Eventos y Sesiones
        </h2>
    </div>

    <div class="overflow-x-auto shadow-sm rounded-lg">
        <div class="w-full lg:w-[1000px] mx-auto my-4">

            <table class="w-full border-collapse bg-white">
                <thead class="bg-primario-500 text-white">
                    <tr>
                        <th class="p-3 text-center text-sm uppercase font-bold">Evento</th>
                        <th class="p-3 text-center text-sm uppercase font-bold">Ponente / Sesión</th>
                        <th class="p-3 text-center text-sm uppercase font-bold">Fecha</th>
                        <th class="p-3 text-center text-sm uppercase font-bold">Horario</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($this->eventos as $evento)
                        {{-- Iteramos sobre las sesiones de cada evento --}}
                        @foreach($evento->sesiones as $sesion)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-center text-base font-semibold text-gray-700">
                                    {{ $evento->nombre }}
                                </td>

                                <td class="p-4 text-center text-base text-gray-600">
                                    <div class="font-bold text-primario-700">{{ $sesion->ponente }}</div>
                                    <div class="text-xs text-gray-400 italic">Sesión programada</div>
                                </td>

                                <td class="p-4 text-center text-base text-gray-600">
                                    {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                                </td>

                                <td class="p-4 text-center text-base">
                                    <span class="bg-primario-100 text-primario-700 px-3 py-1 rounded-full font-medium">
                                        {{ \Carbon\Carbon::parse($sesion->horario)->format('H:i') }} hrs
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            @if($this->eventos->isEmpty())
                <div class="text-center py-10 bg-gray-50 border-2 border-dashed">
                    <p class="text-gray-400 text-lg">No hay eventos disponibles en este momento.</p>
                </div>
            @endif
        </div>
    </div>
</div>