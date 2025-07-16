<form wire:submit.prevent="save">
    <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Equipo</label>
                    <input type="text" wire:model="nombre" id="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-2">
                    <label for="division" class="block text-sm font-medium text-gray-700">División</label>
                    <select wire:model="division" id="division" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una división</option>
                        <option value="Primera">Primera División</option>
                        <option value="Segunda">Segunda División</option>
                        <option value="Tercera">Tercera División</option>
                    </select>
                    @error('division') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="sede" class="block text-sm font-medium text-gray-700">Sede (Estadio)</label>
                    <input type="text" wire:model="sede" id="sede" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('sede') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación Geográfica</label>
                    <input type="text" wire:model="ubicacion" id="ubicacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('ubicacion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6">
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo del Equipo</label>
                    <input type="file" wire:model="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}" class="mt-2 h-20 w-20 object-cover rounded">
                    @elseif ($currentLogo)
                        <img src="{{ Storage::url($currentLogo) }}" class="mt-2 h-20 w-20 object-cover rounded">
                    @endif
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

