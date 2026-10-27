<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
            <i class="fa-solid fa-pen-to-square text-amber-600"></i> Modifier la licence : {{ $license->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                
                <form action="{{ route('admin.licenses.update', $license->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nom du Logiciel / Service</label>
                        <input type="text" name="name" value="{{ old('name', $license->name) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Clé de Licence / Code</label>
                            <input type="text" name="license_key" value="{{ old('license_key', $license->license_key) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white font-mono focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Catégorie</label>
                            <input type="text" name="category_name" list="categories-list" value="{{ old('category_name', $license->category->name ?? '') }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                            <datalist id="categories-list">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nombre total de postes</label>
                            <input type="number" name="total_seats" min="1" value="{{ old('total_seats', $license->total_seats) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Date d'expiration</label>
                            <input type="date" name="expiration_date" value="{{ old('expiration_date', $license->expiration_date ? \Carbon\Carbon::parse($license->expiration_date)->format('Y-m-d') : '') }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <a href="{{ route('admin.licenses.index') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold">Annuler</a>
                        <button type="submit" class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-sm font-semibold transition">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>