<form wire:submit.prevent="save">
    <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="jornada_id" class="block text-sm font-medium text-gray-700">Jornada</label>
                    <select wire:model="jornada_id" id="jornada_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una jornada</option>
                        @foreach($jornadas as $jornada)
                            <option value="{{ $jornada->id }}">{{ $jornada->nombre }} - {{ $jornada->division }} División ({{ $jornada->temporada }})</option>
                        @endforeach
                    </select>
                    @error('jornada_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="sede" class="block text-sm font-medium text-gray-700">Sede (Estadio)</label>
                    <input type="text" wire:model="sede" id="sede" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('sede') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="local_id" class="block text-sm font-medium text-gray-700">Equipo Local</label>
                    <select wire:model="local_id" id="local_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione el equipo local</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}">{{ $equipo->nombre }} ({{ $equipo->division }})</option>
                        @endforeach
                    </select>
                    @error('local_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="visitante_id" class="block text-sm font-medium text-gray-700">Equipo Visitante</label>
                    <select wire:model="visitante_id" id="visitante_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione el equipo visitante</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}">{{ $equipo->nombre }} ({{ $equipo->division }})</option>
                        @endforeach
                    </select>
                    @error('visitante_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del Partido</label>
                    <input type="date" wire:model="fecha" id="fecha" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('fecha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="hora" class="block text-sm font-medium text-gray-700">Hora del Partido</label>
                    <input type="time" wire:model="hora" id="hora" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('hora') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </div>
</form>

