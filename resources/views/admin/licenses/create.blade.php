<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
            <i class="fa-solid fa-key text-red-600"></i> Ajouter une Nouvelle Licence
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                
                <form action="{{ route('admin.licenses.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nom du Logiciel / Service</label>
                        <input type="text" name="name" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0" placeholder="ex: Microsoft 365 Business, Check Point VPN, Adobe CC">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Clé de Licence / Code d'activation</label>
                            <input type="text" name="license_key" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white font-mono focus:border-red-600 focus:ring-0" placeholder="XXXXX-XXXXX-XXXXX">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Catégorie (Proposée ou Nouvelle)</label>
                            <input type="text" name="category_name" list="categories-list" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0" placeholder="Tapez ou choisissez...">
                            <datalist id="categories-list">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nombre total de postes (Seats)</label>
                            <input type="number" name="total_seats" min="1" value="5" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Date d'expiration</label>
                            <input type="date" name="expiration_date" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <a href="{{ route('admin.licenses.index') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold">Annuler</a>
                        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition">Enregistrer la licence</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>