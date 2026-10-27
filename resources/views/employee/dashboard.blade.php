<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace Employé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-2">Bienvenue, Collaborateur 💻</h3>
                <p>Retrouvez ici le matériel et les licences qui vous sont attribués ainsi que vos fiches de décharge.</p>
            </div>
        </div>
    </div>
</x-app-layout>