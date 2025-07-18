<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Editar Partido") }}: {{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route("partidos.show", $partido) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Ver
                </a>
                <a href="{{ route("partidos.index") }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @livewire("partidos-form", ["partido" => $partido])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

