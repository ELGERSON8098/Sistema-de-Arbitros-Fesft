<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Asignar Árbitros al Partido") }}
            </h2>
            <a href="{{ route("partidos.show", $partido) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver al Partido
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire("asignacion-arbitral", ["partido" => $partido])
        </div>
    </div>
</x-app-layout>

