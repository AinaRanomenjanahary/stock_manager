<x-app-layout>

@section('title')
    Produits
@endsection

<div class="min-h-screen bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER (TITLE + SEARCH + BUTTON) -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

            <!-- TITLE -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Produits</h1>
                <p class="text-gray-500">Gestion des produits</p>
            </div>

            <!-- SEARCH -->
            <form method="GET"
                  action="{{ route('produits.index') }}"
                  class="flex w-full md:w-1/3">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Rechercher un produit..."
                       class="w-full border rounded-l-lg p-2 focus:ring focus:ring-blue-200">

                <button type="submit"
                        class="bg-slate-200 text-white px-4 rounded-r-lg hover:bg-sky-300">
                    🔍
                </button>

            </form>

            <!-- ADD BUTTON -->
            <a href="{{ route('produits.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow text-center">
                + Ajouter produit
            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}
        @if (Session::has('status'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg">
                {{ Session::get('status') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="hidden md:block bg-white shadow-lg rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left">

                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Prix</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse ($produits as $produit)

                        <tr class="hover:bg-gray-50">

                            <!-- INDEX PAGINATION -->
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $produits->firstItem() + $loop->index }}
                            </td>

                            <!-- IMAGE -->
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($produit->product_image) }}"
                                     class="w-12 h-12 object-cover rounded-lg border">
                            </td>

                            <!-- NAME -->
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $produit->product_name }}
                            </td>

                            <!-- STOCK -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $produit->product_stock }}
                            </td>

                            <!-- PRICE -->
                            <td class="px-6 py-4 text-gray-800 font-semibold">
                                {{ number_format($produit->product_price, 0, ',', ' ') }} €
                            </td>

                            <!-- ACTIONS -->
                            <td class="px-6 py-4 text-right">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('produits.edit', $produit->id) }}"
                                       class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                        Modifier
                                    </a>

                                    <form action="{{ route('produits.destroy', $produit->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer ce produit ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Aucun produit enregistré
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        <!-- MOBILE CARDS -->
        <div class="md:hidden space-y-4">

            @forelse ($produits as $produit)

            <div class="bg-white p-4 rounded-xl shadow">

                <div class="flex items-center gap-4">

                    <img src="{{ Storage::url($produit->product_image) }}"
                         class="w-14 h-14 rounded-lg object-cover border">

                    <div>
                        <h2 class="font-semibold text-gray-800">
                            {{ $produit->product_name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            Stock: {{ $produit->product_stock }}
                        </p>

                        <p class="text-sm font-bold text-gray-700">
                            {{ number_format($produit->product_price, 0, ',', ' ') }} €
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex gap-2">

                    <a href="{{ route('produits.edit', $produit->id) }}"
                       class="flex-1 text-center px-3 py-2 text-sm rounded-lg bg-blue-100 text-blue-700">
                        Modifier
                    </a>

                    <form action="{{ route('produits.destroy', $produit->id) }}"
                          method="POST"
                          class="flex-1"
                          onsubmit="return confirm('Supprimer ce produit ?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="w-full px-3 py-2 text-sm rounded-lg bg-red-100 text-red-700">
                            Supprimer
                        </button>

                    </form>

                </div>

            </div>

            @empty

            <div class="text-center text-gray-500">
                Aucun produit enregistré
            </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $produits->withQueryString()->links() }}
        </div>

    </div>
</div>

</x-app-layout>
