<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto ">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-welcome />
        </div>
    </div>

</x-app-layout>
