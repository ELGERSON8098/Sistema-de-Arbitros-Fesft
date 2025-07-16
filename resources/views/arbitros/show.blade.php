<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Detalles del Árbitro") }}
            </h2>
            <div class="flex space-x-2">
                @can("update", $arbitro)
                    <a href="{{ route("arbitros.edit", $arbitro) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                @endcan
                <a href="{{ route("arbitros.index") }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire("arbitros-show", ["arbitro" => $arbitro])
        </div>
    </div>
</x-app-layout>

