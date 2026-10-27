<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace Distributeur - Logistique IT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-2">Bienvenue, Gestionnaire de Stock 📦</h3>
                <p>Ici, vous pouvez gérer les attributions de matériel, suivre les stocks et générer les fiches de décharge PDF.</p>
            </div>
        </div>
    </div>
</x-app-layout>