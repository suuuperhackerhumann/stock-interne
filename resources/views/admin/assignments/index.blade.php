<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
                <i class="fa-solid fa-file-pdf text-red-600"></i> Fiches de Décharge & Attributions
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold hover:bg-neutral-300 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <p class="text-sm text-neutral-500 mb-4">
                    Historique des fiches de décharge générées lors de la remise d'équipements aux collaborateurs NOVASYS.
                </p>
                <div class="p-8 text-center border-2 border-dashed border-neutral-200 dark:border-neutral-800 rounded-lg">
                    <i class="fa-solid fa-file-circle-plus text-4xl text-red-600 mb-3"></i>
                    <h3 class="font-bold text-black dark:text-white">Générateur de Fiche de Décharge PDF</h3>
                    <p class="text-xs text-neutral-500 mt-1 max-w-md mx-auto">
                        Module prêt pour la création et la génération automatisée des fiches au format PDF.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>